Blank Theme
===

Blank Theme is a custom blank theme created with underscore theme, which includes foundation basic grid system and some basic customizer settings which are required in almost all projects.

Last Synced with underscore theme : Dec 12, 2015

What more does it have?
---------------

1) WordPress Customizer is already setup with some basic customizer settings.

2) Basic foundation grids.

3) Ready made mobile menu.

4) Removed some unnecessary saas files and folder which are shipped with underscore theme.

5) Css fixes, in underscore and helpful css classes.

6) Some helpful php functions.

7) Grunt file and configration.

8) Slick Slider

9) Dev Lib - https://github.com/xwp/wp-dev-lib

and more..

Getting Started
---------------

1. Search for `'blank-theme'` (inside single quotations) to capture the text domain.
2. Search for `blank_theme_` to capture all the function names.
3. Search for `Text Domain: blank-theme` in style.css.
4. Search for <code>&nbsp;Blank Theme</code> (with a space before it) to capture DocBlocks.
5. Search for `blank-theme-` to capture prefixed handles.
6. Install PHP_CodeSniffer
7. Install wp-dev-lib
8. Setup pre-commit hook

Install Grunt Packages
---------------
Recommended command to install grunt packages,

```bash
npm install --save-dev grunt grunt-autoprefixer grunt-checktextdomain grunt-combine-media-queries grunt-contrib-sass grunt-contrib-uglify grunt-contrib-watch grunt-wp-i18n load-grunt-tasks
```

Setup PHP_CodeSniffer
---------------

#### Install PEAR

```bash
sudo apt-get install php-pear
```

#### Install PHP_CodeSniffer

```bash
pear install PHP_CodeSniffer
```

### Setup WordPress Coding Standards

```bash
cd $(pear config-get php_dir)/PHP/CodeSniffer/Standards
```

```bash
[sudo] git clone git://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards.git
```

To setup WordPress Coding Standards

```bash
[sudo] ln -s WordPress-Coding-Standards/WordPress WordPress
[sudo] ln -s WordPress-Coding-Standards/WordPress-Core WordPress-Core
[sudo] ln -s WordPress-Coding-Standards/WordPress-Docs WordPress-Docs
[sudo] ln -s WordPress-Coding-Standards/WordPress-VIP WordPress-VIP
[sudo] ln -s WordPress-Coding-Standards/WordPress-Extra WordPress-Extra
```

Install [wp-dev-lib](https://github.com/xwp/wp-dev-lib) as submodule
---------------

Clone with submodule

```bash
git clone --recursive git@github.com:rtCamp/blank-theme.git
```
OR

To install as Git submodule (recommended):

```bash
git submodule add -b master https://github.com/xwp/wp-dev-lib.git dev-lib
```

### Install dev-lib submodule for **downloaded** .zip file (recommended):

```bash
git submodule update --remote dev-lib
```

Setup pre-commit hook
---------------

To install the pre-commit hook, symlink to [`pre-commit`](https://github.com/xwp/wp-dev-lib/blob/master/pre-commit) from your project's `.git/hooks/pre-commit`:

```bash
cd .git/hooks && ln -s ../../dev-lib/pre-commit . && cd -
```

Good luck!
