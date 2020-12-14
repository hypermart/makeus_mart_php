<?php

    require "vendor/autoload.php";

    //$client = new MongoDB\Client("mongodb://127.0.0.1:27017", ['username' => 'hypermartuser', 'password' => 'P@$$w0rd', 'authMechanism' => 'SCRAM-SHA-1']);

    //$db=$client->hypermart;

    $client = new MongoDB\Client('mongodb+srv://HMI_AdminDBUser:cyrb7KSRiWbgCJ7@cluster0.g2ggn.mongodb.net/HMI_DevDB?retryWrites=true&w=majority');

    $db=$client->HMI_DevDB;

    //S3 configuration set up constants
    define("REGION", "us-east-2");
    define("VERSION", "latest");
    define("KEY", "AKIAIJDPAVX6E4GORFDQ");
    define("SECRET", "QQv6O2l7wygikds+vaFf332GFHD2a+kasSqMCxwU");
    define("BUCKET_NAME", "sample-files-big");

    $s3 = new Aws\S3\S3Client([
        'region'  => REGION,
        'version' => VERSION,
        'credentials' => [
            'key'    => KEY,
            'secret' => SECRET,
        ]
    ]);
?>