<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gugi&family=Mina&display=swap" rel="stylesheet">
    <link href="main.css" rel="stylesheet" />
</head>

<body>

    <form id="contact-form" class="email-form" autocomplete="off">
        <h1 class="email-form__title">Send me an email </h1>
        <p class="email-form__note">By filling this small form, an email will be automatically sent to me</p>
        <label for="name">Last name <span class="span--color">*</span></label>
        <input id="name" type="text" name="name" class="email-form__text" placeholder="Your name"/>
        <p class="comments"></p>
        <label for="email">Email <span class="span--color">*</span></label>
        <input id="email" type="text" name="email" class="email-form__text" placeholder="Your email adress"/>
        <p class="comments"></p>
        <label for="message">Message <span class="span--color">*</span></label>
        <textarea id="message" name="message" class="email-form__textarea" placeholder="Your message"></textarea>
        <p class="comments"></p>
        <p class="form-note span--color">* All fields must be completed.</p>
        <input type="hidden" id="recaptchaResponse" name="recaptcha-response"/>
        <button type="submit" class="email-form__button">Send</button>
    </form>
    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--SCRIPT ReCaptcha--- don't forget to put your recaptcha site key in the script declaration but also in the function below.-------------------------------------------------------->
    <script src="https://www.google.com/recaptcha/api.js?render=your site key here"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('your_site_key_here', { action: 'homepage' }).then(function (token) {
                document.getElementById("recaptchaResponse").value = token;
            });
        });
    </script>
    <script src="script.js"></script>
</body>

</html>