var fs = require( 'fs' );
const path = require( 'path' );
const sassExtract = require( 'sass-extract' );

sassExtract.render( {
	file: path.resolve( __dirname, '../src/sass/0-settings/_settings.scss' ),
} ).then( rendered => {
	const data = JSON.stringify( rendered.vars );

	const targetFile = path.resolve( __dirname, 'settings.json' );

	fs.writeFile( targetFile, data, function ( err ) {
		if ( err ) {
			throw err;
		}
		console.log( 'File is created successfully.' );
	} );
} );
