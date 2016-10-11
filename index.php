<?php
include './header.php';
include './connect.php';
?>
<script>
    jQuery(document).ready(function ($) {

        var jssor_1_SlideshowTransitions = [
            {$Duration: 1200, x: -0.3, $During: {$Left: [0.3, 0.7]}, $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear}, $Opacity: 2},
            {$Duration: 1200, x: 0.3, $SlideOut: true, $Easing: {$Left: $Jease$.$InCubic, $Opacity: $Jease$.$Linear}, $Opacity: 2}
        ];

        var jssor_1_options = {
            $AutoPlay: true,
            $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
            },
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
            },
            $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
            },
            $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Cols: 1,
                $Align: 0,
                $NoDrag: true
            }
        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        //responsive code begin
        //you can remove responsive code if you don't want the slider scales while window resizing
        function ScaleSlider() {
            var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
            if (refSize) {
                refSize = Math.min(refSize, 600);
                jssor_1_slider.$ScaleWidth(refSize);
            } else {
                window.setTimeout(ScaleSlider, 30);
            }
        }
        ScaleSlider();
        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        //responsive code end
    });
</script>
<div class="wrapper">
    <div id="featured_slide">
        <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: -150px; width: 600px; height: 400px; overflow: hidden; visibility: hidden; border-radius: 10px 125px;">
            <!-- Loading Screen -->
            <div data-u="loading" style="position: absolute; top: 0px; left: -150px;">
                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                <div style="position:absolute;display:block;background:url('../../images/Gallery/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
            </div>
            <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 600px; height: 400px; overflow: hidden;">
                <div data-p="112.50" style="display: none;">
                    <img data-u="image" src="images/Gallery/G1.jpg" />
                    <div data-u="thumb">Do you notice it is draggable by mouse/finger?</div>
                </div>
                <div data-p="112.50" style="display: none;">
                    <img data-u="image" src="images/Gallery/G2.jpg" />
                    <div data-u="thumb">Did you drag by either horizontal or vertical?</div>
                </div>
                <div data-p="112.50" style="display: none;">
                    <img data-u="image" src="images/Gallery/G3.jpg" />
                    <div data-u="thumb">Do you notice navigator responses when drag?</div>
                </div>
                <div data-p="112.50" style="display: none;">
                    <img data-u="image" src="images/Gallery/G4.jpg" />
                    <div data-u="thumb">Do you notice arrow responses when click?</div>
                </div>
                <a data-u="any" href="http://www.jssor.com/demos/banner-slider.slider" style="display:none">Banner Slider</a>
            </div>
            <!-- Thumbnail Navigator -->
            <div data-u="thumbnavigator" class="jssort09-750-45" style="position:absolute;bottom:0px;left:-150px;width:600px;height:75px;">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height:100%; background-color: #000; filter:alpha(opacity=40.0); opacity:0.4;"></div>
                <!-- Thumbnail Item Skin Begin -->
                <div data-u="slides" style="cursor: default;">
                    <div data-u="prototype" class="p">
                        <div data-u="thumbnailtemplate" class="t"></div>
                    </div>
                </div>
                <!-- Thumbnail Item Skin End -->
            </div>
            <!-- Bullet Navigator -->
            <div data-u="navigator" class="jssorb01" style="bottom:16px;right:16px;">
                <div data-u="prototype" style="width:12px;height:12px;"></div>
            </div>
            <!-- Arrow Navigator -->
            <span data-u="arrowleft" class="jssora05l" style="top:0px;left:8px;width:40px;height:40px;" data-autocenter="2"></span>
            <span data-u="arrowright" class="jssora05r" style="top:0px;right:8px;width:40px;height:40px;" data-autocenter="2"></span>
        </div>
    </div>
    <div class="column productcase" >
        <?php
        global $conn;
        $Conditions = array('deleted' => 'N', 'product_status' => 'Active');
        $OrderBy = " RAND() LIMIT 3";
        list($res, $Pg, $TtlRows) = getResultSet('product_detail', $Conditions, $OrderBy);
        ?>

        <ul class="latestnews">
            <?php
            while ($rows = mysqli_fetch_array($res)) {
                $primary_id = clean($rows['product_id']);
                ?>
                <li><a href="product_view.php?pid=<?php echo base64_encode($primary_id); ?>"><img src="./images/catimg/<?php echo clean($rows['product_image']); ?>" alt="" height="100" width="100"/></a>
                    <p><strong><a href="product_view.php?pid=<?php echo base64_encode($primary_id); ?>"><?php echo clean($rows['product_name']); ?></a></strong>
                        <br><?php
                        $my_string = strip_tags($rows['product_desc']);
                        echo Truncate($my_string, 150);
                        ?> 
                    </p>
                </li>
            <?php } ?>
        </ul>

    </div>
</div>
<br class="clear" />
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
        $Conditions = array('deleted' => 'N', 'category_parent' => '1', 'category_status' => 'Active');
        $OrderBy = " category_id ASC ";
        list($res, $Pg, $TtlRows) = getResultSet('category_detail', $Conditions, $OrderBy);
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
                        <img src="images/catimg/<?php echo clean($rows['category_image']); ?>" alt="" width="100" height="100"/>
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
            <?php
            $i++;
        }
        ?>
    </div>
</div>
<br class="clear" />
<?php
include './footer.php';
?>