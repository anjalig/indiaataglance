<?php
$con=mysqli_connect("localhost","root","anshu","csv_db");


if($_POST) {
$output = "";
$name=$_POST["name"];
$email=$_POST["email"];
$comment=$_POST["comment"];
$sql="INSERT INTO feedback (name,email,comment)
         VALUES ('$name','$email','$comment')";
$result=mysqli_query($con,$sql);
if ($result)
  {
$mesgcontent="Thank You for your valuable feedback, we will get back to you soon.";
	require("PHPMailer/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();  // telling the class to use SMTP
$mail->Host     = "smtp.gmail.com"; // SMTP server
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "teamneophytes@gmail.com";  // GMAIL username
$mail->Password   = "prashant@123";      //gmailpassword
$mail->Sender     = "teamneophytes@gmail.com";  //gmail sender email address
$mail->AddAddress($email);
$mail->Subject  = "Thank You ";
$mail->Body =$mesgcontent;
$mail->WordWrap = 100;
//$mail->IsHTML(true);
$mail->Send();

  $output= "Thank you for your valuable feedback!<br> We will gaet back to you soon!";
  }

else
  {
   $output= "Sorry our Server is busy, please try after some time! ";  
  }

 }

?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>India at a Glance</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<!-- Home -->
<div data-role="page" id="page1">
    <div data-theme="a" data-role="header">
	 <h1>Feedback</h1>
        <div data-role="navbar" data-iconpos="top">
            <ul>
                <li>
                    <a href="index.html" data-transition="fade" data-theme="" data-icon="home">
                        Home
                    </a>
                </li>
                <li>
                    <a href="about.html" data-transition="fade" data-theme="" data-icon="info">
                        About
                    </a>
                </li>
                <li>
                    <a href="feedback.php" data-transition="fade" data-theme="" data-icon="star">
                        Feedback
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div data-role="content">
</div>
<?php if($_POST): ?>
<div>
<img src="feedback.jpg" height="100" width="100" /></div>
<br> <br>
   	<?php print $output; ?>
   
   	<?php else: ?> 
    <form method="POST" >
            <div data-role="fieldcontain" class="form-element">
                <label for="name">
                    Name
                </label>
                <input name="name" id="name" placeholder="" value="" type="text">
            </div>
            <div data-role="fieldcontain" class="form-element">
                <label for="email">
                    Email
                </label>
                <input name="email" id="email" placeholder="" value="" type="email">
            </div>
            <div data-role="fieldcontain" class="form-element">
                <label for="comment">
                    Comment
                </label>
                <textarea name="comment" id="comment" placeholder="">Enter your feedback</textarea>
            </div>
            <input id="submit" type="submit" data-theme="a" data-icon="bars" data-iconpos="left"
            value="Submit" class="form-element">
        </form>
<?php endif; ?>
	</div>

	    <div data-theme="a" data-role="footer" data-position="fixed">
        <h3>
            &copy; 2013, Team Neophytes.
        </h3>
    </div>
</body>
</html>

