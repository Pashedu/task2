<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 21.02.17
 * Time: 12:28
 */
    require_once 'myDBlib/myDBHandle.php';
    require_once 'controller/render.php';

    var_dump($_POST);

    if(($_POST['Add']=='addNew'))
    {
      //  var_dump($_POST);
        render('newcompanyadd1.php',['id'=>0]);
    }
    else {

        var_dump($_POST);
        $dbh = new \myDBHandle\myDBHandle();
        $newId = $dbh->newRecord('Companies', ['id' => null,
            'companyname' => $_POST['compname'],
            'regdate' => date($_POST['date']),
            'active' => true,
            'description' => $_POST['desc']
        ]);
        echo '<br><br><br>';

        $res = $dbh->newRecord('compDomains', ['id' => null, 'comp_id' => $newId, 'compDomain' => $_POST['url1']]);
        echo "<br>$res";
        $officeId = $dbh->newRecord('offices', ['id' => null, 'comp_id' => $newId, 'address' => $_POST['address']]);
        echo "<br>$officeId";
        $res = $dbh->newRecord('workers', ['id' => null, 'office_id' => $officeId,
            'first_name' => $_POST['workerfirstname'],
            'last_name' => $_POST['workerlastname'],
            'phone' => $_POST['workerphonenum']
        ]);
        echo "<br>$res";
        $result=$dbh->viewAll();
        render('main.php',['rows'=>$result]);

    }



