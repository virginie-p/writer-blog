$(function() {

    $('.comment-report').on('click', function(e) {
        e.preventDefault();
        $('#report-message').empty();

        $.ajax({
            url : e.currentTarget.getAttribute('href'),
            dataType: 'JSON'
        })
        .done(function(response){
            let data = response;
            if (data.status === 'error') {
                if(data.error == 'report_did_not_work') {
                    $('#report-message').prepend('<div class="alert alert-danger" role="alert">Le commentaire n\'a pas pu être signalé. Merci de réessayer.</div>');
                }
                else if (data.error == 'id_does_not_exist') {
                    $('#report-message').prepend('<div class="alert alert-danger" role="alert">Merci de renseigner un numéro de commentaire pour procéder au signalement.</div>');
                }
            }
            else if (data.status === 'success') {
                $('#report-message').prepend('<div class="alert alert-success" role="alert">Le commentaire a bien été signalé. Il sera modéré dès que possible.</div>');
                $('.report-image').addClass('report-disabled');
                e.currentTarget.removeAttribute('href');
                e.currentTarget.setAttribute('title', 'Ce commentaire est en cours de modération');
            }
        });
    });

});