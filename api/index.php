<?php
$responseArr = [
    'status' => 'FAILED',
    'message' => 'Invalid data found'
];

if (!empty($_POST['email'])) {
    try {
        $from_email = 'info@ecomaxlubricant.com'; // From email address
        $recipient_email = 'pp3681382@gmail.com'; // Recipient email address
        
        // Load POST data from HTML form
        $sender_name = "Ecomax Lubricant"; // Sender name
        $reply_to_email = $from_email; // Reply-to email address
        $subject = "Sample mail for the career page"; // Email subject
        $first_name = "Customer Name:-" . $_POST["first_name"]; // Customer first name
        $last_name = $_POST["last_name"]; // Customer last name
        $customer_email = "Customer Email:-" . $_POST["email"]; // Customer email
        $customer_number = "Customer Number:-" . $_POST["number"]; // Customer phone number
        $message = "Customer Message:-" . $_POST["career_message"]; // Customer message

        // Get uploaded file data using $_FILES array
        if (isset($_FILES['resume'])) {
            $tmp_name = $_FILES['resume']['tmp_name']; // Temporary file name
            $name = $_FILES['resume']['name']; // File name
            $size = $_FILES['resume']['size']; // File size
            $type = $_FILES['resume']['type']; // File type
            $error = $_FILES['resume']['error']; // File error

            if ($error > 0) {
                throw new Exception('Upload error or no files uploaded');
            }

            // Read from the uploaded file and base64 encode content
            $handle = fopen($tmp_name, "r"); // File handle for reading
            $content = fread($handle, $size); // Read file content
            fclose($handle); // Close the file handle

            $encoded_content = chunk_split(base64_encode($content));
            $boundary = md5("random"); // Define boundary with a md5 hashed value

            // Header
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "From:".$from_email."\r\n";
            $headers .= "Reply-To: ".$reply_to_email."\r\n";
            $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n";

            // Plain text
            $body = "--$boundary\r\n";
            $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $body .= chunk_split(base64_encode($first_name . " " . $last_name . "\n" . $customer_email . "\n" . $customer_number . "\n" . $message));

            // Attachment
            $body .= "--$boundary\r\n";
            $body .= "Content-Type: $type; name=".$name."\r\n";
            $body .= "Content-Disposition: attachment; filename=".$name."\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n";
            $body .= "X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
            $body .= $encoded_content; // Attaching the encoded file with email

            $sentMailResult = mail($recipient_email, $subject, $body, $headers);

            if ($sentMailResult) {
                $responseArr = [
                    'status' => 'SUCCESS',
                    'message' => 'Thank you for reaching us. We will get back soon.'
                ];
                // unlink($tmp_name); // delete the file after attachment sent
            } else {
                $responseArr['message'] = 'Failed to send email.';
            }
        } else {
            throw new Exception('No file uploaded');
        }

    } catch (Exception $e) {
        $responseArr['message'] = 'Something went wrong.';
        $responseArr['error'] = $e->getMessage();
    }
}

echo json_encode($responseArr);
exit;
?>
