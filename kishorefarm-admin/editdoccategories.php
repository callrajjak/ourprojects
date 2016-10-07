<?php include_once("connect.php"); 
	
	$tabid = 7;
	if(!isValidUser()) header("Location: ".$siteurl."login.php");

	$success = 1;
	$message = "";
	$catid	 = base64_decode($_REQUEST['catid']);

	if(strtoupper(trim($_POST["btnSubmit"])) == "UPDATE")
	{	
		$continue = 1;
		global $conn;
		$category		= trim($_POST['categorytitle']);
		$categorystatus  = trim($_POST['categorystatus']);
			
		if($continue)
		{	
			$table  = 'dowcat_detail';
			$keyvaluepairs=array( 'dowcat_name'=>$category,'dowcat_status'=>$categorystatus);

			$condition = "AND dowcat_id=".$catid;
			$response=update($table, $keyvaluepairs, $condition, $conn);
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
	// END OF ADD BLOCK

	
	global $conn;
	$Conditions = array('deleted' => 'N', 'dowcat_id'=> $catid);
	$OrderBy = "dowcat_name";
	
	list($res,$Pg,$TtlRows)=getResultSet('dowcat_detail',$Conditions,$OrderBy,$Pg);
	$rows=mysqli_fetch_array($res);

?> 
<?php include_once('admin_header.php');?>
<div class="content">
    	<div class="title"><h5>Download Categories</h5></div>
             <div class="stats">
        	<ul> <li style="float:right;width:110px;"><a title="" class="count green" href="listdoccategories.php">List All</a></li>
               
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
					unset($category);
					unset($categorystatus);
				}?>
      
        <!-- Form begins -->
        <form action="#" method="POST" class="mainForm" enctype="multipart/form-data">
        
        	<!-- Input text fields -->
            <fieldset>
                <div class="widget first">
                    <div class="head"><h5>Edit Download Category</h5></div>
                        

					    <div class="rowElem "><label>Category Title</label><div class="formRight">
						<input type="text" name="categorytitle" placeholder="enter category title" class="rightDir" title="Root Category title visible to public" style="width:50%" value="<?php echo $rows['dowcat_name'];?>"/></div>
                        
                        <div class="fix"></div></div>
                        
                        <div class="rowElem">
                        <label>Category  Status </label> 
                        <div class="formRight">
                           <?php $cstatus = clean($rows['dowcat_status']);?>
							
							
                            <input type="radio" id="radio1" name="categorystatus"  value="Active" <?php if(strtoupper($cstatus) == "ACTIVE"){echo "checked='checked'";}?>/><label for="radio1" >Active</label>
                            <input type="radio" id="radio2" name="categorystatus" value="InActive" <?php if(strtoupper($cstatus) == "INACTIVE"){echo "checked='checked'";}?>/><label for="radio2">Inactive</label>
                           
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



<?php include_once('admin_footer.php');?>        
