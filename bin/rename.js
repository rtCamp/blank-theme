#!/usr/bin/env node

const path    = require( 'path' );
const prompt  = require( 'prompt-sync' )();
const replace = require( 'replace-in-file' );
const rootDir = path.join( __dirname, '..' );

// Helpers
const fgRed     = '\x1b[31m';
const fgGreen   = '\x1b[32m';
const fgBlue    = '\x1b[34m';
const fgMagenta = '\x1b[35m';
const fgCyan    = '\x1b[36m';

// Functions
const consoleOutput = ( color, text ) => {
	console.log( color, text );
};

const capCase = ( string ) => string.replace( /\W+/g, '_' ).split( '_' ).map( ( item ) => item[0].toUpperCase() + item.slice( 1 ) ).join( '_' );

const findReplace = ( findString, replaceString ) => {
	const regex = new RegExp( findString, 'g' );
	const options = {
		files: `${rootDir}/**/*`,
		from: regex,
		to: replaceString,
		ignore: [
			`${rootDir}/node_modules/**/*`,
			`${rootDir}/.git/**/*`,
			`${rootDir}/.github/**/*`,
			`${rootDir}/vendor/**/*`,
			`${rootDir}/_rename.sh`,
			`${rootDir}/bin/rename.js`
		]
	};

	try {
		const changes = replace.sync( options );
		consoleOutput( fgGreen, `${findString}-> ${replaceString}. Modified files: ${changes.join( ', ' )}` );
	} catch ( error ) {
		console.error( 'Error occurred:', error );
	}
};

// Main script
consoleOutput( fgGreen, 'The script will uniquely set up your theme.' );
consoleOutput( fgGreen, '* - required' );

// Theme name
consoleOutput( fgBlue, 'Please enter your theme name (shown in WordPress admin)*:' );

let themeName;
do {
	consoleOutput( fgBlue, '' );
	themeName = prompt( 'Theme name: ' ).trim();

	if ( 0 >= themeName.length ) {
		consoleOutput( fgRed, 'Theme name field is required and cannot be empty.' );
	}
} while ( 0 >= themeName.length );

// Package name
consoleOutput( fgBlue, 'Please enter your package name (used in translations - ' + 'lowercase with no special characters, \'_\' or \'-\' allowed for spaces)*:' );

let themePackageName;
do {
	consoleOutput( fgBlue, '' );
	themePackageName = prompt( 'Package name: ' ).replace( /\W+/g, '-' ).toLowerCase().trim();

	if ( 0 >= themePackageName.length ) {
		consoleOutput( fgRed, 'Package name field is required and cannot be empty.' );
	}
} while ( 0 >= themePackageName.length );

let textDomain;
do {
	consoleOutput( fgBlue, '' );
	textDomain = prompt( 'Text Domain: ' ).replace( /\W+/g, '-' ).toLowerCase().trim();

	if ( 0 >= textDomain.length ) {
		consoleOutput( fgRed, 'Text domain field is required and cannot be empty.' );
	}
} while ( 0 >= textDomain.length );

// Theme prefix
consoleOutput( fgBlue, 'Please enter a theme prefix (used when defining constants)*:' );

let themePrefix;
do {
	consoleOutput( fgBlue, '' );
	themePrefix = prompt( 'Prefix (e.g. INF, ABRR): ' ).toUpperCase().trim();

	if ( 0 >= themePrefix.length ) {
		consoleOutput( fgRed, 'Prefix is required and cannot be empty.' );
	}
} while ( 0 >= themePrefix.length );

let functionPrefix;
do {
	consoleOutput( fgBlue, '' );
	functionPrefix = prompt( 'Function prefix with underscore (e.g. foo_): ' ).trim();

	if ( 0 >= functionPrefix.length ) {
		consoleOutput( fgRed, 'Prefix is required and cannot be empty.' );
	}
} while ( 0 >= functionPrefix.length );

let themeCssClassPrefix;
do {
	consoleOutput( fgBlue, '' );
	themeCssClassPrefix = prompt( 'CSS class prefix with hyphen (e.g. foo-): ' ).trim();

	if ( 0 >= themeCssClassPrefix.length ) {
		consoleOutput( fgRed, 'CSS class prefix is required and cannot be empty.' );
	}
} while ( 0 >= themeCssClassPrefix.length );

// Theme Version
const themeVersionConst  = `${themePrefix}_VERSION`;
const themeDirConst      = `${themePrefix}_TEMP_DIR`;
const themeBuildDirConst = `${themePrefix}_BUILD_URI`;

// Namespace
const themeNamespace = capCase( themePackageName );

// Theme description
consoleOutput( fgBlue, 'Please enter your theme description:' );

const themeDescription = prompt( 'Theme description: ' ).trim();

consoleOutput( fgCyan, '----------------------------------------------------' );
consoleOutput( fgGreen, 'Your details will be:' );

consoleOutput( fgMagenta, `Theme name: ${themeName}` );
consoleOutput( fgMagenta, `Theme description: ${themeDescription}` );
consoleOutput( fgMagenta, `Text domain: ${textDomain}` );
consoleOutput( fgMagenta, `Package: ${themePackageName}` );
consoleOutput( fgMagenta, `Namespace: ${themeNamespace}` );
consoleOutput( fgMagenta, `Theme prefix: ${themePrefix}` );
consoleOutput( fgMagenta, `Function prefix: ${functionPrefix}` );
consoleOutput( fgMagenta, `CSS class prefix: ${themeCssClassPrefix}` );

const confirm = prompt( 'Confirm? (y/n) ' ).trim();

if ( 'y' === confirm ) {
	consoleOutput( fgGreen, 'This might take some time...' );

	findReplace( 'Blank Theme', themeName );
	findReplace( 'blank_theme_description', themeDescription );
	findReplace( 'Blank_Theme', themePackageName );
	findReplace( 'Blank_Theme', themeNamespace );
	findReplace( 'BLANK_THEME_VERSION', themeVersionConst );
	findReplace( 'BLANK_THEME_TEMP_DIR', themeDirConst );
	findReplace( 'BLANK_THEME_BUILD_URI', themeBuildDirConst );
	findReplace( 'blank_theme_', functionPrefix );
	findReplace( 'blank-theme-', themeCssClassPrefix );
	findReplace( 'blank-theme', textDomain );
	findReplace( 'blank_theme', textDomain );

	consoleOutput( fgGreen, 'Finished! Success! Now run `npm install` ' + 'to begin packages installations.' );

} else {
	consoleOutput( fgRed, 'Cancelled.' );
}
