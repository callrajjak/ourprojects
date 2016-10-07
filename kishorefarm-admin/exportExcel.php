<?php
include './connect.php';
 $output = '';  
// if(isset($_POST["export_excel"]))  
// {  
      $sql = "SELECT * FROM contacts_detail ORDER BY contact_id ASC";  
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0)  
      {  
           $output .= '  
                <table class="table" bordered="1">  
                     <tr>  
                          <th>Contact Name</th>  
                          <th>Company Name</th>  
                          <th>Email Id</th>  
                          <th>Phone Number</th>  
                          <th>City</th>  
                          <th>Country</th>  
                          <th>Website</th>  
                          <th>Comments</th> 
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>'.$row["contact_name"].'</td>  
                          <td>'.$row["company_name"].'</td>  
                          <td>'.$row["emailid"].'</td>  
                          <td>'.$row["phone"].'</td>  
                          <td>'.$row["city"].'</td>  
                          <td>'.$row["country"].'</td>  
                          <td>'.$row["website"].'</td>  
                          <td>'.$row["commentsdata"].'</td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
           header("Content-Type: application/xlsx");   
           header("Content-Disposition: attachment; filename=Kishorefarm_contacts.xls");  
           echo $output;  
      }  
// }  
 ?>