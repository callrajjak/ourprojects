<?php

if (isset($_POST["captcha"])) {
    if ($_POST["captcha"] == '') {
        echo "<b class=\"wrong\">Enter above captcha in fields..!!</b>";
    } else {
        //Verifying user input captcha text with google generated captcha
        if ($_SESSION["captcha"] != $_POST["captcha"]) {
//            echo "<b class=\"correct\">Correct Code Entered..!!</b>";
//        } else {
            echo "<b class=\"wrong\">Wrong Code Entered..!!</b>";
        }
        unset($_SESSION['captcha']);
    }
}
?>