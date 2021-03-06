jQuery(document).ready(function () {

    $('#contact-form').submit(function (e) {
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();
        //ajax request sent on form submission
        $.ajax({
            type: 'POST',
            url: 'treatment.php',
            data: postdata,
            dataType: 'json',
            success: function (json) {
                //if the request is successful
                if (json.isSuccess) {
                    $('#contact-form').append("<p class='thank-you'>Your message has been sent. Thank you for contacting me :)</p>");
                    $('#contact-form')[0].reset();
                } else {
                    $('#name + .comments').html(json.nameError);
                    $('#email + .comments').html(json.emailError);
                    $('#message + .comments').html(json.messageError);
                }
            }
        });
    });
});

