<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("classes/searchclause.php");

add_nocache_headers();

include("include/tbl_name_variables.php");


$all=postvalue("all");

$pageName = "print.php";

include('include/xtempl.php');
include('classes/runnerpage.php');
$xt = new Xtempl();

$id = postvalue("id") != "" ? postvalue("id") : 1;
//array of params for classes
$params = array("pageType" => PAGE_PRINT, "id" =>$id, "tName"=>$strTableName);
$params["xt"] = &$xt;
	
$pageObject = new RunnerPage($params);


// add onload event
$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadPrint", '');
$pageObject->addOnLoadJsEvent($onLoadJsCode);

// add button events if exist
$pageObject->addButtonHandlers();



// Modify query: remove blob fields from fieldlist.
// Blob fields on a print page are shown using imager.php (for example).
// They don't need to be selected from DB in print.php itself.
if(!postvalue("pdf"))
	$gQuery->ReplaceFieldsWithDummies(GetBinaryFieldsIndices());

//	Before Process event
if($eventObj->exists("BeforeProcessPrint"))
	$eventObj->BeforeProcessPrint($conn);

$strWhereClause="";
$strHavingClause="";

$selected_recs=array();
if (@$_REQUEST["a"]!="") 
{
	
	$sWhere = "1=0";	
	
//	process selection
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
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strHavingClause=@$_SESSION[$strTableName."_having"];
	$strSQL = gSQLWhere($strWhereClause, $strHavingClause);
}
if(postvalue("pdf"))
	$strWhereClause = @$_SESSION[$strTableName."_pdfwhere"];

$_SESSION[$strTableName."_pdfwhere"] = $strWhereClause;


$strOrderBy=$_SESSION[$strTableName."_order"];
if(!$strOrderBy)
	$strOrderBy=$gstrOrderBy;
$strSQL.=" ".trim($strOrderBy);

$strSQLbak = $strSQL;
if($eventObj->exists("BeforeQueryPrint"))
	$eventObj->BeforeQueryPrint($strSQL,$strWhereClause,$strOrderBy);

//	Rebuild SQL if needed

if($strSQL!=$strSQLbak)
{
//	changed $strSQL - old style	
	$numrows=GetRowCount($strSQL);
}
else
{
	$strSQL = gSQLWhere($strWhereClause, $strHavingClause);
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
	{
		$numrows = gSQLRowCount($strWhereClause, $strHavingClause);
	}
}

LogInfo($strSQL);

$mypage=(integer)$_SESSION[$strTableName."_pagenumber"];
if(!$mypage)
	$mypage=1;

//	page size
$PageSize=(integer)$_SESSION[$strTableName."_pagesize"];
if(!$PageSize)
	$PageSize = GetTableData($strTableName,".pageSize",0);

if($PageSize<0)
	$all = 1;	
	
$recno = 1;
$records = 0;	
$maxpages = 1;
$pageindex = 1;

if(!$all)
{	
	if($numrows)
	{
		$maxRecords = $numrows;
		$maxpages = ceil($maxRecords/$PageSize);
					
		if($mypage > $maxpages)
			$mypage = $maxpages;
		
		if($mypage < 1) 
			$mypage = 1;
		
		$maxrecs = $PageSize;
	}
	$listarray = false;
	if($eventObj->exists("ListQuery"))
		$listarray = $eventObj->ListQuery($pageObject->searchClauseObj,$_SESSION[$strTableName."_arrFieldForSort"],$_SESSION[$strTableName."_arrHowFieldSort"],$_SESSION[$strTableName."_mastertable"],$masterKeysReq,$selected_recs,$PageSize,$mypage);
	if($listarray!==false)
		$rs = $listarray;
	else
	{
			if($numrows)
		{
			$strSQL.=" limit ".(($mypage-1)*$PageSize).",".$PageSize;
		}
		$rs = db_query($strSQL,$conn);
	}
	
	//	hide colunm headers if needed
	$recordsonpage = $numrows-($mypage-1)*$PageSize;
	if($recordsonpage>$PageSize)
		$recordsonpage = $PageSize;
		
	$xt->assign("page_number",true);
	$xt->assign("maxpages",$maxpages);
	$xt->assign("pageno",$mypage);
}
else
{
	$listarray = false;
	if($eventObj->exists("ListQuery"))
		$listarray=$eventObj->ListQuery($pageObject->searchClauseObj,$_SESSION[$strTableName."_arrFieldForSort"],$_SESSION[$strTableName."_arrHowFieldSort"],$_SESSION[$strTableName."_mastertable"],$masterKeysReq,$selected_recs,$PageSize,$mypage);
	if($listarray!==false)
		$rs = $listarray;
	else
		$rs = db_query($strSQL,$conn);
	$recordsonpage = $numrows;
	$maxpages = ceil($recordsonpage/30);
	$xt->assign("page_number",true);
	$xt->assign("maxpages",$maxpages);
	
}


