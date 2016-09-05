<?php 
//Basic Functions[START]
function htmldecode($text){return $cleantext = html_entity_decode($text);}

function isValidUser(){ if(trim($_SESSION['userid'])!='' || trim($_SESSION['userid'])!=NULL){ return 1;}else{ return	0;}}

function clean($text)	{ $text=stripcslashes($text); return $cleantext = htmlentities($text, ENT_QUOTES, 'ISO-8859-1');}

function cleanDB($text) {return mysqli_real_escape_string($text);}

function striptags($text) {return strip_tags($text);}

function startTransaction(){
	mysqli_query($conn,"SET AUTOCOMMIT=0");
	mysqli_query($conn,"START TRANSACTION");
}

function commit(){	mysqli_query($conn,"COMMIT"); }

function rollback(){	mysqli_query($conn,"ROLLBACK"); }

function is_digits($element)
{
  return !preg_match ("/[^0-9]/", $element);
}

function is_tel($num)
{
  $result = TRUE;
  if(!eregi("^\+?[0-9-]{9,15}$", $num)){
    $result = FALSE;
  }
  return $result;
}

function is_discount($element)
{
  return !preg_match ("/[^0-9\-\+\.]/", $element);
}

function num_char($text)
{	return !preg_match ("/[^A-Za-z_0-9]/", $text);
}

/*function is_mob($num)
{
	return preg_match ("/[0-9]{9,15}/", $num);
	//return !preg_match ("/[^\d{10}]/", $num);
}*/

function is_mob($num){
  $result = TRUE;
  if(!eregi("^\+?[0-9]{9,15}$", $num)) {
    $result = FALSE;
  }
  return $result;
}




function is_name($text)
{	
	return !preg_match ("/[^A-Za-z_0-9\'\\\/\-\s\&]/", $text);
}

function is_ver($text)
{	
	return !preg_match ("/[^0-9\.]/", $text);
}


function is_filename($text)
{	
	return !preg_match ("/[^A-Za-z_0-9\&]/", $text);
}

function is_musicfile($text)
{
	return !preg_match("(.*\.([wW][mM][aA])|([mM][pP][3]) |([aA][aA][cC])|([wW][aA][vV]) $)",$text);
}

function is_valid_email($email){
  $result = TRUE;
  if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
    $result = FALSE;
  }
  return $result;
}


function savedate($date)
{
	$month 	= substr($date,3,2);
	$day 	= substr($date,0,2);
	$year 	= substr($date,6,4);
	return $year."-".$day."-".$month;
}

function getDateTime()
{
	$timestamp=time();
	return date("Y-m-d H:i:s",$timestamp);
}

function getdt($dt)
{	
	$date=array();
	$date=explode("-",$dt);
	print_r($date);
	return $date[2]."-".$date[0]."-".$date[1];
}

function getdt2($dt)
{	
	$date=array();
	$date=explode("-",$dt);
	$day=explode(" ",$date[2]);
	$timestamp = strtotime($day[0]."-".$date[1]."-".$date[0]);
	
	return date("M d , Y",$timestamp);
}


function setdate($dt)
{	
	$date=array();
	$date=explode("-",$dt);
	$timestamp = strtotime($dt);
	
	return date("m-d-Y",$timestamp);
}	


function Paging($Pg)
{	
	global $MxAlw;
	if(strlen($Pg)<=0)	$Pg=1;
	$max=($Pg*$MxAlw);
	if($Pg==1) $min=0; else $min=$max-$MxAlw;
	return	array($min,$MxAlw,$Pg);
}


function Paging2($Pg)
{	
	$MxAlw=30;
	if(strlen($Pg)<=0)	$Pg=1;
	$max=($Pg*$MxAlw);
	if($Pg==1) $min=0; else $min=$max-$MxAlw;
	return	array($min,$MxAlw,$Pg);
}
	
