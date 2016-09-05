
    <?php
include './header.php';
?> 

<div class="wrapper col2">
      
    
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
 <div id="container">
    <h1><b>Contact Us</b></h1>
    
    <table width="530" cellspacing="0" cellpadding="5" align="center" style="border:#FF0000 0px solid">
         
            <tbody>
              <tr align="left">
                <td width="236"><b>Your Name:</b></td>
                <td width="282"><input size="37" id="name" class="feedback" name="name" value="<?php echo $name;?>"></td>
              </tr>
              <tr align="left">
                <td width="236"><b>Company Name:</b></td>
                <td width="282"><input size="37" id="companyname" class="feedback" name="companyname" value="<?php echo $companyname;?>"></td>
              </tr>
              <tr align="left">
                <td width="236" valign="top"><b>Email id: </b></td>
                <td width="282" valign="top"><input size="37" id="emailid" class="feedback" name="emailid" value="<?php echo $emailid;?>"></td>
              </tr>
              <tr align="left">
                <td width="236"><b>Phone:</b></td>
                <td width="282"><input size="37" id="phone" class="feedback" name="phone" value="<?php echo $phone;?>"></td>
              </tr>
              <tr align="left">
                <td width="236"><b>City:</b></td>
                <td width="282"><input size="37" id="city" class="feedback" name="city" value="<?php echo $city;?>"></td>
              </tr>
              <tr align="left">
                <td><b>Website:</b></td>
                <td><input size="37" id="website" class="feedback" name="website" value="<?php echo $website;?>"></td>
              </tr>
              <tr align="left">
                <td><b>Your comments: </b></td>
                <td><textarea id="comment" class="feedback" rows="4" cols="34" name="comment"><?php echo $comment;?></textarea></td>
              </tr>
              <tr align="center">
              <td colspan="2">
                <img src="captcha.php" id="captcha" /><br/>
                <a href="#" onclick="
                document.getElementById('captcha').src='captcha.php?'+Math.random();
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
	
  </div>
</div>

<?php
include './footer.php';
?>