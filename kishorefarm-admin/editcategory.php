<?php include('connect.php');
if(!isValidUser()) header("Location: ".$siteurl."login.php");
$tabid = 2;
$success = 1;
$message = "";
$catid	 = base64_decode($_REQUEST['catid']);
//die();
if(strtoupper(trim($_POST["btnSubmit"])) ==	"UPDATE")
{	
	$continue = 1;
	global $conn;

	$categorytitle	= trim($_POST['categorytitle']);
	$parentcategory	= trim($_POST['parentcategory']);
	$categorystatus	= trim($_POST['categorystatus']);
	$categorydesc	= trim($_POST['categorydesc']);

	//die();
	if($_FILES["categoryimage"]["name"]!=''){
		list($result,$msg,$msgcode,$filename)=fileUpload('categoryimage',"../images/catimg/");
		if(!$result){$continue=0; $message = $msg;}
	}

	//$result=isRecordExist('`tblUsers`',"username='$username'");
	//if($result){$message="Username already exist."; $continue=0;}

	if($parentcategory==$catid){$parentcategory=1;}
		
	if($continue)
	{	
		$keyvaluepairs=array( 'category_name'=>$categorytitle, 'category_parent'=>$parentcategory, 'category_status'=>$categorystatus, 'category_description'=>$categorydesc, 'category_image'=>$filename);

		$condition = "AND category_id=".$catid;
		$response=update('category_detail', $keyvaluepairs, $condition, $conn);
		if($response)
		{
			$message = 'Category has been updated successfully.';
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
	$Conditions = array( 'deleted' => 'N' ,'category_id' => $catid );
	$OrderBy = "category_name";
	
	list($res,$Pg,$TtlRows)=getResultSet('category_detail',$Conditions,$OrderBy,$Pg);
	$rows=mysqli_fetch_array($res);

include_once('admin_header.php');
?>
    <div class="content">
    	<div class="title"><h5>Product Categories</h5></div>
        
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
      
        <!-- Form begins -->
        <form action="#" method="POST" class="mainForm" enctype="multipart/form-data">
        
        	<!-- Input text fields -->
            <fieldset>
                <div class="widget first">
                    <div class="head"><h5>Edit Category</h5></div>
                    
                        <div class="rowElem noborder">
                        <label>Parent Category</label>
                        <div class="formRight searchDrop">
						<?php
						$Conditions = array( 'category_status' => 'Active', 'deleted' => 'N' );
						$OrderBy = "category_name";
						list($cres)=getResultSet('category_detail',$Conditions,$OrderBy);
						?>

                        <select data-placeholder="Choose Parent Category" class="chzn-select" style="width:350px;" tabindex="2" name="parentcategory">
                            <option value="1">Root Category</option> 
							<?php if(!empty($cres)){?>
							<?php while($crows=mysqli_fetch_array($cres)){ ?>
							<option value="<?php echo $crows['category_id'];?>" <?php if($crows['category_id']==$rows['category_parent']){ echo "selected='selected'"; }?>><?php echo $crows['category_name'];?></option>
							<?php }	?>
							<?php } ?>
                            
                        </select>
                        </div>             
                        <div class="fix"></div>
                    </div>

					    <div class="rowElem "><label>Category Title</label><div class="formRight">
						<input type="text" name="categorytitle" placeholder="enter category title" class="rightDir" title="Root Category title visible to public" style="width:50%" Value="<?php echo clean($rows['category_name']);?>"/></div><div class="fix"></div></div>
					<div class="rowElem">
                        <label>Category Image :</label> 
                        <div class="formRight">
                            <input type="file" class="fileInput" id="fileInput" name="categoryimage" />
							<a href="../images/catimg/<?php echo $rows['category_image'];?>" target="_blank">
							<?php echo $rows['category_image'];?></a>
                        </div>
                        <div class="fix"></div>
                    </div>
                      <div class="rowElem">
                        <label>Category Status :</label> 
                        <div class="formRight">
						<?php $cstatus = clean($rows['category_status']);?>
							
							
                            <input type="radio" id="radio1" name="categorystatus"  value="Active" <?php if(strtoupper($cstatus) == "ACTIVE"){echo "checked='checked'";}?>/><label for="radio1" >Active</label>
                            <input type="radio" id="radio2" name="categorystatus" value="InActive" <?php if(strtoupper($cstatus) == "INACTIVE"){echo "checked='checked'";}?>/><label for="radio2">Inactive</label>
                           
                        </div>
                        <div class="fix"></div>
                    </div>

                </div>
            </fieldset>
            
            
            
           
           
          
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iPencil">Category Description</h5></div>
                    <textarea class="wysiwyg" rows="5" cols="" name="categorydesc"><?php echo clean($rows['category_description']);?></textarea>                
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
