#!/usr/bin/env node
/**
 * Fiverr profile + review fetcher for AR Software Solutions.
 * Fetches the public seller page, parses profile stats (JSON-LD) and
 * SSR-rendered reviews, then writes fiverr-data.json for the site.
 * Run manually:  node fiverr-update.mjs
 * Auto-run daily: .github/workflows/fiverr-refresh.yml (GitHub Actions)
 */

import fs from 'node:fs';
import path from 'node:path';

const SELLER = 'razaali975';
const PROFILE_URL = `https://www.fiverr.com/${SELLER}`;
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const OUT_FILE = path.join(__dirname, 'fiverr-data.json');
const MIN_REVIEW_LEN = 60;

const UA =
  'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36';

function htmlDecode(s) {
  return s
    .replace(/&quot;/g, '"')
    .replace(/&#39;|&apos;/g, "'")
    .replace(/&#x27;/g, "'")
    .replace(/&amp;/g, '&')
    .replace(/&lt;/g, '<')
    .replace(/&gt;/g, '>')
    .replace(/&#x([0-9a-f]+);/gi, (_, h) => String.fromCharCode(parseInt(h, 16)))
    .replace(/&#(\d+);/g, (_, d) => String.fromCharCode(+d))
    .replace(/&nbsp;/g, ' ')
    .replace(/<[^>]+>/g, ' ')
    .replace(/\s+/g, ' ')
    .trim();
}

function pick(matches, i) {
  return matches && matches[i] && matches[i].length > 1 ? htmlDecode(matches[i][1]) : '';
}

function countryFromFlag(alt) {
  const map = { US: 'United States', GB: 'United Kingdom', PK: 'Pakistan' };
  return map[alt] || alt;
}

import { execFileSync } from 'node:child_process';

function fetchWithCurl(url) {
  const args = [
    '-sS', '--compressed', '-L', '--max-time', '60',
    '-A', UA,
    '-H', 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
    '-H', 'Accept-Language: en-US,en;q=0.9',
    '-H', 'Upgrade-Insecure-Requests: 1',
    url,
  ];
  try {
    return execFileSync('curl', args, { encoding: 'utf8', maxBuffer: 8 * 1024 * 1024 });
  } catch (e) {
    throw new Error('curl fetch failed: ' + (e.stderr || e.message).toString().slice(0, 300));
  }
}

async function main() {
  let html = '';
  try {
    html = fetchWithCurl(PROFILE_URL);
  } catch (e) {
    console.warn('curl failed, falling back to fetch():', e.message);
  }
  if (!html) {
    const res = await fetch(PROFILE_URL, {
      headers: {
        'User-Agent': UA,
        'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'Accept-Language': 'en-US,en;q=0.9',
        'Upgrade-Insecure-Requests': '1',
      },
      redirect: 'follow',
    });
    if (!res.ok) throw new Error(`Fiverr returned HTTP ${res.status}`);
    html = await res.text();
  }
  if (!html || html.length < 50000) throw new Error('Suspiciously small page — likely blocked.');

  const out = { profile: {}, stats: {}, reviews: [], fetchedAt: new Date().toISOString(), source: PROFILE_URL };

  // ---- JSON-LD: profile + aggregate rating ----
  const ld = html.match(/<script type="application\/ld\+json">(.*?)<\/script>/s);
  if (ld) {
    try {
      const data = JSON.parse(ld[1]);
      const me = data.mainEntity || {};
      out.profile.name = me.name || '';
      out.profile.tagline = me.jobTitle || '';
      out.profile.avatar = me.image || '';
      out.profile.url = me.url || PROFILE_URL;
      if (me.aggregateRating) {
        out.stats.rating = parseFloat(me.aggregateRating.ratingValue) || 0;
        out.stats.reviewCount = parseInt(me.aggregateRating.reviewCount, 10) || 0;
      }
      if (me.knowsAbout && Array.isArray(me.knowsAbout)) out.profile.skills = me.knowsAbout;
      if (me.hasOfferCatalog && me.hasOfferCatalog.itemListElement) {
        out.stats.gigs = me.hasOfferCatalog.itemListElement.length;
      }
    } catch (e) {
      console.warn('JSON-LD parse skipped:', e.message);
    }
  }

  // ---- SSR review items ----
  const reviewers = [];
  const items = html.match(/freelancer-review-item-wrapper(.*?)(?=freelancer-review-item-wrapper|<\/ul>)/gs) || [];
  for (const block of items) {
    const text = htmlDecode(block);
    if (text.includes('Order Canceled') || text.includes('Order cancelled')) continue;

    const quoteRaw = block.match(/review-description[^>]*>(.*?)<\/p>/s);
    const quote = htmlDecode(quoteRaw ? quoteRaw[1] : '');
    if (quote.length < MIN_REVIEW_LEN) continue;

    const avatarTitle = block.match(/title="([a-zA-Z0-9_.-]{3,30})"/);
    const user = text.match(/>([a-zA-Z0-9_.-]{3,30})<\/(p|h[1-6])>/);
    let name = avatarTitle ? avatarTitle[1] : (user ? user[1] : '');
    if (!name || name.length > 30 || !/^[a-zA-Z0-9_.-]+$/.test(name)) name = 'Verified Buyer';

    const isRepeat = text.includes('Repeat Client');
    const countryAlt = block.match(/flags\/[0-9a-f]+-[0-9a-f]+\.png" alt="([A-Z]{2})"/);
    const country = countryAlt ? countryFromFlag(countryAlt[1]) : '';

    const hollowStars = (block.match(/M10\.9327 9\.18715/g) || []).length;
    const starSvg = (block.match(/<svg /g) || []).length;
    const stars = Math.min(5, Math.max(1, starSvg - hollowStars));

    reviewers.push({
      name,
      country,
      repeat: isRepeat,
      stars,
      quote: quote.length > 320 ? quote.slice(0, 320).trimEnd() + '…' : quote,
    });
  }

  out.reviews = reviewers;
  out.stats.positive_visible = reviewers.filter((r) => r.stars >= 4).length;

  fs.writeFileSync(OUT_FILE, JSON.stringify(out, null, 2) + '\n', 'utf8');
  console.log(`Wrote ${OUT_FILE}`);
  console.log(`  profile: ${out.profile.name || '(n/a)'} | rating ${out.stats.rating || 'n/a'} on ${out.stats.reviewCount ?? '?'} reviews`);
  console.log(`  reviews kept: ${reviewers.length}`);
  for (const r of reviewers) console.log(`    - ${r.name} (${r.country}, ${r.stars}★) "${r.quote.slice(0, 60)}…"`);
}

main().catch((e) => {
  console.error('fiverr-update failed:', e.message);
  process.exit(1);
});