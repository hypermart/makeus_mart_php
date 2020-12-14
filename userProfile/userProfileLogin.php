<?php
    include "../config.php";

    session_start();

    if(isset($_POST['userName']))  {
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        $collection=$db->users;

        $passwordHash = md5($password);

        $qry = array("userName" => $userName, "password" => $passwordHash);
        $results = $collection->find($qry);

        $responseData = true;
        foreach($results as $result) {
            if($result['userName'] == $userName && $result['password'] == $passwordHash) {
                $_SESSION['userName'] = $result['userName'];
                $_SESSION['type'] = $result['userType'];
                $_SESSION['code'] = $result['refCode'];
                $responseData = true;
                //$data = array("code" => $result['refCode'], 'responseData' => $responseData, 'type' => $result['userType']);
                echo json_encode($responseData);
            } else {
                $responseData = false;
                $data = array("code" => '', 'responseData' => $responseData);
                echo json_encode($data);
            }
        }
    }
?>