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
    static public function create($table, $data)
    {
        $connect=new Connect();
        $connect2=$connect->connection();
        $connect->set_names();
        
        $sql = "
            INSERT INTO
                $table (name, lastname, identification, phone, email, password_hash, role_id, identification_type_id, created)
            VALUES
                (:name, :lastname, :identification, :phone, :email, :password_hash, :role_id, :identification_type_id, :created)
            
        ";
        
        $stmt=$connect2->prepare($sql);
        $stmt->bindParam(":name", $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(":lastname", $data['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(":identification", $data['identification'], PDO::PARAM_STR);
        $stmt->bindParam(":phone", $data['phone'], PDO::PARAM_STR);
        $stmt->bindParam(":email", $data['email'], PDO::PARAM_STR);
        $stmt->bindParam(":password_hash", $data['password_hash'], PDO::PARAM_STR);
        $stmt->bindParam(":role_id", $data['role_id'], PDO::PARAM_STR);
        $stmt->bindParam(":identification_type_id", $data['identification_type_id'], PDO::PARAM_STR);
        $stmt->bindParam(":created", $data['created'], PDO::PARAM_STR);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>
