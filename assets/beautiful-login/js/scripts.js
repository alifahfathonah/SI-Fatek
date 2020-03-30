
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    $.backstretch("http://localhost/fatek.unsrat.ac.id/portal/assets/beautiful-login/img/backgrounds/slide01.jpg");
    
    /*
	    Modals
	*/
	$('.launch-modal').on('click', function(e){
		e.preventDefault();
		$( '#' + $(this).data('modal-id') ).modal();

        var url = $(this).data('url');
        console.log(url);

        $('#modal_dosen').find('form')[0].reset();
        $('#modal_mhs').find('form')[0].reset();
        $('.error-message').remove();

	});

    //Get from API
    if (typeof message_login_dsn !== 'undefined') {
        $('#modal_dosen').modal('show');
    }

    if (typeof message_login_mhs !== 'undefined') {
        $('#modal_mhs').modal('show');
    }

    
    /*
        Form validation
    */
	$('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $('.login-form').on('submit', function(e) {
    	
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function(){
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });
    
    
});
