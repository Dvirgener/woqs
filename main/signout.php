<?php
//UNSET EVERYTHING AND GO OUT ========================>
session_start();
unset($_SESSION['user_id']);
echo header("location: signin.php");
