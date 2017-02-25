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
            });
        });
    </script>
</head>
<body>
    <form action="editRecord.php" method="post">
        <?php
        echo '<table border="solid 2px">';
        foreach ($rows as $row) {
            echo '<tr><td>' . implode('</td><td>', $row);
            echo '<td><button type="submit" name="edit" value="'.$row['id'].'">Edit</button></td>';
            echo '<td><button type="submit" name="delete" value="'.$row['id'].'">Delete</button></td>';
           // echo '<td><button type="button" class="addfields" value="'.$row['id'].'">Add Fields</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        ?>
    </form>
    <form action="/savenew.php" method="post">
        <button name="Add" type="submit" value="addNew">Add New Company</button>
    </form>
</body>
</html>