function getvalbyid($val,$table,$cond)
{
	global $conn;
  $LgnChkQry="select ".$val." from ".$table." where ".$cond ;
	 $ResLgnChk=mysqli_query($conn,$LgnChkQry); 
	 $NmLgnChk=mysqli_num_rows($ResLgnChk); 
	if($NmLgnChk > 0)
	{	
		 
		while($rows=mysqli_fetch_array($ResLgnChk))
		{
	  	$uid = clean($rows[$val]);
		
		}	
	}
	return $uid; 
}


function isRecordExist($tbl,$cond)
{
	global $conn;
	$sel_qry="SELECT * FROM $tbl WHERE $cond ";
 
	$res=mysqli_query($conn,$sel_qry);
	$num=mysqli_num_rows($res);
	if($num>0)
	{ 
		return true;
	}
	else
	{
		return false;
	}
}


	function pagination($total,$per_page = 10,$page = 1, $url = '?'){        

		$adjacents = "2"; 
    	$page = ($page == 0 ? 1 : $page);  
    	$start = ($page - 1) * $per_page;								
		
    	$prev = $page - 1;							
    	$next = $page + 1;
        $lastpage = ceil($total/$per_page);
    	$lpm1 = $lastpage - 1;
    	
    	$pagination = "";
    	if($lastpage > 1)
    	{	
    		$pagination .= "<ul class='pagination'>";
                    //$pagination .= "<li class='details'>Page $page of $lastpage</li>";
    		if ($lastpage < 7 + ($adjacents * 2))
    		{	
    			for ($counter = 1; $counter <= $lastpage; $counter++)
    			{
    				if ($counter == $page)
    					$pagination.= "<li><a class='current'>$counter</a></li>";
    				else
    					$pagination.= "<li><a href='{$url}&page=$counter'>$counter</a></li>";					
    			}
    		}
    		elseif($lastpage > 5 + ($adjacents * 2))
    		{
    			if($page < 1 + ($adjacents * 2))		
    			{
    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}&page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>...</li>";
    				$pagination.= "<li><a href='{$url}&page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}&page=$lastpage'>$lastpage</a></li>";		
    			}
    			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
    			{
    				$pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>...</li>";
    				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}&page=$counter'>$counter</a></li>";					
    				}
    				$pagination.= "<li class='dot'>..</li>";
    				$pagination.= "<li><a href='{$url}&page=$lpm1'>$lpm1</a></li>";
    				$pagination.= "<li><a href='{$url}&page=$lastpage'>$lastpage</a></li>";		
    			}
    			else
    			{
    				$pagination.= "<li><a href='{$url}&page=1'>1</a></li>";
    				$pagination.= "<li><a href='{$url}&page=2'>2</a></li>";
    				$pagination.= "<li class='dot'>..</li>";
    				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
    				{
    					if ($counter == $page)
    						$pagination.= "<li><a class='current'>$counter</a></li>";
    					else
    						$pagination.= "<li><a href='{$url}&page=$counter'>$counter</a></li>";					
    				}
    			}
    		}
    		
    		if ($page < $counter - 1){ 
    			$pagination.= "<li><a href='{$url}&page=$next'>Next >></a></li>";
               // $pagination.= "<li><a href='{$url}&page=$lastpage'>Last</a></li>";
    		}else{
    			$pagination.= "<li><a class='current'>Next >></a></li>";
               // $pagination.= "<li><a class='current'>Last</a></li>";
            }
    		$pagination.= "</ul>\n";		
    	}
    
        return $pagination;
    }

//Basic Functions[END]



//Database Functions [START ]---------------------------------------------------


