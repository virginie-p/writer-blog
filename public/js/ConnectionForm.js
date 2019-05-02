$(function() {
    
    $("#connect-button").click(function(e){
        e.preventDefault();
        $('.messages').empty();

        let form = $('#connexion-form')[0];
        let formData = new FormData(form);

        $.ajax({
            url : $('#connexion-form').attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false
        })
        .done(function(response){
            let data = response;
            if (data.status === 'error') {
                $('#connexion-form').find('input').val('');
                $('.messages').prepend('<div class="alert alert-danger" role="alert">Aucun couple utilisateur/mot de passe existant sur le serveur. Merci de réessayer.</div>');
            }
            else if (data.status === 'success') {
                document.location.reload(true);
            }
        });
    });

});