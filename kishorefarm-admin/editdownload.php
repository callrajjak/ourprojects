<?php include('connect.php');
if(!isValidUser()) header("Location: ".$siteurl."login.php");
$tabid = 6;
$success = 1;
$message = "";

$prodid	 = base64_decode($_REQUEST['prodid']);

if(strtoupper(trim($_POST["btnSubmit"])) ==	"UPDATE")
{	
	$continue = 1;
	global $conn;

	$downloadstatus	= trim($_POST['downloadstatus']);
	$downloaddesc	= trim($_POST['downloaddesc']);
	$downloadname	= trim($_POST['downloadname']);
	$downloadcategory= $_POST['downloadcategory'];

	//print_r($downloadcategory);
	if($_FILES["downloadimage"]["name"]!=''){
	list($result,$msg,$msgcode,$filename)=fileUpload('downloadimage',"../catimg/");
	if(!$result){$continue=0; $message = $msg;}
	}

	if(empty($downloadcategory)){$continue = 0;$message="Please select category.";}
	//die();
	//$result=isRecordExist('`tblUsers`',"username='$username'");
	//if($result){$message="Username already exist."; $continue=0;}
		
	if($continue)
	{	

		$keyvaluepairs=array( 'download_image'=>$filename, 'download_name'=>$downloadname, 'download_desc'=>$downloaddesc, 'download_status'=>$downloadstatus);
		$condition = "AND download_id=".$prodid;

		startTransaction();
		$response=update('download_detail', $keyvaluepairs, $condition, $conn);
		if($response)
		{
			$table2='download_category_detail';
			$cond2 = "AND download_id=".$prodid;
			$flag =1;
			$delresponse=deleteRecords( $table2, $cond2, $conn);
			
			if($delresponse)
			{
				foreach($downloadcategory as $value)
				{
					$response2=insert( $table2, 'download_id,dowcat_id', $prodid.",".$value, $conn);
					if(empty($response2))
					{
						$flag=0;
						break;
					}
				}
			}
			else
			{
				$flag=0;
			}

			if($flag)
			{
				$message = 'Download file has been update successfully.';
				$success = 1;
				commit();
			}
			else
			{
				$message = 'Some problem in the process. please try later.'.mysqli_error();
				$success = 0;
				rollback();
			}
		}
		else
		{
			$message = 'Some problem in the process. please try later.'.mysqli_error();
			$success = 0;
			rollback();
		}
	}
	else
	{
		$success = 0;	
	}
	
}


	global $conn;
	$Conditions = array( 'deleted' => 'N', 'download_id' => $prodid );
	$OrderBy = "download_name";
	
	list($res,$Pg,$TtlRows)=getResultSet('download_detail',$Conditions,$OrderBy,$Pg);
	
	$rows=mysqli_fetch_array($res);



include_once('admin_header.php');
?>

    <div class="content">
    	<div class="title"><h5>Download Manager</h5></div>
          <div class="stats">
        	<ul> <li style="float:right;width:110px;"><a title="" class="count green" href="listdownload.php">List All</a></li>
               
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
					unset($email);
					unset($institutename);
					unset($class);
					unset($board);
					unset($subjects);
				}?>
        </div>
        <!-- Statistics -->
          <form action="#" method="post" class="mainForm" enctype="multipart/form-data">
        
        	<!-- Input text fields -->
            <fieldset>
                <div class="widget first">
                    <div class="head"><h5 class="iList">Text fields</h5></div>
                        
                    
                        <div class="rowElem"><label>Download name</label><div class="formRight"><input type="text" name="downloadname" placeholder="enter your placeholder text here" value="<?php echo $rows['download_name'];?>" /></div><div class="fix"></div></div>
                      
                        <div class="rowElem">
                        <label>Download File</label> 
                        <div class="formRight">
                            <input type="file" class="fileInput" id="fileInput" name="downloadimage" />
                            <a href="../catimg/<?php echo $rows['download_image'];?>" target="_blank">
							<?php echo $rows['download_image'];?></a>
                        </div>
                        <div class="fix"></div>
                    </div>
						

					 <div class="rowElem">
                        <label>Download Categories:</label>
                        <div class="formRight">
						<?php
						$Conditions = array( 'dowcat_status' => 'Active', 'deleted' => 'N' );
						$OrderBy = "dowcat_name";
						list($cres)=getResultSet('dowcat_detail',$Conditions,$OrderBy);
						?>
                            <select data-placeholder="select category" style="" class="chzn-select" multiple="multiple" tabindex="6" name="downloadcategory[]">
                                <?php if(!empty($cres)){?>
								<?php while($crows=mysqli_fetch_array($cres)){ ?>
								<?php
								$pConditions = array( 'download_id' => $prodid );
								list($pres)=getResultSet('download_category_detail',$pConditions);
								?>

									<option value="<?php echo $crows['dowcat_id'];?>" 
									<?php while($prows=mysqli_fetch_array($pres)){
										if($crows['dowcat_id']==$prows['dowcat_id']){ echo "selected='selected'"; }}?>>
									<?php echo $crows['dowcat_name'];?>
									</option>
								<?php }	?>
								<?php } ?>
                            </select>  
                        </div>             
                        <div class="fix"></div>
                    </div>
                        
                </div>
            </fieldset>
            
            <!-- WYSIWYG editor -->
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iPencil">Download Description</h5></div>
                    <textarea class="wysiwyg" rows="5" cols="" name="downloaddesc"><?php echo $rows['download_desc'];?></textarea>                
                </div>
            </fieldset>
            
           
            <fieldset>
                <div class="widget">
                      <div class="rowElem">
                        <label>Download Status</label> 
                        <div class="formRight">
                           <?php $pstatus=$rows['download_status'];?>
                            <input type="radio" id="radio1" name="downloadstatus" <?php if(strtolower($pstatus)=='active'){echo "checked='checked'";}?> value="Active" /><label for="radio1" >Active</label>
                            <input type="radio" id="radio2" name="downloadstatus" <?php if(strtolower($pstatus)=='inactive'){echo "checked='checked'";}?> value="InActive"/><label for="radio2">Inactive</label>
                        </div>
                        <div class="fix"></div>
                    </div>                 </div>
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