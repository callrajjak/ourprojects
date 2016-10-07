<?php include('connect.php');
if(!isValidUser()) header("Location: ".$siteurl."login.php");
$tabid = 2;
$success = 1;
$message = "";

if(strtoupper(trim($_POST["btnSubmit"])) ==	"ADD")
{	
	$continue = 1;
	global $conn;

	$categorytitle	= trim($_POST['categorytitle']);
	$parentcategory	= trim($_POST['parentcategory']);
	$categorystatus		= trim($_POST['categorystatus']);
	$categorydesc	= trim($_POST['categorydesc']);

	//die();

	list($result,$msg,$msgcode,$filename)=fileUpload('categoryimage',"../catimg/");
	if(!$result){$continue=0; $message = $msg;}

	//$result=isRecordExist('`tblUsers`',"username='$username'");
	//if($result){$message="Username already exist."; $continue=0;}
		
	if($continue)
	{	
		$colArray=array( 'category_name'=>$categorytitle, 'category_parent'=>$parentcategory, 'category_status'=>$categorystatus, 'category_description'=>$categorydesc, 'category_image'=>$filename);

		function filter($v)
		{
			if ($v != "")
			{
				return true;
			}
			return false;
		}
		$mainArray=array_filter($colArray,"filter");

		$table  = 'category_detail';
		$fields = array_keys($mainArray);
		$values = array_values($mainArray);

		//print_r($mainArray);
		//print_r($fields);
		//print_r($values);
		//die();

		$response=insert( $table, $fields, $values, $conn);
		if($response)
		{
			$message = 'Category has been added successfully.';
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
include_once('admin_header.php');
?>
    <div class="content">
    	<div class="title"><h5>Product Categories</h5></div>
             <div class="stats">
        	<ul> <li style="float:right;width:110px;"><a title="" class="count green" href="listcategories.php">List All</a></li>
               
            </ul>
            <div class="fix"></div>
        </div>
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
      
        <!-- Form begins -->
        <form action="#" method="POST" class="mainForm" enctype="multipart/form-data">
        
        	<!-- Input text fields -->
            <fieldset>
                <div class="widget first">
                    <div class="head"><h5>Add Category</h5></div>
               
                        <div class="rowElem noborder">
                        <label>Parent Category</label>
                        <div class="formRight searchDrop">
						<?php
						$Conditions = array( 'category_status' => 'Active' );
						$OrderBy = "category_name";
						list($cres)=getResultSet('category_detail',$Conditions,$OrderBy);
						?>
                        <select data-placeholder="Choose Parent Category" class="chzn-select" style="width:350px;" tabindex="2" name="parentcategory">
                            <option value="1">Root Category</option> 
							<?php if(!empty($cres)){?>
							<?php while($crows=mysqli_fetch_array($cres)){ ?>
							<option value="<?php echo $crows['category_id'];?>" <?php if($crows['category_id']==$parentcategory){ echo "selected='selected'"; }?>><?php echo $crows['category_name'];?></option>
							<?php }	?>
							<?php } ?>
                            
                        </select>
                        </div>             
                        <div class="fix"></div>
                    </div>

					    <div class="rowElem "><label>Category Title</label><div class="formRight">
						<input type="text" name="categorytitle" placeholder="enter category title" class="rightDir" title="Root Category title visible to public" style="width:50%"/></div><div class="fix"></div></div>
					<div class="rowElem">
                        <label>Category Image :</label> 
                        <div class="formRight">
                            <input type="file" class="fileInput" id="fileInput" name="categoryimage" />
                        </div>
                        <div class="fix"></div>
                    </div>
                      <div class="rowElem">
                        <label>Category Status :</label> 
                        <div class="formRight">
                            <input type="radio" id="radio1" name="categorystatus" checked="checked" value="Active" /><label for="radio1" >Active</label>
                            <input type="radio" id="radio2" name="categorystatus" value="InActive"/><label for="radio2">Inactive</label>
                           
                        </div>
                        <div class="fix"></div>
                    </div>

                </div>
            </fieldset>
            
            
            
           
           
          
            <fieldset>
                <div class="widget">    
                    <div class="head"><h5 class="iPencil">Category Description</h5></div>
                    <textarea class="wysiwyg" rows="5" cols="" name="categorydesc"></textarea>                
                </div>
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
