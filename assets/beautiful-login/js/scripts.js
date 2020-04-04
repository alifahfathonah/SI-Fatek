
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

        var user = $(this).data('user');
        console.log(user);

        $(".modal-body").find('form').attr('action', window.location.href + '/' + user);
        $(".user").text(user);
        $('.error-message').remove();
    });

    //Get from API
    if (typeof message_login_dsn !== 'undefined') {
        $(".modal-body").find('form').attr('action', window.location.href + '/' + message_login_dsn);
        $(".user").text(message_login_dsn);
        $('#modal_login').modal('show');
    }

    if (typeof message_login_mhs !== 'undefined') {
        $(".modal-body").find('form').attr('action', window.location.href + '/' + message_login_mhs);
        $(".user").text(message_login_mhs);
        $('#modal_login').modal('show');
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
