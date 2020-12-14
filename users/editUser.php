<?php

    include "../config.php";

    $userId = $_POST['userId'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mobileNo = $_POST['mobileNo'];
    $userRole = $_POST['userRole'];

    $passwordHash = md5($password);
    $userCheck = false;

    $collection=$db->hypermartUsers;
    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($userId)],
        ['$set' => [
                'userName' => $userName,
                'password' => $passwordHash,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'mobileNo' => $mobileNo,
                'userRole' => $userRole
            ]
        ]
    );

    echo json_encode($userCheck);
?>