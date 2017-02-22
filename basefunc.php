<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 17.02.17
 * Time: 13:37
 */
error_reporting(E_ALL);
function baseconn()
{
    $link = mysqli_connect('localhost', 'root', 'q12wsxza');
    if (!$link) {
        die('Could not connect: ' . mysqli_error());
    }
    echo 'Connected successfully';
    mysqli_close($link);
}


