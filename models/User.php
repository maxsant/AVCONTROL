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
            
            if(empty($identification) AND empty($password)){
                header("location:".Connect::route().'/index.php?msg=1');
                exit;
            }else{
                $sql = '
                    SELECT
                        u.*,
                        r.name as nameRol
                    FROM
                        users u
                    INNER JOIN roles r ON u.role_id = r.id
                    WHERE
                        u.identification = ? AND u.is_active = 1
                ';
                
                $query = $conectar->prepare($sql);
                $query->bindValue(1, $identification);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                
                if(password_verify($password, $result['password_hash'])){
                    if(is_array($result) AND count($result) > 0){
                        $_SESSION['id']        = $result['id'];
                        $_SESSION['name']      = $result['name'];
                        $_SESSION['lastname']  = $result['lastname'];
                        $_SESSION['email']     = $result['email'];
                        $_SESSION['role']      = $result['nameRol'];
                        $_SESSION['role_id']   = $result['role_id'];
                        header("Location:".Connect::route().'/views/home/index.php');
                        exit;
                    }else{
                        header("location:".Connect::route().'/index.php?msg=2');
                        exit;
                    }
                }else{
                    header("location:".Connect::route().'/index.php?msg=3');
                    exit;
                }
            }
        }
    }
    /* TODO Registrar Usuario por WEB */
    public function registerUser($name, $lastname, $identification, $phone, $email, $password, $identification_type_id)
    {
        $conectar = parent::connection();
        
        if(empty($name) OR empty($lastname) OR empty($password) OR empty($identification) OR empty($identification_type_id) OR empty($email) OR empty($phone)){
            $answer = [
                'status' => false,
                'msg' => 'Campos vacios'
            ];
        }else{
            
            $password_hash      = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = '
                INSERT INTO
                    users (name, lastname, password_hash, identification, identification_type_id, phone, email, role_id, created)
                VALUES
                    (?, ?, ?, ?, ?, ?, ?, 2, now())
            ';
            
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $name);
            $query->bindValue(2, $lastname);
            $query->bindValue(3, $password_hash);
            $query->bindValue(4, $identification);
            $query->bindValue(5, $identification_type_id);
            $query->bindValue(6, $phone);
            $query->bindValue(7, $email);
            
            if($query->execute()){
                $answer = [
                    'status' => true,
                    'msg' => 'usuario creado correctamente',
                    'email' => $email
                ];
            }
        }
        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }
    /* TODO obtener usuario por Correo */
    public function getUserByEmail($email)
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                *
            FROM
                users
            WHERE
                is_active = 1 AND email=?
        ';
        
        $query = $conectar->prepare($sql);
        $query->bindValue(1,$email);
        $query->execute();
        
        return $query->fetch(PDO::FETCH_ASSOC);
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
    /* TODO obtener usuario por ID */
    public function getUsers()
    {
        $conectar = parent::connection();
        
        $sql = '
            SELECT
                u.*,
                r.name as nameRol
            FROM
                users u
            INNER JOIN roles as r ON u.role_id = r.id
            WHERE
                u.is_active = 1
        ';
        
        $query = $conectar->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
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
    public function insertUser($name, $lastname, $identification, $phone, $email, $password_hash, $role_id, $identification_type_id)
    {
        $conectar = parent::connection();
        
        $password = password_hash($password_hash, PASSWORD_DEFAULT);
        
        $sql = '
            INSERT INTO
                users (name, lastname, identification, phone, email, password_hash, role_id, identification_type_id, created)
            VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, now())
        ';

        $query = $conectar->prepare($sql);
        $query->bindValue(1,$name);
        $query->bindValue(2,$lastname);
        $query->bindValue(3,$identification);
        $query->bindValue(4,$phone);
        $query->bindValue(5,$email);
        $query->bindValue(6,$password);
        $query->bindValue(7,$role_id);
        $query->bindValue(8,$identification_type_id);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);   
    }
    /* TODO actualizar usuario por ID */
    public function updateUserById($id, $name, $lastname, $identification, $phone, $email, $password_hash = null, $role_id, $identification_type_id)
    {
        $conectar = parent::connection();
        
        if($password_hash){
            
            $password = password_hash($password_hash, PASSWORD_DEFAULT);
            
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
                    identification_type_id = ?
                WHERE
                    id=?
            ';
            
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$name);
            $query->bindValue(2,$lastname);
            $query->bindValue(3,$identification);
            $query->bindValue(4,$phone);
            $query->bindValue(5,$email);
            $query->bindValue(6,$password);
            $query->bindValue(7,$role_id);
            $query->bindValue(8,$identification_type_id);
            $query->bindValue(9,$id);
            $query->execute();
        }else{
            $sql = '
                UPDATE
                    users
                SET
                    name = ?,
                    lastname = ?,
                    identification = ?,
                    phone = ?,
                    email = ?,
                    role_id = ?,
                    identification_type_id = ?
                WHERE
                    id=?
            ';
            
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$name);
            $query->bindValue(2,$lastname);
            $query->bindValue(3,$identification);
            $query->bindValue(4,$phone);
            $query->bindValue(5,$email);
            $query->bindValue(6,$role_id);
            $query->bindValue(7,$identification_type_id);
            $query->bindValue(8,$id);
            $query->execute();
        }
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>