<?php
include './header.php';
include './connect.php';
?>
<div class="wrapper col5">
    <div id="featured_slide">
        <div id="featured_content">
            <ul>
                <li><img src="images/demo/BannerPoultry.jpg" alt="" width="500" />
                    <div class="floater">
                    </div>
                </li>
                <li><img src="images/demo/bannerweb.jpg" alt="" />
                    <div class="floater">
                    </div>
                </li>
                <li><img src="images/demo/banner3.png" alt="" />
                    <div class="floater">
                    </div>
                </li>
            </ul>
        </div>
        <a href="javascript:void(0);" id="featured-item-prev"><img src="layout/images/prev.png" alt="" /></a> <a href="javascript:void(0);" id="featured-item-next"><img src="layout/images/next.png" alt="" /></a> </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
    <div id="container">
        <h1><b>Welcome to KFEPL - A Window to Success</b></h1>

        <p>Since last 30 yrs Kishore farm equipment Pvt Ltd (KFEPL) is engaged in the development of new & innovative agricultural products, today KFEPL among the top companies providing poultry equipments. Founded by Mr. Mangalbhai. L. Rosia and Later Mr. Kishore M Rosia & Rajesh M Rosia joined the company taking on the responsibilities of marketing and production respectively.</p>
        <p>KFEPL with D&B number is sharply focused on building Quality & Excellence in all its activities to provide high quality products that gives utmost satisfaction to farmers across India.</p>
      <!--  &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;-->


    </div>
</div>
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
<br class="clear" />
<?php
include './footer.php';
?>