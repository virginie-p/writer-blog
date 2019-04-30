$(function() {
    
    $("#subscribe-button").click(function(e){
        e.preventDefault();
        $('.messages').empty();

        let form = $('#subscribe-form')[0];
        let formData = new FormData(form);

        $.ajax({
            url : 'index.php?action=subscribe',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false
        })
        .done(function(response){
            let data = response;
            if (data.status === 'error') {
                let errors = data.errors;
                errors.forEach(element => {
                    if (element == 'missing_fields') {
                        $('.messages').prepend('<div class="alert alert-danger" role="alert">Un ou plusieurs champs ne sont pas renseignés, tous les champs doivent être renseignés afin de procéder à la création du compte.</div>');
                    }
                    else if (element == 'image_or_size_invalid') {
                        $('.messages').prepend('<div class="alert alert-danger" role="alert">Votre image dépasse la taille maximum autorisée par le serveur (2Mo)</div>');
                    }
                    else if (element == 'upload_problem') {
                        $('.messages').prepend('<div class="alert alert-danger" role="alert">Le compte n\'a pas pu être créé en BDD.</div>');
                    }
                    else if (element == 'passwords_not_identical') {
                        $('.messages').prepend('<div class="alert alert-danger" role="alert">Les deux mots de passe renseignés ne sont pas identiques.</div>');
                    }
                    else if (element == 'username_not_matching_regex') {
                        $('.messages').prepend('<div class="alert alert-danger" role="alert">Attention, votre login doit être composé de 6 caractères minimum (incluant points, tirets et caractères alphanumériques).</div>');
                    }
                    else if (element == 'username_already_used') {
                        $('.messages').prepend('<div class="alert alert-danger" role="alert">Ce login est déjà attribué à un autre utilisateur.</div>');
                    }
                    else if (element == 'email_invalid') {
                        $('.messages').prepend('<div class="alert alert-danger" role="alert">Merci de renseigner une adresse email valide.</div>');
                    }
                    else if (element == 'password_not_matching_regex') {
                        $('.messages').prepend('<div class="alert alert-danger" role="alert">Le format du mot de passe n\'est pas respecté</div>');
                    }
                });
            }
            else if (data.status === 'success') {
                $('.messages').prepend('<div class="alert alert-success" role="alert">Votre compte a bien été créé.</div>');
                $('#subscribe-form>input').empty();
            }
        });
    });

});