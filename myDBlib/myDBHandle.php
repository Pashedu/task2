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
        $queryResult = self::$mySQLHandle->query("USE testDB");
    }

    function getDBInfo()
    {
        $queryResult = self::$mySQLHandle->query("show databases");

        foreach ($queryResult as $row) {
            print "<br>Result - " . $row[0];
        }
        self::$mySQLHandle = null;
    }

    function newRecord($table, $values)
    {
        //$insertString = implode('=',$values);
        //$sql = 'INSERT INTO ' . $table . '(id,companyname,regdate,active,description) VALUES (:id,:companyname,:regdate,:active,:description)';
        $sql = "INSERT INTO {$table} ";
        $fields = '(';
        $prepareValues = '(';
        foreach ($values as $field => $item) {
            $fields .= $field.',';
            $prepareValues .= ':'.$field.',';
        }
        $fields=substr($fields,0,-1);
        $prepareValues=substr($prepareValues,0,-1);
        $sql .= $fields.') VALUES '.$prepareValues.')';
       // var_dump($sql);
        $queryRequest = self::$mySQLHandle->prepare($sql);
        try {
            //$date = date('Y/m/d');
            $queryRequest->execute($values);

            $queryRequest = self::$mySQLHandle->prepare("SELECT LAST_INSERT_ID()");
            $queryRequest->execute();
            $result = $queryRequest->fetch(\PDO::FETCH_ASSOC);
         //   echo 'AAAA ---- ';
         //   var_dump($result);
            return $result['LAST_INSERT_ID()'];
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
    //    var_dump($sql);
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
           // echo '<br>'.$field.'  ----  '.$item.'<br>';
            $sql .= $field.' = :'.$field.',';
        }
        $sql=substr($sql,0,-1);
        $sql.= ' WHERE id = '.$id;
        $queryRequest = self::$mySQLHandle->prepare($sql);
        $result = $queryRequest->execute($values);
     //   var_dump($queryRequest->errorInfo());
      //  echo '<br>'.$result;

    }
    function deleteRecord($table,$id)
    {
        $sql="DELETE FROM {$table} WHERE id = :id";
        $queryRequest = self::$mySQLHandle->prepare($sql);
        $queryRequest->bindParam('id',$id);
        $queryRequest->execute();
       // echo "<br>";
        //var_dump($queryRequest->errorInfo());
    }
}