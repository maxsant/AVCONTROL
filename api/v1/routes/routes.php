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
        if(!is_numeric(array_filter($routesArray)[5]) AND array_filter($routesArray)[5] == 'index'){
            if (array_filter($routesArray)[4] == 'users'){
                if (isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD']=='GET'){
                    $users=new usersController();
                    $users->view();
                }
            }
        }else if(is_numeric(array_filter($routesArray)[5])){
            if (array_filter($routesArray)[4] == 'users'){
                if (isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD']=='GET'){
                    $users=new usersController();
                    $users->view(array_filter($routesArray)[5]);
                }
            }
        }
    }
}
?>