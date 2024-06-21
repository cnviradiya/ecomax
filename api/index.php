<?php
$responseArr = [
    'status' => 'FAILED',
    'message' => 'Invalid data found'
];

if(!empty($_POST['email'])) {
    try {
        $to = $_POST['email'];
        $subject = "HTML email";
        $message = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>Thank you for contacting us!</p>
        <table>
        <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        </tr>
        <tr>
        <td>{$_POST['first_name']}</td>
        <td>{$_POST['last_name']}</td>
        </tr>
        </table>
        </body>
        </html>
        ";
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <info@ecomaxlubricant.com>' . "\r\n";
        $headers .= 'Cc: pp3681382@gamil.com' . "\r\n";

        $boundary = md5("random");
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/html; charset=UTF-8\r\n";
        $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $body .= $message . "\r\n";
        
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['resume']['tmp_name'];
            $name = $_FILES['resume']['name'];
            $size = $_FILES['resume']['size'];
            $type = $_FILES['resume']['type'];

            $handle = fopen($tmp_name, "r");
            $content = fread($handle, $size);
            fclose($handle);

            $encoded_content = chunk_split(base64_encode($content));
        
            $body .= "--$boundary\r\n";
            $body .= "Content-Type: $type; name=\"$name\"\r\n";
            $body .= "Content-Disposition: attachment; filename=\"$name\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $body .= $encoded_content . "\r\n";
           
            echo base64_dencode($encoded_content);
        }
        
        $body .= "--$boundary--";

        if (mail($to, $subject, $body, $headers)) {
            $responseArr = [
                'status' => 'SUCCESS',
                'message' => 'Thank you for reaching us. We will get back soon.'
            ];
        } else {
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
