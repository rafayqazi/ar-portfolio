# Web Matrix — Website Design & Structure Documentation

**Site:** [webmatrix.pk](https://webmatrix.pk/)
**Page analyzed:** Homepage only (as requested — internal pages weren't crawled)
**Prepared:** August 8, 2026
**Purpose:** Structural, UX, and content design reference for the Web Matrix marketing site

---

## Table of Contents
1. [Overview](#1-overview)
2. [Technical Stack](#2-technical-stack)
3. [Site Navigation Map](#3-site-navigation-map)
4. [Homepage Section Breakdown](#4-homepage-section-breakdown)
5. [UI Component Library](#5-ui-component-library)
6. [Content & Copywriting Style](#6-content--copywriting-style)
7. [Visual Design Tokens](#7-visual-design-tokens)
8. [Imagery & Iconography](#8-imagery--iconography)
9. [Accessibility & Responsive Notes](#9-accessibility--responsive-notes)
10. [QA / Consistency Findings](#10-qa--consistency-findings)
11. [Recommendations](#11-recommendations)

---

## 1. Overview

Web Matrix presents itself as a Karachi-based digital agency offering an end-to-end suite of services: logo design, web development, e-commerce (Shopify-focused), digital marketing, SEO, PPC, hosting/domains, and copywriting. The homepage is built as a single-scroll sales page — it introduces the agency, showcases all 8 services as clickable cards, layers in trust signals (stats, badges, a testimonial), and closes with two conversion points: a contact form and a discount-offer banner.

## 2. Technical Stack

| Layer | Finding |
|---|---|
| CMS | WordPress |
| Page builder | Elementor (v4.1.4, per page metadata) |
| Fonts | Google Fonts enabled, `font-display: swap` confirmed in meta — specific family not exposed in static markup |
| Responsive | Yes — standard `width=device-width, initial-scale=1` viewport tag |
| Accessibility baseline | "Skip to content" link present (WordPress/Elementor default) |
| E-commerce hint | A floating "Cart" element and modal close controls appear in the footer markup, suggesting a WooCommerce component loads site-wide even though the homepage isn't a shop page |

## 3. Site Navigation Map

**Primary nav:**
- Home
- Our Services *(dropdown, 8 items)*
  - Logo Design
  - Website Development
  - Digital Marketing
  - E-Commerce
  - Hosting & Domains — *dropdown link is a placeholder, see §10*
  - SEO
  - PPC
  - Creative Copywriting
- Portfolio
- About
- Contact
- **Get Started** *(filled button, top-right → /contact/)*

**Footer nav** repeats the same 8 services, plus a "Recognized Platforms" badge block and a contact block.

## 4. Homepage Section Breakdown

In the order each section renders, top to bottom:

### 4.1 Header
Logo (image + "Web Matrix" wordmark) on the left, a horizontal menu with one dropdown, and a filled "Get Started" CTA button on the right. A "Menu" toggle label implies a hamburger menu on mobile.

### 4.2 Hero / Banner
A full-width banner image plus a secondary layered graphic. No standalone headline sits inside the hero itself — the first heading appears with the About section right below it, so the hero reads as image-led rather than text-led.

### 4.3 About Us
Two-column layout: a heading and two paragraphs of positioning copy on one side, a supporting illustration on the other, and one CTA button ("Let's Get Started" → /contact/).

### 4.4 Our Services (8 cards)
An intro paragraph followed by 8 numbered cards (01–08), one per service. Every card repeats the same pattern:
- Number label (01–08)
- Icon/graphic
- Service title
- One-sentence description
- The title repeats a second time with a short teaser line ("To find out more details." / "To find out our Packages")
- An "explore" link to that service's dedicated page

The repeated title + teaser strongly matches Elementor's **Flip Box** widget — the second title/line is almost certainly back-of-card content that only shows on hover, flattened into plain text by static extraction.

### 4.5 Why Choose Web Matrix (Value Prop + Stats)
A "Cost friendly Prices" heading, a positioning paragraph, a support paragraph, and three stat counters:
- Websites — 0+
- Shopify Stores — 0+
- E-commerce Websites — 0+

The "0" values are almost certainly an **Elementor Counter widget** caught at rest — the real numbers count up via JavaScript on scroll and don't appear in a static fetch.

### 4.6 Portfolio
A heading and subheading, followed by 5 category labels (Logo Design, Website Development, Social Media Solution, Mobile App Development, Illustration) that read as a filter bar for a project grid. Actual project thumbnails weren't present in the extracted content — likely images without descriptive alt text, or pulled dynamically from the dedicated /portfolio/ page.

### 4.7 Trust Badges
Five icon + one-line label blocks in a row, using a flat, single-tone icon set (filenames point to the icons8 library):
1. Professional Team Onboard
2. 100% Customer Satisfaction
3. Unique Designs
4. 24/7 Customer Service
5. Money Back Guarantee

### 4.8 Contact Form + Live Chat
A short lead-gen form: Name, Company, Email, Message, an SMS opt-in checkbox with compliance text, and a Send button. A "Support chat Available 24/7" label sits nearby, suggesting a live-chat widget is anchored to this section.

### 4.9 "Let's Get in Touch" Band
A closing CTA band: heading, one line of supporting copy, an email address, three social icons, and a phone number.

### 4.10 Offer Banner + Testimonial (appears twice)
A "Get 10% Discount on first order" banner with a "Select a Package" button (→ an **external** ecomlive.net link) and a "Call Us At" button, paired with one testimonial (quote, client photo, name, role). This whole block — banner plus testimonial — repeats a second time with identical banner copy. This is almost certainly a **testimonial slider**, where each slide bundles a copy of the static offer panel with one rotating testimonial; static extraction just caught two slide instances back to back.

### 4.11 Footer
Four-column layout:
- Logo + one-line agency description + 3 social icons
- Services list (repeats the primary nav's 8 services)
- "Recognized Platforms" — a single Trustpilot badge
- Contact details — phone, map-linked address, email

Closed by a copyright line.

## 5. UI Component Library

| Component | Where used | Notes |
|---|---|---|
| Dropdown nav menu | Header | Single dropdown, 8 children |
| Primary button (filled) | Header, About, Services, Contact, offer banners | Label verbs: "Get Started," "explore," "Select a Package" |
| Flip card | Services grid (×8) | Front: icon + title + description. Back: title + teaser + link |
| Icon badge row | Trust section | Icon over one-line label, 5 across |
| Stat counter | Value-prop section | Animated count-up, 3 across |
| Category filter pills | Portfolio | 5 labels, no active state visible in static markup |
| Testimonial card | Offer/testimonial band | Quote + avatar + name + role |
| Lead form | Contact section | 4 fields + checkbox + submit |
| Footer link columns | Footer | 4 columns |
| Offer banner | Mid-lower page | Repeats — see §10 |

## 6. Content & Copywriting Style

- Headlines follow an "H2 label → H3 expanded promise" pattern: a short eyebrow heading followed by a longer, benefit-driven subheading.
- CTA verbs are consistently action-first: **Get Started, Explore, Select, Send, Call**.
- Tone is benefit-led and reassurance-heavy — pricing value, satisfaction, and guarantee language recur across sections (cost-friendly pricing, money-back guarantee, 24/7 support, 100% satisfaction).
- Service descriptions follow a one-sentence formula: what the service is, plus who it's for or what it achieves.

## 7. Visual Design Tokens

A static content fetch doesn't expose computed CSS, so exact hex values and font families can't be confirmed from this pass — Elementor compiles them into external CSS that isn't part of the readable page content. What's confirmed vs. not:

| Token | Status |
|---|---|
| Color palette | Not extractable from static markup — needs a DevTools inspection or screenshot |
| Heading/body fonts | Google Fonts confirmed enabled; specific family name not exposed |
| Button style | Filled, label-only buttons — no icons inside button text |
| Layout grid | Elementor's standard section → column → widget structure; alternating image/text columns in the hero and About areas |

*If you want the exact palette and fonts pinned down, share a screenshot or the live CSS and I can extract precise values for this section.*

## 8. Imagery & Iconography

- **Photography:** minimal — one client headshot (the testimonial) appears on the homepage.
- **Illustration/3D:** a 3D-rendered rocket graphic sits in the pricing/value section, signaling a "growth/launch" visual metaphor.
- **Icons:** flat, single-tone icon set (icons8-sourced) used for the 5 trust badges.
- **Product graphics:** several service-card icons are stock PNG/WebP images with transparent backgrounds rather than a custom icon set — the icon style isn't fully unified across the 8 service cards.

## 9. Accessibility & Responsive Notes

- "Skip to content" link is present — a good baseline accessibility practice.
- The viewport meta tag confirms mobile-responsive intent.
- Several images in the extracted content resolve to generic filenames with no descriptive alt text (mostly service-card graphics) — worth a pass for screen-reader support.

## 10. QA / Consistency Findings

Real issues surfaced while reading the live page — worth checking before using this as a build reference:

1. **Broken nav link** — "Hosting & Domains" in the header dropdown points to `#` (placeholder), while the same service further down the page correctly links to `/hosting-domain/`.
2. **Three different phone numbers on one page** — `+92 311-3515636` (contact band), `+92 3142 498908` (footer), and `+1 (254) 254-0980` (offer banner — a US number).
3. **Off-domain CTA** — the "Select a Package" button in the offer banner points to `ecomlive.net`, not `webmatrix.pk`.
4. **Typo** — "Disscount" appears in both instances of the offer banner; should read "Discount."
5. **Placeholder social links** — footer social icons all point to `#`, while the contact-band social icons above them link to real LinkedIn/Facebook/Instagram profiles.
6. **Duplicate section** — the offer banner + testimonial block appears twice with identical banner copy (§4.10); worth checking whether only the testimonial is meant to rotate, not the whole panel.
7. **Address mismatch** — the footer address links to a Google Maps listing named "Digitally Possible," not "Web Matrix."

## 11. Recommendations

- Confirm the exact color palette and font family from the live CSS or a screenshot so this doc can carry real tokens instead of placeholders.
- Fix the broken "Hosting & Domains" nav link and settle on one primary contact number across the page.
- Point the footer social icons to the same real profile URLs already used in the contact band.
- Give the 8 service-card icons one consistent visual treatment (currently a mix of stock PNGs and flat icons).
- Add descriptive alt text to service and portfolio images.

