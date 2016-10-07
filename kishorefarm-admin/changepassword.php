<?php include_once("connect.php"); 

if(!isValidUser()) header("Location: ".$siteurl."login.php");

if(strtoupper(trim($_POST["btnSubmit"])) ==	"CHANGE")
{	
	$go = 1 ;
	global $conn;
 	$txtoldpwd	=	addslashes(trim($_POST["txtoldpwd"]));
	$txtnewpwd	=	addslashes(trim($_POST["txtnewpwd"]));
	$txtcpwd  	=	addslashes(trim($_POST["txtcpwd"]));
	$QryChkAdm	=	"SELECT * FROM admin_users WHERE user_id=".$_SESSION['adminid']; 
	$ResChkAdm	=	mysqli_query($conn,$QryChkAdm);
	$NmChkAdm	=	mysqli_num_rows($ResChkAdm);
	if($NmChkAdm > 0)
	{	
		while($rowChkAdm = mysqli_fetch_array($ResChkAdm)){$OldPwd = $rowChkAdm['password'];}
	
		if(strlen($txtoldpwd)<=0)		{$txtoldpwd_err	=	'Please enter old password.';		$go=0;}
		elseif($txtoldpwd!=$OldPwd)		{$txtoldpwd_err	=	'Invalid old password.';		$go=0;}
		if(strlen($txtnewpwd)<=0)		{$txtnewpwd_err	=	'Please enter new password.';		$go=0;}
		if(strlen($txtcpwd)<=0)			{$txtcpwd_err	=	'Please enter confirm password.';	$go=0;}		
		if($txtnewpwd != $txtcpwd)	{$txtcpwd_err	=	'Confirm Password does not match.';			$go=0;}
		elseif(strlen($txtcpwd)<6){$txtcpwd_err="Password length must have atleast 6 character .";$go=0;}
		
		if($go)
		{
			
			//encrypted password .
			//$QryUpdPwd = "UPDATE tblAdminUsers SET  AdminUsersPassword ='".sha1(striptags(clean($txtnewpwd)))."' WHERE tblAdminUsersId=".$_SESSION['adminid'];
			
			$QryUpdPwd = "UPDATE admin_users SET  password ='".striptags(clean($txtnewpwd))."' WHERE user_id=".$_SESSION['adminid'];
			if(mysqli_query($conn,$QryUpdPwd)){
				$msg = 'Password has been changed successfully.';
				$error = 1;				
			}else{
				$msg = 'Some problem in the process. please try later.';
				$error = 0;
			}
		}
		else
		{
			$error = 0;	
		}
	}
	else 
	{ $msg="Sorry, some error occur.";
		  $error=0;
	}
}
?> 
<?php include_once("admin_header.php");?>

        
    <div class="content">
    	<div class="title"><h5>Settings</h5></div>
             
    <?php if($error === 0){?>
				<div class="nNote nFailure hideit">
                <p><strong>FAILURE: </strong>
			<?php if(!empty($msg)){?><?php echo $msg;?><?php }?>                
			<?php if(!empty($txtoldpwd_err)){?><?php echo $txtoldpwd_err;?><?php }?>
			<?php if(!empty($txtnewpwd_err)){?><?php echo $txtnewpwd_err;?><?php }?>
			<?php if(!empty($txtcpwd_err)){?><?php echo $txtcpwd_err;?><?php }?>
				</p>
				</div>
				<?php }elseif($error === 1){?>
				<div class="nNote nSuccess hideit">
                <p><strong>SUCCESS: </strong>
				<?php echo $msg;?>
				</p>
				</div>
				<?php 
					unset($txtoldpwd);
					unset($txtnewpwd);
					unset($txtcpwd);
				}?>
      
        <!-- Form begins -->
        <form action="#" method="POST" class="mainForm" enctype="multipart/form-data">
        
        	<!-- Input text fields -->
            <fieldset>
                <div class="widget first">
                    <div class="head"><h5>Change password</h5></div>
               
                        

					    <div class="rowElem noborder">
                            <label>Old Password</label>
                            <div class="formRight">
                            <input type="password" name="txtoldpwd" placeholder="Old Password" class="rightDir" value="<?php echo $txtoldpwd;?>" maxlength="50" style="width:50%"/>
                            </div>
                            <div class="fix"></div>
                        </div>
                        
                        <div class="rowElem noborder">
                            <label>New Password</label>
                            <div class="formRight">
                            <input type="password" name="txtnewpwd" placeholder="New Password" class="rightDir" value="<?php echo $txtnewpwd;?>" maxlength="50" style="width:50%"/>
                            </div>
                            <div class="fix"></div>
                        </div>
                        
                        <div class="rowElem noborder">
                            <label>Confirm Password</label>
                            <div class="formRight">
                            <input type="password" name="txtcpwd" placeholder="Confirm Password" class="rightDir" value="<?php echo $txtcpwd;?>" maxlength="50" style="width:50%"/>
                            </div>
                            <div class="fix"></div>
                        </div>
                        

                    
                      

                </div>
            </fieldset>
            
            <fieldset>
			   <div class="widget">
			    <div class="head" style="padding:12px 0 0 0;"> <div class="fix"></div><input type="submit" name="btnSubmit" value="Change" class="greyishBtn submitForm" style="float:left;"/></div>
			
                   
					</div>
					   </fieldset>

			   
        </form>

         
    </div>
	
        
    
    <div class="fix"></div>
</div>

    
<?php include_once("admin_footer.php");?>        
