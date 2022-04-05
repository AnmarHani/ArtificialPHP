<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
class Model{
    public $name;
    function __construct($db, $name='undefined'){
        $this->db = $db;
        $this->name = $name;
    }
    
    function create($thatArray){
            $thisArray = array();
            foreach($thatArray as $key=>$value){
                $thisArray[] = "{$key} {$value}";
            }

            $sql = "CREATE TABLE {$this->name} (" . implode(",", $thisArray) . ");";

            $this->db->exec($sql);
    }

    function GET($condition=''){
        if($condition == ''){
            $sql = "SELECT * FROM {$this->name};";           
        }
        else{
            $sql = "SELECT * FROM {$this->name} WHERE {$condition};";
        }
        $result = $this->db->query($sql);
        
        // $emparray = array();
        // while($row = $result->setFetchMode(PDO::FETCH_ASSOC))
        // {
        //     $emparray[] = $row;
        // }
        
        // $result->fetchAll(PDO::FETCH_ASSOC);

        // $arr2 = json_decode($arr);
        // echo json_encode(array("data"=>$arr2));

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    function POST($inputArray){
        $sql = "INSERT INTO {$this->name} VALUES (" . implode(",", $inputArray) . ");";

        $this->db->exec($sql);
        
        return $inputArray;
    }
    
    
    function PUT($inputArray, $condition){
        $thisArray = array();
        foreach($inputArray as $key=>$value){
            $thisArray[] = "{$key} = {$value}";
        }
        $sql_first = "UPDATE {$this->name} SET " . implode(",", $thisArray) . " WHERE {$condition};";
        
        $this->db->exec($sql_first);

        $sql_second = "SELECT * FROM {$this->name} WHERE {$condition};";
        
        $result = $this->db->query($sql_second);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function DELETE($condition){
        $sql = "DELETE FROM {$this->name} WHERE {$condition};";

        $this->db->exec($sql);

        return true;
    }
}

class Response {
    function send($arr){
        ob_clean();
        ob_start();
        print_r(json_encode($arr));
    }
}

class Route {
    function call($func){
        return $func($_REQUEST, new Response());
    }
}


class App {
    public $db;

    function __construct($dbname='',$servername = "localhost",$username = "root", $password = "") {
        try {
            $this->db = new PDO("mysql:host=$servername;dbname={$dbname}", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
  }

?>