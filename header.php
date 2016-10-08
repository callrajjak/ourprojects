<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>kishorefarm</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
                <link href="layout/styles/jquery-ui.css" rel="stylesheet" type="text/css"/>
                <link href="layout/styles/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                <script src="layout/scripts/bootstrap.min.js" type="text/javascript"></script>
                <script src="//code.jquery.com/jquery-1.10.2.js"></script>
                <script src="layout/scripts/jquery.min.js" type="text/javascript"></script>
                <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
                <script src="layout/scripts/jssor.slider-21.1.5.debug.js" type="text/javascript"></script>
                    <!--<script src="layout/scripts/jquery.min.js" type="text/javascript"></script>-->
        <!--            <script src="layout/scripts/jquery.jcarousel.pack.js" type="text/javascript"></script>
                    <script src="layout/scripts/jquery.jcarousel.setup.js" type="text/javascript"></script>-->
                <script>
                    $(document).ready(function () {
                        $('#brand').change(function () {
                            var brand_id = $(this).val();
                            $.ajax({
                                url: "loaddata.php",
                                method: "POST",
                                data: {brand_id: brand_id},
                                success: function (data) {

                                    $('#show_product').html(data);
                                }
                            });
                        });
                        
                    });

                </script>  

                </head>
                <body id="top">
                    <!-- ####################################################################################################### -->
                    <div class="wrapper col#666666">
                        <div id="header">
                            <div id="logo">

                                <div class="fl_left">
                                    <img src="images/demo/kishorefarmlogo.gif" height="100" width="250">

                                </div><div class="searchpanel" >
                                </div>
                                <!--<h1><a href="index.html">KISHORE</a></h1>
                                <p>FARM EQUIPMENTS PVT.LTD</p>-->
                            </div>
                            <div id="topnav">
                                <ul>
                                    <li class="active"><a href="index.php">Home</a></li>
                                    <li><a href="Gallery.php#1">Gallery</a></li>
                                    <li><a href="CategoryList.php">Category</a></li>
                                    <li><a href="#1">Download</a>
                                        <ul>
                                            <li><a href="#1">Brochure</a></li>
                                            <li><a href="#1">Installation Manual</a></li>
                                        </ul></li>
                                    <li><a href="AboutUs.php">About Us</a></li>
                                    <li><a href="ContactUs.php">Contact Us</a></li>
                                </ul>
                            </div>
                            <br class="clear" />
                        </div>
                    </div>