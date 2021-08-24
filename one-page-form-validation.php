<?php


/*Function to create a form. Where input has already been given, this will 
 * display in the form fields (except for password). Else, it will be blank.
 */

function make_form($email=null, $username=null, $password=null, 
    $date_of_birth=null, $gender=null, $address=null){
    
        
    echo '<h2>Please fill in the following details:</h2>';
    echo '<form action="one-page-form-validation.php" method="post">';
    
    
    //Input field for email address, either blank or prefilled:
    echo '<label for="email">Email address: </label>';
    if ($email === null) {
        echo '<input type="text" id="email" name="email" required><br><br>';
    } else {
        echo '<input type="text" id="email" name="email" required value="'
            .$email.'"><br><br>';

    }

    
    //Input field for username, either blank or prefilled:
    echo '<label for="username">Username: </label>';
    if ($username === null) {
        echo '<input type="text" id="username" name="username" required><br><br>';
    } else {
        echo '<input type="text" id="username" name="username" required value="'
               .$username.'"><br><br>';

    }
    
    
    //Input field for username, either blank or prefilled:
    echo '<label for="password">Password: </label>';
    if ($password === null) {
        echo '<input type="text" id="email" name="password" required><br><br>';
    } else {
        echo '<input type="text" id="email" name="password" required><br><br>';

    }
    
    //Input field for date of birth, either blank or prefilled:
    echo '<label for="date_of_birth">Date of birth: </label>';
    if ($date_of_birth === null) {
        echo '<input type="date" id="date_of_birth" name="date_of_birth" 
                required><br><br>';
    } else {
        echo '<input type="date" id="date_of_birth" name="date_of_birth" 
                required value="'.$date_of_birth.'"><br><br>';

    }
    
    
    //Input field for gender, either blank or prefilled:
    echo '<label for="gender">Gender: </label>';
    if ($gender === null) {
        echo '<div id="gender">
		        <label for="male">Male</label>
		        <input type="radio" value="male" id="male" name="gender">
		        <label for="female">Female</label>
		        <input type="radio" value="female" id="female" name="gender">
		        <label for="other">Other</label>
		        <input type="radio" value="other" id="other" name="gender">
		     </div>';
        echo '<br>';
    } else {
        
        //Set the "checked" attribute as an empty string for each radio field
        
        $male_check = "";
        $female_check = "";
        $other_check = "";
        
        //Determine which option was selected when the form was submitted,
        //and make that attribute say "checked". The others remain blank.
        if ($gender === "male"){
            $male_check = "checked";
        } else if ($gender === "female"){
            $female_check = "checked";
        } else if ($gender === "other"){
            $other_check = "checked";
        } 
        
        
        //Print the form input with the check attribute as dynamic field.
        echo '<div id="gender">
		        <label for="male">Male</label>
		        <input type="radio" value="male" id="male" name="gender" '
		          .$male_check.'>
		        <label for="female">Female</label>
		        <input type="radio" value="female" id="female" name="gender" '
		          .$female_check.'>
		        <label for="other">Other</label>
		        <input type="radio" value="other" id="other" name="gender" '
		          .$other_check.'>
		     </div>';
        echo '<br>';
    }
    
    
    //Input field for gender, either blank or prefilled:
    echo '<label for="address">Address: </label><br>';
    if ($address === null) {
        echo '<textarea id= "address" name= "address" rows="4" cols="50" 
                required></textarea><br><br>';
    } else {
        echo '<textarea id= "address" name= "address" rows="4" cols="50" 
                required>'.$address.'</textarea><br><br>';
    }
    
                    
    echo '<button type="submit">Submit</button>';
    echo '</form>';
}


//The main validation logic for each field:

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    //Save the user input into variables we'll use
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    
    //Declare and initialise the message to be displayed upon submission
    $error_message = "<p style=\"color:red; font-weight:bold;\">Your form 
                        encountered the following problems: </p> <ul>";
    $submit_message = "Thanks for submitting the form. The details you 
                        provided are as follows: <ul>";
    
    //This boolean will be used to determined which message to display
    $error = FALSE;
    
    
    //Validate email address: must be a valid email address 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message .= "<li style=\"color:red;\">You did not enter a valid 
                            email address</li>";
        $error = TRUE;
    } else {
        $submit_message .= "<li>Email address: " . $email . "</li>";
    }
    
    //Validate username: 6-10 characters; alphanumeric only
    $username = $_POST["username"];
    
    if (preg_match("/^[a-zA-Z0-9]{6,10}$/", $username)!=1) {
        $error_message .= "<li style=\"color:red;\">You did not enter a valid 
                            username</li>";
        $error = TRUE;
    } else {
        $submit_message .= "<li>Username: " . $username . "</li>";
    }
    
    //Validate password: at least one lowercase letter, one uppercase letter, 
    //and one number
    $password = $_POST["password"];
    
    //With inspiration from: https://mkyong.com/regular-expressions/10-java-
    //regular-expression-examples-you-should-know/
    if (preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/", $password)!=1) {
        $error_message .= "<li style=\"color:red;\">You did not enter a valid 
                            password</li>";
        $error = TRUE;
    } else {
        $submit_message .= "<li>Password: " . $password . "</li>";
    }
    
    //Validate date of birth: after 1900, and before 2020
    $date_of_birth = $_POST["date_of_birth"];
    //Wtih thanks to: https://stackoverflow.com/a/4529648/12786165
    $birth_year = date('Y', strtotime($date_of_birth));
    
    if ($birth_year >2020 || $birth_year < 1900) {
        $error_message .= "<li style=\"color:red;\">You did not enter a valid 
                            date of birth</li>";
        $error = TRUE;
    } else {
        $submit_message .= "<li>Date of birth: " . $date_of_birth . "</li>";
    }
    
    //Validate gender: either “male”, “female”, or “other”
    $gender = $_POST["gender"];
    
    if (!in_array($gender,["male", "female", "other"])) {
        $error_message .= "<li style=\"color:red;\">You did not enter a valid 
                            gender</li>";
    } else {
        $submit_message .= "<li>Gender: " . $gender . "</li>";
    }
    
    //Validate address: no specifications given
    $address = $_POST["address"];
    
    if (!$address) {
        $error_message .= "<li style=\"color:red;\">You did not enter a valid 
                            address</li>";
        $error = TRUE;
    } else {
        $submit_message .= "<li>Address: " . $address . "</li>";
    }
    
    //Decide which messages to print based on whether there were any errors or not:
    if ($error === TRUE){
        
        //If there were errore, list all the validation errors (not just the first one)
        echo $error_message;
        
        //Also print the form, passing the input into the function so that the
        //fields can be pre-poppulated
        make_form($email, $username, $password, $date_of_birth, $gender, $address);
    } else {
        
        //If there were no errors, print the submitted info:
        echo $submit_message;
    }
    
    //Close the unordered list that was started within the error or success message
    echo "</ul>";
  
    
    //If the form hasn't been submitted yet, print the blank form:
} else {
    make_form();
}

?>