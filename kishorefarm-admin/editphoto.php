<?php include('connect.php');
if(!isValidUser()) header("Location: ".$siteurl."login.php");
$tabid = 5;
$success = 1;
$message = "";

$prodid	 = base64_decode($_REQUEST['prodid']);
if(strtoupper(trim($_POST["btnSubmit"])) == "UPDATE" )
{	
	$continue = 1;
	global $conn;

	$downloadstatus	= trim($_POST['downloadstatus']);
	//$downloaddesc	= trim($_POST['downloaddesc']);
	$downloadname	= trim($_POST['downloadname']);
	//$downloadcategory= $_POST['downloadcategory'];

	//print_r($downloadcategory);
	if($_FILES["downloadimage"]["name"]!=''){
	list($result,$msg,$msgcode,$filename)=fileUpload('downloadimage',"../images/catimg/");
	if(!$result){$continue=0; $message = $msg;}
	}

	//if(empty($downloadcategory)){$continue = 0;$message="Please select category.";}
	//die();
	//$result=isRecordExist('`tblUsers`',"username='$username'");
	//if($result){$message="Username already exist."; $continue=0;}
		
	if($continue)
	{	
		$keyvaluepairs=array( 'gallery_image'=>$filename, 'gallery_name'=>$downloadname, 'gallery_status'=>$downloadstatus);

		$condition = "AND gallery_id=".$prodid;

		$response=update('gallery_detail', $keyvaluepairs, $condition, $conn);
		if($response)
		{
			$message = 'Photo has been updated successfully.';
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
	$Conditions = array( 'deleted' => 'N', 'gallery_id' => $prodid );
	$OrderBy = " gallery_name ";
	
	list($res,$Pg,$TtlRows)=getResultSet('gallery_detail',$Conditions,$OrderBy,$Pg);
	
	$rows=mysqli_fetch_array($res);


include_once('admin_header.php');
?>

    <div class="content">
    	<div class="title"><h5>Gallery Manager</h5></div>
          <div class="stats">
        	<ul> <li style="float:right;width:110px;"><a title="" class="count green" href="listphotos.php">List All</a></li>
               
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
					unset($address);
				}?>
        </div>
        <!-- Statistics -->
          <form action="#" method="post" class="mainForm" enctype="multipart/form-data">
        
        	<!-- Input text fields -->
            <fieldset>
                <div class="widget first">
                    <div class="head"><h5 class="iList">Gallery Photo</h5></div>
                        
                    
                        <div class="rowElem"><label>Photo Title</label><div class="formRight"><input type="text" name="downloadname" placeholder="" value="<?php echo $rows['gallery_name'];?>"/></div><div class="fix"></div></div>
                      
                        <div class="rowElem">
                        <label>Photo</label> 
                        <div class="formRight">
                            <input type="file" class="fileInput" id="fileInput" name="downloadimage" /><br />
                            <a href="../images/catimg/<?php echo $rows['gallery_image'];?>" target="_blank">
							<img src="../images/catimg/<?php echo $rows['gallery_image'];?>" width="100" /></a>
                        </div>
                        <div class="fix"></div>
                    </div>
						
						<div class="rowElem">
                        <label>Photo Status</label> 
                        <div class="formRight">
                           <?php $pstatus=$rows['gallery_status'];?>
                            <input type="radio" id="radio1" name="downloadstatus" <?php if(strtolower($pstatus)=='active'){echo "checked='checked'";}?> value="Active" /><label for="radio1" >Active</label>
                            <input type="radio" id="radio2" name="downloadstatus" <?php if(strtolower($pstatus)=='inactive'){echo "checked='checked'";}?> value="InActive"/><label for="radio2">Inactive</label>
                        </div>
                        <div class="fix"></div>
                    </div>
					 
                        
                </div>
            </fieldset>

            <fieldset>
                <div class="widget">
                    <div class="head" style="padding:12px 0 0 0;">
                    <div class="fix"></div>
                    <input type="submit" name="btnSubmit" value="Update" class="greyishBtn submitForm" style="float:left;"/>
                    </div>
                </div>
            </fieldset>
            
</form>
        
        
        
    
    </div>
    <div class="fix"></div>
</div>

<?php
include_once('admin_footer.php');
?>