<?php 
    include "../config.php";

    $collection=$db->supplierRegister;
    
    $id = $_POST['id'];
    $deleteResult = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($id)], ['limit' => 1]);

    echo 'ok';
?>