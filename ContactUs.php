
<?php
include './header.php';
include './connect.php';
include 'validation.php';
//session_start();
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#reload").click(function () {
            $("#captcha_img").attr("src", "captcha.php");
        });
    });
    </script>
<!-- ####################################################################################################### -->
<div class="wrapper">
    <div class="container">
        <div class="content" style="font-family:arial">
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
        </div>
        

        <div class="contactcontainer">

            <form method="post" action="ContactUs.php">
                <table id="contacttable" border="0">
                    <tr>
                        <td><label>Name :</label></td>
                        <td><input class="input" type="text" name="name" value=""></td>
                        <td><span class="error"><?php echo $nameError; ?></span></td>
                    </tr>
                    <tr>
                        <td><label>Company Name :</label></td>
                        <td><input class="input" type="text" name="companyname" value=""></td>
                        <td><span class="error"><?php echo $companyNameError; ?></span><br><br></td>
                    </tr>
                    <tr>
                        <td><label>Email Id:</label></td>
                        <td><input class="input" type="text" name="email" value=""></td>
                        <td><span class="error"><?php echo $emailError; ?></span></td>
                    </tr>
                    <tr>
                        <td><label>Phone :</label></td>
                        <td><input class="input" type="text" name="phone" value=""></td>
                        <td><span class="error"><?php echo $phoneError; ?></span></td>
                    </tr>
                    <tr>
                        <td><label>City :</label></td>
                        <td><input class="input" type="text" name="city" value=""></td>
                        <td><span class="error"><?php echo $cityError; ?></span></td>
                    </tr>
                    <tr>
                        <td><label>Country :</label></td>
                        <td><input class="input" type="text" name="country" value=""></td>
                        <td><span class="error"><?php echo $countryError; ?></span></td>
                    </tr>
                    <tr>
                        <td><label>WebSite :</label></td>
                        <td><input class="input" type="text" name="website" value=""></td>
                        <td><span class="error"><?php echo $websiteError; ?></span></td>
                    </tr>
                    <tr>
                        <td><label>Your Comments :</label></td>
                        <td><textarea name="message" val=""></textarea></td>
                        <td><span class="error"><?php echo $messageError; ?></span></td>
                    </tr>
                    <tr>
                        <td><br/><br/><br/><br/><br/><br/></td>

                        <td colspan="2"><img id="captcha_img" src="captcha.php" /><br/>
                            <a href="#" onclick="document.getElementById('captcha_img').src='captcha.php?'+Math.random();document.getElementById('captcha1').focus();"
                               id="change-image">Can't read? try another one</a><br/>
                            </td>
                        
                    <tr>
                        <td>Enter Text:</td>
                        <td><input id="captcha1" name="captcha" type="text"></td>
                        <td><?php include 'verify.php'; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input class="submit" type="submit" name="submit" value="Submit"><br/><span class="success"><?php echo $successMessage; ?></span></td>
                    </tr>
                </table>
                
                <br/>
            </form>
        </div>
    </div>
</div>

<!--<script type="text/javascript">
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
</script>-->
<br class="clear"/>
<?php
include './footer.php';
?>