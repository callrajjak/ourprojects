<?php include('connect.php');
if(!isValidUser()) header("Location: ".$siteurl."login.php");
$tabid = 3;
$success = 1;
$message = "";
$prodid	 = base64_decode($_REQUEST['prodid']);

if(strtoupper(trim($_POST["btnSubmit"])) ==	"UPDATE")
{	
	$continue = 1;
	global $conn;

	$productstatus	= trim($_POST['productstatus']);
	$productarrival	= trim($_POST['productarrival']);
	$productinstall	= trim($_POST['productinstall']);
	$productadv		= trim($_POST['productadv']);
	$productdesc	= trim($_POST['productdesc']);
	$productprice	= trim($_POST['productprice']);
	$productname	= trim($_POST['productname']);
	$productcode	= trim($_POST['productcode']);
	$productcategory= $_POST['productcategory'];

	//print_r($productcategory);
	if($_FILES["productimage"]["name"]!=''){
		list($result,$msg,$msgcode,$filename)=fileUpload('productimage',"../images/catimg/");
		if(!$result){$continue=0; $message = $msg;}
	}

	if(empty($productcategory)){$continue = 0;$message="Please select category.";}
	//die();
	//$result=isRecordExist('`tblUsers`',"username='$username'");
	//if($result){$message="Username already exist."; $continue=0;}
		
	if($continue)
	{	

		$keyvaluepairs=array( 'product_image'=>$filename, 'product_name'=>$productname, 'product_desc'=>$productdesc, 'product_code'=>$productcode, 'product_pricing'=>$productprice, 'product_advantage'=>$productadv, 'product_installation'=>$productinstall, 'product_new_arival'=>$productarrival, 'product_status'=>$productstatus);
		$condition = "AND product_id=".$prodid;

		startTransaction();
		$response=update('product_detail', $keyvaluepairs, $condition, $conn);
		if($response)
		{
			$flag  = 1;
			$table2= 'product_category_detail';
			$cond2 = "AND product_id=".$prodid;

			$delresponse=deleteRecords( $table2, $cond2, $conn);
			
			if($delresponse)
			{
				foreach($productcategory as $value)
				{
					$response2=insert( $table2, 'product_id,category_id', $prodid.",".$value, $conn);
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
				$message = 'Product has been added successfully.';
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
	$Conditions = array( 'deleted' => 'N', 'product_id' => $prodid);
	$OrderBy = "product_name";
	
	list($res,$Pg,$TtlRows)=getResultSet('product_detail',$Conditions,$OrderBy,$Pg);
	$rows=mysqli_fetch_array($res);

include_once('admin_header.php');
?>

    <div class="content">
    	<div class="title"><h5>Product Manager</h5></div>
          <div class="stats">
        	<ul> <li style="float:right;width:110px;"><a title="" class="count green" href="listproduct.php">List All</a></li>
               
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
                        <div class="rowElem noborder"><label>Product Code</label><div class="formRight"><input type="text" name="productcode" value="<?php echo $rows['product_code'];?>"/></div><div class="fix"></div></div>
                    
                        <div class="rowElem"><label>Product name</label><div class="formRight"><input type="text" name="productname" value="<?php echo $rows['product_name'];?>" placeholder="enter your placeholder text here"/></div><div class="fix"></div></div>
                      
                        <div class="rowElem">
                        <label>Product Image</label> 
                        <div class="formRight">
                            <input type="file" class="fileInput" id="fileInput" name="productimage" />
							<a href="../images/catimg/<?php echo $rows['product_image'];?>" target="_blank">
							<?php echo $rows['product_image'];?></a>

                        </div>
                        <div class="fix"></div>
                    </div>
						<div class="rowElem"><label>Product Price</label><div class="formRight"><input type="text" name="productprice" value="<?php echo $rows['product_pricing'];?>" placeholder="enter your placeholder text here"/></div><div class="fix"></div></div>

					 <div class="rowElem">
                        <label>Product Category:</label>
                        <div class="formRight">
						<?php
						$Conditions = array( 'category_status' => 'Active', 'deleted' => 'N' );
						$OrderBy = "category_name";
						list($cres)=getResultSet('category_detail',$Conditions,$OrderBy);
						?>
                            <select data-placeholder="select category" style="" class="chzn-select" multiple="multiple" tabindex="6" name="productcategory[]">
                                <?php if(!empty($cres)){?>
								<?php while($crows=mysqli_fetch_array($cres)){ ?>
								<?php
								$pConditions = array( 'product_id' => $prodid );
								list($pres)=getResultSet('product_category_detail',$pConditions);
								?>

									<option value="<?php echo $crows['category_id'];?>" 
									<?php while($prows=mysqli_fetch_array($pres)){
										if($crows['category_id']==$prows['category_id']){ echo "selected='selected'"; }}?>>
									<?php echo $crows['category_name'];?>
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
                    <textarea class="wysiwyg" rows="5" cols="" name="productdesc"><?php echo $rows['product_desc'];?></textarea>                
                </div>
            </fieldset>
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iPencil">Product Advantage</h5></div>
                    <textarea class="wysiwyg" rows="5" cols="" name="productadv"><?php echo $rows['product_advantage'];?></textarea>                
                </div>
            </fieldset>
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iPencil">Product Installation </h5></div>
                    <textarea class="wysiwyg" rows="5" cols="" name="productinstall"><?php echo $rows['product_installation'];?></textarea>                
                </div>
            </fieldset>
            <fieldset>
                <div class="widget">   <div class="rowElem">
                        <label>Product  New Arrival</label> 
                        <div class="formRight">
						<?php $new=$rows['product_new_arival'];?>
                            <input type="radio" id="radio1" name="productarrival" <?php if(strtolower($new)=='yes'){echo "checked='checked'";}?>  value="Yes" /><label for="radio1" >Yes</label>
                            <input type="radio" id="radio2" name="productarrival" <?php if(strtolower($new)=='no'){echo "checked='checked'";}?> value="No"/><label for="radio2">No</label>
                           
                        </div>
                        <div class="fix"></div>
                    </div>
                      <div class="rowElem">
                        <label>Product  Status </label> 
                        <div class="formRight">
						<?php $pstatus=$rows['product_status'];?>
                            <input type="radio" id="radio1" name="productstatus" <?php if(strtolower($pstatus)=='active'){echo "checked='checked'";}?> value="Active" /><label for="radio1" >Active</label>
                            <input type="radio" id="radio2" name="productstatus" <?php if(strtolower($pstatus)=='inactive'){echo "checked='checked'";}?> value="InActive"/><label for="radio2">Inactive</label>
                           
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