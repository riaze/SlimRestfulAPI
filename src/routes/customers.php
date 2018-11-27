<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Get All Customers


$app->get('/api/customers', function(Request $request, Response $response){
   $sql = "SELECT * FROM customers";
   try{
    
    $db = new db();
    $db = $db->connection();
    $stmt = $db->query($sql);
    $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($customers);
   }
   catch(PDOException $e){
       echo '{"error":{"text":'.$e->getMessage().'}';
       
   }
    
});

//Get one Customers

$app->get('/api/customers/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM customers where id = $id";
    try{
     
     $db = new db();
     $db = $db->connection();
     $stmt = $db->query($sql);
     $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
     $db = null;
     echo json_encode($customer);
     
    }
    catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}';
        
    }
     
 });

 //Add a Customers

$app->post('/api/customers/{add}', function(Request $request, Response $response){
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $addresss = $request->getParam('addresss');
    $city = $request->getParam('city');
    $states = $request->getParam('states');

    $sql = "INSERT INTO customers (first_name, last_name, phone, email, addresss, city,states)
           VALUES(:first_name, :last_name, :phone, :email, :addresss, :city,:states)";
    
    try{
     
     $db = new db();
     $db = $db->connection();
     $stmt = $db->prepare($sql);
     $stmt->bindParam(':first_name',    $first_name);
     $stmt->bindParam(':last_name',     $last_name);
     $stmt->bindParam(':phone',         $phone); 
     $stmt->bindParam(':email',         $email);
     $stmt->bindParam(':addresss',      $addresss);
     $stmt->bindParam(':city',          $city);
     $stmt->bindParam(':states',        $states);

     $stmt->execute();

     echo '{"notice":{"text":"customer Added"}';
    }
    catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}';
        
    }
     
 });

 //update customer

$app->put('/api/customers/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id'); 
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $addresss = $request->getParam('addresss');
    $city = $request->getParam('city');
    $states = $request->getParam('states');

    $sql = "UPDATE customers SET 
        first_name=:first_name, 
        last_name =:last_name, 
        phone     =:phone, 
        email     =:email, 
        addresss  = :addresss, 
        city      =:city,
        states    =:states 
        where id = $id";
    
    try{
     
     $db = new db();
     $db = $db->connection();
     $stmt = $db->prepare($sql);
     $stmt->bindParam(':first_name',    $first_name);
     $stmt->bindParam(':last_name',     $last_name);
     $stmt->bindParam(':phone',         $phone); 
     $stmt->bindParam(':email',         $email);
     $stmt->bindParam(':addresss',      $addresss);
     $stmt->bindParam(':city',          $city);
     $stmt->bindParam(':states',        $states);

     $stmt->execute();

     echo '{"notice":{"text":"customer Updated"}';
    }
    catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}';
        
    }
     
 });
//delete customers
 
$app->delete('/api/customers/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM customers where id = $id";
    try{
     
     $db = new db();
     $db = $db->connection();
     $stmt = $db->prepare($sql);
     $stmt->execute();
     $db =null;
     
     echo '{"notice":{"text":"customer Deleted"}';
    }
    catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}';
        
    }
     
 });


