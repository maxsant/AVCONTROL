<?php 

class usersController 
{
    public function view($id = null)
    {
        if(!empty($id)){
            $user = userModel::user($id, "users");
            if(!empty($user)){
                $arrayData=[
                    "status" => 200,
                    "message" => 'Este es el usuario con el ID: '.$user['id'],
                    "value" => [
                        "name"=> $user['name'],
                        "lastname"=> $user['lastname'],
                        "identification"=> $user['identification'],
                        "phone"=> $user['phone'],
                        "email"=>$user['email'],
                        "created"=> $user['created'],
                        "modified"=> $user['modified']
                    ]
                ];
            }else{
                $arrayData=[
                    "status" => 400,
                    "message" => 'No se encontro un usuario'
                ];
            }
            echo json_encode($arrayData,true);
            return;
        }else{
            $users=userModel::index("users");
            $arrayData=[
                "status" => 200, 
                "message" => 'lista de usuarios '.count($users),
                "users" => []
            ];
            
            foreach ($users as $value){
                $userDetails=[
                    "name"=> $value['name'],
                    "lastname"=> $value['lastname'],
                    "identification"=> $value['identification'],
                    "phone"=> $value['phone'],
                    "email"=>$value['email'],
                    "created"=> $value['created'],
                    "modified"=> $value['modified']
                ];
                $arrayData['users'][] = $userDetails;
            }
            echo json_encode($arrayData,true);
            return;
        }
    }
    public function create($data)
    {
        $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $arrayData = [
            "name" => $data['name'],
            "lastname" => $data['lastname'],
            "identification" => $data['identification'],
            "phone" => $data['phone'],
            "email" => $data['email'],
            "password_hash" => $password_hash,
            "identification_type_id" => $data['identification_type_id'],
            "role_id" => $data['role_id'],
            "created" => $data['created']
        ];
        
        $create = userModel::create("users", $arrayData);
        
        if($create){
            $json = [
                "status" => 200,
                "message" => "Se creo correctamente el usuario"
            ];
        }else{
            $json = [
                "status" => 400,
                "message" => "No se creo correctamente el usuario"
            ];
        }
        echo json_encode($json, true);
        return;
    }
}
?>
