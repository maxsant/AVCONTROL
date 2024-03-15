<?php 
require_once(__DIR__. '/../../../config/connection.php');

class userModel extends Connect
{
    static public function index($table)
    {
        $connect=new Connect();
        $connect2=$connect->connection();
        $connect->set_names();
        $sql="SELECT * FROM $table";

        $stmt=$connect2->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    static public function user($id,$table)
    {
        $connect=new Connect();
        $connect2=$connect->connection();
        $connect->set_names();
        $sql="SELECT * FROM $table WHERE id=?";
        
        $stmt=$connect2->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
}
?>
