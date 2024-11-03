<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $nickname = htmlspecialchars(trim($_POST['nickname']));  
    // Initialize an empty array for errors
    $errors = [];

    // Validate the name
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }

    // Validate the email
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
       if (empty($nickname)) {
        $errors[] = 'Nickname is required.';
    } elseif (strlen($nickname) > 8) {
        $errors[] = 'Nickname should not be longer than 8 characters.';
    }
    // Check if there are any errors
    if (!empty($errors)) {
        // If there are errors, send them back to the client as a response
        echo implode('<br>', $errors);
    } else {
        // If validation passes, proceed with the form processing
        // For example, you could save the data to a database here
        
        // Return a success message
        echo "Success! Name: $name, Email: $email, Nickname: $nickname";
   
    }
} else {    
    // If the request method is not POST, return an error message
    echo "Invalid request method.";
}
?>