
$(document).ready(function(){

			$( '.jt-waypoint' ).waypoint( {
					offset: '70%',
					handler: function() {
						$(this).addClass( 'jt-animated' );
					}
					
			} );
			
	});
/**
   * Slide left instantiation and action.
   */
  var slideLeft = new Menu({
    wrapper: '#o-wrapper',
    type: 'slide-left',
    menuOpenerClass: '.c-button',
    maskId: '#c-mask'
  });

  var slideLeftBtn = document.querySelector('#c-button--slide-left');
  
  slideLeftBtn.addEventListener('click', function(e) {
    e.preventDefault;
    slideLeft.open();
  });