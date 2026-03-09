# CLAUDE.md

## Project Overview


Astro-based personal portfolio/profile site. Bilingual (French default - > we will chenge it to German, English), deployed on Vercel.

## Tech Stack

- **Framework**: Astro 5 with React islands (`@astrojs/react`)
- **Styling**: Tailwind CSS v4 (via `@tailwindcss/vite`)
- **UI Components**: Radix UI primitives + shadcn/ui (`components.json`)
- **Content**: MDX with Astro Content Collections (blog, tips)
- **Forms**: React Hook Form + Zod validation + Resend for email
- **Deployment**: Vercel (`@astrojs/vercel` adapter)
- **Package Manager**: npm

## Commands

```bash
npm run dev       # Start dev server

```

## Project Structure

```
src/
  components/      # Shared UI components (Header, Footer, etc.)
    ui/            # shadcn/ui components
  features/        # Feature-based modules
    blog/          # Blog feature + content (MDX files)
    tips/          # Tips feature + content (MDX files)
    projects/      # Projects feature
    contact/       # Contact form
  i18n/            # Translations (ui.ts) and i18n utilities
  layouts/         # BaseLayout.astro
  pages/           # Astro pages (index, contact, 404, etc.)
    en/            # English locale pages
    api/           # API routes (contact form endpoint)
  stores/          # Nanostores for state
  lib/             # Utilities (remark plugins, etc.)
  styles/          # Global styles
```

## Internationalization

- Default locale: **French** (`fr`) — no URL prefix
- English: `/en/` prefix
- Translations live in `src/i18n/ui.ts` — a typed object with `fr` and `en` keys
- Use `useTranslations(lang, feature)` helper to access translations in components

## Content Collections

Defined in `src/content.config.ts`:
- **blog**: MDX files in `src/features/blog/content/`
- **tips**: MDX files in `src/features/tips/content/`

Frontmatter fields include `isDraft`, `lang`, `pubDate`, `heroImage`, `tags`, `relatedPosts`/`relatedTips`.

## Environment Variables

Copy `.env.example` to `.env`. Required for contact form:
- `RESEND_API_KEY` — Resend API key
- `CONTACT_FORM_TO_EMAIL` — recipient email
- `RESEND_FROM_EMAIL` — verified sender email
- `PUBLIC_GOOGLE_CALENDAR_URL` — optional scheduling link

## Key Conventions

- Feature code lives in `src/features/<feature>/` alongside its content
- Shared UI in `src/components/ui/` (shadcn/ui style)
- Zod validation errors are localized via `src/i18n/zodErrorMap.ts`
- Mermaid diagrams: `inline-svg` locally, `pre-built` in production (Vercel can't run Playwright)
- Update `astro.config.mjs` `site` field before deploying to production
