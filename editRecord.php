<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 22.02.17
 * Time: 12:06
 */
require_once "myDBlib/myDBHandle.php";

$dbh = new \myDBHandle\myDBHandle();


    if(isset($_POST['save']))
    {
        $dbh->updateRecord('Companies',$_POST['save'],['companyname'=>$_POST['compname'],
            'regdate'=>$_POST['regdate'],'description'=>$_POST['desc']]);
        echo 'Record Updated';
        $rows=$dbh->searchRecords(['id'=>$_POST['save']],'Companies');
        renderFields($rows);
    }
    if (isset($_POST['edit']))
    {
        $rows=$dbh->searchRecords(['id'=>$_POST['edit']],'Companies');
        var_dump($rows);
        renderFields($rows);

    }
    if(isset($_POST['restore']))
    {
        $dbh->updateRecord('Companies',$_POST['restore'],['active'=>1]);
        echo "Restored record with id ".$_POST['restore'];
    }
    if (isset($_POST['delete']))
    {
        $dbh->updateRecord('Companies',$_POST['delete'],['active'=>0]);
        echo "Deleted record with id ".$_POST['delete'];

    }
    function renderFields($rows)
    {
        echo "<form method='post' action='editRecord.php'>";
        echo "<input name='compname' type='text' value='".$rows[0]['companyname']."'>";
        echo "<input name='regdate' type='text' value='".$rows[0]['regdate']."'>";
        echo "<input name='desc' type='text' value='".$rows[0]['description']."'>";
        echo "<br>";
        echo "<button name='save' type='submit' value='".$rows[0]['id']."'>Save</button>";
        echo "<input type='reset' value='Reset'>";
        echo "</form>";
    }

