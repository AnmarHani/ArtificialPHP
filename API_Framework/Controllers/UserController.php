<?php
require_once('../Models/UserModel.php');

function getAllUsers($request, $response){
    ob_clean();
    ob_start();
    global $User; //To Use The Model
    $result = $User->GET();
    
    $data = array(
            "data"=>$result,
            "mine"=>"Hello", 
        );
        
        return $response->send($data);
        
} 
function createUser($request, $response){

    global $User; //To Use The Model

    // echo $request['name']; //To Get The 'name' Input From The Request
    
    $result = $User->POST(array(1,"'username'","'password'"));

    $data = array(
        "data"=>$result,
        "random_string"=>"Hello World", 
        "print_name"=>$request['name']
    );


    return $response->send($data);


} 
