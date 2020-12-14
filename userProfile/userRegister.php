<?php
    include "../config.php";

    session_start();

    $userType = $_POST['userType'];
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $refCode = $_POST['code'];

    $collection=$db->users;

    $passwordHash = md5($password);

    $qry = array("userName" => $userName);
    $results = $collection->find($qry);

    $dataCount = $collection->count($qry);

    $userData = array(
        'userName' => $userName,
        'password' => $passwordHash,
        'firstName' => '',
        'lastName' => '',
        'email' => '',
        'mobileNo' => '',
        'refCode' => $refCode,
        'userRole' => 'user',
        'userType' => $userType
    );

    $responseData = false;
    if($dataCount > 0) {
        $responseData = true;
        echo json_encode($dataCount);
    } else {
        $responseData = false;
        $collection->insertOne($userData);
        echo json_encode($dataCount);
    }
?>