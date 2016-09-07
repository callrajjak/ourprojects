<?php  
 //load_data.php  
 $connect = mysqli_connect("localhost", "root", "", "kishoref_kfrk");  
 $output = '';  
 if(isset($_POST["brand_id"]))  
 {
      if($_POST["brand_id"] != '')  
      {  
          $sql = "select * from product_detail as pd,product_category_detail as pcd where pd.product_id = pcd.product_id and pcd.category_id = " .$_POST["brand_id"];
      }  
      else  
      {  
           $sql = "SELECT * FROM product_detail";  
      }  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '<div class="col-md-3"><div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["product_name"].'</div></div>';  
      }  
      echo $output;  
 }  
 ?>  