Blank Theme
===

Blank Theme is a custom Blank theme created with underscore theme, which includes foundation basic grid system and some basic customizer settings which are required in almost all projects. Here are some of the other more interesting things you'll find here:

* A modern workflow with a pre-made command-line interface to turn your project into a more pleasant experience.
* A just right amount of lean, well-commented, modern, HTML5 templates.
* `class-assets.php` that enqueue all your require css and js files.
* `class-blank-theme.php` file in inc/classes is where the theme is setup. This file add all the require theme supports. 
* Customizer registration and settings added in `inc/classes/class-customizer.php` file.
* 2 widgets ( Sidebar & Footer ) added in `inc/classes/class-widgets.php` file.
* `inc/helpers/custom-functions.php` where you can add your custom functions.
* Custom template tags in `inc/helpers/template-tags.php` that keep your templates clean and neat and prevent code duplication.
* In `assets/src/js/admin/customizer.js` file, Theme Customizer enhancements added for a better user experience.
* `assets/src/js/components` where you can add the common components for the theme.
* You can add styles in `assets/src/sass` folder.


Getting Started
---------------

### Requirements

`Blank Theme` requires the following dependencies:

- [Node.js](https://nodejs.org/)
- [Composer](https://getcomposer.org/)

### Setup

After cloning/downloading repository, you need to install the necessary Node.js and Composer dependencies :

```bash
$ composer install
$ npm install
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



#### Available CLI commands

```bash
# Generate pot files
npm run pot

# Lint CSS, JS and PHP
npm run lint:css
npm run lint:js
npm run lint:php
npm run lint:php:fix
```



#### Before commit

This `precommit` script will lint your scss, js, php files and also generate pot file.

```bash
npm run precommit
```



Does this interest you?
---------------
<a href="https://rtcamp.com/"><img src="https://rtcamp.com/wp-content/uploads/sites/2/2019/04/github-banner@2x.png" alt="Join us at rtCamp, we specialize in providing high performance enterprise WordPress solutions"></a>
