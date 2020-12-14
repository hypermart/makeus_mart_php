<?php
    include "../config.php";

    include "../mail.php";

    $registerType = "Influencer";
    $countKycfiles = count($_FILES['kycUpload']['name']);
    $kycFilesArr = array();
    $countKycTpeOfDocu = count($_POST['typeOfKyc']);
    $kycDocumentType = array();

    for($index=0;$index < $countKycfiles;$index++){
        // File name
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

    for($i=0;$i < $countKycTpeOfDocu;$i++) {
        $kycDocumVal =  $_POST['typeOfKyc'][$i];
        array_push($kycDocumentType, $kycDocumVal);
    }

    $combinedKycDocum = array_combine($kycDocumentType, $kycFilesArr);

    //Post data
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $email = $_POST['email'];
    $mobileNo = $_POST['mobileNo'];
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
    $signatureTmpFile = $_FILES['signature']['tmp_name'];
    $signatureFileName = $_FILES['signature']['name'];

    $signatureResult = $s3->putObject([
        'Bucket' => BUCKET_NAME,
        'Key'    => 'infulencer-documents/'.$signatureFileName,
        'SourceFile' => $signatureTmpFile			
    ]);

    $signatureDocument = $signatureResult['ObjectURL'];

    $influenNumber = rand(1000,9999);

    $influencerCode = 'INF'.$influenNumber;

    $superInfluencers = $_POST['superInfluencers'];

    //Influencer Data
    $influencerData = array(
        'firstName' => $firstName,
        'middleName' => $middleName,
        'lastName' => $lastName,
        'dateOfBirth' => $dateOfBirth,
        'email' => $email,
        'mobileNo' => $mobileNo,
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
        'influencerCode' => $influencerCode,
        'superInfluencer' => $superInfluencers
    );

    $collection=$db->influencerRegister;
    $collection->insertOne($influencerData);

    $companyName = '';
    sendEmail($firstName, $influencerCode, $email, $registerType, $companyName);
    
    //echo json_encode($influencerData);
?>