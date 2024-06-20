<?php
$responseArr = [
    'status' => 'FAILED',
    'message' => 'Invalid data found'
];
if(!empty($_POST['email'])) {
    try {
        $to = $_POST['email'];
        $subject = "dharumil";
        
        $message = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>Thank you for the contact us!</p>
        <table>
        <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        </tr>
        <tr>
        <td>John</td>
        <td>Doe</td>
        </tr>
        </table>
        </body>
        </html>
        ";
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: <info@ecomaxlubricant.com>' . "\r\n";
        $headers .= 'Cc: bhalanidhrumil72@gmail.com' . "\r\n";
        
        mail($to,$subject,$message,$headers);
        $responseArr = [
            'status' => 'SUCCESS',
            'message' => 'Thank you for reach us. we will get back soon.'
        ];
    } catch (\Throwable $th) {
        //throw $th;
        $responseArr['message'] = 'Something went wrong.';
        $responseArr['error'] = $th->getMessage();
    }
    
}
echo json_encode($responseArr);
exit;


?>