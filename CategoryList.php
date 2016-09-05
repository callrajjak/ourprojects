<?php
include './header.php';
include './connect.php';
?> 

<div class="wrapper col2">
      
    
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
    <div id="categoryContainer">
        <h2 style="color:#fff; font-size:18px; ">Our Wide Range of Product Categories </h2><br>
        <?php
        global $conn;
        $Conditions = array( 'deleted' => 'N', 'category_parent'=> '1', 'category_status'=> 'Active');
        $OrderBy = " category_id ASC ";
        list($res,$Pg,$TtlRows)=getResultSet('category_detail',$Conditions,$OrderBy);
        //$categoryQuery = "select * from category_detail where 1 and deleted = 'N' and category_parent = '1' and category_status = 'Active' order by category_id asc";
        //$res = mysqli_query($conn, $categoryQuery);
        ?>
        <?php
        $i = 1;
        while ($rows = mysqli_fetch_array($res)) {
            $primary_id = clean($rows['category_id']);
            if ($i % 2 == 0) {
                $class = 'fl_right';
            } else {
                $class = 'fl_left';
            }
            ?>
            <div class="<?php echo $class; ?> prodbox">

                <div class="boxy">
    <?php /* ?><div class="boxytitle"><h2><a href="#"><?php echo clean($rows['category_name']);?> &raquo;</a></h2></div>
      <br class="clear" /> <?php */ ?>
                    <a href="product_list.php?cid=<?php echo base64_encode($primary_id); ?>" >
                        <img src="catimg/<?php echo clean($rows['category_image']); ?>" alt="" width="100" height="100"/>
                    </a>
                    <!-- <p><strong><a href="#">Product feature</a></strong></p> -->
                    <p> <?php
                    $my_string = clean($rows['category_description']);
                    echo Truncate($my_string, 300);
                    ?> </p>
                </div>
                <br class="clear" />
                <div class="boxyfoot">
                    <a href="product_list.php?cid=<?php echo base64_encode($primary_id); ?>" class="boxyfoottile"><?php echo clean($rows['category_name']); ?> </a>
                    <a href="category_view.php?cid=<?php echo base64_encode($primary_id); ?>" class="product_details_container">
                        Details</a>

                </div>
            </div>
    <?php $i++;
} ?>
    </div>
    
</div>
<br class="clear"/>



<?php
include './footer.php';
?>