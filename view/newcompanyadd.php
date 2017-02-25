<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>заголовок</title>
    <script type='text/javascript' src='../js/jquery-3.1.1.js'></script>
    <script type='text/javascript' src='../js/jquery-ui.min.js'></script>
    <script type='text/javascript' src='../js/jquery.ui.datepicker-uk.js'></script>
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
<form action="/savenew.php" method="post">
  <!--  <input type="text" name="id" value="<?php echo $id;?>" > -->
    <input type="text" name="compname" value="<?php echo $companyname; ?>" placeholder="company name">
    <input id="bornDate" type="text" name="date" value="<?php echo $regdate; ?>" placeholder="date">
    <input type="text" name="desc" value="<?php echo $description; ?>" placeholder="short description">
    <br>
    <input type="text" name="url1" value="" placeholder="Enter Url:">
    <button type="button">add url</button>
    <br>
    <input type="text" name="address" value="" placeholder="Enter office address:">
    <button type="button">add office</button>
    <br>
    <input type="text" name="workerfirstname" value="" placeholder="Enter worker first name:">
    <input type="text" name="workerlastname" value="" placeholder="Enter worker  last name:">
    <input type="text" name="workerphonenum" value="" placeholder="Enter worker  phone num:">
    <button type="submit">Confirm</button> <button type="submit">Reset</button>
</form>

</body>
</html>