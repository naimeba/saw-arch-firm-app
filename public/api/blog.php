<?php

/* session_start();

if (isset($_SESSION["UserId"])== false) {
    header('Location: login.html');
    return;
} */

require_once('db/mysql_credentials.php');

$con= mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);

if(mysqli_connect_errno()){
    echo"Failed to connect to mysql:".mysqli_connect_error();
}

$blogcontent=$_POST['blogcontent'];
$blogcontent=trim($blogcontent);
$blogcontent=mysqli_real_escape_string($con,$blogcontent);
//echo $blogcontent;
$keyword=$_POST['keyword'];
$keyword=trim($keyword);
$keyword=mysqli_real_escape_string($con,$keyword);
//echo $keyword;

function insertBlog($blogcontent, $keyword, $db_connection) {

    $query =  "insert into blog (keywords,blog_content) values ('".$keyword."','".$blogcontent."');";
    $res = mysqli_query($db_connection,$query);
    return $res;
}

$successful = insertBlog ($blogcontent,$keyword,$con);
if ($successful) {
    // Success message
    header("Location: index.html");
    return;
} else {
    // Error message
    echo $successful;
    echo "There was an error in the insert blog process";
}



