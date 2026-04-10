<?php

// TODO: change credentials in the db/mysql_credentials.php file
require_once('db/mysql_credentials.php');
session_start();
if (isset($_SESSION["UserId"])== false) {
    header('Location: login.html');
    return;
} 
// Open DBMS Server connection
$con= mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);

if(mysqli_connect_errno($con)){
    echo"Failed to connect to mysql:".mysqli_connect_error($conn);
    return;
}

// Get value from $_SESSION
if (isset($_SESSION["Email"])== false) {
    header('Location: login.html');
    return;
} 
$email = $_SESSION["Email"]; // replace null with $_SESSION
$email =trim($email);
$email = mysqli_real_escape_string($con,$email);


// Get values from $_POST, but do it IN A SECURE WAY
$first_name = $_POST['firstname']; // replace null with $_POST and sanitization
$first_name =trim($first_name);
$first_name = mysqli_real_escape_string($con,$first_name);
$last_name = $_POST['lastname']; // replace null with $_POST and sanitization
$last_name = trim($last_name);
$last_name =mysqli_real_escape_string($con,$last_name);

$newemail = "";
if ( isset($_POST['email']) == true )
{
    $newemail = $_POST['email'];
    $newemail = trim($newemail);
    $newemail =mysqli_real_escape_string($con,$newemail);
} else {
    $newemail = $email;
}

// Get additional values from $_POST, but do it IN A SECURE WAY
// If you have additional values, change functions params accordingly

function update_user($email, $first_name, $last_name, $newemail, $db_connection) {
    // TODO: update logic here
    $query = "update utenti set last_name = '".$last_name."', first_name= '".$first_name."', email='".$newemail."' where email='".$email."';";
    // Return if the update was successful
 
    $res = mysqli_query($db_connection,$query);
    if (!$res){
        echo 'Error: '.mysqli_error($db_connection);
    }
    return $res;
}

// Get user from login
$successful = update_user($email, $first_name, $last_name, $newemail, $con);

if ($successful) {
    // Success message
    $_SESSION["Email"]=$newemail;
    $_SESSION["UserId"]=$first_name;
    header("Location: show_profile.php");
    exit();
} else {
    // Error message
    echo "There was an error in the update process.";
}
