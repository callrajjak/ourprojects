<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
</script>
  <script>
  $(function() {
    $( "#jQuery_accordion" ).accordion({
      collapsible: true
    });
  });
  </script>
<!-- <script>
    $(document).ready(function(){
      
     $.ajax({url:"accord1.txt",success:function(ajaxresult){
     $("#accord1").append(ajaxresult);
    }});

     $.ajax({url:"accord2.txt",success:function(ajaxresult){
     $("#accord2").append(ajaxresult);
    }});

});
</script> -->

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

</head>
<body>
<div id="jQuery_accordion">
  <h3>header 1</h3>
  <div>
    
    This is section 3. Content can include listing as well.
<ol><li>item 1</li>
    <li>Item 2</li>
    <li>Item 3</li>
</ol>
    
    </div>
  <h3>header 2</h3>
  <div>
    
    This is section 3. Content can include listing as well.
<ol><li>item 1</li>
    <li>Item 2</li>
    <li>Item 3</li>
</ol>
    </div>
  <h3>header 3</h3>
  <div>
    This is section 3. Content can include listing as well.
<ol><li>item 1</li>
    <li>Item 2</li>
    <li>Item 3</li>
</ol>
    </div>
</div>
</body>
</html>


