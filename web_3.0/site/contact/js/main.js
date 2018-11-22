
(function ($) {
    "use strict";

    /*================================================================== [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){ // si les champs sont vides ou incorrect, on affiche les champs en rouge via showvalidate
                showValidate(input[i]);
                check=false;
            }
        }

        var name = $("#name").val();
        var lastname = $("#lastname").val();
        var email = $("#email").val();
        var phonenumber = $("#phonenumber").val();
        var message = $("#message").val();

        // Checking for blank fields.
        if (name == '' || email == '' || contact == '') {
            alert("Please Fill Required Fields");
        } else {
// Returns successful data submission message when the entered information is stored in database.
            $.post("contact_form.php", {
                name1: name,
                email1: email,
                message1: message,
                contact1: contact
            }, function(data) {
                $("#returnmessage").append(data); // Append returned message to message paragraph.
                if (data == "Your Query has been received, We will contact you soon.") {
                    $("#form")[0].reset(); // To reset form fields on success.
                }
            });
        }



        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) { //verification des champs
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false; // on supprime les espaces avant et après
            }
        }
    }

    function showValidate(input) { //afficher les champs en rouge si pas ok
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    

})(jQuery);