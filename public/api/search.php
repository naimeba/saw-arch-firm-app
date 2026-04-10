<?php
require_once('headerSnippet.php');
// TODO: change credentials in the db/mysql_credentials.php file
require_once('db/mysql_credentials.php');

mysqli_report(MYSQLI_REPORT_OFF);
// Open DBMS Server connection
$con= mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_db);

if(mysqli_connect_errno()){
    echo"Failed to connect to mysql:".mysqli_connect_error();
}
// Get search string from $_GET['search']
// but do it IN A SECURE WAY

if ( isset($_GET["search"]) == false){
    header("Location: index.html");
}

$search = $_GET['search']; // replace null with $_GET and sanitization
$search=trim($search);

$search=mysqli_real_escape_string($con,$search);

function search($search, $db_connection) {
    // TODO: search logic here
    $query= "SELECT * FROM blog WHERE  MATCH(keywords,blog_content) AGAINST ('".$search."' IN NATURAL LANGUAGE MODE);";
    //$query= "SELECT *, MATCH(keywords,blog_content) AGAINST (\"calcestruzzo\" IN NATURAL LANGUAGE MODE) FROM blog;"
    // Return array of results
    $res = mysqli_query($db_connection,$query);
    return $res;
}

// Search on database
$results = search($search, $con);

require_once('menu.php');

$display_search = '<div class="display-search-result">';
if ($results) {

    $blogs_res = '';
    foreach ($results as $result) {
    // Format as you like and print search results
        $blogs_res=$blogs_res.'<div class="blog-content display-search-blog">'.$result['blog_content'].'</div>';
    }

    if (strlen($blogs_res) == 0){
        $display_search=$display_search.'<p id="no-result">No results found</p>';
    } else {
        $display_search=$display_search.$blogs_res;
    }
    
} else {
    // No matches found
    $display_search=$display_search.'<p>No results found. Ciao!</p>';
}
$display_search = $display_search.'</div>';
echo $display_search;
