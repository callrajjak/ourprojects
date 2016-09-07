
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
//        $output .= '<div class="col-md-3">';
//        $output .= '<div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["product_name"].'';
//        $output .= '</div>';
//        $output .= '</div>';
        $output .= '<h3>' . $row["product_name"] . '</h3>';
        $output .= '<div>';
        $output .= '<p>' . $row["product_desc"] . '</p>';
        $output .= '</div>';
        ?>

        <h3>header 1</h3>
        <div></div>

        <?php
    }
    return $output;
}
?>  
<!DOCTYPE html>  
<br /><br />  
<div class="container">  
    <h3>  
        <select name="brand" id="brand">  
            <option value="">Show All Product</option>  
            <?php echo fill_brand($conn); ?>  
        </select>  
        <br /><br />  
        <div id="show_product">  
            <?php echo fill_product($conn); ?>  
        </div>  
    </h3>  
</div>  
<script>
    $(function () {
        $("#show_product").accordion({
            collapsible: true
        });
    });
</script>
<br class="clear"/>
<?php
include './footer.php';
?>
