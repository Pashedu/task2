<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 22.02.17
 * Time: 15:30
 */
    require_once "myDBlib/myDBHandle.php";
    $dbh = new \myDBHandle\myDBHandle();

    $rows=$dbh->searchRecords(['id'=>$_GET['id']],'Companies');
    echo '<table border="solid 2px">';
    foreach ($rows as $row) {
        echo '<tr><td>' . implode('</td><td>', $row);
     //   echo '<td><button type="submit" name="edit" value="'.$row['id'].'">Edit</button></td>';
     //   echo '<td><button type="submit" name="delete" value="'.$row['id'].'">Delete</button></td>';
     //   echo '<td><button type="button" class="addfields" value="'.$row['id'].'">Add Fields</button></td>';
        echo '</tr>';
    }
    echo '<br><br>';
    echo '</table>';
    $rows=$dbh->searchRecords(['comp_id'=>$_GET['id']],'compDomains');
    echo '<table border="solid 2px">';
    foreach ($rows as $row) {
        echo '<tr><td>' . implode('</td><td>', $row);
        //   echo '<td><button type="submit" name="edit" value="'.$row['id'].'">Edit</button></td>';
        //   echo '<td><button type="submit" name="delete" value="'.$row['id'].'">Delete</button></td>';
        //   echo '<td><button type="button" class="addfields" value="'.$row['id'].'">Add Fields</button></td>';
        echo '</tr>';
    }
    echo '</table>';

var_dump($_GET);