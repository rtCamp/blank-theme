Blank Theme
===

Blank Theme is a custom blank theme created with underscore theme, which includes foundation basic grid system and some basic customizer settings which are required in almost all projects.



Getting Started
---------------

After cloning repo, `cd` into `assets` folder and run

```bash
npm install
```

and then run the following command which will prompt for the theme name, start renaming and do cleanup.

```bash
npm run init
```



#### Compile Assets

```
npm run dev       # During development
npm run prod      # When ready for production
```



#### Other Commands

```bash
# Generate pot files
npm run pot

# Lint css and JS
npm run lint-css 
npm run lint-js
```



#### Before commit

This `precommit` script will lint your scss, js files and also generate pot file.

```bash
npm run precommit
```


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
