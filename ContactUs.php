<?php
include_once('connect.php');

if (!empty($_POST['btnsubmit'])) {
    $msg = '';
    $success = 1;
    $continue = 1;
    $name = $_REQUEST['name'];
    $companyname = $_REQUEST['companyname'];
    $emailid = $_REQUEST['emailid'];
    $confirmemailid = $_REQUEST['confirmemailid'];
    $phone = $_REQUEST['phone'];
    $city = $_REQUEST['city'];
    $country = $_REQUEST['country'];
    $website = $_REQUEST['website'];
    $comment = $_REQUEST['comment'];
    $captcha = $_REQUEST['captcha'];

    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
        $msg = 'Please enter correct text code';
        $continue = 0;
    }

    if ($continue) {
        // multiple recipients (note the commas)
        $to = "callrajjak@gmail.com";

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
			<td>Country:</td>
			<td>{$country}</td>
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
            /* ================================= */
            global $conn;
            $colArray = array('contact_name' => $name, 'company_name' => $companyname, 'emailid' => $emailid, 'phone' => $phone, 'city' => $city, 'country' => $country, 'website' => $website, 'commentsdata' => $comment);

            function filter($v) {
                if ($v != "") {
                    return true;
                }
                return false;
            }

            $mainArray = array_filter($colArray, "filter");
            $table = 'contacts_detail';
            $fields = array_keys($mainArray);
            $values = array_values($mainArray);
            //print_r($mainArray);
            //print_r($fields);
            //print_r($values);
            //die();
//            startTransaction();
            $response = insert($table, $fields, $values, $conn);
//            if ($response) {
//
//                if ($flag) {
//                    $msg = 'contact has been added successfully.';
//                    $success = 1;
//                    commit();
//                } else {
//                    $msg = 'Some problem in the process. please try later.' . mysql_error();
//                    $success = 0;
//                    rollback();
//                }
//            } else {
//                $msg = 'Some problem in the process. please try later.' . mysql_error();
//                $success = 0;
//                rollback();
//            }
            /* ================================= */

            $name = $companyname = $emailid = $phone = $confirmemailid = $city = $country = $website = $comment = $captcha = "";
        } else {
            $msg = "Fail to send mail.";
            $success = 0;
        }
    } else {
        $success = 0;
    }
}



include_once('header.php');
?>

<!-- ####################################################################################################### -->
<div class="wrapper">
    <div class="container">
        <div class="content" style="font-family:arial">

            <div id="component-contact">
                <div class="result">
                <?php
                if (!empty($msg)) {
                    if ($success) {
                        echo $msg;
                    } else {
                        echo $msg;
                    }
                }
                ?>
                </div>
                <p style="font-size:18px;">	 
                <table id="addresstable">
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
                <form id="cform" name="cform" method="post" action="#">

                    <table width="530" cellspacing="0" cellpadding="5" align="center" style="border:#FF0000 0px solid">

                        <tbody>
                            <tr>
                                <td><b>Your Name:</b></td>
                                <td><input type="text" id="name" name="name" value="<?php echo $name; ?>"></td>
                            </tr>
                            <tr>
                                <td><b>Company Name:</b></td>
                                <td><input type="text" id="companyname" name="companyname" value="<?php echo $companyname; ?>"></td>
                            </tr>
                            <tr>
                                <td><b>Email id: </b></td>
                                <td><input type="text" id="emailid" class="feedback" name="emailid" value="<?php echo $emailid; ?>"></td>
                            </tr>
                            <tr>
                                <td><b>Confirm Email id: </b></td>
                                <td><input type="text" id="confirmemailid" class="feedback" name="confirmemailid" value="<?php echo $confirmemailid; ?>"></td>
                            </tr>
                            <tr>
                                <td><b>Phone:</b></td>
                                <td ><input type="text" id="phone" name="phone" value="<?php echo $phone; ?>"></td>
                            </tr>
                            <tr>
                                <td><b>City:</b></td>
                                <td ><input type="text" id="city" name="city" value="<?php echo $city; ?>"></td>
                            </tr>
                            <tr>
                                <td><b>Country:</b></td>
                                <td ><input type="text" id="country" name="country" value="<?php echo $country; ?>"></td>
                            </tr>
                            <tr>
                                <td><b>Website:</b></td>
                                <td><input type="text" id="website" name="website" value="<?php echo $website; ?>"></td>
                            </tr>
                            <tr>
                                <td><b>Your comments: </b></td>
                                <td><textarea id="comment" rows="4" cols="34" name="comment"><?php echo $comment; ?></textarea></td>
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
                                    <input type="submit" class="submit" name="btnsubmit" value="Submit"><br/>
                                    <input type="reset" class="reset" name="reset" value=" Reset " id="NW-RESET"></td>
                            </tr>
                        </tbody>

                    </table>
                </form>

            </div>


        </div>
        <?php include_once('sidebar.php'); ?>
    </div>

    <script type="text/javascript">
        // Select all of the forms on the page (in this case the only one)
        // and call 'validity' on the result.
        $(function () {
            $("#cform").validity(function () {

                $('#name').require();
                //$('#companyname').require();
                $('#emailid').require().match('email');
                $('.feedback').equal('Email id not matched');
                $('#phone').match('integer');
                //$('#city').require();
                $('#website').match('url');
                $('#country').require();
                $('#comment').require();
                $('#captcha-form').require();

            });
        });
    </script>

    <?php include_once('footer.php'); ?>