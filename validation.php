<?php

// Initialize variables to null.
$name = "";  //Sender Name
$email = "";  //Sender's email ID
$phone = ""; //Subject of mail
$message = ""; //Sender's Message 
$city = ""; //Sender's Message 
$company = ""; //Sender's Message 
$country = ""; //Sender's Message 
$website = ""; //Sender's Message 

$nameError = "";
$emailError = "";
$phoneError = "";
$messageError = "";
$successMessage = "";
$companyNameError = "";
$cityError = "";
$websiteError = "";
$countryError = "";

//On submitting form below function will execute

if (isset($_POST['submit'])) {
    // checking null values in message
    if (empty($_POST["name"])) {
        $nameError = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameError = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["companyname"])) {
        $companyNameError = "Company Name is required";
    } else {
        $company = test_input($_POST["companyname"]);
        // check name only contains letters and whitespace 
    }

// checking null values in message  
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }
// checking null values in message    
    if (empty($_POST["phone"])) {
        $phoneError = "Phone Number is required";
    } else {
        $phone = test_input($_POST["phone"]);
    }
    if (empty($_POST["city"])) {
        $cityError = "City is required";
    } else {
        $city = test_input($_POST["city"]);
    }
    if (empty($_POST["country"])) {
        $countryError = "Country is required";
    } else {
        $country = test_input($_POST["country"]);
    }
    if (empty($_POST["website"])) {
        $websiteError = "WebSite is required";
    } else {
        $website = test_input($_POST["website"]);
    }
// checking null values in message
    if (empty($_POST["message"])) {
        $messageError = "Comments is required";
    } else {
        $message = test_input($_POST["message"]);
    }
// checking null values in all fields  
    if (!($name == '') && !($email == '') && !($phone == '') && !($city == '') && !($country == '') && !($message == '')) {// checking valid email
        if (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {

            $header = $name . "<" . $email . ">";
            $headers = "From: {$email}\r\n";
            //$headers = 'Bcc: info@rkage.com' . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            /* Let's prepare the message for the e-mail */
            $msg = "Hello! $name

 Thank you...! For Contacting Us.
echo $msg;
 Name: $name
 E-mail: $email
 Phone: $phone
 Message: $message 
  
 This is a Contact Confirmation mail.
 We Will contact You as soon as possible.";

            $msg1 = " $name Contacted Us.
echo $msg1;
 Here are some information about $name.

 Name: $name
 E-mail: $email
 Purpose: $phone
 Message: $message ";

            /* Send the message using mail() function */
            if (mail($email, $headers, $msg) && mail("callrajjak@gmail.com", $header, $msg1)) {
                echo "inside if for checking";
                global $conn;
                $colArray = array('contact_name' => $name, 'company_name' => $company, 'emailid' => $email, 'phone' => $phone, 'city' => $city, 'country' => $country, 'website' => $website, 'commentsdata' => $message);

                echo "create column array";
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

                startTransaction();
                echo "start transaction";
                echo "$table"." ".$fields." ".$values."<br/>";
                $response = insert($table, $fields, $values, $conn);
                echo "response is ".$response;
                if ($response) {
                    
                    if ($flag) {
                        $message = 'contact has been added successfully.';
                        $success = 1;
                        commit();
                    } else {
                        $message = 'Some problem in the process. please try later.' . mysql_error();
                        $success = 0;
                        rollback();
                    }
                } else {
                    $message = 'Some problem in the process. please try later.' . mysql_error();
                    $success = 0;
                    rollback();
                }
                $successMessage = "Message sent successfully.......";
            }
        } else {
            $emailError = "Invalid Email";
        }
    }
}

// function for filtering input values
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>