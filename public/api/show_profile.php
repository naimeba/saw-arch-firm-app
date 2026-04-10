<?php

require_once('headerSnippet.php');

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
}

if (isset($_SESSION["Email"])== false) {
    header('Location: login.html');
    return;
}

require_once('menu.php');

$email = $_SESSION["Email"];
$email=trim($email);
// Get profile data from database (check current session)
$email=mysqli_real_escape_string($con,$email);

    // TODO: check if passwords match
$query = "select * from utenti where email='".$email."';";

$res = mysqli_query($con,$query);

if ($res){

    $row = mysqli_fetch_assoc($res);

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    
    // TODO: format it however you like in this page that shows profile data
    echo '<div class="show-profile-content">';
    echo '<div class=show-profile-item><p>Email</p>'.$email.'</div>'; // replace null with $_POST and sanitization
    echo '<div class=show-profile-item><p>First Name</p>'.$first_name.'</div>'; // replace null with $_POST and sanitization
    echo '<div class=show-profile-item><p>Last Name</p>'.$last_name.'</div>'; // replace null with $_POST and sanitization
    echo '<div class=show-profile-item><button><a href="update_pass.html">Update Password</a></button>';
    echo '</div>';
} else {
    echo '<div class="show-profile-content">';
    echo "<p>Unable to process</p>";
    echo '</div>';
}


