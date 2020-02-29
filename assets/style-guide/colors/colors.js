
const colorsContainer = document.getElementById( 'sg-colors' );

fetch( '../settings.json' ).then( response => response.json() ).then( ( data ) => {

	if ( _.isEmpty( data ) ) {
		return false;
	}

	const variables = data.global;
	const usedExpressions = [];

	_.each( variables, ( variable ) => {
		if ( variable.type === 'SassColor' && variable.value.hex ) {

			const expression = _.first( variable.declarations ).expression;

			if ( expression && expression.startsWith( '$' ) && ! _.includes( usedExpressions, expression ) ) {

				usedExpressions.push( expression );

				const box = document.createElement( 'li' );
				const pallet = document.createElement( 'div' );
				const varInput = document.createElement( 'input' );

				pallet.style.backgroundColor = variable.value.hex;
				varInput.value = expression;

				box.append( pallet );
				box.append( varInput );

				varInput.addEventListener( 'click', () => {
					varInput.select();
					document.execCommand( 'copy' );
				} );

				box.classList.add( 'sg-color-box' );

				colorsContainer.append( box );
			}
		}
	} )

} );
