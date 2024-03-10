<?php
class User extends Connect
{
    /* TODO Iniciar Session */
    public function login()
    {
        $conectar = parent::connection();
        
        if(isset($_POST['enviar'])){
            $identification = $_POST['identification'];
            $password       = $_POST['password_hash'];
            
            if(empty($identification) AND $password){
                exit();
            }else{
                $sql = '
                    SELECT
                        *
                    FROM
                        users
                    WHERE
                        identification = ? AND password_hash = ? AND is_active = 1
                ';
                
                $query = $conectar->prepare($sql);
                $query->bindValue(1, $identification);
                $query->bindValue(2, $password);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                
                if(is_array($result) AND count($result) > 0){
                    
                }else{
                    exit();
                }
            }
        }
    }
    /* TODO obtener usuario por ID */
    public function getUserById($id)
    {
        $conectar = parent::connection();

        $sql = '
            SELECT 
                *
            FROM
                users
            WHERE
                is_active = 1 AND id=?
        ';

        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);  
    }
    /* TODO eliminar usurio por ID */
    public function deleteUserById($id)
    {
        $conectar = parent::connection();

        $sql = '
            UPDATE
                users
            SET
                is_active = 0
            WHERE
                id=?
        ';

        $query = $conectar->prepare($sql);
        $query->bindValue(1,$id);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
    /* TODO insertar usuario */
    public function insertCategory($name, $lastname, $identification, $phone, $email, $password_hash, $role_id, $identification_type_id)
    {
        $conectar = parent::connection();

        $sql = '
            INSERT INTO
                users (name, lastname, identification, phone, email, password_hash, role_id, identification_type_id, created)
            VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, now())
        ';

        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$lastname);
        $query->bindValue(3,$identification);
        $query->bindValue(4,$phone);
        $query->bindValue(5,$email);
        $query->bindValue(6,$password_hash);
        $query->bindValue(7,$role_id);
        $query->bindValue(8,$identification_type_id);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);   
    }
    /* TODO actualizar usuario por ID */
    public function updateUserById($id, $name, $lastname, $identification, $phone, $email, $password_hash, $role_id, $identification_type_id)
    {
        $conectar = parent::connection();

        $sql = '
            UPDATE
                users
            SET
                name = ?,
                lastname = ?,
                identification = ?,
                phone = ?,
                email = ?,
                password_hash = ?,
                role_id = ?,
                identification_type_id = ?,
            WHERE
                id=?
        ';

        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$lastname);
        $query->bindValue(3,$identification);
        $query->bindValue(4,$phone);
        $query->bindValue(5,$email);
        $query->bindValue(6,$password_hash);
        $query->bindValue(7,$role_id);
        $query->bindValue(8,$identification_type_id);
        $query->bindValue(9,$id);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>