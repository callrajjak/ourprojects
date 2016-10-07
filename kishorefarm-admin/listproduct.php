<?php include "./connect.php"; 
	
	$tabid = 3;
	if(!isValidUser()) header("Location: ".$siteurl."login.php");

	$success = 1;
	$message = "";
	if(!empty($_POST["hdndelete"]))
	{
		global $conn;
		$prodid=base64_decode($_REQUEST['hdnid']);
		$table= 'product_detail';
		$cond = "AND product_id=".$prodid;
		$keyvaluepairs=array( 'deleted'=> 'Y');
		$delresponse=update($table, $keyvaluepairs, $cond, $conn);
		if($delresponse)
		{
			$message = 'Product has been delete successfully.';
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
	$OrderBy = "product_name";
	
	list($res,$Pg,$TtlRows)=getResultSet('product_detail',$Conditions,$OrderBy,$Pg=0);


include_once('admin_header.php');
?>

    <div class="content">
    	<div class="title"><h5>Dashboard</h5></div>
        <div class="stats">
        	<ul> <li style="float:right;width:150px;"><a title="" class="count green" href="addproduct.php">Add New</a></li>
               
            </ul>
            <div class="fix"></div>
        </div>
       <div class="table" style="margin-top: 10px;">
            <div class="head"><h5 class="iFrames">Product list</h5></div>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Code</th>
                           <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
				<?php 
				$srno=1;
				while($rows=mysqli_fetch_array($res)){
					$primary_id= clean($rows['product_id']);
			?>
                    <tr class="gradeA">
                        <td><?php echo clean($rows['product_name']);?></td>
                        <td><?php echo clean($rows['product_code']);?></td>
                      
                      
                        <td><input type="button" value="Edit" class="mws-button blue small" onclick="window.location.href='editproduct.php?prodid=<?php echo base64_encode($primary_id);?>'" /></th>
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