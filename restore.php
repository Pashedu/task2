<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>заголовок</title>
</head>
<body>
    <form action="editRecord.php" method="post">
        <?php
        require_once "myDBlib/myDBHandle.php";
        $dbh = new \myDBHandle\myDBHandle();
        $rows=$dbh->searchRecords(['active'=>0],'Companies');
        echo '<table border="solid 2px">';
        foreach ($rows as $row) {
            echo '<tr><td>' . implode('</td><td>', $row);
            echo '<td><button type="submit" name="restore" value="'.$row['id'].'">Restore</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        ?>

    </form>
</body>
</html>

