<?php include('connect.php');
if(!isValidUser()) header("Location: ".$siteurl."login.php");
$tabid = 4;
$success = 1;
$message = "";
$prodid	 = base64_decode($_REQUEST['prodid']);

if(strtoupper(trim($_POST["btnSubmit"])) ==	"UPDATE")
{	
	$continue = 1;
	global $conn;

	$partstatus	= trim($_POST['partstatus']);
	$partarrival	= trim($_POST['partarrival']);
	$partinstall	= trim($_POST['partinstall']);
	$partadv		= trim($_POST['partadv']);
	$partdesc	= trim($_POST['partdesc']);
	$partprice	= trim($_POST['partprice']);
	$partname	= trim($_POST['partname']);
	$partcode	= trim($_POST['partcode']);
	$partcategory= $_POST['partcategory'];

	//print_r($partcategory);
	if($_FILES["partimage"]["name"]!=''){
		list($result,$msg,$msgcode,$filename)=fileUpload('partimage',"../catimg/");
		if(!$result){$continue=0; $message = $msg;}
	}

	if(empty($partcategory)){$continue = 0;$message="Please select product.";}
	//die();
	//$result=isRecordExist('`tblUsers`',"username='$username'");
	//if($result){$message="Username already exist."; $continue=0;}
		
	if($continue)
	{	

		$keyvaluepairs=array( 'part_image'=>$filename, 'part_name'=>$partname, 'part_desc'=>$partdesc, 'part_code'=>$partcode, 'part_new_arival'=>$partarrival, 'part_status'=>$partstatus);
		$condition = "AND part_id=".$prodid;

		startTransaction();
		$response=update('part_detail', $keyvaluepairs, $condition, $conn);
		if($response)
		{
			$flag  = 1;
			$table2= 'part_product_detail';
			$cond2 = "AND part_id=".$prodid;

			$delresponse=deleteRecords( $table2, $cond2, $conn);
			
			if($delresponse)
			{
				foreach($partcategory as $value)
				{
					$response2=insert( $table2, 'part_id,product_id', $prodid.",".$value, $conn);
					if(empty($response2))
					{
						$flag=0;
						break;
					}
				}
			}
			else
			{
				$subjectflag=0;
			}

			if($flag)
			{
				$message = 'Part has been added successfully.';
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
	$Conditions = array( 'deleted' => 'N', 'part_id' => $prodid);
	$OrderBy = "part_name";
	
	list($res,$Pg,$TtlRows)=getResultSet('part_detail',$Conditions,$OrderBy,$Pg);
	$rows=mysqli_fetch_array($res);

include_once('admin_header.php');
?>

    <div class="content">
    	<div class="title"><h5>Product Manager</h5></div>
          <div class="stats">
        	<ul> <li style="float:right;width:110px;"><a title="" class="count green" href="listproductpart.php">List All</a></li>
               
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
				<?php }?>
        </div>
        <!-- Statistics -->
          <form action="#" method="post" class="mainForm" enctype="multipart/form-data">
        
        	<!-- Input text fields -->
            <fieldset>
                <div class="widget first">
                    <div class="head"><h5 class="iList">Text fields</h5></div>
                        <div class="rowElem noborder"><label>Product Code</label><div class="formRight"><input type="text" name="partcode" value="<?php echo $rows['part_code'];?>"/></div><div class="fix"></div></div>
                    
                        <div class="rowElem"><label>Product name</label><div class="formRight"><input type="text" name="partname" value="<?php echo $rows['part_name'];?>" placeholder="enter your placeholder text here"/></div><div class="fix"></div></div>
                      
                        <div class="rowElem">
                        <label>Product Image</label> 
                        <div class="formRight">
                            <input type="file" class="fileInput" id="fileInput" name="partimage" />
							<a href="../catimg/<?php echo $rows['part_image'];?>" target="_blank">
							<?php echo $rows['part_image'];?></a>

                        </div>
                        <div class="fix"></div>
                    </div>
						<div class="rowElem"><label>Product Price</label><div class="formRight"><input type="text" name="partprice" value="<?php echo $rows['part_pricing'];?>" placeholder="enter your placeholder text here"/></div><div class="fix"></div></div>

					 <div class="rowElem">
                        <label>Product Category:</label>
                        <div class="formRight">
						<?php
						$Conditions = array( 'product_status' => 'Active', 'deleted' => 'N' );
						$OrderBy = "product_name";
						list($cres)=getResultSet('product_detail',$Conditions,$OrderBy);
						?>
                            <select data-placeholder="select category" style="" class="chzn-select" multiple="multiple" tabindex="6" name="partcategory[]">
                                <?php if(!empty($cres)){?>
								<?php while($crows=mysqli_fetch_array($cres)){ ?>
								<?php
								$pConditions = array( 'part_id' => $prodid );
								list($pres)=getResultSet('part_product_detail',$pConditions);
								?>

									<option value="<?php echo $crows['product_id'];?>" 
									<?php while($prows=mysqli_fetch_array($pres)){
										if($crows['product_id']==$prows['product_id']){ echo "selected='selected'"; }}?>>
									<?php echo $crows['product_name'];?>
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
                    <div class="head"><h5 class="iPencil">Product Description</h5></div>
                    <textarea class="wysiwyg" rows="5" cols="" name="partdesc"><?php echo $rows['part_desc'];?></textarea>                
                </div>
            </fieldset>
           
            <fieldset>
                <div class="widget">   <div class="rowElem">
                        <label>Product  New Arrival</label> 
                        <div class="formRight">
						<?php $new=$rows['part_new_arival'];?>
                            <input type="radio" id="radio1" name="partarrival" <?php if(strtolower($new)=='yes'){echo "checked='checked'";}?>  value="Yes" /><label for="radio1" >Yes</label>
                            <input type="radio" id="radio2" name="partarrival" <?php if(strtolower($new)=='no'){echo "checked='checked'";}?> value="No"/><label for="radio2">No</label>
                           
                        </div>
                        <div class="fix"></div>
                    </div>
                      <div class="rowElem">
                        <label>Product  Status </label> 
                        <div class="formRight">
						<?php $pstatus=$rows['part_status'];?>
                            <input type="radio" id="radio1" name="partstatus" <?php if(strtolower($pstatus)=='active'){echo "checked='checked'";}?> value="Active" /><label for="radio1" >Active</label>
                            <input type="radio" id="radio2" name="partstatus" <?php if(strtolower($pstatus)=='inactive'){echo "checked='checked'";}?> value="InActive"/><label for="radio2">Inactive</label>
                           
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