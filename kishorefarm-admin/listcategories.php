<?php include_once("connect.php"); 
	
	$tabid = 2;
	if(!isValidUser()) header("Location: ".$siteurl."login.php");

	$success = 1;
	$message = "";
	if(!empty($_POST["hdndelete"]))
	{
		global $conn;
		$catid=base64_decode($_REQUEST['hdnid']);
		$table= 'category_detail';
		$cond = "AND category_id=".$catid;

		$delresponse=deleteRecords( $table, $cond, $conn);
		if($delresponse)
		{
			$message = 'User has been delete successfully.';
			$success = 1;
		}
		else
		{
			$message = 'Some problem in the process. please try later.'.mysqli_error();
			$success = 0;
		}
	}
	
	global $conn;
	$Conditions = array( 'deleted' => 'N' );
	$OrderBy = "category_name";
	
	list($res,$Pg,$TtlRows)=getResultSet('category_detail',$Conditions,$OrderBy,$Pg=0);


include_once('admin_header.php');
?>

    <div class="content">
    	<div class="title"><h5>Dashboard</h5></div>
        <div class="stats">
        	<ul> <li style="float:right;width:128px;"><a title="" class="count green" href="addcategory.php">Add New Categories</a></li>
               
            </ul>
            <div class="fix"></div>
        </div>
       <div class="table" style="margin-top: 10px;">
            <div class="head"><h5 class="iFrames">Category list</h5></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Parent Category</th>
                        <th>Status</th>
                        
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
				$srno=1;
				while($rows=mysqli_fetch_array($res)){
					$primary_id= clean($rows['category_id']);
					$pcat=getvalbyid('category_name','category_detail',"category_id=".clean($rows['category_parent'])." AND deleted='N'");
					if(empty($pcat))
					{
						$pcat= "Root";
					}
			?>
                    <tr class="gradeA">
                        <td><?php echo clean($rows['category_name']);?></td>
                        <td><?php echo $pcat;?></td>
                        <td><?php echo clean($rows['category_status']);?></td>
                      
                        <td><input type="button" value="Edit" class="mws-button blue small" onclick="window.location.href='editcategory.php?catid=<?php echo base64_encode($primary_id);?>'" /></th>
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

<?php
include_once('admin_footer.php');
?>