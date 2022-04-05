<?php
require_once('../Models/UserModel.php');

function getAllUsers($request, $response){
    ob_clean();
    ob_start();
    global $User;
    // echo $request['name'];
    // $User->POST(array(1,"'Anm'","'Anm123'"));
    $result = $User->GET();
    
    $data = array(
            "data"=>$result,
            "mine"=>"Hello", 
        );
        
        return $response->send($data);
        
} 
function createUser($request, $response){

    global $User;

    // echo $request['name'];
    
    $result = $User->POST(array(2,"'Anm'","'Anm123'"));

    $data = array(
        "data"=>$result,
        "mine"=>"Hello", 
        "tryingInsteadEcho"=>$request['name']
    );


    return $response->send($data);


} 
