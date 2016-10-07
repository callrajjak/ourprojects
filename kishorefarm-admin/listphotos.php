<?php include_once("connect.php"); 
	
	$tabid = 5;
	if(!isValidUser()) header("Location: ".$siteurl."login.php");

	$success = 1;
	$message = "";
	if(!empty($_POST["hdndelete"]))
	{
		global $conn;
		$prodid=base64_decode($_REQUEST['hdnid']);
		$table= 'gallery_detail';
		$cond = "AND gallery_id=".$prodid;
		$keyvaluepairs=array( 'deleted'=> 'Y');
		$delresponse=update($table, $keyvaluepairs, $cond, $conn);
		if($delresponse)
		{
			$message = 'Photo has been delete successfully.';
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
	$OrderBy = " gallery_name ";
	
	list($res,$Pg,$TtlRows)=getResultSet('gallery_detail',$Conditions,$OrderBy,$Pg);


include_once('admin_header.php');
?>

    <div class="content">
    	<div class="title"><h5>Gallery Manager</h5></div>
        <div class="stats">
        	<ul> 
            	<li style="float:right;width:150px;"><a title="" class="count green" href="addphoto.php">Add New</a></li>
            </ul>
            <div class="fix"></div>
        </div>
       <div class="table" style="margin-top: 10px;">
            <div class="head"><h5 class="iFrames">Gallery Photo list</h5></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
				$srno=1;
				while($rows=mysqli_fetch_array($res)){
					$primary_id= clean($rows['gallery_id']);
			?>
                    <tr class="gradeA">
                        <td><?php echo clean($rows['gallery_name']);?></td>
                        <td><a href="../catimg/<?php echo $rows['gallery_image'];?>" target="_blank">
							<img src='../catimg/<?php echo $rows['gallery_image'];?>' width="100"  /></a></td>
                            <td><?php echo clean($rows['gallery_status']);?></td>
                      
                      
                        <td><input type="button" value="Edit" class="mws-button blue small" onclick="window.location.href='editphoto.php?prodid=<?php echo base64_encode($primary_id);?>'" /></th>
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