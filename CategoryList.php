<?php
include './header.php';
include './connect.php';
?> 

<div class="wrapper col2">
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
    <div id="categoryListContainer">
        <h2 style="color:#fff; font-size:18px; ">Our Wide Range of Product Categories </h2><br>
        <?php
        global $conn;
        $Conditions = array('deleted' => 'N', 'category_parent' => '1', 'category_status' => 'Active');
        $OrderBy = " category_id ASC ";
        list($res, $Pg, $TtlRows) = getResultSet('category_detail', $Conditions, $OrderBy);

        $i = 1;
        while ($rows = mysqli_fetch_array($res)) {
            $primary_id = clean($rows['category_id']);
            $categoryQuery = "select pd.product_id,pd.product_name,pcd.category_id from product_detail as pd,product_category_detail as pcd where pd.product_id = pcd.product_id and pcd.category_id = " . $primary_id;
            $catprodres = mysqli_query($conn, $categoryQuery);
            if($i%2==0){$class='fl_rightbackground';}else{$class='fl_leftbackground';}
            ?>
        <div id="prodboxbackground" class="<?php echo $class; ?>">
            <div class=" prodbox">
                <div id="categoryheader">
                    <a href="productlist.php?cid=<?php echo base64_encode($primary_id); ?>" class="catboxyfoottile"><?php echo clean($rows['category_name']); ?> </a>
                </div>
                
                <div class="catboxy"><?php /* ?><div class="boxytitle"><h2><a href="#"><?php echo clean($rows['category_name']);?> &raquo;</a></h2></div>
          <br class="clear" /> <?php */ ?>

                    <a href="productlist.php?cid=<?php echo base64_encode($primary_id); ?>" >
                        <img src="images/catimg/<?php echo clean($rows['category_image']); ?>" alt="" width="100" height="100" style="margin-left:25px;"/>
                    </a>
                    <!-- <p><strong><a href="#">Product feature</a></strong></p> -->
                    <p id="categorydesc"> <?php
                        $my_string = clean($rows['category_description']);
                        echo Truncate($my_string, 300);
                        ?> </p>
                </div>
                <br class="clear" />
                <div class="catboxyfoot">

                    <ul id="prodlistfromcategory">
                        <?php
                        if (mysqli_num_rows($catprodres) != 0) {
                            while ($rows1 = mysqli_fetch_array($catprodres)) {
                                ?>
                                <li>
                                    <a href="productlist.php?cid=<?php echo base64_encode($primary_id); ?>" class="catboxyfoottileforProduct"><?php echo clean($rows1['product_name']); ?> </a>
                                </li>
                                <?php
                            }
                        } else {
                            ?>

                            <li>
                                <a><?php echo "Products not available to display!!!!" ?> </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>            
                    
<!--<a href="category_view.php?cid=<?php // echo base64_encode($primary_id); ?>" class="product_details_container">Details</a>-->
                </div>
                
                <a href="download_list.php" class="downloads_details_container">Downloads Now</a>
            </div>
        </div>
            <br/>
            <br/>
            <?php
            $i++;
        }
        ?>
    </div>  
</div>
<br class="clear"/>
<?php
include './footer.php';
?>