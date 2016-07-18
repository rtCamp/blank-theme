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

9) PHPCS - https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards

10) Dev Lib - https://github.com/xwp/wp-dev-lib

and more..

Setup PHP_CodeSniffer
---------------

#### Install `PEAR`

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
[sudo] ln -s WordPress-Coding-Standards/WordPress-VIP WordPress-VIP
[sudo] ln -s WordPress-Coding-Standards/WordPress-Extra WordPress-Extra
```

### Install wp-dev-lib as submodule

To install as Git submodule (recommended):

```bash
git submodule add -b master https://github.com/xwp/wp-dev-lib.git dev-lib
```

Setup pre-commit hook
---------------

To install the pre-commit hook, symlink to [`pre-commit`](dev-lib/pre-commit) from your project's `.git/hooks/pre-commit`:

```bash
cd .git/hooks && ln -s ../../dev-lib/pre-commit . && cd -
```	


Getting Started
---------------

Use Blank Theme Builder to build your custom theme https://github.com/sayedwp/blank-theme-builder

And that's it. :)

Good luck!
