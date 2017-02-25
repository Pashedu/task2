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
<form action="/basefunc.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="text" name="compname" value="<?php echo $company['companyname']; ?>" placeholder="company name">
    <input id="bornDate" type="text" name="date" value="<?php echo $company['regdate']; ?>" placeholder="date">
    <input type="text" name="desc" value="<?php echo $company['description']; ?>" placeholder="short description">
    <br><br>
    <?php
        $i=0;

        foreach( $urls as $url)
        {
            echo '<input type="text" name="url[]" value="'.$url['compDomain'].'">';
        }
        echo '<br><input type="text" name="url[]" value="" placeholder="Enter Url:">';
        echo '<br><br>';
        $i=0;
        //var_dump($offices);
        foreach( $offices as $office)
        {
            echo '<input type="text" name="office['.$i.'][address]" value="'.$office['address'].'">';
            echo '<fieldset>';
            $j=0;
            foreach( $office[1] as $worker)
            {
                echo '<input type="text" name="office['.$i.']['.$j.'][fn]" value="'.$worker['first_name'].'">';
                echo '<input type="text" name="office['.$i.']['.$j.'][ln]" value="'.$worker['last_name'].'">';
                echo '<input type="text" name="office['.$i.']['.$j.'][phone]" value="'.$worker['phone'].'"><br>';
                $j++;
            }
            echo '<input type="text" name="office['.$i.']['.$j.'][fn]" value="" placeholder="Прізвище">';
            echo '<input type="text" name="office['.$i.']['.$j.'][ln]" value="" placeholder="Ім\'я">';
            echo '<input type="text" name="office['.$i.']['.$j.'][phone]" value="" placeholder="Телефон">';
            echo '</fieldset>';
            $i++;
        }
        echo '<input type="text" name="office['.$i.'][address]" value="" placeholder="Enter office address:">';
        echo '<br><br>';
    ?>

    <br>
    <button type="submit">Set changes</button>
    <input type="button" onclick="location.href='/index.php';" value="Go to Main View">
</form>

</body>
</html>