<?php

// TODO: change credentials in the db/mysql_credentials.php file
require_once('db/mysql_credentials.php');
session_start();
// if (isset($_SESSION["UserId"])== false) {
//     header('Location: login.html');
//     return;
// } 
// Open DBMS Server connection
$con= mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);
if(mysqli_connect_errno()){
    echo"Failed to connect to mysql:".mysqli_connect_error();
}
    
// Get values from $_POST, but do it IN A SECURE WAY
$email = $_POST['email']; // replace null with $_POST and sanitization
$email=trim($email);
$email=mysqli_real_escape_string($con,$email);
$first_name = $_POST['firstname']; // replace null with $_POST and sanitization
$first_name =trim($first_name);
$first_name = mysqli_real_escape_string($con,$first_name);
$last_name = $_POST['lastname']; // replace null with $_POST and sanitization
$last_name = trim($last_name);
$last_name =mysqli_real_escape_string($con,$last_name);
$password = $_POST['pass']; // replace null with $_POST and sanitization
$password =trim($password);
$password =mysqli_real_escape_string($con,$password);
$password_confirm =$_POST['confirm']; // replace null with $_POST and sanitization
$password_confirm =trim($password_confirm);
$password_confirm =mysqli_real_escape_string($con,$password_confirm);
// Get additional values from $_POST, but do it IN A SECURE WAY
// If you have additional values, change functions params accordingly

function insert_user($email, $first_name, $last_name, $password, $password_confirm, $db_connection) {

    if ($password != $password_confirm){
        return false;
    }

    $passwd = md5($password,true);
    $query="INSERT INTO utenti(email,first_name,last_name,password)
			VALUES ('".$email."','" .$first_name."','".$last_name."','".$passwd."');";

    $res = mysqli_query($db_connection,$query);
    
    if(!$res){
        //header('HTTP/1.1 400 Bad Request');
        //echo "Error: ".mysqli_error($db_connection);
        return false;
    }
	
    // Return if the registration was successful
    return $res;
}

// Get user from login
$successful = insert_user($email, $first_name, $last_name, $password, $password_confirm, $con);

require_once('headerSnippet.php');
require_once('menu.php');
echo '<div class="show-profile-content">';

if ($successful) {
    // Success message
    echo "$email registered successfully!";
} else {
    // Error message
    echo "There was an error in the registration process.";
}
echo '</div>';
