Blank Theme
===

Blank Theme is a custom blank theme created with underscore theme, which includes foundation basic grid system and some basic customizer settings which are required in almost all projects.

What more does it have?
---------------

1) WordPress Customizer is already setup with some basic customizer settings.

2) Webpack configuration with all required packages to develop theme.

3) Basic foundation grids.

4) Stylelint, eslint and postcss configuration.

5) CSS fixes, in underscore and helpful CSS classes.

6) Some helpful php functions.

7) Slick Slider

and more..

Getting Started
---------------

Install packages by running

```bash
npm install
```

#### Setup theme files and variables

Please enter valid input for theme name, version and description after running following command.

```bash
npm run rename
```

#### Install OR update all dependencies
```bash
npm run update-deps
```

#### Compile Assets
```
npm run dev       # During development
npm run prod      # When ready for production
```

#### Code Linting
- Use `npm run precommit` before commit and push your changes.
- Use `npm run lint-css` to lint scss files.
- Use `npm run lint-js` to lint js files.

#### Cleanup build directory
```bash
npm run clean
```

### Note
- For assets, make sure you watch and sync `manifest.json` file, otherwise assets will not found on server.
  - For `npm run dev` compiled file name will be normal.
  - For `npm run prod` compiled file name with content hash.
- Sync complete `build` directory on server.
- Before code push to repository, make sure you lint your code using `npm run precommit` command.

Good luck!
