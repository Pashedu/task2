<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 22.02.17
 * Time: 12:06
 */
require_once "myDBlib/myDBHandle.php";
require_once "controller/render.php";
$dbh = new \myDBHandle\myDBHandle();


    $rows=$dbh->searchRecords(['id'=>$_POST['edit']],'Companies');
    $rows[1]=$dbh->searchRecords(['comp_id'=>$rows[0]['id']],'compDomains');
    $rows[2]=$dbh->searchRecords(['comp_id'=>$rows[0]['id']],'offices');
    for($i=0, $officesCount=count($rows[2]); $i<$officesCount; $i++)
    {

        $rows[2][$i][1]=$dbh->searchRecords(['office_id'=>$rows[2][$i]['id']],'workers');
    }
    render('newcompanyadd1.php',['id'=>$_POST['edit'],'company'=>$rows[0],'urls'=>$rows[1],'offices'=>$rows[2]]);



