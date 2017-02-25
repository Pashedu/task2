<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 17.02.17
 * Time: 13:37
 */
    error_reporting(E_ALL);
    require_once 'myDBlib/myDBHandle.php';
    require_once 'controller/render.php';
    //var_dump($_POST);

    $Id=$_POST['id'];
    $dbh = new \myDBHandle\myDBHandle();
    if($_POST['id']==0){
        $Id = $dbh->newRecord('Companies', ['id' => null,
            'companyname' => $_POST['compname'],
            'regdate' => date($_POST['date']),
            'active' => true,
            'description' => $_POST['desc']
        ]);
    }
    else
    {
        $dbh->updateRecord('Companies', $_POST['id'], [
            'companyname' => $_POST['compname'],
            'regdate' => date($_POST['date']),
            'active' => true,
            'description' => $_POST['desc']
        ]);
    }

   // echo '<br><br>';
    $rows=$dbh->searchRecords(['comp_id'=>$Id],'compDomains');
   // var_dump($rows);

    $lengthBase = count ($rows);
    $lengthPost = count ($_POST['url']);
    for ($i = 0; $i < $lengthBase; $i++) {
        if($_POST['url'][$i]!=null){
            $dbh->updateRecord('compDomains', $rows[$i]['id'], ['compDomain' => $_POST['url'][$i]]);
        }
        else{
            $dbh->deleteRecord('compDomains',$rows[$i]['id']);
        }
    }
    $i=$lengthBase;
   // echo $i.' NEW URL - '.$_POST['url'][$i];
    while($i<$lengthPost)
    {
        if($_POST['url'][$i]!=null)
        {
            $dbh->newRecord('compDomains',['comp_id'=>$Id,'compDomain'=>$_POST['url'][$i]]);

        }
        $i++;
    }

    $rows=$dbh->searchRecords(['comp_id'=>$Id],'offices');

    $lengthBase = count ($rows);
    $lengthPost = count ($_POST['office']);
    for ($i = 0; $i < $lengthBase; $i++) {
        if($_POST['office'][$i]['address']!=null){
            $dbh->updateRecord('offices', $rows[$i]['id'], ['address' => $_POST['office'][$i]['address']]);
            // workers handle
            $rowsWorkers=$dbh->searchRecords(['office_id'=>$rows[$i]['id']],'workers');
            $lengthBaseWorker = count ($rowsWorkers);
            $lengthPostWorker = count ($_POST['office'][$i]);

            for ($j = 0; $j < $lengthBaseWorker; $j++) {
              //  var_dump($_POST['office'][$i][$j]); echo '<br>';
                if(($_POST['office'][$i][$j]['fn']!=null)||
                    ($_POST['office'][$i][$j]['ln']!=null)||
                    ($_POST['office'][$i][$j]['phone']!=null))
                {
                    $dbh->updateRecord('workers', $rowsWorkers[$j]['id'], ['first_name' => $_POST['office'][$i][$j]['fn'],
                                                                            'last_name'=>$_POST['office'][$i][$j]['ln'],
                                                                            'phone'=>$_POST['office'][$i][$j]['phone']]);
                }
                else{
                    $dbh->deleteRecord('workers', $rowsWorkers[$j]['id']);
                }
            }
            $j=$lengthBaseWorker;

            while($j<$lengthPostWorker)
            {
                if(($_POST['office'][$i][$j]['fn']!=null)||
                    ($_POST['office'][$i][$j]['ln']!=null)||
                    ($_POST['office'][$i][$j]['phone']!=null))
                {
                    $dbh->newRecord('workers', ['office_id'=>$rows[$i]['id'],
                        'first_name' => $_POST['office'][$i][$j]['fn'],
                        'last_name'=>$_POST['office'][$i][$j]['ln'],
                        'phone'=>$_POST['office'][$i][$j]['phone']]);

                }
                $j++;
            }

        }
        else{
            $dbh->deleteRecord('offices',$rows[$i]['id']);
        }
    }
    $i=$lengthBase;
    // echo $i.' NEW URL - '.$_POST['url'][$i];
    while($i<$lengthPost)
    {
        if($_POST['office'][$i]['address']!=null)
        {
            $dbh->newRecord('offices',['comp_id'=>$Id,'address'=>$_POST['office'][$i]['address']]);

        }
        $i++;
    }
   
    unset($rows);
    $rows=$dbh->searchRecords(['id'=>$Id],'Companies');
    $rows[1]=$dbh->searchRecords(['comp_id'=>$rows[0]['id']],'compDomains');
    $rows[2]=$dbh->searchRecords(['comp_id'=>$rows[0]['id']],'offices');
    for($i=0, $officesCount=count($rows[2]); $i<$officesCount; $i++)
    {

        $rows[2][$i][1]=$dbh->searchRecords(['office_id'=>$rows[2][$i]['id']],'workers');
    }
    render('newcompanyadd1.php',['id'=>$Id,'company'=>$rows[0],'urls'=>$rows[1],'offices'=>$rows[2]]);

