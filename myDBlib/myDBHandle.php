<?php
/**
 * Created by IntelliJ IDEA.
 * User: pashed
 * Date: 20.02.17
 * Time: 11:00
 */

namespace myDBHandle;


class myDBHandle
{
    private static $mySQLHandle;

    function __construct()
    {
        try {
            self::$mySQLHandle = new \PDO('mysql:host=localhost', 'root', 'q12wsxza');
        } catch (\PDOException $e) {
            print "Err! - " . $e->getMessage() . "<br>";
            die();
        }
        print "connect establish<br>";
        $queryResult = self::$mySQLHandle->query("USE testDB");
        //var_dump($queryResult);
    }

    function getDBInfo()
    {
        $queryResult = self::$mySQLHandle->query("show databases");
        //var_dump($queryResult);
        foreach ($queryResult as $row) {
            print "<br>Result - " . $row[0];
            //  var_dump($row);
        }
        self::$mySQLHandle = null;
    }

    function newRecord($table, $values)
    {
        //$insertString = implode('=',$values);
        $sql = 'INSERT INTO ' . $table . '(id,companyname,regdate,active,description) VALUES (:id,:companyname,:regdate,:active,:description)';
        $queryRequest = self::$mySQLHandle->prepare($sql);
        try {
            $date = date('Y/m/d');
            //     var_dump($date);
            $result = $queryRequest->execute($values);
            var_dump($result);
            // $queryRequest = self::$mySQLHandle->query('INSERT INTO Companies(id,companyname,regdate,active,description) VALUES (null,"ftftftftf",CURRENT_DATE,true,"yghuikhj iughtrdf iugkjdrrf kihjtrdyg")');
        } catch (\PDOException $e) {
            print "Err! - " . $e->getMessage() . "<br>";
        }
    }

    function searchRecord($whatToSearch)
    {
        $queryRequest = self::$mySQLHandle->prepare('SELECT * From Companies WHERE id = :id');
        $queryRequest->bindParam('id', $whatToSearch);
        $result = $queryRequest->execute();
        // var_dump($result);
        $rows = $queryRequest->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            echo '<tr><td>' . implode('</td><td>', $row) . '</td></tr>';
        }
        //      echo json_encode($rows,JSON_PRETTY_PRINT);
        //  var_dump($rows);
        //
    }

    function viewAll()
    {
        $queryRequest = self::$mySQLHandle->query('SELECT * From Companies');
        $rows = $queryRequest->fetchAll(\PDO::FETCH_ASSOC);
        echo '<table>';
        foreach ($rows as $row) {
            echo '<tr><td>' . implode('</td><td>', $row) . '</td></tr>';
        }
        echo '</table>';
        // echo json_encode($rows,JSON_PRETTY_PRINT);
    }

    function updateRecord($table,$id,$values)
    {
        $sql = 'UPDATE '.$table.' SET ';

        foreach ($values as $field => $item) {
            echo '<br>'.$field.'  ----  '.$item.'<br>';
            $sql .= $field.' = :'.$field.',';
        }
        $sql=substr($sql,0,-1);
        $sql.= ' WHERE id = '.$id;
        $queryRequest = self::$mySQLHandle->prepare($sql);
        $result = $queryRequest->execute($values);
        var_dump($queryRequest->errorInfo());
        echo '<br>'.$result;

    }
}