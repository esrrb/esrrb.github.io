<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
include("include/dbcommon.php");
include("classes/searchclause.php");
session_cache_limiter("none");

include("include/tbl_name_variables.php");


// Modify query: remove blob fields from fieldlist.
// Blob fields on an export page are shown using imager.php (for example).
// They don't need to be selected from DB in export.php itself.
$gQuery->ReplaceFieldsWithDummies(GetBinaryFieldsIndices());

//	Before Process event
if($eventObj->exists("BeforeProcessExport"))
	$eventObj->BeforeProcessExport($conn);

$strWhereClause="";
$strHavingClause="";
$selected_recs=array();
$options = "1";

header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
include('include/xtempl.php');
include('classes/runnerpage.php');
$xt = new Xtempl();

$id = postvalue("id") != "" ? postvalue("id") : 1;
//array of params for classes
$params = array("pageType" => PAGE_EXPORT, "id" =>$id, "tName"=>$strTableName);
$params["xt"] = &$xt;
if(!$eventObj->exists("ListGetRowCount") && !$eventObj->exists("ListQuery"))
	$params["needSearchClauseObj"] = false;
$pageObject = new RunnerPage($params);

if (@$_REQUEST["a"]!="")
{
	$options = "";
	$sWhere = "1=0";	

//	process selection
	$selected_recs=array();
	if (@$_REQUEST["mdelete"])
	{
		foreach(@$_REQUEST["mdelete"] as $ind)
		{
			$keys=array();
			$keys["Name"]=refine($_REQUEST["mdelete1"][mdeleteIndex($ind)]);
			$selected_recs[]=$keys;
		}
	}
	elseif(@$_REQUEST["selection"])
	{
		foreach(@$_REQUEST["selection"] as $keyblock)
		{
			$arr=explode("&",refine($keyblock));
			if(count($arr)<1)
				continue;
			$keys=array();
			$keys["Name"]=urldecode($arr[0]);
			$selected_recs[]=$keys;
		}
	}

	foreach($selected_recs as $keys)
	{
		$sWhere = $sWhere . " or ";
		$sWhere.=KeyWhere($keys);
	}


	$strSQL = gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
	
	$_SESSION[$strTableName."_SelectedSQL"] = $strSQL;
	$_SESSION[$strTableName."_SelectedWhere"] = $sWhere;
	$_SESSION[$strTableName."_SelectedRecords"] = $selected_recs;
}

if ($_SESSION[$strTableName."_SelectedSQL"]!="" && @$_REQUEST["records"]=="") 
{
	$strSQL = $_SESSION[$strTableName."_SelectedSQL"];
	$strWhereClause=@$_SESSION[$strTableName."_SelectedWhere"];
	$selected_recs = $_SESSION[$strTableName."_SelectedRecords"];
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strHavingClause=@$_SESSION[$strTableName."_having"];
	$strSQL=gSQLWhere($strWhereClause,$strHavingClause);
}

$mypage=1;
if(@$_REQUEST["type"])
{
//	order by
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);

	$strSQLbak = $strSQL;
	if($eventObj->exists("BeforeQueryExport"))
		$eventObj->BeforeQueryExport($strSQL,$strWhereClause,$strOrderBy);
//	Rebuild SQL if needed
	if($strSQL!=$strSQLbak)
	{
//	changed $strSQL - old style	
		$numrows=GetRowCount($strSQL);
	}
	else
	{
		$strSQL = gSQLWhere($strWhereClause,$strHavingClause);
		$strSQL.=" ".trim($strOrderBy);
		$rowcount=false;
		if($eventObj->exists("ListGetRowCount"))
		{
			$masterKeysReq=array();
			for($i = 0; $i < count($pageObject->detailKeysByM); $i ++)
				$masterKeysReq[]=$_SESSION[$strTableName."_masterkey".($i + 1)];
			$rowcount=$eventObj->ListGetRowCount($pageObject->searchClauseObj,$_SESSION[$strTableName."_mastertable"],$masterKeysReq,$selected_recs);
		}
		if($rowcount!==false)
			$numrows=$rowcount;
		else
			$numrows=gSQLRowCount($strWhereClause,$strHavingClause);
	}
	LogInfo($strSQL);

