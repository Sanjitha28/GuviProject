<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require 'vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection=$client->guvi->info;

$functionName=$_POST['functionName'];
$userid=$_POST['userid'];
$search=array(
    "userid" => $userid,
);
$fetch=$collection->findOne($search);
if($functionName=="fetching"){
    fetching();
}
if($functionName=="update"){
    update();
}
function fetching(){
    global $fetch;
    if ($fetch){
        echo json_encode(array(
            'success' => true,
            'userid' => $fetch['userid'],
            "name" => $fetch['name'],
            "email" => $fetch['email'],
            "phno" => $fetch['phno'],
            "dob" => $fetch['dob'] 
          ));
    }
    else{
        echo json_encode(array(
            'success' => false,
            'message'=> "You have not updated your profile"
          ));
    }    
}

function update(){
    global $fetch,$collection,$userid;
    
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phno=$_POST['phno'];
    $dob=$_POST['dob'];
    $data=array(
        "userid" => $userid,
        "name" => $name,
        "email" => $email,
        "phno" => $phno,
        "dob" => $dob 
    );
    if ($fetch){
        $updateResult = $collection->updateOne(
           [ "userid" => $userid ],
           [ '$set' => [ 
               'name' => $name,
               'email' => $email,
               'phno' => $phno,
               'dob' => $dob
           ]]
       );
       echo "sanji";
   }
   else{
       $insert = $collection->insertOne($data);
       echo "sai";
   }
    
}
?>