// Get ResultSet Function ------------------------------------------------------
	function getResultSet($Table,$Conditions="",$OrderBy="",$Pg=0)
	{
		global $conn;
		list($min,$max,$Pg)=Paging($Pg);
		
		$con_str = "";
		$TtlRows = 0;
		
		if(!empty($Conditions))
		{
			
			if(is_array($Conditions))
			{
				$keys	= array_keys($Conditions);
				$values	= array_values($Conditions);
				
				$key_count = count($keys);
				$value_count = count($values);
				
				if($key_count==$value_count)
				{
					for($c=0;$c<$value_count;$c++)
					{
						if(!empty($values[$c]))
						{
							$con_str .= " AND ".$keys[$c]." = '".$values[$c]."' ";
						}
					}
				}
			}
			else
			{
				$con_str = $Conditions;
			}
		}
		
		if(!empty($OrderBy))
		{
			$con_str .= " ORDER BY ".$OrderBy;
		}
		
		$sel_qry="SELECT * FROM $Table WHERE 1 $con_str ";

		if(!empty($Pg))
		{
			$Res=mysqli_query($conn,$sel_qry);
			$TtlRows=mysqli_num_rows($Res);
			$TtlPg=ceil($TtlRows/$max);
			if(($TtlPg<$Pg) && ($TtlPg>0)) list($min,$max,$Pg)=Paging($Pg-1);
			
			 $sel_qry .=" LIMIT $min,$max";
		}

		echoLog($sel_qry);
	 
		$res=mysqli_query($conn,$sel_qry);
		if($res)
		{
			$num=mysqli_num_rows($res);
			if($num>0)
			{
				if(empty($TtlRows)){$TtlRows=$num;}
				return array($res,$Pg,$TtlRows);
			}
		}

		return array($res,$Pg,$TtlRows);
	}
	

// Get Row Function ------------------------------------------------------
	function getRow($Table,$Conditions)
	{
		global $conn;
		
		$con_str = "";
		
		if(!empty($Conditions))
		{
			
			if(is_array($Conditions))
			{
				$keys	= array_keys($Conditions);
				$values	= array_values($Conditions);
				
				$key_count = count($keys);
				$value_count = count($values);
				
				if($key_count==$value_count)
				{
					for($c=0;$c<$value_count;$c++)
					{
						if(!empty($values[$c]))
						{
							$con_str .= " AND ".$keys[$c]." = '".$values[$c]."' ";
						}
					}
				}
			}
			else
			{
				$con_str = $Conditions;
			}
		}
		
		$sel_qry="SELECT * FROM $Table WHERE 1 $con_str ";
		echoLog($query);
		$res=mysqli_query($conn,$sel_qry);
		if($res)
		{
			$num=mysqli_num_rows($res);
			if($num>0)
			{
				$row=mysqli_fetch_array($res);
				return $row;
			}
		}
	}


//Execute Query Function ------------------------------------------------------
	function executeQuery($query,$conn,$Pg)
	{
		//echo "".$query;
		if(!empty($Pg))
		{
			list($min,$max,$Pg)=Paging($Pg);
			$Res=mysqli_query($conn,$query);
			if($Res)
			{
				$TtlRows=mysqli_num_rows($Res);
				$TtlPg=ceil($TtlRows/$max);
				if(($TtlPg<$Pg) && ($TtlPg>0)) list($min,$max,$Pg)=Paging($Pg-1);
				
				$query .=" LIMIT $min,$max";				
			}
		}
		
		$res=mysqli_query($conn,$query);
		if($res)
		{
			$num=mysqli_num_rows($res);
			if($num>0)
			{
				if(empty($TtlRows)){$TtlRows=$num;}
				return array($res,$Pg,$TtlRows);
			}
		}
		return array($res,$Pg,$TtlRows);
	}


// Insert Function ------------------------------------------------------
	function insert( $table, $fields, $values, $conn)
	{
		if(!empty($fields))
		{
			if(is_array($fields))
			{
				$count = count($fields);
				if($count>0)
				{
					$con_str .= "( ";
					for($c=0;$c<$count;$c++)
					{
						if(!empty($fields[$c]))
						{
							$con_str .= "".$fields[$c].", ";
						}
					}
					$con_str = substr($con_str,0,strlen($con_str)-2);
					$con_str .= ") ";
				}
			}
			else
			{
				$con_str .= "(".$fields.") ";
			}
		}
		
		
		if(!empty($values))
		{
			if(is_array($values))
			{
				$count = count($values);
				if($count>0)
				{
					$con_str .= " VALUES( ";
					for($c=0;$c<$count;$c++)
					{
						$con_str .= "'".$values[$c]."', ";
					}
					$con_str = substr($con_str,0,strlen($con_str)-2);
					$con_str .= ") ";
				}
			}
			else
			{
				$con_str .= " VALUES(".$values.") ";
			}
		}
		
		$query = "INSERT INTO $table $con_str ";
		echoLog($query);
		$res=mysqli_query($conn,$query);
		if($res)
		{
			$id=mysqli_insert_id();
			if(empty($id))
			{
				return 1;
			}
			return mysqli_insert_id();
		}
		
		return 0;
	}


