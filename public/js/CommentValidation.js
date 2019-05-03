$(function() {

    $('.validate-comment').on('click', function(e){
        e.preventDefault();
        $('.comment-validation-messages').empty();

        $.ajax({
            url : e.currentTarget.getAttribute('href'),
            dataType: 'JSON'
        })
        .done(function(response){
            let data = response;
            if (data.status === 'error') {
                if(data.error == 'validation_did_not_work') {
                    $('.comment-validation-messages').prepend('<div class="alert alert-danger" role="alert">La validation du commentaire en base de données n\'a pas fonctionné. Merci de réessayer.</div>');
                }
                else if(data.error == 'comment_not_reported') {
                    $('.comment-validation-messages').prepend('<div class="alert alert-danger" role="alert">Vous ne pouvez pas valider un commentaire qui n\'a pas été reporté par un utilisateur.</div>');
                }
                else if(data.error == 'no_comment_id') {
                    $('.comment-validation-messages').prepend('<div class="alert alert-danger" role="alert">Aucun id de commentaire renseigné.</div>');  
                }
            }
            else if (data.status === 'success') {
                $(e.target).parents('tr:first').removeAttr('class');
                $(e.target).parents().siblings('.moderation-status').text('Validé');
                $('.comment-validation-messages').prepend('<div class="alert alert-success" role="alert">Le commentaire a été validé.</div>');
                $('.validate-comment').remove();
            }
        })
    })

});