//	 Pagination:

	$nPageSize = 0;
	if(@$_REQUEST["records"]=="page" && $numrows)
	{
		$mypage = (integer)@$_SESSION[$strTableName."_pagenumber"];
		$nPageSize = (integer)@$_SESSION[$strTableName."_pagesize"];
		
		if(!$nPageSize)
			$nPageSize = GetTableData($strTableName,".pageSize",0);
				
		if($nPageSize<0)
			$nPageSize = 0;
			
		if($nPageSize>0)
		{
			if($numrows<=($mypage-1)*$nPageSize)
				$mypage = ceil($numrows/$nPageSize);
		
			if(!$mypage)
				$mypage = 1;
			
					$strSQL.=" limit ".(($mypage-1)*$nPageSize).",".$nPageSize;
		}
	}
	$listarray = false;
	if($eventObj->exists("ListQuery"))
		$listarray = $eventObj->ListQuery($pageObject->searchClauseObj,$_SESSION[$strTableName."_arrFieldForSort"],$_SESSION[$strTableName."_arrHowFieldSort"],$_SESSION[$strTableName."_mastertable"],$masterKeysReq,$selected_recs,$nPageSize,$mypage);
	if($listarray!==false)
		$rs = $listarray;
	elseif($nPageSize>0)
	{
					$rs = db_query($strSQL,$conn);
	}
	else
		$rs = db_query($strSQL,$conn);

	if(!ini_get("safe_mode"))
		set_time_limit(300);
	
	if(@$_REQUEST["type"]=="excel")
	{
//	remove grouping
		$locale_info["LOCALE_SGROUPING"]="0";
		$locale_info["LOCALE_SMONGROUPING"]="0";
		ExportToExcel();
	}
	else if(@$_REQUEST["type"]=="word")
	{
		ExportToWord();
	}
	else if(@$_REQUEST["type"]=="xml")
	{
		ExportToXML();
	}
	else if(@$_REQUEST["type"]=="csv")
	{
		$locale_info["LOCALE_SGROUPING"]="0";
		$locale_info["LOCALE_SDECIMAL"]=".";
		$locale_info["LOCALE_SMONGROUPING"]="0";
		$locale_info["LOCALE_SMONDECIMALSEP"]=".";
		ExportToCSV();
	}
	db_close($conn);
	return;
}

// add button events if exist
$pageObject->addButtonHandlers();

// add onload event
$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadExport", '');
$pageObject->addOnLoadJsEvent($onLoadJsCode);

if($options)
{
	$xt->assign("rangeheader_block",true);
	$xt->assign("range_block",true);
}

$xt->assign("exportlink_attrs", 'id="saveButton'.$pageObject->id.'"');

$pageObject->body["begin"] .="<script type=\"text/javascript\" src=\"include/jquery.js\"></script>\r\n";
$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
if ($pageObject->debugJSMode === true)
{
	/*$pageObject->body['begin'] .= "<script type=\"text/javascript\" src=\"include/runnerJS/Runner.js\"></script>\r\n".
		"<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>\r\n".
		"<script type=\"text/javascript\" src=\"include/runnerJS/Observer.js\"></script>\r\n";*/
	$pageObject->body['begin'] .= "<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
}
else
	$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";

$pageObject->fillSetCntrlMaps();
$pageObject->body['end'] .= '<script>';
$pageObject->body['end'] .= "window.controlsMap = '".jsreplace(my_json_encode($pageObject->controlsHTMLMap))."';";
$pageObject->body['end'] .= "window.settings = '".jsreplace(my_json_encode($pageObject->jsSettings))."';";
$pageObject->body['end'] .= '</script>';
$pageObject->addCommonJs();		
	