// Update Function -------------------------------------------------------
	function update( $table, $keyvaluepairs, $condition, $conn)
	{
		if(!empty($keyvaluepairs))
		{
			if(is_array($keyvaluepairs))
			{
				$count = count($keyvaluepairs);
				if($count>0)
				{
					$update_str = '';
					foreach($keyvaluepairs as $key=>$value)
					{
						if(!empty($value))
						{
							$update_str .= $key."='".$value."', ";
						}
					}
					$update_str = substr($update_str,0,strlen($update_str)-2);
				}
			}
			else
			{
				$update_str .= $keyvaluepairs;
			}
		}
		
		$query = "UPDATE $table SET $update_str WHERE 1 $condition ";
		echoLog($query);
		$res=mysqli_query($conn,$query);
		if($res)
		{
			return 1;
		}
		
		return 0;
	}


// Delete Function -------------------------------------------------------------
	function deleteRecords( $table, $condition, $conn)
	{

		$query = "DELETE FROM $table WHERE 1 $condition ";
		$res=mysqli_query($conn,$query);
		if($res)
		{
			return 1;
		}
		
		return 0;
	}


//Database Functions [END ]---------------------------------------------------


	function echoLog($string)
	{
		$f = @fopen("echo.log", 'a+');
		if ($f) {	
		  @fputs($f, date("m.d.Y g:i:sa")." | $string \n ----------------------- \n");
		  @fclose($f);
		}
	}

	
	function Truncate($string, $length, $stopanywhere=false) {
		//truncates a string to a certain char length, stopping on a word if not specified otherwise.
		if (strlen($string) > $length) {
			//limit hit!
			$string = substr($string,0,($length -3));
			if ($stopanywhere) {
				//stop anywhere
				$string .= '...';
			} else{
				//stop on a word.
				$string = substr($string,0,strrpos($string,' ')).'...';
			}
		}
		
		return $string;
	}


//File Uploading Function
	function fileUpload($file,$path)
	{

		if (!is_uploaded_file($_FILES[$file]['tmp_name'])) 
		{
			$result		 = 0;
			$msg		 = "please upload file.";
			$msgcode	 = 1;
			return array($result,$msg,$msgcode,$filename);		
		}
		else if($_FILES[$file]['type'] != "image/gif" and $_FILES[$file]['type'] != "image/pjpeg" and $_FILES[$file]['type'] != "image/jpg" and $_FILES[$file]['type'] != "image/jpeg" and $_FILES[$file]['type'] != "image/png" and $_FILES[$file]['type'] != "application/pdf") 
		{
			$result		 = 0;
			$msg		 = "Invalid file type!";
			$msgcode	 = 2;
			return array($result,$msg,$msgcode,$filename);
		} 
		else 
		{
			$img =time().($_FILES[$file]['name']);
			$img=str_replace(' ','_',$img);
			$target_path = $path;
			$filename=$img;
			
			if(!move_uploaded_file($_FILES[$file]["tmp_name"],$target_path.$img))
			{	
				$result		 = 0;
				$msg		 = "Error occured in uploading the file.";
				$msgcode	 = 3;
				return array($result,$msg,$msgcode,$filename);
			}		
			else
			{
				$result		 = 1;
				$msg		 = "File Uploaded Successfully.";
				$msgcode	 = 4;
				return array($result,$msg,$msgcode,$filename);
			}
		}
	}	

	
?>