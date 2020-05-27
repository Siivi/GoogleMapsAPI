<?php

    $host = "localhost";
    $user = "root";
    $psw = "";
    $dbname = "markers";

    $dsn = "mysql:host=$host; dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    function escape($html)
{
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
    /*
    try {
        $conn = new PDO("mysql:host=$host;dbname=markers", $user, $psw);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }*/
      /*
//session_start();
require_once "crud.php";

class Database

{   
    private $host = "mysql:host=localhost";
    private $user = "root";
    private $psw = "";
    private $dbname = "markers.markers";
    public $conn;
    public function connect()
    {
        $this->conn = mysqli_connect('localhost', 'root','','markers');
        if(mysqli_connect_error())
        {
            die("Jama majas");
        }
    }
    public function check($a)
    {
        $return = mysqli_real_escape_string($this->conn,$a);
        return $return;
    }
    public function insertRecord($name,$lat,$lng,$description)
    {
        $conn=$this->connect();

        mysqli_query($conn, "INSERT INTO ".$this->dbname."(name,lat,lng,description)VALUES('$name','$lat','$lng','$description')") or die(mysqli_error($conn));
        echo "<div style='padding:20px; background-color:yellow;'> Andmed lisatud</div>";


    }   
    
}*/
