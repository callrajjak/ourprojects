<?php include_once("connect.php"); 
	
	$tabid = 7;
	if(!isValidUser()) header("Location: ".$siteurl."login.php");

	$success = 1;
	$message = "";

	if(!empty($_POST["hdndelete"]))
	{
		global $conn;
		$classid=base64_decode($_REQUEST['hdnid']);
		$table= 'dowcat_detail';
		$cond = "AND dowcat_id=".$classid;
		$keyvaluepairs=array( 'deleted'=> 'Y');
		
		$delresponse=update($table, $keyvaluepairs, $cond, $conn);
		if($delresponse)
		{
			$message = 'Category has been delete successfully.';
			$success = 1;
		}
		else
		{
			$message = 'Some problem in the process. please try later.'.mysqli_error();
			$success = 0;
		}
	}
	// END OF DELETE BLOCK


	if(strtoupper(trim($_POST["btnSubmit"])) ==	"ADD")
	{	
		$continue = 1;
		global $conn;
		$category		= trim($_POST['categorytitle']);
		$categorystatus  = trim($_POST['categorystatus']);
			
		if($continue)
		{	
			$table  = 'dowcat_detail';
			$fields = array('dowcat_name','dowcat_status');
			$values = array($category,$categorystatus);

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
	// END OF ADD BLOCK

	
	global $conn;
	$Conditions = array( 'deleted' => 'N' );
	$OrderBy = "dowcat_name";
	
	list($res,$Pg,$TtlRows)=getResultSet('dowcat_detail',$Conditions,$OrderBy,$Pg);


?> 
<?php include_once('admin_header.php');?>
<div class="content">
    	<div class="title"><h5>Download Categories</h5></div>
             
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
                    <div class="head"><h5>Add Download Category</h5></div>
                        

					    <div class="rowElem "><label>Category Title</label><div class="formRight">
						<input type="text" name="categorytitle" placeholder="enter category title" class="rightDir" title="Root Category title visible to public" style="width:50%"/></div>
                        
                        <div class="fix"></div></div>
                        
                        <div class="rowElem">
                        <label>Category  Status </label> 
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
			    <div class="head" style="padding:12px 0 0 0;"> <div class="fix"></div><input type="submit" name="btnSubmit" value="Add" class="greyishBtn submitForm" style="float:left;"/></div>
			
                   
					</div>
					   </fieldset>
        </form>
        
        
        
        <div class="table" style="margin-top: 10px;">
            <div class="head"><h5 class="iFrames">Download category list</h5></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Status</th>
                           <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
				$srno=1;
				while($rows=mysqli_fetch_array($res)){
					$primary_id= clean($rows['dowcat_id']);
			?>
                    <tr class="gradeA">
                        <td><?php echo clean($rows['dowcat_name']);?></td>
                        <td><?php echo clean($rows['dowcat_status']);?></td>
                      
                      
                    <td><input type="button" value="Edit" class="mws-button blue small" onclick="window.location.href='editdoccategories.php?catid=<?php echo base64_encode($primary_id);?>'" /></th>
					<td>
					<form action="#" method="post" onsubmit="return confirm('Are you sure to delete this record ?');">
					<input type="submit" value="Delete" class="mws-button red small" />
					<input type="hidden" name="hdndelete" value="delete" />
					<input type="hidden" name="hdnid" value="<?php echo base64_encode($primary_id);?>" />
					</form>
					</td>
                    </tr>
                   <?php	$srno++;}	?> 
                </tbody>
            </table>
        </div>
        

         
    </div>
    
     <div class="fix"></div>
</div>



<?php include_once('admin_footer.php');?>        
