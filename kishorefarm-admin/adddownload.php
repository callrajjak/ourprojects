<?php include('connect.php');
if(!isValidUser()) header("Location: ".$siteurl."login.php");
$tabid = 6;
$success = 1;
$message = "";

if(strtoupper(trim($_POST["btnSubmit"])) ==	"ADD")
{	
	$continue = 1;
	global $conn;

	$downloadstatus	= trim($_POST['downloadstatus']);
	$downloaddesc	= trim($_POST['downloaddesc']);
	$downloadname	= trim($_POST['downloadname']);
	$downloadcategory= $_POST['downloadcategory'];

	//print_r($downloadcategory);

	list($result,$msg,$msgcode,$filename)=fileUpload('downloadimage',"../catimg/");
	if(!$result){$continue=0; $message = $msg;}

	if(empty($downloadcategory)){$continue = 0;$message="Please select category.";}
	//die();
	//$result=isRecordExist('`tblUsers`',"username='$username'");
	//if($result){$message="Username already exist."; $continue=0;}
		
	if($continue)
	{	

		$colArray=array( 'download_image'=>$filename, 'download_name'=>$downloadname, 'download_desc'=>$downloaddesc, 'download_status'=>$downloadstatus);

		function filter($v)
		{
			if ($v != "")
			{
				return true;
			}
			return false;
		}
		$mainArray=array_filter($colArray,"filter");

		$table  = 'download_detail';
		$fields = array_keys($mainArray);
		$values = array_values($mainArray);

		//print_r($mainArray);
		//print_r($fields);
		//print_r($values);
		//die();

		startTransaction();
		$response=insert( $table, $fields, $values, $conn);
		if($response)
		{
			$table2='download_category_detail';
			$flag =1;
			foreach($downloadcategory as $value)
			{
				$response2=insert( $table2, 'download_id,dowcat_id', $response.",".$value, $conn);
				if(empty($response2))
				{
					$flag=0;
					break;
				}
			}

			if($flag)
			{
				$message = 'Download file has been added successfully.';
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
				}?>
        </div>
        <!-- Statistics -->
          <form action="#" method="post" class="mainForm" enctype="multipart/form-data">
        
        	<!-- Input text fields -->
            <fieldset>
                <div class="widget first">
                    <div class="head"><h5 class="iList">Download manager</h5></div>
                        
                    
                        <div class="rowElem"><label>Download name</label><div class="formRight"><input type="text" name="downloadname" placeholder="enter your placeholder text here"/></div><div class="fix"></div></div>
                      
                        <div class="rowElem">
                        <label>Download File</label> 
                        <div class="formRight">
                            <input type="file" class="fileInput" id="fileInput" name="downloadimage" />
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
								<option value="<?php echo $crows['dowcat_id'];?>" <?php if($crows['dowcat_id']==$rows['category_parent']){ echo "selected='selected'"; }?>><?php echo $crows['dowcat_name'];?></option>
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
                    <textarea class="wysiwyg" rows="5" cols="" name="downloaddesc"></textarea>                
                </div>
            </fieldset>
            
           
            <fieldset>
                <div class="widget">
                      <div class="rowElem">
                        <label>Download Status</label> 
                        <div class="formRight">
                            <input type="radio" id="radio1" name="downloadstatus" checked="checked" value="Active" /><label for="radio1" >Active</label>
                            <input type="radio" id="radio2" name="downloadstatus" value="InActive"/><label for="radio2">Inactive</label>
                           
                        </div>
                        <div class="fix"></div>
                    </div>                 </div>
            </fieldset>
			<fieldset>
			   <div class="widget">
			    <div class="head" style="padding:12px 0 0 0;"> <div class="fix"></div><input type="submit" name="btnSubmit" value="Add" class="greyishBtn submitForm" style="float:left;"/></div>
			
                   
					</div>
					   </fieldset>
            
</form>
        
        
        
    
    </div>
    <div class="fix"></div>
</div>

<?php
include_once('admin_footer.php');
?>