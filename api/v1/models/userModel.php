<?php 
require_once '../../../config/connection.php';

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
        $stmt->close();
        
        return $stmt->fetchAll();
    }
}
?>
