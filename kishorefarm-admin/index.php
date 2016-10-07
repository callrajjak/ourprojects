<?php include './connect.php';
if(!isValidUser()) header("Location: ".$siteurl."login.php");
$tabid = 1;
include_once('admin_header.php');
?>

    <div class="content">
    	<div class="title"><h5>Dashboard</h5></div>
        
        <!-- Statistics -->
        <div class="stats">
        	<ul>
            	<li><a href="#" class="count grey" title=""><?php echo getvalbyid('count(*)','category_detail',"deleted='N'");?></a><span style="padding-top:10px;">CATEGORIES</span></li>
                
                <li><a href="#" class="count grey" title=""><?php echo getvalbyid('count(*)','product_detail',"deleted='N'");?></a><span style="padding-top:10px;">Products</span></li>
                <li><a href="#" class="count grey" title=""><?php echo getvalbyid('count(*)','part_detail',"deleted='N'");?></a><span style="padding-top:10px;">Product Parts</span></li>
                <li class="last"><a href="#" class="count grey" title=""><?php echo getvalbyid('count(*)','download_detail',"deleted='N'");?></a><span style="padding-top:10px;">Download</span></li>
            </ul>
            <div class="fix"></div>
        </div>
      
        
        
        
    
    </div>
    <div class="fix"></div>
</div>

<?php
include_once('admin_footer.php');
?>