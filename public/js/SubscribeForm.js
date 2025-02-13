$(function() {
    
    $("#subscribe-button").click(function(e){
        e.preventDefault();
        $('.messages-subscription').empty();

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
                        $('.messages-subscription').prepend('<div class="alert alert-danger" role="alert">Un ou plusieurs champs ne sont pas renseignés, tous les champs doivent être renseignés afin de procéder à la création du compte.</div>');
                    }
                    else if (element == 'image_or_size_invalid') {
                        $('.messages-subscription').prepend('<div class="alert alert-danger" role="alert">Votre image dépasse la taille maximum autorisée par le serveur (2Mo)</div>');
                    }
                    else if (element == 'upload_problem') {
                        $('.messages-subscription').prepend('<div class="alert alert-danger" role="alert">Le compte n\'a pas pu être créé en BDD.</div>');
                    }
                    else if (element == 'passwords_not_identical') {
                        $('.messages-subscription').prepend('<div class="alert alert-danger" role="alert">Les deux mots de passe renseignés ne sont pas identiques.</div>');
                    }
                    else if (element == 'username_not_matching_regex') {
                        $('.messages-subscription').prepend('<div class="alert alert-danger" role="alert">Attention, votre login doit être composé de 6 caractères minimum (incluant points, tirets et caractères alphanumériques).</div>');
                    }
                    else if (element == 'username_already_used') {
                        $('.messages-subscription').prepend('<div class="alert alert-danger" role="alert">Ce login est déjà attribué à un autre utilisateur.</div>');
                    }
                    else if (element == 'email_invalid') {
                        $('.messages-subscription').prepend('<div class="alert alert-danger" role="alert">Merci de renseigner une adresse email valide.</div>');
                    }
                    else if (element == 'password_not_matching_regex') {
                        $('.messages-subscription').prepend('<div class="alert alert-danger" role="alert">Le format du mot de passe n\'est pas respecté</div>');
                    }
                    else if (element == 'just_spaces') {
                        $('.messages-subscription').prepend('<div class="alert alert-danger" role="alert">Votre nom ou votre prénom ne peuvent pas être composés uniquement d\'espaces</div>');
                    }
                    else if (element == 'invalid_extension') {
                        $('.messages-subscription').prepend('<div class="alert alert-danger" role="alert">Ce type de fichier n\'est pas accepté. Seuls les fichiers .jpeg, .jpg et .png sont acceptés.</div>');  
                    }
                    else if (element == 'file_not_moved') {
                        $('.messages-subscription').prepend('<div class="alert alert-danger" role="alert">Le fichier n\'a pas pu être enregistré sur le serveur. Merci de bien vouloir réessayer.</div>');  
                    }
                });
            }
            else if (data.status === 'success') {
                $('.messages-subscription').prepend('<div class="alert alert-success" role="alert">Votre compte a bien été créé.</div>');
                $('#subscribe-form').find('input').val('');
            }
        });
    });

});