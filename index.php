<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 17.02.17
 * Time: 13:37
 */

    require_once "myDBlib/myDBHandle.php";
    $dbh = new \myDBHandle\myDBHandle();

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
            $(".addfields").on('click',function () {
                window.location = '/markdel.php?id='+$(this).val();
            })
        });
    </script>
</head>
<body>
    <form action="editRecord.php" method="post">
        <?php
       // $rows=$dbh->viewAll();
        $rows=$dbh->searchRecords(['active'=>1,'id'=>28],'Companies', 'or');
        echo '<table border="solid 2px">';
        foreach ($rows as $row) {
            echo '<tr><td>' . implode('</td><td>', $row);
            echo '<td><button type="submit" name="edit" value="'.$row['id'].'">Edit</button></td>';
            echo '<td><button type="submit" name="delete" value="'.$row['id'].'">Delete</button></td>';
            echo '<td><button type="button" class="addfields" value="'.$row['id'].'">Add Fields</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        ?>
    </form>
    <form action="/controller.php" method="post">
        <input type="text" name="compname" value="" placeholder="company name">
        <input id="bornDate" type="text" name="date" value="" placeholder="date">
        <input type="text" name="desc" value="" placeholder="short description">
        <input name="Add" type="submit" value="Add">
    </form>
    <form action="restore.php">
        <button type="submit">Restore records</button>
    </form>
</body>
</html>
