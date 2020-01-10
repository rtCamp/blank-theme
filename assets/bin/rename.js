#!/usr/bin/env node

const path    = require( 'path' );
const fs      = require( 'fs' );
const prompt  = require( 'prompt-sync' )();
const replace = require( 'replace-in-file' );
const rootDir = path.join( __dirname, '../..' );

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

const findReplace = ( findString, replaceString ) => {
	const regex = new RegExp( findString, 'g' );
	const options = {
		files: `${rootDir}/**/*`,
		from: regex,
		to: replaceString,
		ignore: [
			`${rootDir}/**/node_modules/**/*`,
			`${rootDir}/.git/**/*`,
			`${rootDir}/.github/**/*`,
			`${rootDir}/**/vendor/**/*`,
			`${rootDir}/**/bin/rename.js`
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
consoleOutput( fgGreen, 'Please enter your theme name (shown in WordPress admin)*:' );

let themeName;
do {
	consoleOutput( fgGreen, '' );
	themeName = prompt( 'Theme name: ' );

	if ( null !== themeName && themeName.length ) {
		themeName = themeName.trim();
	} else {
		consoleOutput( fgRed, 'Theme name field is required and cannot be empty.' );
	}
} while ( 0 >= themeName.length );

// Theme Version.
const themeVersion = '1.0.0';

const lowerThemeName = themeName.toLowerCase().trim();
const lowerWithHyphen = lowerThemeName.replace( /\W+/g, '-' ).trim();
const lowerWithUnderscore = lowerThemeName.replace( /\W+/g, '_' ).trim();
const lowerPrefixWithHyphen = lowerWithHyphen + '-';
const lowerPrefixWithunderscore = lowerWithUnderscore + '_';

const camelCaseThemeName = themeName.replace( /\w\S*/g, function ( txt ) {
	return txt.charAt( 0 ).toUpperCase() + txt.substr( 1 ).toLowerCase();
} );
const camelCaseWithHyphen = camelCaseThemeName.replace( /\W+/g, '-' ).trim();
const camelCaseWithUnderscore = camelCaseThemeName.replace( /\W+/g, '_' ).trim();
const camelCasePrefixWithHyphen = camelCaseWithHyphen + '-';
const camelCasePrefixWithUnderscore = camelCaseWithUnderscore + '_';

const upperThemeName = themeName.toUpperCase().trim();
const upperWithHyphen = upperThemeName.replace( /\W+/g, '-' ).trim();
const upperWithUnderscore = upperThemeName.replace( /\W+/g, '_' ).trim();
const upperPrefixWithHyphen = upperWithHyphen + '-';
const upperPrefixWithUnderscore = upperWithUnderscore + '_';

// Theme Constants.
const themeVersionConst = `${upperWithUnderscore}_VERSION`;
const themeDirConst = `${upperWithUnderscore}_TEMP_DIR`;
const themeBuildDirConst = `${upperWithUnderscore}_BUILD_DIR`;
const themeBuildDirURIConst = `${upperWithUnderscore}_BUILD_URI`;

consoleOutput( fgCyan, '----------------------------------------------------' );
consoleOutput( fgGreen, 'Theme details will be:' );

consoleOutput( fgMagenta, `Theme name: ${themeName}` );
consoleOutput( fgMagenta, `Theme version: ${themeVersion}` );
consoleOutput( fgMagenta, `Text domain: ${lowerWithHyphen}` );
consoleOutput( fgMagenta, `Package: ${themeName}` );
consoleOutput( fgMagenta, `Namespace: ${camelCaseWithUnderscore}` );
consoleOutput( fgMagenta, `Function prefix: ${lowerPrefixWithunderscore}` );
consoleOutput( fgMagenta, `CSS class prefix: ${lowerPrefixWithHyphen}` );
consoleOutput( fgMagenta, `PHP variable: ${lowerPrefixWithunderscore}` );
consoleOutput( fgMagenta, `Version constant: ${themeVersionConst}` );
consoleOutput( fgMagenta, `Directory constant: ${themeDirConst}` );
consoleOutput( fgMagenta, `Build directory Path constant: ${themeBuildDirConst}` );
consoleOutput( fgMagenta, `Build directory URI constant: ${themeBuildDirURIConst}` );

const confirm = prompt( 'Confirm? (y/n) ' ).trim();

if ( 'y' === confirm ) {
	consoleOutput( fgGreen, 'This might take some time...' );

	findReplace( 'Blank Theme', themeName );
	findReplace( 'blank theme', lowerThemeName );

	findReplace( 'Version: 2.0.0', 'Version: ' + themeVersion );
	findReplace( '"version": "2.0.0"', '"version": "' + themeVersion + '"' );

	findReplace( 'Blank-Theme-', camelCasePrefixWithHyphen );
	findReplace( 'Blank_Theme_', camelCasePrefixWithUnderscore );

	findReplace( 'blank-theme-', lowerPrefixWithHyphen );
	findReplace( 'blank_theme_', lowerPrefixWithunderscore );

	findReplace( 'BLANK_THEME_VERSION', themeVersionConst );
	findReplace( 'BLANK_THEME_TEMP_DIR', themeDirConst );
	findReplace( 'BLANK_THEME_BUILD_DIR', themeBuildDirConst );
	findReplace( 'BLANK_THEME_BUILD_URI', themeBuildDirURIConst );

	findReplace( 'BLANK-THEME-', upperPrefixWithHyphen );
	findReplace( 'BLANK_THEME_', upperPrefixWithUnderscore );

	findReplace( 'BLANK-THEME', upperWithHyphen );
	findReplace( 'BLANK_THEME', upperWithUnderscore );

	findReplace( 'Blank-Theme', camelCaseWithHyphen );
	findReplace( 'Blank_Theme', camelCaseWithUnderscore );

	findReplace( 'blank-theme', lowerWithHyphen );
	findReplace( 'blank_theme', lowerWithUnderscore );

	if ( fs.existsSync( `${rootDir}/inc/classes/class-blank-theme.php` ) ) {

		fs.renameSync( `${rootDir}/inc/classes/class-blank-theme.php`, `${rootDir}/inc/classes/class-${lowerWithHyphen}.php`, ( err ) => {
			if ( err ) {
				throw err;
			}
			fs.statSync( `${rootDir}/inc/classes/class-${lowerWithHyphen}.php`, ( error, stats ) => {
				if ( error ) {
					throw error;
				}
				consoleOutput( fgBlue, `stats: ${JSON.stringify( stats )}` );
			} );
		} );

	}

	consoleOutput( fgGreen, 'Finished! Success! Now run `npm run update-deps` to begin package update.' );

} else {
	consoleOutput( fgRed, 'Cancelled.' );
}
