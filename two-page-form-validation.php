

<?php

//This file validates the form input from two-page-form.html


//Declare and initialise the message to be displayed upon submission
$error_message = "Your form encountered the following problems: <ul>";
$submit_message = "Thanks for submitting the form. The details you provided are as follows: <ul>";
//This boolean will be used to determined which message to display
$error = FALSE;


//Validate email address: must be a valid email address
$email = $_POST["email"];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_message .= "<li>You did not enter a valid email address</li>";
    $error = TRUE;
} else {
    $submit_message .= "<li>Email address: " . $email . "</li>";
}

//Validate username: 6-10 characters; alphanumeric only
$username = $_POST["username"];

if (preg_match("/^[a-zA-Z0-9]{6,10}$/", $username)!=1) {
    $error_message .= "<li>You did not enter a valid username</li>";
    $error = TRUE;
} else {
    $submit_message .= "<li>Username: " . $username . "</li>";
}
 
//Validate password: at least one lowercase letter, one uppercase letter, and one number
$password = $_POST["password"];

//With inspiration from: https://mkyong.com/regular-expressions/10-java-regular-expression-examples-you-should-know/
if (preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/", $password)!=1) {
    $error_message .= "<li>You did not enter a valid password</li>";
    $error = TRUE;
} else {
    $submit_message .= "<li>Password: " . $password . "</li>";
}

//Validate date of birth: after 1900, and before 2020
$date_of_birth = $_POST["date_of_birth"];
//With thanks to: https://stackoverflow.com/a/4529648/12786165
$birth_year = date('Y', strtotime($date_of_birth));

if ($birth_year >2020 || $birth_year < 1900) {
    $error_message .= "<li>You did not enter a valid date of birth</li>";
    $error = TRUE;
} else {
    $submit_message .= "<li>Date of birth: " . $date_of_birth . "</li>";
}

//Validate gender: either “male”, “female”, or “other”
$gender = $_POST["gender"];

if (!in_array($gender,["male", "female", "other"])) {
    $error_message .= "<li>You did not enter a valid gender</li>";
} else {
    $submit_message .= "<li>Gender: " . $gender . "</li>";
}

//Validate address: no specifications given
$address = $_POST["address"];

if (!$address) {
    $error_message .= "<li>You did not enter a valid address</li>";
    $error = TRUE;
} else {
    $submit_message .= "<li>Address: " . $address . "</li>";
}


//Decide which messages to print based on whether there were any errors or not:
if ($error === TRUE){
    echo $error_message;
} else {
    echo $submit_message;
}

echo "</ul>";