$fieldsArr = array();
$arr = array();
$arr['fName'] = "Name";
$arr['viewFormat'] = ViewFormat("Name", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Esrrb-Chip";
$arr['viewFormat'] = ViewFormat("Esrrb-Chip", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "E-0";
$arr['viewFormat'] = ViewFormat("E-0", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "E-1";
$arr['viewFormat'] = ViewFormat("E-1", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "E-3";
$arr['viewFormat'] = ViewFormat("E-3", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "E-5";
$arr['viewFormat'] = ViewFormat("E-5", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "P-0";
$arr['viewFormat'] = ViewFormat("P-0", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "P-1";
$arr['viewFormat'] = ViewFormat("P-1", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "P-3";
$arr['viewFormat'] = ViewFormat("P-3", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "P-5";
$arr['viewFormat'] = ViewFormat("P-5", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "M-0";
$arr['viewFormat'] = ViewFormat("M-0", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "M-1";
$arr['viewFormat'] = ViewFormat("M-1", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "M-3";
$arr['viewFormat'] = ViewFormat("M-3", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "M-5";
$arr['viewFormat'] = ViewFormat("M-5", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "K4-0";
$arr['viewFormat'] = ViewFormat("K4-0", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "K4-1";
$arr['viewFormat'] = ViewFormat("K4-1", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "K4-3";
$arr['viewFormat'] = ViewFormat("K4-3", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "K4-5";
$arr['viewFormat'] = ViewFormat("K4-5", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "K27-0";
$arr['viewFormat'] = ViewFormat("K27-0", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "K27-1";
$arr['viewFormat'] = ViewFormat("K27-1", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "K27-3";
$arr['viewFormat'] = ViewFormat("K27-3", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "K27-5";
$arr['viewFormat'] = ViewFormat("K27-5", $strTableName);
$fieldsArr[] = $arr;
$pageObject->setGoogleMapsParams($fieldsArr);

$colsonpage=1;
if($colsonpage>$recordsonpage)
	$colsonpage=$recordsonpage;
if($colsonpage<1)
	$colsonpage=1;


//	fill $rowinfo array
	$pages = array();
	$rowinfo = array();
	$rowinfo["data"]=array();
	if($eventObj->exists("ListFetchArray"))
		$data = $eventObj->ListFetchArray($rs);
	else
		$data = db_fetch_array($rs);	

	while($data)
	{
		if($eventObj->exists("BeforeProcessRowPrint"))
		{
			if(!$eventObj->BeforeProcessRowPrint($data))
			{
				if($eventObj->exists("ListFetchArray"))
					$data = $eventObj->ListFetchArray($rs);
				else
					$data = db_fetch_array($rs);
				continue;
			}
		}
		break;
	}
	
	while($data && ($all || $recno<=$PageSize))
	{
		$row=array();
		$row["grid_record"]=array();
		$row["grid_record"]["data"]=array();
		for($col=1;$data && ($all || $recno<=$PageSize) && $col<=1;$col++)
		{
			$record=array();
			$recno++;
			$records++;
			$keylink="";
			$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["Name"]));


//	Name - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Name", ""),"field=Name".$keylink,"",MODE_PRINT);
			$record["Name_value"]=$value;

//	Esrrb-Chip - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"Esrrb-Chip", "Number"),"field=Esrrb%2DChip".$keylink,"",MODE_PRINT);
			$record["Esrrb_Chip_value"]=$value;

//	E-0 - 
			$value="";
				$value = ProcessLargeText(GetData($data,"E-0", ""),"field=E%2D0".$keylink,"",MODE_PRINT);
			$record["E_0_value"]=$value;

//	E-1 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"E-1", "Number"),"field=E%2D1".$keylink,"",MODE_PRINT);
			$record["E_1_value"]=$value;

//	E-3 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"E-3", "Number"),"field=E%2D3".$keylink,"",MODE_PRINT);
			$record["E_3_value"]=$value;

//	E-5 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"E-5", "Number"),"field=E%2D5".$keylink,"",MODE_PRINT);
			$record["E_5_value"]=$value;

//	P-0 - 
			$value="";
				$value = ProcessLargeText(GetData($data,"P-0", ""),"field=P%2D0".$keylink,"",MODE_PRINT);
			$record["P_0_value"]=$value;

//	P-1 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"P-1", "Number"),"field=P%2D1".$keylink,"",MODE_PRINT);
			$record["P_1_value"]=$value;

//	P-3 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"P-3", "Number"),"field=P%2D3".$keylink,"",MODE_PRINT);
			$record["P_3_value"]=$value;

//	P-5 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"P-5", "Number"),"field=P%2D5".$keylink,"",MODE_PRINT);
			$record["P_5_value"]=$value;

//	M-0 - 
			$value="";
				$value = ProcessLargeText(GetData($data,"M-0", ""),"field=M%2D0".$keylink,"",MODE_PRINT);
			$record["M_0_value"]=$value;

//	M-1 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"M-1", "Number"),"field=M%2D1".$keylink,"",MODE_PRINT);
			$record["M_1_value"]=$value;

//	M-3 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"M-3", "Number"),"field=M%2D3".$keylink,"",MODE_PRINT);
			$record["M_3_value"]=$value;

//	M-5 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"M-5", "Number"),"field=M%2D5".$keylink,"",MODE_PRINT);
			$record["M_5_value"]=$value;

//	K4-0 - 
			$value="";
				$value = ProcessLargeText(GetData($data,"K4-0", ""),"field=K4%2D0".$keylink,"",MODE_PRINT);
			$record["K4_0_value"]=$value;

//	K4-1 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"K4-1", "Number"),"field=K4%2D1".$keylink,"",MODE_PRINT);
			$record["K4_1_value"]=$value;

//	K4-3 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"K4-3", "Number"),"field=K4%2D3".$keylink,"",MODE_PRINT);
			$record["K4_3_value"]=$value;

//	K4-5 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"K4-5", "Number"),"field=K4%2D5".$keylink,"",MODE_PRINT);
			$record["K4_5_value"]=$value;

//	K27-0 - 
			$value="";
				$value = ProcessLargeText(GetData($data,"K27-0", ""),"field=K27%2D0".$keylink,"",MODE_PRINT);
			$record["K27_0_value"]=$value;

//	K27-1 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"K27-1", "Number"),"field=K27%2D1".$keylink,"",MODE_PRINT);
			$record["K27_1_value"]=$value;

//	K27-3 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"K27-3", "Number"),"field=K27%2D3".$keylink,"",MODE_PRINT);
			$record["K27_3_value"]=$value;

//	K27-5 - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"K27-5", "Number"),"field=K27%2D5".$keylink,"",MODE_PRINT);
			$record["K27_5_value"]=$value;
			if($col<$colsonpage)
				$record["endrecord_block"]=true;
			$record["grid_recordheader"]=true;
			$record["grid_vrecord"]=true;
			
			if($eventObj->exists("BeforeMoveNextPrint"))
				$eventObj->BeforeMoveNextPrint($data,$row,$record);
				
			$row["grid_record"]["data"][]=$record;
			
			if($eventObj->exists("ListFetchArray"))
				$data = $eventObj->ListFetchArray($rs);
			else
				$data = db_fetch_array($rs);
				
			while($data)
			{
				if($eventObj->exists("BeforeProcessRowPrint"))
				{
					if(!$eventObj->BeforeProcessRowPrint($data))
					{
						if($eventObj->exists("ListFetchArray"))
							$data = $eventObj->ListFetchArray($rs);
						else
							$data = db_fetch_array($rs);
						continue;
					}
				}
				break;
			}
		}
		if($col<=$colsonpage)
		{
			$row["grid_record"]["data"][count($row["grid_record"]["data"])-1]["endrecord_block"]=false;
		}
		$row["grid_rowspace"]=true;
		$row["grid_recordspace"] = array("data"=>array());
		for($i=0;$i<$colsonpage*2-1;$i++)
			$row["grid_recordspace"]["data"][]=true;
		
		$rowinfo["data"][]=$row;
		
		if($all && $records>=30)
		{
			$page=array("grid_row" =>$rowinfo);
			$page["pageno"]=$pageindex;
			$pageindex++;
			$pages[] = $page;
			$records=0;
			$rowinfo=array();
		}
		
	}
	if(count($rowinfo))
	{
		$page=array("grid_row" =>$rowinfo);
		if($all)
			$page["pageno"]=$pageindex;
		$pages[] = $page;
	}
	
	for($i=0;$i<count($pages);$i++)
	{
	 	if($i<count($pages)-1)
			$pages[$i]["begin"]="<div name=page class=printpage>";
		else
		    $pages[$i]["begin"]="<div name=page>";
			
		$pages[$i]["end"]="</div>";
	}

	$page=array();
	$page["data"]=&$pages;
	$xt->assignbyref("page",$page);

	

$strSQL=$_SESSION[$strTableName."_sql"];

$isPdfView = false;
if (GetTableData($strTableName, ".isUsebuttonHandlers", false) || $isPdfView || $onLoadJsCode)
{
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
	{
		$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
	}	
	$pageObject->fillSetCntrlMaps();
	$pageObject->body['end'] .= '<script>';
	$pageObject->body['end'] .= "window.controlsMap = '".jsreplace(my_json_encode($pageObject->controlsHTMLMap))."';";
	$pageObject->body['end'] .= "window.settings = '".jsreplace(my_json_encode($pageObject->jsSettings))."';";
	$pageObject->body['end'] .= '</script>';
	$pageObject->addCommonJs();		
}


if (GetTableData($strTableName, ".isUsebuttonHandlers", false) || $isPdfView || $onLoadJsCode)
	$pageObject->body["end"] .= "<script>".$pageObject->PrepareJS()."</script>";

$xt->assignbyref("body",$pageObject->body);
$xt->assign("grid_block",true);

$xt->assign("Name_fieldheadercolumn",true);
$xt->assign("Name_fieldheader",true);
$xt->assign("Name_fieldcolumn",true);
$xt->assign("Name_fieldfootercolumn",true);
$xt->assign("Esrrb_Chip_fieldheadercolumn",true);
$xt->assign("Esrrb_Chip_fieldheader",true);
$xt->assign("Esrrb_Chip_fieldcolumn",true);
$xt->assign("Esrrb_Chip_fieldfootercolumn",true);
$xt->assign("E_0_fieldheadercolumn",true);
$xt->assign("E_0_fieldheader",true);
$xt->assign("E_0_fieldcolumn",true);
$xt->assign("E_0_fieldfootercolumn",true);
$xt->assign("E_1_fieldheadercolumn",true);
$xt->assign("E_1_fieldheader",true);
$xt->assign("E_1_fieldcolumn",true);
$xt->assign("E_1_fieldfootercolumn",true);
$xt->assign("E_3_fieldheadercolumn",true);
$xt->assign("E_3_fieldheader",true);
$xt->assign("E_3_fieldcolumn",true);
$xt->assign("E_3_fieldfootercolumn",true);
$xt->assign("E_5_fieldheadercolumn",true);
$xt->assign("E_5_fieldheader",true);
$xt->assign("E_5_fieldcolumn",true);
$xt->assign("E_5_fieldfootercolumn",true);
$xt->assign("P_0_fieldheadercolumn",true);
$xt->assign("P_0_fieldheader",true);
$xt->assign("P_0_fieldcolumn",true);
$xt->assign("P_0_fieldfootercolumn",true);
$xt->assign("P_1_fieldheadercolumn",true);
$xt->assign("P_1_fieldheader",true);
$xt->assign("P_1_fieldcolumn",true);
$xt->assign("P_1_fieldfootercolumn",true);
$xt->assign("P_3_fieldheadercolumn",true);
$xt->assign("P_3_fieldheader",true);
$xt->assign("P_3_fieldcolumn",true);
$xt->assign("P_3_fieldfootercolumn",true);
$xt->assign("P_5_fieldheadercolumn",true);
$xt->assign("P_5_fieldheader",true);
$xt->assign("P_5_fieldcolumn",true);
$xt->assign("P_5_fieldfootercolumn",true);
$xt->assign("M_0_fieldheadercolumn",true);
$xt->assign("M_0_fieldheader",true);
$xt->assign("M_0_fieldcolumn",true);
$xt->assign("M_0_fieldfootercolumn",true);
$xt->assign("M_1_fieldheadercolumn",true);
$xt->assign("M_1_fieldheader",true);
$xt->assign("M_1_fieldcolumn",true);
$xt->assign("M_1_fieldfootercolumn",true);
$xt->assign("M_3_fieldheadercolumn",true);
$xt->assign("M_3_fieldheader",true);
$xt->assign("M_3_fieldcolumn",true);
$xt->assign("M_3_fieldfootercolumn",true);
$xt->assign("M_5_fieldheadercolumn",true);
$xt->assign("M_5_fieldheader",true);
$xt->assign("M_5_fieldcolumn",true);
$xt->assign("M_5_fieldfootercolumn",true);
$xt->assign("K4_0_fieldheadercolumn",true);
$xt->assign("K4_0_fieldheader",true);
$xt->assign("K4_0_fieldcolumn",true);
$xt->assign("K4_0_fieldfootercolumn",true);
$xt->assign("K4_1_fieldheadercolumn",true);
$xt->assign("K4_1_fieldheader",true);
$xt->assign("K4_1_fieldcolumn",true);
$xt->assign("K4_1_fieldfootercolumn",true);
$xt->assign("K4_3_fieldheadercolumn",true);
$xt->assign("K4_3_fieldheader",true);
$xt->assign("K4_3_fieldcolumn",true);
$xt->assign("K4_3_fieldfootercolumn",true);
$xt->assign("K4_5_fieldheadercolumn",true);
$xt->assign("K4_5_fieldheader",true);
$xt->assign("K4_5_fieldcolumn",true);
$xt->assign("K4_5_fieldfootercolumn",true);
$xt->assign("K27_0_fieldheadercolumn",true);
$xt->assign("K27_0_fieldheader",true);
$xt->assign("K27_0_fieldcolumn",true);
$xt->assign("K27_0_fieldfootercolumn",true);
$xt->assign("K27_1_fieldheadercolumn",true);
$xt->assign("K27_1_fieldheader",true);
$xt->assign("K27_1_fieldcolumn",true);
$xt->assign("K27_1_fieldfootercolumn",true);
$xt->assign("K27_3_fieldheadercolumn",true);
$xt->assign("K27_3_fieldheader",true);
$xt->assign("K27_3_fieldcolumn",true);
$xt->assign("K27_3_fieldfootercolumn",true);
$xt->assign("K27_5_fieldheadercolumn",true);
$xt->assign("K27_5_fieldheader",true);
$xt->assign("K27_5_fieldcolumn",true);
$xt->assign("K27_5_fieldfootercolumn",true);

	$record_header=array("data"=>array());
	for($i=0;$i<$colsonpage;$i++)
	{
		$rheader=array();
		if($i<$colsonpage-1)
		{
			$rheader["endrecordheader_block"]=true;
		}
		$record_header["data"][]=$rheader;
	}
	$xt->assignbyref("record_header",$record_header);
	$xt->assign("grid_header",true);
	$xt->assign("grid_footer",true);


$templatefile = "tbl_name_print.htm";
	
if($eventObj->exists("BeforeShowPrint"))
	$eventObj->BeforeShowPrint($xt,$templatefile);

if(!postvalue("pdf"))
	$xt->display($templatefile);
else
{
	$xt->load_template($templatefile);
	$page = $xt->fetch_loaded();
	$pagewidth=postvalue("width")*1.05;
	$pageheight=postvalue("height")*1.05;
	$landscape=false;
	if(postvalue("all"))
	{
		if($pagewidth>$pageheight)
		{
			$landscape=true;
			if($pagewidth/$pageheight<297/210)
				$pagewidth = 297/210*$pageheight;
		}
		else
		{
			if($pagewidth/$pageheight<210/297)
				$pagewidth = 210/297*$pageheight;
		}
	}
}

?>
