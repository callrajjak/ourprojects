<?php include('connect.php');
if(!isValidUser()) header("Location: ".$siteurl."login.php");
$tabid = 8;
$success = 1;
$message = "";
$prodid	 = base64_decode($_REQUEST['prodid']);
if(strtoupper(trim($_POST["btnSubmit"])) =="UPDATE")
{	
	$continue = 1;
	global $conn;

	$productstatus= trim($_POST['productstatus']);
	$name		 = trim($_POST['name']);
	$email		= trim($_POST['email']);
	$username	 = trim($_POST['username']);
	$password	 = trim($_POST['password']);


	//die();
	//$result=isRecordExist('tblusers',"username='$username'");
	//if($result){$message="Username already exist."; $continue=0;}
		
	if($continue)
	{	

		$keyvaluepairs=array( '`username`'=>$username, '`password`'=>$password, '`name`'=>$name, '`email`'=>$email, 'status'=>$productstatus);

		$condition = "AND userid=".$prodid;

		$response=update('`tblusers`', $keyvaluepairs, $condition, $conn);
		if($response)
		{
			$message = 'User has been updated successfully.';
			$success = 1;
		}
		else
		{
			$message = 'Some problem in the process. please try later.'.mysqli_error();
			$success = 0;
		}
	}
	else
	{
		$success = 0;	
	}
	
}


	global $conn;
	$Conditions = array( 'deleted' => 'N', 'userid' => $prodid );
	$OrderBy = "name";
	
	list($res,$Pg,$TtlRows)=getResultSet('`tblusers`',$Conditions,$OrderBy,$Pg);
	
	$rows=mysqli_fetch_array($res);


include_once('admin_header.php');
?>

    <div class="content">
    	<div class="title"><h5>User Management</h5></div>
          <div class="stats">
        	<ul> <li style="float:right;width:110px;"><a title="" class="count green" href="listusers.php">List All</a></li>
               
            </ul>
            <div class="fix"></div>
			<?php if($success === 0){?>
				<?php if(!empty($message)){?>
				<div class="nNote nFailure hideit">
                <p><strong>FAILURE: </strong>
				<?php echo $message;?>
				</p>
				</div>
				<?php }?>
				<?php }elseif($success === 1){?>
				<?php if($message <> ''){?>
				<div class="nNote nSuccess hideit">
                <p><strong>SUCCESS: </strong>
				<?php echo $message;?>
				</p>
				</div>
				<?php }?>
				<?php 
					unset($username);
					unset($password);
					unset($uname);
					unset($email);
				}?>
        </div>
        <!-- Statistics -->
          <form action="#" method="post" class="mainForm" enctype="multipart/form-data">
        
        	<!-- Input text fields -->
            <fieldset>
                <div class="widget first">
                    <div class="head"><h5 class="iList">Edit User</h5></div>
                        <div class="rowElem noborder"><label>Username</label><div class="formRight">
                        <input type="text" name="username" value="<?php echo $rows['username'];?>"/></div>
                        <div class="fix"></div></div>
                    
                        <div class="rowElem">
                        <label>Password</label>
                        <div class="formRight"><input type="password" name="password" placeholder="" value="<?php echo $rows['password'];?>"/></div>
                        <div class="fix"></div>
                        </div>
                      
                        
						<div class="rowElem">
                        <label>Name</label>
                        <div class="formRight"><input type="text" name="name" placeholder="" value="<?php echo $rows['name'];?>"/></div>
                        <div class="fix"></div>
                        </div>
                        
                        <div class="rowElem">
                        <label>email</label>
                        <div class="formRight"><input type="text" name="email" placeholder="" value="<?php echo $rows['email'];?>"/></div>
                        <div class="fix"></div>
                        </div>
                        
                        <div class="rowElem">
                        <label>User  Status </label> 
                        <div class="formRight">
                           <?php $pstatus=$rows['status'];?>
                            <input type="radio" id="radio1" name="productstatus" <?php if(strtolower($pstatus)=='active'){echo "checked='checked'";}?> value="Active" /><label for="radio1" >Active</label>
                            <input type="radio" id="radio2" name="productstatus" <?php if(strtolower($pstatus)=='inactive'){echo "checked='checked'";}?> value="InActive"/><label for="radio2">Inactive</label>
                        </div>
                        <div class="fix"></div>
                    </div>
                        
                </div>
            </fieldset>
            
         
            
         
            
            
            
			<fieldset>
			   <div class="widget">
			    <div class="head" style="padding:12px 0 0 0;"> <div class="fix"></div><input type="submit" name="btnSubmit" value="Update" class="greyishBtn submitForm" style="float:left;"/></div>
			
                   
					</div>
					   </fieldset>
            
</form>
        
        
        
    
    </div>
    <div class="fix"></div>
</div>

<?php
include_once('admin_footer.php');
?>