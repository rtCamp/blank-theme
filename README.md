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

Setup theme and install packages.

**Note:** After install packages, it will prompt for theme name. Once theme setup complete for development, it will remove git directory.

```bash
npm run init
```

#### Install or update all dependencies
```bash
npm run update-deps
```

#### Compile Assets
```
npm run dev       # During development
npm run prod      # When ready for production
```

#### Cleanup build directory
```bash
npm run clean
```

#### Generate pot file
```bash
npm run pot
```

#### Code Linting
- Use `npm run lint-css` to lint scss files.
- Use `npm run lint-js` to lint js files.

#### Before commit
This `precommit` script will lint your scss, js files and also generate pot file.

```bash
npm run precommit
```

### Note
- For assets, make sure you watch and sync `manifest.json` file, otherwise assets will not found on server.
  - For `npm run dev` compiled file name will be normal.
  - For `npm run prod` compiled file name with content hash.
- Sync complete `build` directory on server. 
- Before code push to repository, make sure you lint your code using `npm run precommit` command.

## Contributing

### Reporting a bug 🐞

Before creating a new issue, do browse through the [existing issues](https://github.com/rtCamp/blank-theme/issues) for resolution or upcoming fixes. 

If you still need to [log an issue](https://github.com/rtCamp/blank-theme/issues/new), making sure to include as much detail as you can, including clear steps to reproduce your issue if possible.

### Create a pull request

Want to contribute a new feature? Start a conversation by logging an [issue](https://github.com/rtCamp/blank-theme/issues).

Once you're ready to send a pull request, please run through the following checklist:

1. Browse through the existing issues for anything related to what you want to work on. If you don't find any related issues, open a new one.

1. Fork the repository.

1. Create a branch from `develop` for each issue you'd like to address and commit your changes.

1. Push the code changes from your local clone to your fork.

1. Open a pull request and that's it! We'll with feedback as soon as possible (Isn't collaboration a great thing? 😌)

1. Once your pull request has passed final code review and tests, it will be merged into `develop` and be in the pipeline for the next release. Props to you! 🎉

### Unit testing

- Setup local unit test environment by running script from terminal

```./bin/install-wp-tests.sh <db-name> <db-user> <db-pass> [db-host] [wp-version] [skip-database-creation]```
- Execute `phpunit` in terminal from repository to run all test cases.
- Execute `phpunit ./tests/inc/test-class.php` in terminal with file path to run specific tests.


Good luck!

Does this interest you?
---------------
<a href="https://rtcamp.com/"><img src="https://rtcamp.com/wp-content/uploads/2019/04/github-banner@2x.png" alt="Join us at rtCamp, we specialize in providing high performance enterprise WordPress solutions"></a>
