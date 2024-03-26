<?php 
$routesArray=explode("/", $_SERVER['REQUEST_URI']);

if (count(array_filter($routesArray)) ==3){
    // Cuando no se hace una peticion
    $json=[
        "status" =>400,
        "message" =>'Ruta incorrecta'
    ];
    echo json_encode($json,true);
    return;
}else{
    if (count(array_filter($routesArray)) == 5 ){
        if(!is_numeric(array_filter($routesArray)[5])){
            if(array_filter($routesArray)[5] == 'index'){
                if (array_filter($routesArray)[4] == 'users'){
                    if (isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD']=='GET'){
                        $users=new usersController();
                        $users->view();
                    }
                }
            }else if(array_filter($routesArray)[5] == 'create'){
                if (array_filter($routesArray)[4] == 'users'){
                    if (isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD']=='POST'){
                        //Leer datos de jSON
                        $json_data = file_get_contents("php://input");
                        //Decodificado JSON
                        $data = json_decode($json_data, true);
                        if(empty($data)){
                            $json = [
                                "status" => 400,
                                "message" => "Error de formato JSON"
                            ];
                            
                            echo json_encode($json, true);
                            return;
                        }
                        $users=new usersController();
                        $users->create($data);
                    }
                }
            }
        }else if(is_numeric(array_filter($routesArray)[5])){
            if (array_filter($routesArray)[4] == 'users'){
                if (isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD']=='GET'){
                    $users=new usersController();
                    $users->view(array_filter($routesArray)[5]);
                }
                if (isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD']=='DELETE'){
                    $users=new usersController();
                    $users->delete(array_filter($routesArray)[5]);
                }
                if (isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD']=='PUT'){
                    //Leer datos de jSON
                    $json_data = file_get_contents("php://input");
                    //Decodificado JSON
                    $data = json_decode($json_data, true);
                    if(empty($data)){
                        $json = [
                            "status" => 400,
                            "message" => "Error de formato JSON"
                        ];
                        
                        echo json_encode($json, true);
                        return;
                    }
                    $users=new usersController();
                    $users->update(array_filter($routesArray)[5], $data);
                }
            }
        }
    }
}
?>