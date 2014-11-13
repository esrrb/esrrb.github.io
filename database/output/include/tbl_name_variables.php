<?php
$strTableName="tbl_name";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="tbl_name";

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT Name,  `Esrrb-Chip`,  `E-0`,  `E-1`,  `E-3`,  `E-5`,  `P-0`,  `P-1`,  `P-3`,  `P-5`,  `M-0`,  `M-1`,  `M-3`,  `M-5`,  `K4-0`,  `K4-1`,  `K4-3`,  `K4-5`,  `K27-0`,  `K27-1`,  `K27-3`,  `K27-5`";
$gsqlFrom="FROM tbl_name";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/tbl_name_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_tbl_name;
$eventObj = &$tableEvents["tbl_name"];

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>