<?php include_once("connect.php");
global $conn;

if($_GET["session_destroy"] == true)
{
	    $ip=$_SERVER['REMOTE_ADDR'];
		$query_update="UPDATE admin_users SET userlastip ='".ip2long(cleanDB($ip))."' WHERE user_id=".cleanDB($_SESSION["adminid"]);
		$result_update=mysqli_query($conn,$query_update);	
		if($result_update){ 
		//session_unset();	
	       // session_destroy();
		   unset($_SESSION["adminid"]);
		   header("Location: ".$siteurl."index.php");
		}	 
}
if(isValidUser()) header("Location:".$siteurl."index.php");

$msg="";
$error=0;
if(!empty($_POST["submit"]))
{ 
	$msg="";	
	$go=1;
	$user=trim($_POST["txtusername"]);
	$pass=trim($_POST["txtpassword"]);

        if(strlen($user)<=0||strlen($pass)<=0 ){$msg="Please fill all the fields.";$go=0;$error=1;}
	if($go)
	{
		//encrypted password
		//$query="select * from admin_users where AdminUsersName='".cleanDB($user)."' and AdminUsersPassword='".sha1(cleanDB($pass))."'";
		
		$query="select * from admin_users where user_name='".$user."' and password='".$pass."'";
		$result=mysqli_query($conn,$query);
		$count=mysqli_num_rows($result); 
		if($count>0) 
		{
		    while($row = mysqli_fetch_array($result)){$adminid  =$row["user_id"]; $flag=$row["block"]; $deleteFlag=$row["deleted"]; }	
				 
				if($flag=='Y' || $deleteFlag=='Y'){	
			        $msg="You don't have access to the Admin Panel. Please contact Super Admin."; $error=1;
				}
				else
				{
			        $_SESSION["adminid"]=$adminid;
					$sessionid=session_id();
				  	header("Location:".$siteurl."index.php");	
		        }
		}
                else 
                    {
                           $msg = " Invalid Username And/Or Password.";
                           $error = 1;
                       }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Welcome to Kishorefarm Administrator</title>

<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css' />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript" src="js/plugins/spinner/jquery.mousewheel.js"></script>
<script type="text/javascript" src="js/plugins/spinner/ui.spinner.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> 

<script type="text/javascript" src="js/plugins/wysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/plugins/wysiwyg/wysiwyg.image.js"></script>
<script type="text/javascript" src="js/plugins/wysiwyg/wysiwyg.link.js"></script>
<script type="text/javascript" src="js/plugins/wysiwyg/wysiwyg.table.js"></script>

<script type="text/javascript" src="js/plugins/flot/jquery.flot.js"></script>
<script type="text/javascript" src="js/plugins/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="js/plugins/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/plugins/flot/excanvas.min.js"></script>
<script type="text/javascript" src="js/plugins/flot/jquery.flot.resize.js"></script>

<script type="text/javascript" src="js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/plugins/tables/colResizable.min.js"></script>

<script type="text/javascript" src="js/plugins/forms/forms.js"></script>
<script type="text/javascript" src="js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="js/plugins/forms/autotab.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="js/plugins/forms/chosen.jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.tagsinput.min.js"></script>

<script type="text/javascript" src="js/plugins/other/calendar.min.js"></script>
<script type="text/javascript" src="js/plugins/other/elfinder.min.js"></script>

<script type="text/javascript" src="js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.alerts.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.colorpicker.js"></script>

<script type="text/javascript" src="js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="js/plugins/wizards/jquery.validate.js"></script>

<script type="text/javascript" src="js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.ToTop.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.listnav.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.prettyPhoto.js"></script>

<script type="text/javascript" src="js/custom.js"></script>

</head>

<body>

<!-- Top navigation bar -->
<div id="topNav">
    <div class="fixed">
        <div class="wrapper">
            <div class="backTo"><a href="http://www.kishorefarm.com" title=""><img src="images/icons/topnav/mainWebsite.png" alt="" /><span>Main website</span></a></div>
            <div class="userNav">
                <ul>
                    
                    <li><a href="#" title=""><img src="images/icons/topnav/help.png" alt="" /><span>Help</span></a></li>
                </ul>
            </div>
            <div class="fix"></div>
        </div>
    </div>
</div>


				<?php if($error === 1){?>
				<?php if(!empty($msg)){?>
				<div class="nNote nFailure hideit">
                <p><strong>FAILURE: </strong>
				<?php echo $msg;?>
				</p>
				</div>
				<?php }?>
				<?php }elseif($error === 0){?>
				<?php if($msg <> ''){?>
				<div class="nNote nSuccess hideit">
                <p><strong>SUCCESS: </strong>
				<?php echo $msg;?>
				</p>
				</div>
				<?php }?>
				<?php }?>

<!-- Login form area -->
<div class="loginWrapper">
	<div class="loginLogo"><img src="images/loginLogo.png" alt="" /></div>
    <div class="loginPanel">
        <div class="head"><h5 class="iUser">Login</h5></div>
        <form action="#" method="post" id="valid" class="mainForm">
            <fieldset>
                <div class="loginRow noborder">
                    <label for="req1">Username:</label>
                    <div class="loginInput"><input type="text" name="txtusername" maxlength="50" class="validate[required]" id="req1" /></div>
                    <div class="fix"></div>
                </div>
                
                <div class="loginRow">
                    <label for="req2">Password:</label>
                    <div class="loginInput"><input type="password" name="txtpassword" maxlength="50"  class="validate[required]" id="req2" /></div>
                    <div class="fix"></div>
                </div>
                
                <div class="loginRow">
                    <!-- <div class="rememberMe"><input type="checkbox" id="check2" name="chbox" /><label for="check2">Remember me</label></div> -->
                    <input type="submit" name="submit" value="Log me in" class="greyishBtn submitForm" />
                    <div class="fix"></div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<!-- Footer -->
<div id="footer">
	<div class="wrapper">
    	<span>&copy; Copyright 2012. All rights reserved. Kishorefarm   by   <a href="#" title="">RKage.com :: Call 828-616-9973 :: email info@rkage.com</a></span>
    </div>
</div>

</body>
</html>
