<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 17.02.17
 * Time: 13:37
 */

    require_once "myDBlib/myDBHandle.php";

    $dbh = new \myDBHandle\myDBHandle();
/*
  //  $dbh->getDBInfo();
    $dbh->newRecord('Companies',['id'=>null,
                    'companyname'=>'Івано-Франківський МОЗ',
                    'regdate'=>  date('Y/m/d'),
                    'active'=>true,
                    'description'=>'Тестова Українська компанія для перевірки кодування'
                    ]);
*/
    $dbh->viewAll();
  //  $dbh->searchRecord('21');
    $dbh->updateRecord('Companies','27',['companyname'=>'Грьобана заміна',
        'description'=>'Аццкий опис при заміні при переведенні компанії в стан фолс','active'=>0]);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>заголовок</title>
    <script type='text/javascript' src='js/jquery-3.1.1.js'></script>
    <script type='text/javascript' src='js/jquery-ui.min.js'></script>
    <script type='text/javascript' src='js/jquery.ui.datepicker-uk.js'></script>
    <link rel='stylesheet', href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>
    <script>
        $(function () {
            $("#bornDate").datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: new Date(),
                maxDate: new Date()
            });
        });
    </script>
</head>
<body>
    <form action="/controller.php" method="post">
        <input type="text" name="compname" value="" placeholder="company name">
        <input id="bornDate" type="text" name="date" value="" placeholder="date">
        <input type="text" name="desc" value="" placeholder="short description">
        <input name="Add" type="submit" value="Add">
    </form>
</body>
</html>
