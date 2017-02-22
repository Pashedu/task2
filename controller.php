<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 21.02.17
 * Time: 12:28
 */
    require_once 'myDBlib/myDBHandle.php';

    var_dump($_POST);

    $dbh = new \myDBHandle\myDBHandle();
    //$dbh->getDBInfo();
    $dbh->newRecord('Companies',['id'=>null,
                    'companyname'=>$_POST['compname'],
                    'regdate'=>  date($_POST['date']),
                    'active'=>true,
                    'description'=>$_POST['desc']
                    ]);

