<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //require 'vendor/autoload.php';

    function sendEmail($name, $code, $email, $registerType, $companyName) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtpout.secureserver.net'; //'relay-hosting.secureserver.net'; smtpout.secureserver.net
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Username = 'back.office@hypermartindia.com';
        $mail->Password = 'back@0ffice';
        $mail->setFrom('back.office@hypermartindia.com', 'Hypermart');
        $mail->addReplyTo('back.office@hypermartindia.com', 'Hypermart');
        $mail->addAddress($email, $name);
        $mail->AddCC('anantha.krishna@hypermartindia.com');
        $mail->Subject = 'Hypermart Registration';
        $mail->CharSet  = "UTF-8";
        if($registerType == 'Influencer') {
            $mailContent = "<html>Dear $name, <br><br>
                            Congratulations! <br><br>
                            Your Influencer id is <strong><i>$code</i></strong>.<br><br>
                            Welcome. You have now become an 'Influencer' in Makus Mart LLP which does the e-Commerce business under the brand name <a target='_blank' href='https://www.hypermartindia.com'>https://www.hypermartindia.com</a>.<br><br>
                            You will avail the benefits of Influencer once you commence the enrollment of customers of your reference. There is “no limit” to enroll customers. Happily enroll as many as you can and as long as you can.<br><br>
                            You will also get benefited for doing so. However, please ensure you will be present while enrolling your customers to ensure the customer registration happens with your 'Influencer id' without fail.  Failing which will deprive you of your Influencer benefits.<br><br>
                            Happy enrollment of customers.<br><br>
                            We thank you and grateful to you for every customer enrollment and every customer order.<br><br>
                            Please register here using your influencer id <a href='http://3.18.2.184/hypermart/userProfile/register.php?type=influencer' target='_blank'>Register</a><br><br>
                            Faithfully yours.<br>
                            Makus Mart Team
                        </html>";
        } elseif ($registerType == 'Super Influencer') {
            $mailContent = "<html>Dear $name, <br><br>
                            Congratulations! <br><br>
                            Your Super Influencer id is <strong><i>$code</i></strong>.<br><br>
                            Welcome. You have now become an 'Super Influencer' in Makus Mart LLP which does the e-Commerce business under the brand name <a target='_blank' href='https://www.hypermartindia.com'>https://www.hypermartindia.com</a>.<br><br>
                            You will avail the benefits of Super Influencer once you commence the enrollment of influencers of your reference. There is “no limit” to enroll influencers. Happily enroll as many as you can and as long as you can. Please note, you can also enroll customers directly and you will avail benefit of influencer also.<br><br>
                            Please ensure you will be present while enrolling your customers to ensure the customer registration happens with your 'Super Influencer id' without fail. Failing which will deprive you of your Super Influencer benefits.<br><br>
                            Happy enrollment of influencers and customers.<br><br>
                            We thank you and grateful to you for every influencer and customer enrollment and every customer order.<br><br>
                            Please register here using your super influencer id <a href='http://3.18.2.184/hypermart/userProfile/register.php?type=superinfluencer' target='_blank'>Register</a><br><br>
                            Faithfully yours.<br>
                            Makus Mart Team
                        </html>";
        } else {
            $mailContent = "<html>Dear $name, <br><br>
                            Congratulations! <br><br>
                            Your Company name is $companyName ans Supplier id is <strong><i>$code</i></strong>.<br><br>
                            Welcome. You have now become a 'Supplier' in Makus Mart LLP which does the e-Commerce business under the brand name <a target='_blank' href='https://www.hypermartindia.com'>https://www.hypermartindia.com</a>.<br><br>
                            You are our esteemed supplier and we will make all efforts to increase our customer base and the same will be a positive impact for your products also.  Let us use all the tools such as “Promotions”, “timely discounts” and MOST importantly “Quality Of Service (QOS)” in the form of delivering products “Deliver All Without Missing (DAWOM)” and “At Committed Time (ACT)”<br><br>
                            You will also get benefited for doing so in the form of extended customer base and higher turnover.<br><br>
                            Happy supplying!<br><br>
                            We thank you and grateful to you for supplying for every customer order.<br><br>
                            Please register here using your supplier id <a href='http://3.18.2.184/hypermart/userProfile/register.php?type=supplier' target='_blank'>Register</a><br><br>
                            Faithfully yours.<br>
                            Makus Mart Team
                        </html>";
        }
        $mail->Body = $mailContent;
        $mail->IsHTML(true);
        if (!$mail->send()) {
            echo '';
        } else {
            if($registerType == 'Influencer' || $registerType == 'Super Influencer') {
                echo json_encode($code);
            } else {
                $csvData = array('supplierCode' => $code, 'email '=> $email);
                echo json_encode($csvData);
            }     
        }
    }
?>