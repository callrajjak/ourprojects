<?php 	session_start();

		global $conn;
		ini_set( "display_errors",0);
		ini_set('max_execution_time', 600); //300 seconds = 5 minutes
		
		//	Server Connection Details.
		/*$HstNm		=	"null";
		$DbUsrNm	=	"null";
		$Pwd		=	"null";
		$DbNm		=	"null";
		$siteurl	=	"unkown";*/
		
		// 	Local Connection Details.
//		$HstNm		=	"localhost";
//		$DbUsrNm	=	"kishoref_rkpanel";
//		$Pwd		=	"simple@159";
//		$DbNm		=	"kishoref_kfrk";
		$siteurl	=	"http://localhost/kishorefarmnew/ourprojects/kishorefarm-admin/";//"http://www.kishorefarm.com/admin/";
		
                define('hostname','localhost');
                define('username','root');
                define('password', '');
                define('dbname', 'kishoref_kfrk');
		$MxAlw		=	10; // SET Global Max Records on List pages
//		$conn		=	mysqli_connect($HstNm,$DbUsrNm,$Pwd);
		$conn		= mysqli_connect(hostname, username, password, dbname);
//		mysql_select_db($DbNm,$conn);
		
		//Include Files.
		include_once("function.php");
?>