$pageObject->body["end"] .= "<script>".$pageObject->PrepareJS()."</script>";
$xt->assignbyref("body",$pageObject->body);

$xt->display("tbl_name_export.htm");

function ExportToExcel()
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=tbl_name.xls");

	echo "<html>";
	echo "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">";
	
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData();

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToWord()
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=tbl_name.doc");

	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData();

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToXML()
{
	global $nPageSize,$rs,$strTableName,$conn,$eventObj;
	header("Content-Type: text/xml");
	header("Content-Disposition: attachment;Filename=tbl_name.xml");
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs);
	else
		$row = db_fetch_array($rs);	
	if(!$row)
		return;
		
	global $cCharset;
	
	echo "<?xml version=\"1.0\" encoding=\"".$cCharset."\" standalone=\"yes\"?>\r\n";
	echo "<table>\r\n";
	$i=0;
	
	
	while((!$nPageSize || $i<$nPageSize) && $row)
	{
		$values = array();
			$values["Name"] = GetData($row,"Name","");
			$values["Esrrb-Chip"] = GetData($row,"Esrrb-Chip","");
			$values["E-0"] = GetData($row,"E-0","");
			$values["E-1"] = GetData($row,"E-1","");
			$values["E-3"] = GetData($row,"E-3","");
			$values["E-5"] = GetData($row,"E-5","");
			$values["P-0"] = GetData($row,"P-0","");
			$values["P-1"] = GetData($row,"P-1","");
			$values["P-3"] = GetData($row,"P-3","");
			$values["P-5"] = GetData($row,"P-5","");
			$values["M-0"] = GetData($row,"M-0","");
			$values["M-1"] = GetData($row,"M-1","");
			$values["M-3"] = GetData($row,"M-3","");
			$values["M-5"] = GetData($row,"M-5","");
			$values["K4-0"] = GetData($row,"K4-0","");
			$values["K4-1"] = GetData($row,"K4-1","");
			$values["K4-3"] = GetData($row,"K4-3","");
			$values["K4-5"] = GetData($row,"K4-5","");
			$values["K27-0"] = GetData($row,"K27-0","");
			$values["K27-1"] = GetData($row,"K27-1","");
			$values["K27-3"] = GetData($row,"K27-3","");
			$values["K27-5"] = GetData($row,"K27-5","");
		
		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{			
			$eventRes = $eventObj->BeforeOut($row, $values);
		}
		if ($eventRes)
		{
			$i++;
			echo "<row>\r\n";
			foreach ($values as $fName => $val)
			{
				$field = htmlspecialchars(XMLNameEncode($fName));
				echo "<".$field.">";
				echo htmlspecialchars($values[$fName]);
				echo "</".$field.">\r\n";
			}
			echo "</row>\r\n";
		}
		
		
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs);
		else
			$row = db_fetch_array($rs);	
	}
	echo "</table>\r\n";
}

function ExportToCSV()
{
	global $rs,$nPageSize,$strTableName,$conn,$eventObj;
	header("Content-Type: application/csv");
	header("Content-Disposition: attachment;Filename=tbl_name.csv");
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs);
	else
		$row = db_fetch_array($rs);	
	if(!$row)
		return;
	
		
		
	$totals=array();

	
