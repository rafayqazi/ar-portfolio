# AR Portfolio Project Guide

These instructions describe the AR Software Solutions portfolio website for AI coding agents. Follow the existing static-site architecture and conventions when making changes.

## Project structure

- `index.html` — Main landing page, shared navigation, homepage portfolio, testimonials, and inline Alpine.js interactions.
- `pages/` — Standalone About, Contact, Portfolio, Publications, and Project Details pages.
- `services/` — Individual service pages (including Chrome Extension Development) and the services overview.
- `css/index.css` — Shared site styles and visual design system.
- `js/data.js` — Shared profile, skills, experience, project descriptions, categories, technologies, image lists, and project PDFs.
- `data/fiverr-data.json` — Fiverr profile, statistics, and review data fetched by the homepage.
- `images/` — Shared site-wide images, branding, icons, and testimonials.
- `Portfolio/`, `Web Development/`, `writiing portfolio/`, and `fiverr/` — Project screenshots and documents grouped by portfolio/client/topic. Preserve the existing directory names and spelling.
- `demos/` — Standalone demos, including the PHP landing-page demo.
- `docs/` — Design and SEO documentation, CV, and other supporting documents.
- `scripts/` — Maintenance scripts, including the Fiverr data refresh script.
- `.github/workflows/` — GitHub Actions automation.
- `wrangler.jsonc` — Cloudflare Wrangler project configuration.
- `llms.txt`, `robots.txt`, and `sitemap.xml` — Search and crawler metadata.

## Architecture and conventions

- This is a static site, not a bundled application. Pages use semantic HTML, shared CSS, and browser JavaScript; Alpine.js, Tailwind CSS, and AOS are loaded from CDNs where used.
- `js/data.js` is the canonical source for portfolio project content. Update that data rather than duplicating project descriptions or galleries in page markup.
- The portfolio data stores media paths relative to the site root. `js/data.js` resolves project image and PDF paths against the site root derived from its own script URL. Keep this behavior so assets work both under a local subpath such as `/ar-portfolio/` and on the deployed site.
- Add media to the appropriate existing asset folder and use the exact filename and letter case. Deployment environments can be case-sensitive; filenames may contain spaces.
- Pages under `pages/` and `services/` use `../` for links to shared CSS, JavaScript, and root-level assets. Do not introduce host-root paths such as `/Portfolio/...`, which break when the site is deployed below a domain subpath.
- Keep the existing visual language: responsive layouts, shared styles from `css/index.css`, and the established navy, coral, and neo-glass treatments. Prefer existing classes and page patterns.
- Preserve accessibility basics: descriptive image alt text, semantic elements, keyboard-operable controls, and responsive behavior.
- Keep page metadata, canonical URLs, and structured data consistent when adding or renaming a public page.

## Local development and validation

- There is no package manifest or build/test command. Serve the repository root through Apache/XAMPP (for example, `http://localhost/ar-portfolio/`) rather than opening nested pages as unrelated filesystem roots.
- After changing a page or asset path, check the affected page and its image/PDF requests in a browser. Verify both the homepage and nested portfolio pages when shared data or shared styles change.
- Before adding a project, confirm every listed image and PDF exists in the repository and that its path is relative to the site root.
- Do not add dependencies or a build system for changes that can be implemented within the current static-site setup.
