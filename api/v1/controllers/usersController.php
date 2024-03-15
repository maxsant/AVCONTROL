<?php 

class usersController 
{
    public function view()
    {
        $users=userModel::index("users");
        $arrayData=[
            "status" => 200, 
            "message" => 'lista de usuarios'.count($users),
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
?>
