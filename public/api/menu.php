<?php

echo '
<script type="text/javascript" src="/js/funct_helpers.js"></script>
<div class="content-nav-bar"><p id="userid"></p>  
    <div class="form-popup" id="myForm">
        <form action="login.php" method="POST" class="form-container">
            <h1>Login</h1>
            <label for="formemailid"><b>Email</b></label>
            <input id="formemailid" type="email" placeholder="Enter Email" name="email"/>
            <label for="formpass"><b>Password</b></label>
            <input id="formpass" type="password" placeholder="Enter Password" name="pass"/>
            <input type="submit" class="btn" value="Submit"/>
            <button type="button" class="btn cancel" onclick="closeForm(\'myForm\')">Close</button>
        </form>
    </div>
    <div class="menu-container" onclick="changeMenuIcon(this)">
        <div class="menu-bar1"></div>
        <div class="menu-bar2"></div>
        <div class="menu-bar3"></div>
        <div class="dropdown">
            <div id="myDropdown" class="dropdown-content">
                <a href="/index.html">Home</a>
                <a href="/api/showBlog.php">Blog</a>
                <a href="/search.html">Search</a>
                <a id ="linklogin" href="/login.html">Log In</a>
                <a id ="linkregister" href="/registration.html">Register</a>
            </div>
        </div>
    </div>
    <p class="open-button" id="loginid" onclick="openForm(\'myForm\')">Log In</p>
</div>';