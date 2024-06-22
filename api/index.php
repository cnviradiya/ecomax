<?php
$responseArr = [
    'status' => 'FAILED',
    'message' => 'Invalid data found'
];

if (!empty($_POST['email'])) {
    try {
        $from_email = 'info@ecomaxlubricant.com'; //from mail, sender email address
        $recipient_email = 'pp3681382@gmail.com'; //recipient email address

        //Load POST data from HTML form
        $sender_name = "Ecomax Lubricant"; //sender name
        $reply_to_email = $from_email; //sender email, it will be used in "reply-to" header
        $subject  = "Sample mail for the career page"; //subject for the email
        
        $first_name = "Customer Name: " . htmlspecialchars($_POST["first_name"]) . " " . htmlspecialchars($_POST["last_name"]); //body of the email
        $customer_email = "Customer Email: " . htmlspecialchars($_POST["customer_email"]); //body of the email
        $customer_number = "Customer Number: " . htmlspecialchars($_POST["customer_number"]); //body of the email
        $message = "Message: " . htmlspecialchars($_POST["career_message"]); //body of the email

        // Get uploaded file data using $_FILES array
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['resume']['tmp_name']; // get the temporary file name of the file on the server
            $name     = basename($_FILES['resume']['name']); // get the name of the file
            $size     = $_FILES['resume']['size']; // get size of the file for size validation
            $type     = $_FILES['resume']['type']; // get type of the file

            // Read from the uploaded file & base64_encode content
            $handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
            $content = fread($handle, $size); // reading the file
            fclose($handle); // close upon completion

            $encoded_content = chunk_split(base64_encode($content));
            $boundary = md5("random"); // define boundary with a md5 hashed value

            // Headers
            $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
            $headers .= "From: " . $from_email . "\r\n"; // Sender Email
            $headers .= "Reply-To: " . $reply_to_email . "\r\n"; // Email address to reach back
            $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n"; // Defining Content-Type

            // Plain text
            $body = "--" . $boundary . "\r\n";
            $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $body .= chunk_split(base64_encode($first_name . "\n" . $customer_number . "\n" . $customer_email . "\n" . $message));

            // Attachment
            $body .= "--" . $boundary . "\r\n";
            $body .= "Content-Type: " . $type . "; name=\"" . $name . "\"\r\n";
            $body .= "Content-Disposition: attachment; filename=\"" . $name . "\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n";
            $body .= "X-Attachment-Id: " . rand(1000, 99999) . "\r\n\r\n";
            $body .= $encoded_content; // Attaching the encoded file with email

            $body .= "--" . $boundary . "--";

            $sentMailResult = mail($recipient_email, $subject, $body, $headers);

            if ($sentMailResult) {
                $responseArr = [
                    'status' => 'SUCCESS',
                    'message' => 'Thank you for reaching us. We will get back soon.'
                ];
                // unlink($name); // delete the file after attachment sent.
            } else {
                $responseArr['message'] = 'Failed to send email.';
            }
        } else {
            $responseArr['message'] = 'Invalid file upload.';
        }
    } catch (\Throwable $th) {
        $responseArr['message'] = 'Something went wrong.';
        $responseArr['error'] = $th->getMessage();
    }
}

echo json_encode($responseArr);
exit;
?>
