<?php include_once("connect.php"); 
	
	$tabid = 6;
	if(!isValidUser()) header("Location: ".$siteurl."login.php");

	$success = 1;
	$message = "";
	if(!empty($_POST["hdndelete"]))
	{
		global $conn;
		$prodid=base64_decode($_REQUEST['hdnid']);
		$table= 'download_detail';
		$cond = "AND download_id=".$prodid;
		$keyvaluepairs=array( 'deleted'=> 'Y');
		$delresponse=update($table, $keyvaluepairs, $cond, $conn);
		if($delresponse)
		{
			$message = 'Download file has been delete successfully.';
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
	$OrderBy = "download_name";
	
	list($res,$Pg,$TtlRows)=getResultSet('download_detail',$Conditions,$OrderBy,$Pg);


include_once('admin_header.php');
?>

    <div class="content">
    	<div class="title"><h5>Download Manager</h5></div>
        <div class="stats">
        	<ul> 
            	<li style="float:right;width:150px;"><a title="" class="count green" href="adddownload.php">Add New</a></li>
            </ul>
            <div class="fix"></div>
        </div>
       <div class="table" style="margin-top: 10px;">
            <div class="head"><h5 class="iFrames">Download list</h5></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Download Name</th>
                        <th>Download File</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
				$srno=1;
				while($rows=mysqli_fetch_array($res)){
					$primary_id= clean($rows['download_id']);
			?>
                    <tr class="gradeA">
                        <td><?php echo clean($rows['download_name']);?></td>
                        <td><a href="../images/catimg/<?php echo $rows['download_image'];?>" target="_blank">
							<?php echo $rows['download_image'];?></a></td>
                      
                      
                        <td><input type="button" value="Edit" class="mws-button blue small" onclick="window.location.href='editdownload.php?prodid=<?php echo base64_encode($primary_id);?>'" /></th>
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