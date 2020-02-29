
const fontsContainer = document.getElementById( 'sg-fonts-info' );

fetch( '../settings.json' ).then( response => response.json() ).then( ( data ) => {

	if ( _.isEmpty( data ) ) {
		return false;
	}

	const variables = data.global;
	const usedExpressions = [];

	_.each( variables, ( variable ) => {

		if ( variable.type === 'SassList' && _.first( variable.sources ).endsWith( 'typography.scss' ) ) {

			const expression = _.first( variable.declarations ).expression;

			if ( expression && ! _.includes( usedExpressions, expression ) ) {

				usedExpressions.push( expression );

				const para = document.createElement( 'p' );

				para.textContent = expression;

				fontsContainer.append( para );
			}
		}
	} )

} );
