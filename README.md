# Blank Theme

Blank Theme is a custom blank theme created with the underscore theme, which includes the Foundation basic grid system and some basic customizer settings required in almost all projects.

## Getting Started

After cloning the repo, run the following:

```bash
npm install
```

Then run the following command which will prompt for the theme name, start renaming, and clean up:

```bash
npm run init
```

#### Compile Assets

To compile assets, use the following commands:

```bash
npm run build:dev  # During development
npm run build:prod # When ready for production
```

#### Other Commands

```bash
# Generate POT files
npm run build:pot

# Lint all at once
npm run lint:all

# Lint only staged files
npm run lint:staged

# Lint individual CSS, JS, PHP and package.json
npm run lint:css
npm run lint:css:fix
npm run lint:js
npm run lint:js:fix 
npm run lint:js:report
npm run lint:php
npm run lint:php:fix
npm run lint:package-json
```

#### Before Commit

This `precommit` script will lint your SCSS, JS, PHP files and also generate the POT file:

```bash
npm run precommit
```

## Does this interest you?

<a href="https://rtcamp.com/"><img src="https://rtcamp.com/wp-content/uploads/sites/2/2019/04/github-banner@2x.png" alt="Join us at rtCamp, we specialize in providing high performance enterprise WordPress solutions"></a>