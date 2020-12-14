<?php

    include "../config.php";

    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mobileNo = $_POST['mobileNo'];
    $userRole = $_POST['userRole'];

    $passwordHash = md5($password);

    $collection=$db->hypermartUsers;

    $qry = array("userName" => $userName);

    $users = $collection->find($qry);

    $userCheck = false;
    $userData = array(
        'userName' => $userName,
        'password' => $passwordHash,
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'mobileNo' => $mobileNo,
        'userRole' => $userRole
    );        
    $collection->insertOne($userData);
    echo json_encode($userCheck);
?>