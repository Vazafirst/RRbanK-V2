$('form#lgf').submit( function( e ) {
  $( this ).children( 'input[type=submit]' ).attr( 'disabled', 'disabled' );
  e.preventDefault(); 
  return false;
});