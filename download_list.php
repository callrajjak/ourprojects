<?php
include_once('connect.php');

$Pg = $_GET['page']; // getting page no from URL	
$cid = base64_decode($_REQUEST['cid']);
$list = 'c';
$title = 'Download Categories';
global $conn;

if (strlen($Pg) <= 0) {
    $Pg = $_POST["page"];
    if (strlen($Pg) <= 0) {
        $Pg = 1;
    } elseif (!is_numeric($Pg)) {
        $Pg = 1;
    } //validation for page no
} else {
    if (!is_numeric($Pg)) {
        $Pg = 1;
    } elseif ($Pg <= 0) {
        $Pg = 1;
    } //validation for page no
}

if (!empty($cid)) {
    $Conditions = " D.deleted='N' AND DC.dowcat_id='$cid' AND D.download_status='Active' ";
    $OrderBy = 'ORDER BY D.download_id DESC';

    $query = " SELECT * FROM  `download_detail` AS D 
				   LEFT JOIN  `download_category_detail` AS DC ON D.download_id=DC.download_id
				   WHERE " . $Conditions . " " . $OrderBy;

    list($res, $Pg, $TtlRows) = executeQuery($query, $conn, $Pg);
    $list = 'p';
    $title = 'Downloads';
} else {
    $Conditions = array('deleted' => 'N', 'dowcat_status' => 'Active');
    $OrderBy = " dowcat_id DESC";
    list($res, $Pg, $TtlRows) = getResultSet('`dowcat_detail`', $Conditions, $OrderBy, $Pg);
    $list = 'c';
}

include_once('header.php');
?>
<!-- ####################################################################################################### -->
<div class="wrapper">
    <div class="container">
        <div class="content" style="font-family:arial">
            <div id="comments">
                <h2 class="prtitle"><?php echo $title; ?></h2>
                <ul class="commentlist">

                    <?php
                    if ($TtlRows) {

                        if ($list == 'c') {
                            $i = 1;
                            while ($rows = mysqli_fetch_array($res)) {
                                $primary_id = clean($rows['dowcat_id']);
                                if ($i % 2 == 0) {
                                    $class = 'comment_even';
                                } else {
                                    $class = 'comment_odd';
                                }
                                ?>
                                <li class="<?php echo $class; ?>">
                                    <div class="author pro_name"><span class="name">
                                            <a href="download_list.php?cid=<?php echo base64_encode($primary_id); ?>">
                                <?php echo clean($rows['dowcat_name']); ?>
                                            </a></span></div>
                                    <div class="cleardiv"></div>

                                </li>
                                <?php
                                $i++;
                            }
                        } else {
                            $i = 1;
                            while ($rows = mysqli_fetch_array($res)) {
                                $primary_id = clean($rows['download_id']);
                                if ($i % 2 == 0) {
                                    $class = 'comment_even';
                                } else {
                                    $class = 'comment_odd';
                                }
                                ?>
                                <li class="<?php echo $class; ?>">
                                    <div class="author pro_name"><span class="name"><a href="images/catimg/<?php echo clean($rows['download_image']); ?>" target="_blank"><?php echo clean($rows['download_name']); ?></a></span></div>
                                    <div class="cleardiv"></div>
                                </li>
                                <?php
                                $i++;
                            }
                        }
                    } else {
                        echo "$title are not available";
                    }
                    ?>

                </ul>
            </div>

    <?php echo pagination($TtlRows, $per_page = 10, $Pg, $url = 'download_list.php?s=1'); ?>

        </div>
    </div>


<?php
include_once('footer.php');
?>