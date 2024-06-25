<?php
$responseArr = [
    'status' => 'FAILED',
    'message' => 'Invalid data found'
];
// const $_FROM_EMAIL = "infoecomaxlubricant@gmail.com";
const $_FROM_EMAIL = "trushang_rathod@itcodrs.in";
echo $_FROM_EMAIL;
exit;
function mailSend($to, $subject, $message, $headers) {
    mail($to, $subject, $message, $headers);
}
function thankYouMail($toEmail) {
    $to = 'bob@example.com';

    $subject = 'Website Change Request';

    $headers  = "From: " . strip_tags($_FROM_EMAIL) . "\r\n";
    $headers .= "Reply-To: " . strip_tags($_FROM_EMAIL) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $message = '<p><strong>Thank you for reach us</strong>. We will get back to you soon.</p>';

    mailSend($toEmail, $subject, $message, $headers);
}
function sentAdminEmail($requestdInput, $type, $requestdFiles = null) {
    $htmlBody = "<table>";
    $htmlBody .= "<thead>";
    $htmlBody .= "<tr>";
    $htmlBody .= "<td>Name:</td>";
    $htmlBody .= "<td>".$requestdInput['first_name'] . " " .$requestdInput['last_name']."</td>";
    $htmlBody .= "</tr>";
    $htmlBody .= "<tr>";
    $htmlBody .= "<td>Email:</td>";
    $htmlBody .= "<td>".$requestdInput['email'] ."</td>";
    $htmlBody .= "</tr>";
    $htmlBody .= "<tr>";
    $htmlBody .= "<td>Phone:</td>";
    $htmlBody .= "<td>".$requestdInput['phone'] ."</td>";
    $htmlBody .= "</tr>";
    $htmlBody .= "<tr>";
    $htmlBody .= "<td>Message:</td>";
    $htmlBody .= "<td>".$requestdInput['message'] ."</td>";
    $htmlBody .= "</tr>";
    $htmlBody .= "</thead>";
    $htmlBody .= "<tbody>";
    $htmlBody .= "</tbody>";
    $htmlBody .= "</table>";
    if(!empty($requestdFiles)) {
        

    }

    $headers  = "From: " . strip_tags($_FROM_EMAIL) . "\r\n";
    $headers .= "Reply-To: " . strip_tags($_FROM_EMAIL) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    if($type == 'CAREER') {
        // sent career data to admin with attach
        $subject= "Career | Request founded from " . $requestdInput['first_name'] . " " .$requestdInput['last_name'] . " | " . $requestdInput['phone'];

        mailSend($_FROM_EMAIL, $subject, $htmlBody, $headers);
    } else {
        // contact us mail
        $subject= "Contact | Request founded from " . $requestdInput['first_name'] . " " .$requestdInput['last_name'] . " | " . $requestdInput['phone'];

        mailSend($_FROM_EMAIL, $subject, $htmlBody, $headers);
        // sent contact data to admin
    }
}
function careerMail($requestedInput, $requestedFiles) {
    // Sent mail to admin
    sentAdminEmail($requestedInput, 'CAREER', $requestedFiles);
    // Sent thank you email to customer
    thankYouMail($requestedInput['email']);
}
function contactMail($requestedInput) {
    // Sent mail to admin
    sentAdminEmail($requestedInput, 'CONTACT');
    // Sent thank you email to customer
    thankYouMail($requestedInput['email']);
}
if(!empty($_POST['email'])) {
    try {
        if (!empty($_GET['a'])) {
            if($_GET['a'] == 'career') {
                careerMail($_POST, $_FILES);
            } else {
                contactMail($_POST);
            }
        }
        // $from_email = 'infoecomaxlubricant@gmail.com'; //from mail, sender email address
        // $recipient_email = 'trushang_rathod@itcoders.in'; //recipient email address
         
        // //Load POST data from HTML form
        // $sender_name = "Ecomax Lubricant"; //sender name
        // $reply_to_email = $from_email; //sender email, it will be used in "reply-to" header
        // $subject     = "Sample mail for the Ecomax page"; //subject for the email
        // // $subjectto     = "Thank you for your interest in Ecomax, your trusted manufacturer and supplier of lubricant engine oil. We're here to assist you with any inquiries, feedback, or requests you may have. Please feel free to reach out to us using the information above:"; 0//subject for the email
        // $first_name  = "Customer Name:-".$_POST["first_name"]; //body of the email
        // $last_name  = $_POST["last_name"]; //body of the email
        // $customer_email = "Customer Email:-".$_POST["email"]; //body of the email
        // $customer_number = "Customer Number:-".$_POST["number"]; //body of the email
        // $message  = "Customer Message:-".$_POST["career_message"]; //body of the email
        // // $email2 = "User".$__POST["email"];



        // $tmp_name = $_FILES['resume']['tmp_name']; // get the temporary file name of the file on the server
        // $name     = $_FILES['resume']['name']; // get the name of the file
        // $size     = $_FILES['resume']['size']; // get size of the file for size validation
        // $type     = $_FILES['resume']['type']; // get type of the file
        // $error     = $_FILES['resume']['error']; // get the error (if any)
        // //validate form field for attaching the file
        // if($error > 0)
        // {
        //     //die('Upload error or No files uploaded');
        // }
        // //read from the uploaded file & base64_encode content
        // $handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
        // $content = fread($handle, $size); // reading the file
        // fclose($handle);                 // close upon completion
     
        // $encoded_content = chunk_split(base64_encode($content));
        // $boundary = md5("random"); // define boundary with a md5 hashed value
     
        // //header
        // $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
        // $headers .= "From:".$from_email."\r\n"; // Sender Email
        // $headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email address to reach back
        // $headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
        // $headers .= "boundary = $boundary\r\n"; //Defining the Boundary
             
        // // $headers2 .= "Reply-To: ".$from_email."\r\n"; // Email address to reach back


        // //plain text
        // $body = "--$boundary\r\n";
        // $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        // $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        // $body .= chunk_split(base64_encode($first_name." ".$last_name."\n".$customer_email."\n".$customer_number."\n".$message));
             
        // //attachment
        // $body .= "--$boundary\r\n";
        // $body .="Content-Type: $type; name=".$name."\r\n";
        // $body .="Content-Disposition: attachment; filename=".$name."\r\n";
        // $body .="Content-Transfer-Encoding: base64\r\n";
        // $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
        // $body .= $encoded_content; // Attaching the encoded file with email
         
        // $sentMailResult = mail($recipient_email, $subject, $body, $headers);

        // // $sentMailResult2 = mail ($recipient_email, $subjectto, $body, $headers2);
     
        // // if($sentMailResult2 ){
        // //     $responseArr = [
        // //         'status' => 'SUCCESS',
        // //         'message' => 'Thank for Submit.'
        // //     ];
        // //     // unlink($name); // delete the file after attachment sent.
        // // }
        // // else{
        // //     $responseArr['message'] = 'Failed to send email.';
        // // }
        $responseArr = [
            'status' => 'SUCCESS',
            'message' => 'Thank you for reaching us. We will get back soon.'
        ];

        // if($sentMailResult ){
        //     // unlink($name); // delete the file after attachment sent.
        // }
        // else{
        //     $responseArr['message'] = 'Failed to send email.';
        // }

    } catch (\Throwable $th) {
        $responseArr['message'] = 'Something went wrong.';
        $responseArr['error'] = $th->getMessage();
    }
}
echo json_encode($responseArr);
exit;
?>