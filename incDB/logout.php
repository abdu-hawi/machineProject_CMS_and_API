<?php

require ('session.php');
    
    $_SESSION['userinfo'] = false;
    
    header('location:../index.php');

?>