# Ipsum Logistic Theme

## Installation
1. Copy this folder into `wp-content/themes/ipsum-logistic-theme`.
2. Activate theme in **Appearance → Themes**.
3. Create a page and set it as static front page in **Settings → Reading**.
4. Configure menus in **Appearance → Menus** (`primary`, `mobile`, `footer`).

## Editable areas
- **Appearance → Theme Options**: work hours, phone, email, address, social links, map embed.
- **Front page edit screen**: `Front Page Sections` meta box.
- **CPTs**:
  - Services (`il_service`)
  - FAQ (`il_faq`)
  - Testimonials (`il_testimonial`)

## Security notes
- No secrets are stored in the theme. Put credentials/secrets in `wp-config.php` or environment config.
- Contact form uses nonce + honeypot + transient rate-limit.