// write header
	$outstr="";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Name\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Esrrb-Chip\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"E-0\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"E-1\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"E-3\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"E-5\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"P-0\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"P-1\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"P-3\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"P-5\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"M-0\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"M-1\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"M-3\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"M-5\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"K4-0\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"K4-1\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"K4-3\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"K4-5\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"K27-0\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"K27-1\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"K27-3\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"K27-5\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		
		
		$values = array();
			$format="";
			$values["Name"] = GetData($row,"Name",$format);
			$format="Number";
			$values["Esrrb-Chip"] = $row["Esrrb-Chip"];
			$format="";
			$values["E-0"] = GetData($row,"E-0",$format);
			$format="Number";
			$values["E-1"] = $row["E-1"];
			$format="Number";
			$values["E-3"] = $row["E-3"];
			$format="Number";
			$values["E-5"] = $row["E-5"];
			$format="";
			$values["P-0"] = GetData($row,"P-0",$format);
			$format="Number";
			$values["P-1"] = $row["P-1"];
			$format="Number";
			$values["P-3"] = $row["P-3"];
			$format="Number";
			$values["P-5"] = $row["P-5"];
			$format="";
			$values["M-0"] = GetData($row,"M-0",$format);
			$format="Number";
			$values["M-1"] = $row["M-1"];
			$format="Number";
			$values["M-3"] = $row["M-3"];
			$format="Number";
			$values["M-5"] = $row["M-5"];
			$format="";
			$values["K4-0"] = GetData($row,"K4-0",$format);
			$format="Number";
			$values["K4-1"] = $row["K4-1"];
			$format="Number";
			$values["K4-3"] = $row["K4-3"];
			$format="Number";
			$values["K4-5"] = $row["K4-5"];
			$format="";
			$values["K27-0"] = GetData($row,"K27-0",$format);
			$format="Number";
			$values["K27-1"] = $row["K27-1"];
			$format="Number";
			$values["K27-3"] = $row["K27-3"];
			$format="Number";
			$values["K27-5"] = $row["K27-5"];

		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{			
			$eventRes = $eventObj->BeforeOut($row,$values);
		}
		if ($eventRes)
		{
			$outstr="";			
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["Name"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["Esrrb-Chip"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["E-0"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["E-1"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["E-3"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["E-5"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["P-0"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["P-1"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["P-3"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["P-5"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["M-0"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["M-1"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["M-3"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["M-5"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["K4-0"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["K4-1"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["K4-3"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["K4-5"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["K27-0"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["K27-1"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["K27-3"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"','""',$values["K27-5"]).'"';
			echo $outstr;
		}
		
		$iNumberOfRows++;
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs);
		else
			$row = db_fetch_array($rs);	
			
		if(((!$nPageSize || $iNumberOfRows<$nPageSize) && $row) && $eventRes)
			echo "\r\n";
	}
}


function WriteTableData()
{
	global $rs,$nPageSize,$strTableName,$conn,$eventObj;
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs);
	else
		$row = db_fetch_array($rs);	
	if(!$row)
		return;
// write header
	echo "<tr>";
	if($_REQUEST["type"]=="excel")
	{
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Name").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Esrrb-Chip").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("E-0").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("E-1").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("E-3").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("E-5").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("P-0").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("P-1").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("P-3").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("P-5").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("M-0").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("M-1").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("M-3").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("M-5").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("K4-0").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("K4-1").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("K4-3").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("K4-5").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("K27-0").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("K27-1").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("K27-3").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("K27-5").'</td>';	
	}
	else
	{
		echo "<td>"."Name"."</td>";
		echo "<td>"."Esrrb-Chip"."</td>";
		echo "<td>"."E-0"."</td>";
		echo "<td>"."E-1"."</td>";
		echo "<td>"."E-3"."</td>";
		echo "<td>"."E-5"."</td>";
		echo "<td>"."P-0"."</td>";
		echo "<td>"."P-1"."</td>";
		echo "<td>"."P-3"."</td>";
		echo "<td>"."P-5"."</td>";
		echo "<td>"."M-0"."</td>";
		echo "<td>"."M-1"."</td>";
		echo "<td>"."M-3"."</td>";
		echo "<td>"."M-5"."</td>";
		echo "<td>"."K4-0"."</td>";
		echo "<td>"."K4-1"."</td>";
		echo "<td>"."K4-3"."</td>";
		echo "<td>"."K4-5"."</td>";
		echo "<td>"."K27-0"."</td>";
		echo "<td>"."K27-1"."</td>";
		echo "<td>"."K27-3"."</td>";
		echo "<td>"."K27-5"."</td>";
	}
	echo "</tr>";

	$totals=array();
// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
			
		$values = array();	

					
							$format="";
			
			$values["Name"] = GetData($row,"Name",$format);
					
							$format="Number";
			
			$values["Esrrb-Chip"] = GetData($row,"Esrrb-Chip",$format);
					
							$format="";
			
			$values["E-0"] = GetData($row,"E-0",$format);
					
							$format="Number";
			
			$values["E-1"] = GetData($row,"E-1",$format);
					
							$format="Number";
			
			$values["E-3"] = GetData($row,"E-3",$format);
					
							$format="Number";
			
			$values["E-5"] = GetData($row,"E-5",$format);
					
							$format="";
			
			$values["P-0"] = GetData($row,"P-0",$format);
					
							$format="Number";
			
			$values["P-1"] = GetData($row,"P-1",$format);
					
							$format="Number";
			
			$values["P-3"] = GetData($row,"P-3",$format);
					
							$format="Number";
			
			$values["P-5"] = GetData($row,"P-5",$format);
					
							$format="";
			
			$values["M-0"] = GetData($row,"M-0",$format);
					
							$format="Number";
			
			$values["M-1"] = GetData($row,"M-1",$format);
					
							$format="Number";
			
			$values["M-3"] = GetData($row,"M-3",$format);
					
							$format="Number";
			
			$values["M-5"] = GetData($row,"M-5",$format);
					
							$format="";
			
			$values["K4-0"] = GetData($row,"K4-0",$format);
					
							$format="Number";
			
			$values["K4-1"] = GetData($row,"K4-1",$format);
					
							$format="Number";
			
			$values["K4-3"] = GetData($row,"K4-3",$format);
					
							$format="Number";
			
			$values["K4-5"] = GetData($row,"K4-5",$format);
					
							$format="";
			
			$values["K27-0"] = GetData($row,"K27-0",$format);
					
							$format="Number";
			
			$values["K27-1"] = GetData($row,"K27-1",$format);
					
							$format="Number";
			
			$values["K27-3"] = GetData($row,"K27-3",$format);
					
							$format="Number";
			
			$values["K27-5"] = GetData($row,"K27-5",$format);

		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{			
			$eventRes = $eventObj->BeforeOut($row, $values);
		}
		if ($eventRes)
		{
			$iNumberOfRows++;
			echo "<tr>";

							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
						
			
									$format="";
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["Name"]);
					else
						echo htmlspecialchars($values["Name"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["Esrrb-Chip"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="";
									echo htmlspecialchars($values["E-0"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["E-1"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["E-3"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["E-5"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="";
									echo htmlspecialchars($values["P-0"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["P-1"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["P-3"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["P-5"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="";
									echo htmlspecialchars($values["M-0"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["M-1"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["M-3"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["M-5"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="";
									echo htmlspecialchars($values["K4-0"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["K4-1"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["K4-3"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["K4-5"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="";
									echo htmlspecialchars($values["K27-0"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["K27-1"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["K27-3"]);
			echo '</td>';
							echo '<td>';
						
			
									$format="Number";
									echo htmlspecialchars($values["K27-5"]);
			echo '</td>';
			echo "</tr>";
		}		
		
		
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs);
		else
			$row = db_fetch_array($rs);	
	}
	
}

function XMLNameEncode($strValue)
{	
	$search=array(" ","#","'","/","\\","(",")",",","[");
	$ret=str_replace($search,"",$strValue);
	$search=array("]","+","\"","-","_","|","}","{","=");
	$ret=str_replace($search,"",$ret);
	return $ret;
}

function PrepareForExcel($str)
{
	$ret = htmlspecialchars($str);
	if (substr($ret,0,1)== "=") 
		$ret = "&#61;".substr($ret,1);
	return $ret;

}


?>
