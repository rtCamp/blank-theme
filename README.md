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

1. Search for `'blank-theme'` (inside single quotations) to capture the text domain.
2. Search for `blank_theme_` to capture all the function names.
3. Search for `Text Domain: blank-theme` in style.css.
4. Search for <code>&nbsp;Blank Theme</code> (with a space before it) to capture DocBlocks.
5. Search for `blank-theme-` to capture prefixed handles.

#### Package Setup

Install packages by running

```bash
npm install
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
  - For `npm run prod` compiled file name with come with content hash.
- Sync complete `build` directory on server. 
- Before code push to repository, make sure you link your code using above mentioned commands.

Good luck!
