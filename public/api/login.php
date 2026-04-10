<?php

// TODO: change credentials in the db/mysql_credentials.php file
require_once('db/mysql_credentials.php');

// Add session control, header, ...
session_start();
require_once('headerSnippet.php');
require_once('menu.php');

// Open DBMS Server connection
$con= mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);

if(mysqli_connect_errno()){
    echo '<div class="show-profile-content">';
    echo"Failed to connect to mysql:".mysqli_connect_error($conn);
    echo '</div>';
    return;
}

// Get credentials from $_POST['email'] and $_POST['pass']
// but do it IN A SECURE WAY
$email = $_POST['email']; // replace null with $_POST and sanitization
$email=trim($email);
$email=mysqli_real_escape_string($con,$email);
$password = $_POST['pass']; // replace null with $_POST and sanitization
$password =trim($password);
$password =mysqli_real_escape_string($con,$password);

function login($email, $pass, $db_connection) {
    // TODO: login logic here
    $passwd = md5($pass,true);

    $query = "select * from utenti where email='".$email."';";

    $res = mysqli_query($db_connection,$query);

    $row = mysqli_fetch_assoc($res);
    
    $password = $row['password'];

    if ( !(bin2hex($passwd) === bin2hex($password)) ){
        return null;
    }

    $utente = $row['first_name'];
    
    // Return logged user
    return  $utente;
}

// Get user from login
$user = login($email, $password, $con);

echo '<div class="show-profile-content">';
if ($user) {
    // Welcome message
    echo "Welcome $user!";
    echo '</div>';
    $_SESSION["UserId"]=$user;
    $_SESSION["Email"]=$email;
    header('Location: index.html');
    return;
} else {
    // Error message
    echo "Wrong email or password";
}
echo '</div>';

