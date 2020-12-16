<?php

require_once('User.php');
if(!isset($_SESSION['signup']['email'])){
    header('Location:account.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Planet Hosting a Hosting Category Flat Bootstrap Responsive Website Template | Login :: w3layouts</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Planet Hosting Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<!---fonts-->
<link href='//fonts.googleapis.com/css?family=Voltaire' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!---fonts-->
<!--script-->
<link rel="stylesheet" href="css/swipebox.css">
			<script src="js/jquery.swipebox.min.js"></script> 
			    <script type="text/javascript">
					jQuery(function($) {
						$(".swipebox").swipebox();
					});
				</script>
<!--script-->
</head>
<?php require "header.php" ?>
<div class="content">
   <!-- registration -->
   <div class="main-1">
      <div class="container" style="overflow:hidden;">
         <div class="register">
            <div class="register-top-grid">
               <form method="POST" >
                  <div>
                     <p><?php echo $_SESSION['signup']['email'];?></p>
                     <h3><input type="submit" name="verifybymail"  style="background-color:#585CA7;color:honeydew;" value="Verify by Email"></h3>
                  </div>
               </form>
               
              <form method="POST"> 
               <div>
                  <h3 style="color:#585CA7;">Enter OTP Recieved.</h3><br>
                  <input type="number" name="otp" style="border-radius:10px;"><br>
                  <input type="submit" name="verify" value="Verify" style="margin-top:10px;border-radius:10px;background-color:#585CA7;color:honeydew;">   
               </div> 
               </form>
                
               <form method="POST">
                  <div>
                     <p><?php echo $_SESSION['signup']['phone'];?></p>
                     <h3><input type="submit" name="verifybyphone"  style="background-color:#585CA7;color:honeydew;" value="Verify by Phone"></h3>
                  </div>
               </form> 
               
                 
            </div> 
                
         </div>
      </div>
   </div>
</div>
   <!-- registration -->


<!-- login -->
<?php require "footer.php" ?>
<?php
  
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   require '/home/cedcoss/vendor/autoload.php';
   if(isset($_POST['verifybymail']))
   {
      $_SESSION['verifyby']="mail";
      $obj= new Dbcon();
      $obj2=new User();
      $otp = rand(1000,9999);
      $_SESSION['otp']=$otp;
      $mail = new PHPMailer();
         try {                                       
            $mail->isSMTP(true);                                             
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                              
            $mail->Username   = 'himanarora8898@gmail.com';                  
            $mail->Password   = 'Stark@#$8898';                         
            $mail->SMTPSecure = 'tls';                               
            $mail->Port       = 587;   
               
            $mail->setfrom('himanarora8898@gmail.com', 'CedHosting');            
            $mail->addAddress($_SESSION['signup']['email']); 
            $mail->addAddress($_SESSION['signup']['email'], $_SESSION['signup']['name']); 
                  
            $mail->isHTML(true);                                   
            $mail->Subject = 'Account Verification'; 
            $mail->Body    = 'Hi User,Here is your otp for account verification- '.$otp; 
            $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $mail->send();
            header('location: verifybymail.php?email=' .$_SESSION['signup']['email']);
            } 
         catch (Exception $e)
            {
            echo "Mailer Error: " . $mail->ErrorInfo;
         }
         
   }

   if (isset($_POST['verify'])){
      require_once('User.php');
      $obj= new Dbcon();
      $obj2=new User();
      $ver=$_SESSION['verifyby'];
      $m=$_SESSION['signup']['email'];

      $inotp=isset($_POST['otp'])?$_POST['otp']:'';
      if($inotp!=$_SESSION['otp']){
            echo "<script>alert('Email-verification unsuccessfull please verify again');
            window.location.href='aftersignup.php';</script>";
      }
      else{
         $obj2->verify($inotp,$m,$ver,$obj->conn);
      }
      
      
   }



   if (isset($_POST['verifybyphone'])){
      $_SESSION['verifyby']="phone";
      $otp = rand(1000,9999);
      $_SESSION['otp']=$otp;
      $fields = array(
          "sender_id" => "FSTSMS",
          "message" => 'Your Otp is'.$otp,
          "language" => "english",
          "route" => "p",
          "numbers" => $_SESSION['signup']['phone'],
      );
      
      $curl = curl_init();
      
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => array(
          "authorization:AW7DzfNXySiaFWyQoiIIYk3ycbXSH3TAp19p1wD7d7PJ5xMigQK3TLvD0acf",
          "accept: */*",
          "cache-control: no-cache",
          "content-type: application/json"
        ),
      ));
      
      $response = curl_exec($curl);
      $err = curl_error($curl);
      
      curl_close($curl);
      
      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        echo $response;
      }
      }
?>