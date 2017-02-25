<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 23.02.17
 * Time: 16:19
 */
require_once "myDBlib/myDBHandle.php";
require_once "controller/render.php";

    $dbh = new \myDBHandle\myDBHandle();
    if (isset($_POST['delete']))
    {
        $dbh->deleteRecord('Companies',$_POST['delete']);
        $result=$dbh->viewAll();
        render('main.php',['rows'=>$result]);

    }
