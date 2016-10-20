<?php include('connect.php');
if(!isValidUser()) header("Location: ".$siteurl."login.php");
$tabid = 3;
$success = 1;
$message = "";

if(strtoupper(trim($_POST["btnSubmit"])) ==	"ADD")
{	
	$continue = 1;
	global $conn;

	$productstatus	= trim($_POST['productstatus']);
	$productarrival	= trim($_POST['productarrival']);
	$productinstall	= trim($_POST['productinstall']);
	$productadv	= trim($_POST['productadv']);
	$productdesc	= trim($_POST['productdesc']);
	$productprice	= trim($_POST['productprice']);
	$productname	= trim($_POST['productname']);
	$productcode	= trim($_POST['productcode']);
	$productcategory= $_POST['productcategory'];

	//print_r($productcategory);

	list($result,$msg,$msgcode,$filename)=fileUpload('productimage',"../images/catimg/");
	if(!$result){$continue=0; $message = $msg;}

	if(empty($productcategory)){$continue = 0;$message="Please select category.";}
	//die();
	//$result=isRecordExist('`tblUsers`',"username='$username'");
	//if($result){$message="Username already exist."; $continue=0;}
		
	if($continue)
	{	

		$colArray=array( 'product_image'=>$filename, 'product_name'=>$productname, 'product_desc'=>$productdesc, 'product_code'=>$productcode, 'product_pricing'=>$productprice, 'product_advantage'=>$productadv, 'product_installation'=>$productinstall, 'product_new_arival'=>$productarrival, 'product_status'=>$productstatus);

		function filter($v)
		{
			if ($v != "")
			{
				return true;
			}
			return false;
		}
		$mainArray=array_filter($colArray,"filter");

		$table  = 'product_detail';
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
			$table2='product_category_detail';
			$flag =1;
			foreach($productcategory as $value)
			{
				$response2=insert( $table2, 'product_id,category_id', $response.",".$value, $conn);
				if(empty($response2))
				{
					$flag=0;
					break;
				}
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
                        <div class="rowElem noborder"><label>Product Code</label><div class="formRight"><input type="text" name="productcode"/></div><div class="fix"></div></div>
                    
                        <div class="rowElem"><label>Product name</label><div class="formRight"><input type="text" name="productname" placeholder="enter your placeholder text here"/></div><div class="fix"></div></div>
                      
                        <div class="rowElem">
                        <label>Product Image</label> 
                        <div class="formRight">
                            <input type="file" class="fileInput" id="fileInput" name="productimage" />
                        </div>
                        <div class="fix"></div>
                    </div>
						<div class="rowElem"><label>Product Price</label><div class="formRight"><input type="text" name="productprice" placeholder="enter your placeholder text here"/></div><div class="fix"></div></div>

					 <div class="rowElem">
                        <label>Categories:</label>
                        <div class="formRight">
						<?php
						$Conditions = array( 'category_status' => 'Active', 'deleted' => 'N' );
						$OrderBy = "category_name";
						list($cres)=getResultSet('category_detail',$Conditions,$OrderBy);
						?>
                            <select data-placeholder="select category" style="" class="chzn-select" multiple="multiple" tabindex="6" name="productcategory[]">
                                <?php if(!empty($cres)){?>
								<?php while($crows=mysqli_fetch_array($cres)){ ?>
								<option value="<?php echo $crows['category_id'];?>" <?php if($crows['category_id']==$rows['category_parent']){ echo "selected='selected'"; }?>><?php echo $crows['category_name'];?></option>
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
                    <textarea class="wysiwyg" rows="5" cols="" name="productdesc"></textarea>                
                </div>
            </fieldset>
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iPencil">Product Advantage</h5></div>
                    <textarea class="wysiwyg" rows="5" cols="" name="productadv"></textarea>                
                </div>
            </fieldset>
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iPencil">Product Installation </h5></div>
                    <textarea class="wysiwyg" rows="5" cols="" name="productinstall"></textarea>                
                </div>
            </fieldset>
            <fieldset>
                <div class="widget">   <div class="rowElem">
                        <label>Product  New Arrival</label> 
                        <div class="formRight">
                            <input type="radio" id="radio1" name="productarrival" checked="checked" value="Yes" /><label for="radio1" >Yes</label>
                            <input type="radio" id="radio2" name="productarrival" value="No"/><label for="radio2">No</label>
                           
                        </div>
                        <div class="fix"></div>
                    </div>
                      <div class="rowElem">
                        <label>Product  Status </label> 
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