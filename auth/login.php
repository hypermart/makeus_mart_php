<?php
    include "../config.php";

    session_start();

    if(isset($_POST['userName']))  {
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        $collection=$db->hypermartUsers;

        $passwordHash = md5($password);

        $qry = array("userName" => $userName, "password" => $passwordHash);
        $results = $collection->find($qry);

        $responseData = true;
        foreach($results as $result) {
            if($result['userName'] == $userName && $result['password'] == $passwordHash) {
                $_SESSION['userName'] = $result['userName'];
                $_SESSION['userRole'] = $result['userRole'];
                $responseData = true;
                echo json_encode($responseData);
            } else {
                $responseData = false;
                echo json_encode($responseData);
            }
        }
    }
?>