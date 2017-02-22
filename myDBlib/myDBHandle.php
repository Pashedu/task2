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
            $result = $queryRequest->execute($values);
            var_dump($result);
            // $queryRequest = sel::$mySQLHandle->query('INSERT INTO Companies(id,companyname,regdate,active,description) VALUES (null,"ftftftftf",CURRENT_DATE,true,"yghuikhj iughtrdf iugkjdrrf kihjtrdyg")');
        } catch (\PDOException $e) {
            print "Err! - " . $e->getMessage() . "<br>";
        }
    }

    function searchRecords($whatToSearch, $whereToSearch = 'Companies', $glue = '')
    {
        $sql="SELECT * From $whereToSearch WHERE";
        foreach ($whatToSearch as $field => $item) {
            //echo '<br>'.$field.'  ----  '.$item.'<br>';
            $sql .=" $field = :$field $glue";
        }
        $sql=substr($sql,0,-(strlen($glue)+1));
        var_dump($sql);
        $queryRequest = self::$mySQLHandle->prepare($sql);
        $result = $queryRequest->execute($whatToSearch);
        $rows = $queryRequest->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
    }

    function viewAll()
    {
        $queryRequest = self::$mySQLHandle->query('SELECT * From Companies');
        $rows = $queryRequest->fetchAll(\PDO::FETCH_ASSOC);
        return $rows;
     /*
        // echo json_encode($rows,JSON_PRETTY_PRINT);
     */
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