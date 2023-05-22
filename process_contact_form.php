<?php

session_start();


    // connect to database (PDO - PHP database Object)
    $database = new PDO(
        "mysql:host=devkinsta_db;dbname=Study_Group", 
        "root", // username
        "r9wz9RSYYaTbjS7v" // password 
    );
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

if (empty($name) || empty($email) || empty($message)){
    $error = "You better type something!";
} else if (strlen($message) < 10){
    $error = 'Must be 10 Character';
} else {
    $success = "Welcome to DENISH Home";
    // 2. add $_POST['student_name'] to students array ( $_SESSION['students'] )
    $sql = 'INSERT INTO users (`name`, `email`, `message`) 
        VALUES (:name, :email, :message)';
    
    $query = $database -> prepare( $sql );

    $query->execute([ 
        'name' => $name,
        'email' => $email,
        'message' => $message
    ]);

    // 3. redirect the user back to index.php

}

        // do error checking
        if ( isset( $error ) ) {
            // store the error message in session
            $_SESSION['error'] = $error;
            // redirect the user back to login.php
            header("Location: index.php");
            exit;
        }

        
        // do error checking
        if ( isset( $success ) ) {
            // store the error message in session
            $_SESSION['success'] = $success;
            // redirect the user back to login.php
            header("Location: index.php");
            exit;
        }
