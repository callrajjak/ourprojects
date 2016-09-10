
<?php
include './header.php';
include './connect.php';
?>
<style>
    .ui-accordion .ui-accordion-header {
        display: block;
        cursor: pointer;
        position: relative;
        margin: 2px 0 0 0;

        min-height: 0; /* support: IE7 */
        font-size: 100%;
        border:1px solid #FDF8E4;
        background:#846733;
        color:#fff;
    }
</style>
<?php
global $conn;

function fill_brand($conn) {
    $output = '';
    $sql = "SELECT * FROM category_detail";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $output .= '<option value="' . $row["category_id"] . '">' . $row["category_name"] . '</option>';
    }
    return $output;
}

function fill_product($conn) {
    $output = '';
    $sql = "SELECT * FROM product_detail";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {

        $output .= '<h3>' . $row["product_name"] . '</h3>';
        $output .= '<div>';
        $output .= '<p>' . $row["product_desc"] . '</p>';
        $output .= '</div>';
    }
    return $output;
}
?>  
<!DOCTYPE html>  
<div id="productContainer">
    <div id="sideCatContainer">
        <div id="sidecategory">
            <ul>
                <?php
                global $conn;
                $Conditions = array('deleted' => 'N', 'category_parent' => '1', 'category_status' => 'Active');
                $OrderBy = " category_id ASC ";
                list($res, $Pg, $TtlRows) = getResultSet('category_detail', $Conditions, $OrderBy);

                $i = 1;
                while ($rows = mysqli_fetch_array($res)) {
                    $primary_id = clean($rows['category_id']);
                    ?>

                    <li><a href="productlist.php?cid=<?php echo base64_encode($primary_id); ?>" class="catboxyfoottile"><?php echo clean($rows['category_name']); ?> </a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="container">  

    <!--    <select name="brand" id="brand">  
            <option value="">Show All Product</option>  
        <?php // echo fill_brand($conn); ?> 
        </select>  -->

        <div id="show_product">  
            <?php echo fill_product($conn); ?>  
        </div>  

    </div>
</div>
<script>
    $(function () {
        $('#show_product').accordion({
            collapsible: true
        });
    });
</script>
<br class="clear"/>
<?php
include './footer.php';
?>
