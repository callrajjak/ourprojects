<?php
include './header.php';
?> 

<div class="wrapper col2">
      
    
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col3">
 <div id="container">
    <h1><b>About Us</b></h1>
    
    <p>Since last 30 yrs Kishore farm equipment Pvt Ltd (KFEPL) is engaged in the development of new & innovative agricultural products, today KFEPL among the top companies providing poultry equipments. Founded by Mr. Mangalbhai. L. Rosia and Later Mr. Kishore M Rosia & Rajesh M Rosia joined the company taking on the responsibilities of marketing and production respectively.</p>
      <p>KFEPL with D&B number is sharply focused on building Quality & Excellence in all its activities to provide high quality products that gives utmost satisfaction to farmers across India.</p>
      
      <p>With a motto to provide a “Complete Home for Your Chicks” Today KFEPL has Wide Range of Poultry Equipments and is the leading supplier across India and different parts of globe. Our Automatic And Manual products Like Feeders, Drinkers, Gas Brooders, Incubator, Nipple Drinking System, Pan Feeding System etc.
</p>
      <p>Over 30 years KFEPL has accomplished numerous turnkey projects in Automatic and Manual Equipments with Shed Construction and basic infrastructures.</p>
      <p>KFEPL is among the leader in the poultry industry and this is based on its unparalleled attention to customers’ needs, combined with its superior technological know-how and production capacity. Thus this allows company to develop and offer a broad range of products, tailor-made to help its customers achieve optimum out come in their poultry farm.</p>
      <p>KFEPL has installed the most modern poultry equipments and is committed to environmental quality and social responsibility. KFEPL is focused on increasing its production capacity by using the world’s most advanced technology in order to supply its customers with innovative products and superior technical service. This will allow it to create and supply more new products that help its customers stay at the leading edge.</p>
      
      <div id="comments">
         <h2>Management Profile</h2>
     
      <p>Mr. Mangalbhai Rosia is the founder of KFEPL, known for his hard experimental work since 1972 has varied and rich experience in Engineering space. Mr. Rosia’s key achievements include designing and developing quality product taking care of market and environmental conditions. He gained his experience through his stint with numerous companies before starting KFEPL.
 </p><p>
Mr. Rosia’s purpose is to make KFEPL "a company the industry admires", be it customers, people or industry peers. 
 </p><p>
Mr. Rajesh Rosia drives the organization's business strategy, he is Bachelor of Engineer. Rajesh carries with him rich and dedicated experience in the poultry industry. Today his business strategy has brought huge recognition to KFEPL in the market there by making company well known in the poultry arena. 
 </p><p>
Rajesh says in our chosen markets, we are the leader in client satisfaction, professionalism, superior quality and innovation. We strive to be the most efficient and customer centric company in the region.</p>
  </div>
</div>
    
    <div class="wrapper col3">
    <div id="categoryContainer">
        <h2 style="color:#fff; font-size:18px; ">Our Wide Range of Product Categories </h2><br>
        <?php
        global $conn;
        //$Conditions = array( 'deleted' => 'N', 'category_parent'=> '1', 'category_status'=> 'Active');
        //$OrderBy = " category_id ASC ";
        //list($res,$Pg,$TtlRows)=getResultSet('category_detail',$Conditions,$OrderBy);
        $categoryQuery = "select * from category_detail where 1 and deleted = 'N' and category_parent = '1' and category_status = 'Active' order by category_id asc";
        $res = mysqli_query($conn, $categoryQuery);
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