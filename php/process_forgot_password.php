<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './vendor/phpmailer/phpmailer/src/Exception.php';
require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
require './vendor/phpmailer/phpmailer/src/SMTP.php';


include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    
    $stmt = $connect->prepare("SELECT fname, lname FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $fullname = $row['fname'] . ' ' . $row['lname'];

        $newPassword = substr(bin2hex(random_bytes(5)), 0, 10);
       

        $updateStmt = $connect->prepare("UPDATE users SET password = ? WHERE email = ?");
        $updateStmt->bind_param("ss", $newPassword, $email);
      
           
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'saradhalankaagro@gmail.com';                     //SMTP username
                $mail->Password   = 'tdraxttvlpbbxbek';                               //SMTP password
                $mail->SMTPSecure = 'ssl';          
                $mail->Port       = 465;  
               
                $mail->setFrom('saradhalankaagro@gmail.com', 'Saradha Lanka Agro');
                $mail->addAddress($email);  

             
                $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = 'Password Reset';
                $mail->Body    = "Dear $fullname,<br><br>Your password has been reset. Your new password is: <strong>$newPassword</strong><br><br>Please change it after logging in.";

                if($mail->send()){
                echo '<script>alert("A reset link has been sent to your email.");</script>';
                echo '<script>window.location.href = "login.php";</script>';
                $updateStmt->execute();
                }
                
                
            } catch (Exception $e) {
                echo 'Failed to send the reset link. Please try again later.';
                echo '<script>alert("Failed to send the reset link. Please try again later.");</script>';
                echo 'Mailer error: ' . $mail->ErrorInfo;
            }
      
    } else {
        echo 'Email not found.';
    }
}
$connect->close();
?>