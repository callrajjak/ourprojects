<?php
include './header.php';
include_once './connect.php';


$Conditions = array('deleted' => 'N', 'gallery_status' => 'Active');
$OrderBy = " gallery_id DESC";
list($res, $Pg, $TtlRows) = getResultSet('gallery_detail', $Conditions, $OrderBy, $Pg);



$Conditions = array('deleted' => 'N', 'gallery_status' => 'Active');
$OrderBy = " gallery_id DESC";
list($res, $Pg, $TtlRows) = getResultSet('gallery_detail', $Conditions, $OrderBy, $Pg);
?>

<!-- ####################################################################################################### -->
<div class="wrapper">
    <div class="container">
        <div class="content" style="font-family:arial">
            <?php
            while ($rows = mysqli_fetch_array($res)) {
                $primary_id = clean($rows['gallery_id']);
                ?>
            <a style="display:block;float:left;margin:10px;border:1px solid #666; padding:2px;" rel="example_group" href="./images/catimg/<?php echo clean($rows['gallery_image']); ?>" title="<?php echo clean($rows['gallery_name']); ?>"><img alt="" src="./images/catimg/<?php echo clean($rows['gallery_image']); ?>" height="180" width="180" /></a>
                    <?php
                }
                ?>
        </div>
    </div>
    <br class="clear"/>
    <?php
    
    include_once('footer.php');
    ?>