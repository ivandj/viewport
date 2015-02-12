<?php

    session_start();
    require_once 'vp.php';

    echo '<pre>';
    print_r($_SESSION['vp']);
    echo '</pre>';

?>