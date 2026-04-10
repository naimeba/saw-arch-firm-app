<?php

require_once('headerSnippet.php');
require_once('menu.php');

require_once('db/mysql_credentials.php');

$con= mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);

if(mysqli_connect_errno()){
    echo"Failed to connect to mysql:".mysqli_connect_error();
}

$query = "SELECT count(*) FROM blog;";
$res = mysqli_query($con,$query);

if ($res == false) {
    echo "Errore";
    //header("Location: index.html");
    return;
}
$row=mysqli_fetch_array($res);
$totalpages=$row[0];
mysqli_free_result($res);

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$query = "SELECT * FROM blog LIMIT ?,?;";
$stmt =mysqli_prepare($con,$query);
$limit = 1;
$start=($page-1);
mysqli_stmt_bind_param($stmt,'ii',$start,$limit);
mysqli_execute($stmt);

$res = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($res);

$bgc = $row['blog_content'];
$data_pub = $row['data_pubblicazione'];
$id = $row['id'];
mysqli_stmt_close($stmt);


$currentDisplayPage = '<div class="blog-display"><div class="pub-date">'.$data_pub.'</div><div class="blog-content">'.$bgc.'</div>';

$pagination = '<div class="pagination">';

if ($page > 1) {
    $pagination = $pagination.'<a class="prev" href="showBlog.php?page='.($page-1).'">Prev</a>';
}

if ($page > 3){
    $pagination =$pagination.'<a href="showBlog.php?page=1">1</a>';
}
if ($page-2 > 0){
    $pagination = $pagination.'<a href="showBlog.php?page='.($page-2).'">'.($page-2).'</a>';  
}
if ($page-1 > 0){
    $pagination = $pagination.'<a href="showBlog.php?page='.($page-1).'">'.($page-1).'</a>';  
}
$pagination = $pagination.'<a class="active" href="showBlog.php?page='.($page).'">'.($page).'</a>';  

if ($page+1 < $totalpages+1){
    $pagination = $pagination.'<a href="showBlog.php?page='.($page+1).'">'.($page+1).'</a>';  
}
if ($page+2 < $totalpages+1){
    $pagination = $pagination.'<a href="showBlog.php?page='.($page+2).'">'.($page+2).'</a>';  
}
if ($page < $totalpages) {
    $pagination = $pagination.'<a class="next" href="showBlog.php?page='.($page+1).'">Next</a>';
}

$pagination = $pagination.'</div> ';
echo $currentDisplayPage.$pagination."</div>";