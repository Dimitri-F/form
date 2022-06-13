<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require './phpMailer/Exception.php';
require './phpMailer/PHPMailer.php';
require './phpMailer/SMTP.php';
$mail = new PHPMailer(true);
// we create an object here, with all the answers
$formJson = array("name" => "", "email" => "", "message" => "", "nameError" => "", "emailError" => "", "messageError" => "", "isSuccess" => false);
//the address that will receive the emails
$emailTo = "dimitri.fonsat@gmail.com";
//we define a constant for the redirection in case of captcha failure
define('INDEX', 'index.php');
//we check if the POST method is used
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //we check if "recaptchaResponse" contains a value
    if(empty($_POST['recaptcha-response'])){
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = INDEX;
        header("Location: http://$host$uri/$extra");
        exit;
    }else{
        //we prepare the url for the captcha response
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=6Lc5h2cgAAAAAKGoBDtPHlcibokr7wf4HgQ8WbNi&response={$_POST['recaptcha-response']}";
        $response = file_get_contents($url);
        //we check that we have an answer to the captcha
        if(empty($response) || is_null($response)){
            // refresh the page if the answer is empty or returns null
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra = INDEX;
            header("Location: http://$host$uri/$extra");
            exit;
        }else{
            $data = json_decode($response);
            if($data->success){
        // cleaning data from form inputs
        $formJson["name"] = test_input($_POST["name"]);// data cleaning
        $formJson["email"] = test_input($_POST["email"]);
        $formJson["message"] = test_input($_POST["message"]);
        $formJson["isSuccess"] = true;
        $emailText = "";
        // we check if the input values are present and well formatted
        if (empty($formJson["name"])){
            $formJson["nameError"] = "I want to know everything. Even your name!";
            $formJson["isSuccess"] = false;
            }
        else{
            $emailText .= "Name: {$formJson['name']}\n";
        }
        if(!isEmail($formJson["email"]))
        {
            $formJson["emailError"] = "Are you trying to trick me? This is not an email!";
            $formJson["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Email: {$formJson['email']}\n";
        }
        if (empty($formJson["message"]))
        {
            $formJson["messageError"] = "What do you want to tell me?";
            $formJson["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Message: {$formJson['message']}\n";
        }
    // if all fields are filled in correctly
        if($formJson["isSuccess"]) {
            try{
                //we initialize the parameters for sending the email
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Remove the comment if you want to have info about SMTP process
                //SMTP
                $mail->isSMTP();
                $mail->Host = "localhost";
                $mail->Port = 1025;
                //encoding
                $mail->Charset = "utf-8";
                //receiver
                $mail->addAddress($emailTo);
                //sender
                $mail->setFrom(($formJson['email']));
                //Content
                $mail->Subject = "Mail de contact: " . ($formJson["name"]);
                $mail->Body = ($formJson['message']);
                //Mail sending
                $mail->Send();
            }catch(Exception $e){
                echo "Message non envoyé. Erreur: {$mail->ErrorInfo}";
                exit(json_encode($formJson));
            }
        }
        
    // send json objects to ajax script
        echo json_encode($formJson);
            }
            else 
            {
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = INDEX;
                header("Location: http://$host$uri/$extra");
                exit;
            }
        }
    }
}else{
    //If it is not the "POST" method that is used
    http_response_code(405);
    echo 'Méthode non autorisée';
}
function isEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function test_input($data)
{
    $data = trim($data); // we remove unnecessary spaces
    $data = stripslashes($data); // we remove the "\"
    $data = htmlspecialchars($data); // we remove the "<" or ">" characters and display html directly
    return $data;
}
