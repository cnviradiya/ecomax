<?php
$responseArr = [
    'status' => 'FAILED',
    'message' => 'Invalid data found'
];
if(!empty($_POST['email'])) {
    try {
        $from_email = 'infoecomaxlubricant@gmail.com'; //from mail, sender email address
        $recipient_email = 'trushang_rathod@itcoders.in'; //recipient email address
         
        //Load POST data from HTML form
        $sender_name = "Ecomax Lubricant"; //sender name
        $reply_to_email = $from_email; //sender email, it will be used in "reply-to" header
        $subject     = "Sample mail for the Ecomax page"; //subject for the email
        $subjectto     = "Thank you for your interest in Ecomax, your trusted manufacturer and supplier of lubricant engine oil. We're here to assist you with any inquiries, feedback, or requests you may have. Please feel free to reach out to us using the information above:"; 0//subject for the email
        $first_name  = "Customer Name:-".$_POST["first_name"]; //body of the email
        $last_name  = $_POST["last_name"]; //body of the email
        $customer_email = "Customer Email:-".$_POST["email"]; //body of the email
        $customer_number = "Customer Number:-".$_POST["number"]; //body of the email
        $message  = "Customer Message:-".$_POST["career_message"]; //body of the email
        // $email2 = "User".$__POST["email"];



        $tmp_name = $_FILES['resume']['tmp_name']; // get the temporary file name of the file on the server
        $name     = $_FILES['resume']['name']; // get the name of the file
        $size     = $_FILES['resume']['size']; // get size of the file for size validation
        $type     = $_FILES['resume']['type']; // get type of the file
        $error     = $_FILES['resume']['error']; // get the error (if any)
        //validate form field for attaching the file
        if($error > 0)
        {
            //die('Upload error or No files uploaded');
        }
        //read from the uploaded file & base64_encode content
        $handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
        $content = fread($handle, $size); // reading the file
        fclose($handle);                 // close upon completion
     
        $encoded_content = chunk_split(base64_encode($content));
        $boundary = md5("random"); // define boundary with a md5 hashed value
     
        //header
        $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
        $headers .= "From:".$from_email."\r\n"; // Sender Email
        $headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email address to reach back
        $headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
        $headers .= "boundary = $boundary\r\n"; //Defining the Boundary
             
        $headers2 .= "Reply-To: ".$email2."\r\n"; // Email address to reach back


        //plain text
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split(base64_encode($first_name." ".$last_name."\n".$customer_email."\n".$customer_number."\n".$message));
             
        //attachment
        $body .= "--$boundary\r\n";
        $body .="Content-Type: $type; name=".$name."\r\n";
        $body .="Content-Disposition: attachment; filename=".$name."\r\n";
        $body .="Content-Transfer-Encoding: base64\r\n";
        $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
        $body .= $encoded_content; // Attaching the encoded file with email
         
        $sentMailResult = mail($recipient_email, $subject, $body, $headers);

        $sentMailResult2 = mail ($recipient_email, $subjectto, $body, $headers2);
     
        if($sentMailResult2 ){
            $responseArr = [
                'status' => 'SUCCESS',
                'message' => 'Thank for Submit.'
            ];
            // unlink($name); // delete the file after attachment sent.
        }
        else{
            $responseArr['message'] = 'Failed to send email.';
        }

        if($sentMailResult ){
            $responseArr = [
                'status' => 'SUCCESS',
                'message' => 'Thank you for reaching us. We will get back soon.'
            ];
            // unlink($name); // delete the file after attachment sent.
        }
        else{
            $responseArr['message'] = 'Failed to send email.';
        }

    } catch (\Throwable $th) {
        $responseArr['message'] = 'Something went wrong.';
        $responseArr['error'] = $th->getMessage();
    }
}
echo json_encode($responseArr);
exit;
?>