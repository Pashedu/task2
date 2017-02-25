<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 17.02.17
 * Time: 13:37
 */

    require_once "myDBlib/myDBHandle.php";
    require_once "controller/render.php";
    $dbh = new \myDBHandle\myDBHandle();
    $result=$dbh->viewAll();
    //var_dump($result);
    render('main.php',['rows'=>$result]);

