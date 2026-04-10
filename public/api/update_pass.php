<?php
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
$email = $_POST['email']; // replace null with $_POST and sanitization
$email=trim($email);
$email=mysqli_real_escape_string($con,$email);
$password = $_POST['oldpass']; // replace null with $_POST and sanitization
$password =trim($password);
$password =mysqli_real_escape_string($con,$password);

function login($email, $pass, $db_connection) {
    // TODO: login logic here

    $passwd = md5($pass,true);
    $query = "select * from utenti where email='".$email."';";
    $res = mysqli_query($db_connection,$query);
    $row = mysqli_fetch_assoc($res);  
    $password_db = $row['password'];
    
    if ( !(bin2hex($password_db) === bin2hex($passwd)) ){
        return null;
    }

    $utente = $row['first_name'];
    
    // Return logged user
    return  $utente;
}

// Get user from login
$user = login($email, $password, $con);

if ($user) {
    // Welcome message

    echo "name ".$user;

    $password = $_POST['pass']; // replace null with $_POST and sanitization
    $password =trim($password);
    $password =mysqli_real_escape_string($con,$password);
    $password_confirm = $_POST['confirm']; // replace null with $_POST and sanitization
    $password_confirm =trim($password_confirm);
    $password_confirm =mysqli_real_escape_string($con,$password_confirm);
    if ($password != $password_confirm){
      echo "Password does not match";;
    }
    // TODO: registration logic here
    $passwd = md5($password,true);

    $query = "update utenti set password = '".$passwd."' where email='".$email."';";
    
    $res = mysqli_query($con,$query);

    if (!$res){
        require_once('headerSnippet.php');
        require_once('menu.php');
        echo '<div class="show-profile-content">Unable to process</div>';
    }

    session_unset();
    header('Location: index.html');

} else {
    // Error message
    require_once('headerSnippet.php');
    require_once('menu.php');
    echo '<div class="show-profile-content">Wrong credentials</div>';
   
}
