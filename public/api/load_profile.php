<?php
session_start();
if (isset($_SESSION["UserId"])) {
    echo $_SESSION["UserId"];
}
