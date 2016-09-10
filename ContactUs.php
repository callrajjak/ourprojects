
<?php
include './header.php';

if (!empty($_POST['btnsubmit'])) {
    $msg = '';
    $success = 1;
    $continue = 1;
    $name = $_REQUEST['name'];
    $companyname = $_REQUEST['companyname'];
    $emailid = $_REQUEST['emailid'];
    $phone = $_REQUEST['phone'];
    $city = $_REQUEST['city'];
    $website = $_REQUEST['website'];
    $comment = $_REQUEST['comment'];
    $captcha = $_REQUEST['captcha'];

    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
        $msg = 'Please enter correct text code';
        $continue = 0;
    }

    if ($continue) {
        // multiple recipients (note the commas)
        $to = "info@kishorefarm.com";

        // subject
        $subject = "Enquiry From website";

        // compose message
        $message = "
	<html>
	  <head>
		<title>Enquiry from website</title>
	  </head>
	  <body>
		<h1>Enquiry :</h1>
		<table border='0' >
		<tr>
			<td>Name:</td>
			<td>{$name}</td>
		</tr>
		<tr>
			<td>Company Name:</td>
			<td>{$companyname}</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>{$emailid}</td>
		</tr>
		<tr>
			<td>Phone:</td>
			<td>{$phone}</td>
		</tr>
		<tr>
			<td>City:</td>
			<td>{$city}</td>
		</tr>
		<tr>
			<td>Website:</td>
			<td>{$website}</td>
		</tr>
		<tr>
			<td>Comment:</td>
			<td>{$comment}</td>
		</tr>
		
	  </body>
	</html>
	";

        // To send HTML mail, the Content-type header must be set
        $headers = "From: {$emailid}\r\n";
        //$headers = 'Bcc: info@rkage.com' . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        // send email
        if (mail($to, $subject, $message, $headers)) {
            $msg = "Mail sent";
            $success = 1;
            $name = $companyname = $emailid = $phone = $city = $website = $comment = $captcha = "";
        } else {
            $msg = "Fail to send mail.";
            $success = 0;
        }
    } else {
        $success = 0;
    }
}
?>
<div class="wrapper">
    <div id="breadcrumb">
        <ul>
            <li class="first">You Are Here</li>
            <li>&#187;</li>
            <li><a href="#">Home</a></li>
            <li>&#187;</li>
            <li class="current"><a href="#">Contact us</a></li>
        </ul>
    </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
    <div class="container">
        <div class="content" style="font-family:arial">

            <div id="component-contact">
<?php
if (!empty($msg)) {
    if ($success) {
        echo $msg;
    } else {
        echo $msg;
    }
}
?>
                <form id="cform" name="cform" method="post" action="#">
                    <p style="font-size:18px;">	 
                    <table>
                        <tr>
                            <td><b>Address:</b> </td>
                            <td>11, Halav Pool Road, <br>Sunrise Estate, <br>Kurla West, Mumbai, Maharashtra 400070<br></td>
                        </tr>
                        <tr>
                            <td><b>Phone:</b></td>
                            <td>022 2503 5973<br><br></td>
                        </tr>
                    </table>


                    </p>
                    <table width="530" cellspacing="0" cellpadding="5" align="center" style="border:#FF0000 0px solid">

                        <tbody>
                            <tr align="left">
                                <td width="236"><b>Your Name:</b></td>
                                <td width="282"><input size="37" id="name" class="feedback" name="name" value="<?php echo $name; ?>"></td>
                            </tr>
                            <tr align="left">
                                <td width="236"><b>Company Name:</b></td>
                                <td width="282"><input size="37" id="companyname" class="feedback" name="companyname" value="<?php echo $companyname; ?>"></td>
                            </tr>
                            <tr align="left">
                                <td width="236" valign="top"><b>Email id: </b></td>
                                <td width="282" valign="top"><input size="37" id="emailid" class="feedback" name="emailid" value="<?php echo $emailid; ?>"></td>
                            </tr>
                            <tr align="left">
                                <td width="236"><b>Phone:</b></td>
                                <td width="282"><input size="37" id="phone" class="feedback" name="phone" value="<?php echo $phone; ?>"></td>
                            </tr>
                            <tr align="left">
                                <td width="236"><b>City:</b></td>
                                <td width="282"><input size="37" id="city" class="feedback" name="city" value="<?php echo $city; ?>"></td>
                            </tr>
                            <tr align="left">
                                <td><b>Website:</b></td>
                                <td><input size="37" id="website" class="feedback" name="website" value="<?php echo $website; ?>"></td>
                            </tr>
                            <tr align="left">
                                <td><b>Your comments: </b></td>
                                <td><textarea id="comment" class="feedback" rows="4" cols="34" name="comment"><?php echo $comment; ?></textarea></td>
                            </tr>
                            <tr align="center">
                                <td colspan="2">
                                    <img src="captcha.php" id="captcha" /><br/>
                                    <a href="#" onclick="
                                            document.getElementById('captcha').src = 'captcha.php?' + Math.random();
                                            document.getElementById('captcha-form').focus();"
                                       id="change-image">Not readable? Change text.</a><br/>
                                    <b>Human Test</b><br/>
                                    <input type="text" name="captcha" id="captcha-form"  />
                                <td>
                            </tr>
                            <tr>
                                <td align="center" colspan="2">
                                    <input type="submit" name="btnsubmit" value="Submit">
                                    <input type="reset" name="reset" value=" Reset " id="NW-RESET"></td>
                            </tr>
                        </tbody>

                    </table>
                </form>

            </div>

        </div>

    </div>

    <script type="text/javascript">
        // Select all of the forms on the page (in this case the only one)
        // and call 'validity' on the result.
        $(function () {
            $("#cform").validity(function () {

                $('#name').require();
                //$('#companyname').require();
                $('#emailid').require().match('email');
                $('#phone').match('integer');
                //$('#city').require();
                $('#website').match('url');
                $('#comment').require();
                $('#captcha-form').require();

            });
        });
    </script>

<?php
include './footer.php';
?>