<?php include('connect.php');
if(!isValidUser()) header("Location: ".$siteurl."login.php");
$tabid = 4;
$success = 1;
$message = "";

if(strtoupper(trim($_POST["btnSubmit"])) ==	"ADD")
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

	list($result,$msg,$msgcode,$filename)=fileUpload('productimage',"../catimg/");
	if(!$result){$continue=0; $message = $msg;}

	if(empty($productcategory)){$continue = 0;$message="Please select product.";}
	//die();
	//$result=isRecordExist('`tblUsers`',"username='$username'");
	//if($result){$message="Username already exist."; $continue=0;}
		
	if($continue)
	{	

		$colArray=array( '`part_image`'=>$filename, '`part_name`'=>$productname, '`part_desc`'=>$productdesc, '`part_code`'=>$productcode, '`part_new_arival`'=>$productarrival, '`part_status`'=>$productstatus);

		function filter($v)
		{
			if ($v != "")
			{
				return true;
			}
			return false;
		}
		$mainArray=array_filter($colArray,"filter");

		$table  = 'part_detail';
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
			$table2='part_product_detail';
			$flag =1;
			foreach($productcategory as $value)
			{
				$response2=insert( $table2, 'part_id,product_id', $response.",".$value, $conn);
				if(empty($response2))
				{
					$flag=0;
					break;
				}
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
include_once('admin_header.php');
?>

    <div class="content">
    	<div class="title"><h5>Product Part Manager</h5></div>
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
                        <div class="rowElem noborder"><label>Part Code</label><div class="formRight"><input type="text" name="productcode"/></div><div class="fix"></div></div>
                    
                        <div class="rowElem"><label>Part name</label><div class="formRight"><input type="text" name="productname" placeholder="enter your placeholder text here"/></div><div class="fix"></div></div>
                      
                        <div class="rowElem">
                        <label>Part Image</label> 
                        <div class="formRight">
                            <input type="file" class="fileInput" id="fileInput" name="productimage" />
                        </div>
                        <div class="fix"></div>
                    </div>
						

					 <div class="rowElem">
                        <label>Select Products for This Part:</label>
                        <div class="formRight">
						<?php
						$Conditions = array( 'product_status' => 'Active', 'deleted' => 'N' );
						$OrderBy = "product_name";
						list($cres)=getResultSet('product_detail',$Conditions,$OrderBy);
						?>
                            <select data-placeholder="select category" style="" class="chzn-select" multiple="multiple" tabindex="6" name="productcategory[]">
                                <?php if(!empty($cres)){?>
								<?php while($crows=mysqli_fetch_array($cres)){ ?>
								<option value="<?php echo $crows['product_id'];?>" <?php if($crows['product_id']==$rows['product_id']){ echo "selected='selected'"; }?>><?php echo $crows['product_name'];?></option>
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
                    <div class="head"><h5 class="iPencil">Part Description</h5></div>
                    <textarea class="wysiwyg" rows="5" cols="" name="productdesc"></textarea>                
                </div>
            </fieldset>
            
            <fieldset>
                <div class="widget">   <div class="rowElem">
                        <label>Part  New Arrival</label> 
                        <div class="formRight">
                            <input type="radio" id="radio1" name="productarrival" checked="checked" value="Yes" /><label for="radio1" >Yes</label>
                            <input type="radio" id="radio2" name="productarrival" value="No"/><label for="radio2">No</label>
                           
                        </div>
                        <div class="fix"></div>
                    </div>
                      <div class="rowElem">
                        <label>Part  Status </label> 
                        <div class="formRight">
                            <input type="radio" id="radio1" name="productstatus" checked="checked" value="Active" /><label for="radio1" >Active</label>
                            <input type="radio" id="radio2" name="productstatus" value="InActive"/><label for="radio2">Inactive</label>
                           
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