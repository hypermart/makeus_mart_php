<?php
    include "../config.php";

    include "../mail.php";

    $registerType = "Supplier";
    $countKycfiles = count($_FILES['kycUpload']['name']);
    $kycFilesArr = array();
    $countKycTpeOfDocu = count($_POST['typeOfKyc']);
    $kycDocumentType = array();

    for($index=0;$index < $countKycfiles;$index++){
        // File name
        if (file_exists($_FILES['kycUpload']['tmp_name'][$index])) {
            $filename = $_FILES['kycUpload']['name'][$index];
            $filetempname = $_FILES['kycUpload']['tmp_name'][$index];

            $kycResult = $s3->putObject([
                'Bucket' => BUCKET_NAME,
                'Key'    => 'infulencer-documents/'.$filename,
                'SourceFile' => $filetempname			
            ]);
            $kycDocument = $kycResult['ObjectURL'];
            array_push($kycFilesArr, $kycDocument);
        }
    }

    for($i=0;$i < $countKycTpeOfDocu;$i++) {
        if(isset($_POST['typeOfKyc'][$i])) {
            $kycDocumVal =  $_POST['typeOfKyc'][$i];
            array_push($kycDocumentType, $kycDocumVal);
        }
    }

    if(!empty($kycDocumentType) && !empty($kycDocumVal)) {
        $combinedKycDocum = array_combine($kycDocumentType, $kycFilesArr);
    } else {
        $combinedKycDocum = [];
    }

    //Post data
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $email = $_POST['email'];
    $mobileNo = $_POST['mobileNo'];
    $companyName = $_POST['companyName'];
    $addressLineOne = $_POST['addressLineOne'];
    $addressLineTwo = $_POST['addressLineTwo'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $bankName = $_POST['bankName'];
    $bankAddress = $_POST['bankAddress'];
    $accountType = $_POST['accountType'];
    $accountNumber = $_POST['accountNumber'];
    $ifscCode = $_POST['ifscCode'];
    //kyc documents
    
    //Signature
    if (file_exists($_FILES['signature']['tmp_name'])) {
        $signatureTmpFile = $_FILES['signature']['tmp_name'];
        $signatureFileName = $_FILES['signature']['name'];

        $signatureResult = $s3->putObject([
            'Bucket' => BUCKET_NAME,
            'Key'    => 'infulencer-documents/'.$signatureFileName,
            'SourceFile' => $signatureTmpFile			
        ]);

        $signatureDocument = $signatureResult['ObjectURL'];
    } else {
        $signatureDocument = '';
    }

    $supplierNumber = rand(1000,9999);

    $supplierCode = 'SUP'.$supplierNumber;

    //Super Influencer Data
    $supplierData = array(
        'firstName' => $firstName,
        'middleName' => $middleName,
        'lastName' => $lastName,
        'dateOfBirth' => $dateOfBirth,
        'email' => $email,
        'mobileNo' => $mobileNo,
        'companyName' => $companyName,
        'addressLineOne' => $addressLineOne,
        'addressLineTwo' => $addressLineTwo,
        'city' => $city,
        'pincode' => $pincode,
        'bankName' => $bankName,
        'bankAddress' => $bankAddress,
        'accountType' => $accountType,
        'accountNumber' => $accountNumber,
        'ifscCode' => $ifscCode,
        'kycDocument' => $combinedKycDocum,
        'signature' => $signatureDocument,
        'supplierCode' => $supplierCode
    );

    $collection=$db->supplierRegister;
    $collection->insertOne($supplierData);
    
    sendEmail($firstName, $supplierCode, $email, $registerType, $companyName);
?>