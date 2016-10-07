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
//		$siteurl	=	"http://www.kishorefarm.com/admin/";
		
                $HstNm		=	"localhost";
		$DbUsrNm	=	"root";
		$Pwd		=	"";
		$DbNm		=	"kishoref_kfrk";
//		$siteurl	=	"http://www.kishorefarm.com/admin/";
		$siteurl	=	"http://localhost/kishorefarmnew/ourprojects/kishorefarm-admin/";
		
		$MxAlw		=	10; // SET Global Max Records on List pages
		$conn		=	mysqli_connect($HstNm,$DbUsrNm,$Pwd,$DbNm);
		//mysqli_select_db($conn,$DbNm);
		
		//Include Files.
		include_once("function.php");
?>