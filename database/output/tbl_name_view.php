<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/tbl_name_variables.php");

add_nocache_headers();


include('include/xtempl.php');
include('classes/runnerpage.php');
include("classes/searchclause.php");
$xt = new Xtempl();


$query = $gQuery->Copy();

$filename = "";	
$message = "";
$key = array();
$next = array();
$prev = array();
$all = postvalue("all");
$pdf = postvalue("pdf");
$mypage = 1;

//Show view page as popUp or not
$inlineview = (postvalue("onFly") ? true : false);

//If show view as popUp, get parent Id
if($inlineview)
	$parId = postvalue("parId");
else
	$parId = 0;

//Set page id	
if(postvalue("id"))
	$id = postvalue("id");
else
	$id = 1;

//$isNeedSettings = true;//($inlineview && postvalue("isNeedSettings") == 'true') || (!$inlineview);	
	
// assign an id			
$xt->assign("id",$id);

//array of params for classes
$params = array("pageType" => PAGE_VIEW, "id" =>$id, "tName"=>$strTableName);
$params["xt"] = &$xt;
//Get array of tabs for edit page
$params['useTabsOnView'] = useTabsOnView($strTableName);
if($params['useTabsOnView'])
	$params['arrViewTabs'] = GetViewTabs($strTableName);
$pageObject = new RunnerPage($params);

// SearchClause class stuff
$pageObject->searchClauseObj->parseRequest();
$_SESSION[$strTableName.'_advsearch'] = serialize($pageObject->searchClauseObj);

// proccess big google maps

// add onload event
$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadView", '');
$pageObject->addOnLoadJsEvent($onLoadJsCode);

// add button events if exist
$pageObject->addButtonHandlers();

//For show detail tables on master page view
$dpParams = array();
if($pageObject->isShowDetailTables)
{
	$ids = $id;
	$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array('tableNames'=>$dpParams['strTableNames'], 'ids'=>$dpParams['ids']);
	$pageObject->AddJSFile("include/detailspreview");
}


//	Before Process event
if($eventObj->exists("BeforeProcessView"))
	$eventObj->BeforeProcessView($conn);

$strWhereClause = '';
$strHavingClause = '';
if(!$all)
{
//	show one record only
	$keys=array();
	$strWhereClause="";
	$keys["Name"]=postvalue("editid1");
	$strWhereClause = KeyWhere($keys);
	$strSQL = gSQLWhere($strWhereClause);
}
else
{
	if ($_SESSION[$strTableName."_SelectedSQL"]!="" && @$_REQUEST["records"]=="") 
	{
		$strSQL = $_SESSION[$strTableName."_SelectedSQL"];
		$strWhereClause=@$_SESSION[$strTableName."_SelectedWhere"];
	}
	else
	{
		$strWhereClause=@$_SESSION[$strTableName."_where"];
		$strHavingClause=@$_SESSION[$strTableName."_having"];
		$strSQL=gSQLWhere($strWhereClause,$strHavingClause);
	}
//	order by
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);
}

$strSQLbak = $strSQL;
if($eventObj->exists("BeforeQueryView"))
	$eventObj->BeforeQueryView($strSQL,$strWhereClause);
if($strSQLbak == $strSQL)
{
	$strSQL=gSQLWhere($strWhereClause,$strHavingClause);
	if($all)
	{
		$numrows=gSQLRowCount($strWhereClause,$strHavingClause);
		$strSQL.=" ".trim($strOrderBy);
	}
}
else
{
//	changed $strSQL - old style	
	if($all)
	{
		$numrows=GetRowCount($strSQL);
	}
}

if(!$all)
{
	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
}
else
{
//	 Pagination:
	$nPageSize=0;
	if(@$_REQUEST["records"]=="page" && $numrows)
	{
		$mypage=(integer)@$_SESSION[$strTableName."_pagenumber"];
		$nPageSize=(integer)@$_SESSION[$strTableName."_pagesize"];
		if($numrows<=($mypage-1)*$nPageSize)
			$mypage=ceil($numrows/$nPageSize);
		if(!$nPageSize)
			$nPageSize=$gPageSize;
		if(!$mypage)
			$mypage=1;
		$strSQL.=" limit ".(($mypage-1)*$nPageSize).",".$nPageSize;
	}
	$rs=db_query($strSQL,$conn);
}

$data=db_fetch_array($rs);

if($eventObj->exists("ProcessValuesView"))
	$eventObj->ProcessValuesView($data);

$out="";
$first=true;

$templatefile="";
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

while($data)
{
	$xt->assign("show_key1", htmlspecialchars(GetData($data,"Name", "")));

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["Name"]));

////////////////////////////////////////////
//Name - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"Name", ""),"","",MODE_VIEW);
	$xt->assign("Name_value",$value);
	if(!$pageObject->isAppearOnTabs("Name"))
		$xt->assign("Name_fieldblock",true);
	else
		$xt->assign("Name_tabfieldblock",true);
////////////////////////////////////////////
//Esrrb-Chip - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"Esrrb-Chip", "Number"),"","",MODE_VIEW);
	$xt->assign("Esrrb_Chip_value",$value);
	if(!$pageObject->isAppearOnTabs("Esrrb-Chip"))
		$xt->assign("Esrrb_Chip_fieldblock",true);
	else
		$xt->assign("Esrrb_Chip_tabfieldblock",true);
////////////////////////////////////////////
//E-0 - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"E-0", ""),"","",MODE_VIEW);
	$xt->assign("E_0_value",$value);
	if(!$pageObject->isAppearOnTabs("E-0"))
		$xt->assign("E_0_fieldblock",true);
	else
		$xt->assign("E_0_tabfieldblock",true);
////////////////////////////////////////////
//E-1 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"E-1", "Number"),"","",MODE_VIEW);
	$xt->assign("E_1_value",$value);
	if(!$pageObject->isAppearOnTabs("E-1"))
		$xt->assign("E_1_fieldblock",true);
	else
		$xt->assign("E_1_tabfieldblock",true);
////////////////////////////////////////////
//E-3 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"E-3", "Number"),"","",MODE_VIEW);
	$xt->assign("E_3_value",$value);
	if(!$pageObject->isAppearOnTabs("E-3"))
		$xt->assign("E_3_fieldblock",true);
	else
		$xt->assign("E_3_tabfieldblock",true);
////////////////////////////////////////////
//E-5 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"E-5", "Number"),"","",MODE_VIEW);
	$xt->assign("E_5_value",$value);
	if(!$pageObject->isAppearOnTabs("E-5"))
		$xt->assign("E_5_fieldblock",true);
	else
		$xt->assign("E_5_tabfieldblock",true);
////////////////////////////////////////////
//P-0 - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"P-0", ""),"","",MODE_VIEW);
	$xt->assign("P_0_value",$value);
	if(!$pageObject->isAppearOnTabs("P-0"))
		$xt->assign("P_0_fieldblock",true);
	else
		$xt->assign("P_0_tabfieldblock",true);
////////////////////////////////////////////
//P-1 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"P-1", "Number"),"","",MODE_VIEW);
	$xt->assign("P_1_value",$value);
	if(!$pageObject->isAppearOnTabs("P-1"))
		$xt->assign("P_1_fieldblock",true);
	else
		$xt->assign("P_1_tabfieldblock",true);
////////////////////////////////////////////
//P-3 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"P-3", "Number"),"","",MODE_VIEW);
	$xt->assign("P_3_value",$value);
	if(!$pageObject->isAppearOnTabs("P-3"))
		$xt->assign("P_3_fieldblock",true);
	else
		$xt->assign("P_3_tabfieldblock",true);
////////////////////////////////////////////
//P-5 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"P-5", "Number"),"","",MODE_VIEW);
	$xt->assign("P_5_value",$value);
	if(!$pageObject->isAppearOnTabs("P-5"))
		$xt->assign("P_5_fieldblock",true);
	else
		$xt->assign("P_5_tabfieldblock",true);
////////////////////////////////////////////
//M-0 - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"M-0", ""),"","",MODE_VIEW);
	$xt->assign("M_0_value",$value);
	if(!$pageObject->isAppearOnTabs("M-0"))
		$xt->assign("M_0_fieldblock",true);
	else
		$xt->assign("M_0_tabfieldblock",true);
////////////////////////////////////////////
//M-1 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"M-1", "Number"),"","",MODE_VIEW);
	$xt->assign("M_1_value",$value);
	if(!$pageObject->isAppearOnTabs("M-1"))
		$xt->assign("M_1_fieldblock",true);
	else
		$xt->assign("M_1_tabfieldblock",true);
////////////////////////////////////////////
//M-3 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"M-3", "Number"),"","",MODE_VIEW);
	$xt->assign("M_3_value",$value);
	if(!$pageObject->isAppearOnTabs("M-3"))
		$xt->assign("M_3_fieldblock",true);
	else
		$xt->assign("M_3_tabfieldblock",true);
////////////////////////////////////////////
//M-5 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"M-5", "Number"),"","",MODE_VIEW);
	$xt->assign("M_5_value",$value);
	if(!$pageObject->isAppearOnTabs("M-5"))
		$xt->assign("M_5_fieldblock",true);
	else
		$xt->assign("M_5_tabfieldblock",true);
////////////////////////////////////////////
//K4-0 - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"K4-0", ""),"","",MODE_VIEW);
	$xt->assign("K4_0_value",$value);
	if(!$pageObject->isAppearOnTabs("K4-0"))
		$xt->assign("K4_0_fieldblock",true);
	else
		$xt->assign("K4_0_tabfieldblock",true);
////////////////////////////////////////////
//K4-1 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"K4-1", "Number"),"","",MODE_VIEW);
	$xt->assign("K4_1_value",$value);
	if(!$pageObject->isAppearOnTabs("K4-1"))
		$xt->assign("K4_1_fieldblock",true);
	else
		$xt->assign("K4_1_tabfieldblock",true);
////////////////////////////////////////////
//K4-3 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"K4-3", "Number"),"","",MODE_VIEW);
	$xt->assign("K4_3_value",$value);
	if(!$pageObject->isAppearOnTabs("K4-3"))
		$xt->assign("K4_3_fieldblock",true);
	else
		$xt->assign("K4_3_tabfieldblock",true);
////////////////////////////////////////////
//K4-5 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"K4-5", "Number"),"","",MODE_VIEW);
	$xt->assign("K4_5_value",$value);
	if(!$pageObject->isAppearOnTabs("K4-5"))
		$xt->assign("K4_5_fieldblock",true);
	else
		$xt->assign("K4_5_tabfieldblock",true);
////////////////////////////////////////////
//K27-0 - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"K27-0", ""),"","",MODE_VIEW);
	$xt->assign("K27_0_value",$value);
	if(!$pageObject->isAppearOnTabs("K27-0"))
		$xt->assign("K27_0_fieldblock",true);
	else
		$xt->assign("K27_0_tabfieldblock",true);
////////////////////////////////////////////
//K27-1 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"K27-1", "Number"),"","",MODE_VIEW);
	$xt->assign("K27_1_value",$value);
	if(!$pageObject->isAppearOnTabs("K27-1"))
		$xt->assign("K27_1_fieldblock",true);
	else
		$xt->assign("K27_1_tabfieldblock",true);
////////////////////////////////////////////
//K27-3 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"K27-3", "Number"),"","",MODE_VIEW);
	$xt->assign("K27_3_value",$value);
	if(!$pageObject->isAppearOnTabs("K27-3"))
		$xt->assign("K27_3_fieldblock",true);
	else
		$xt->assign("K27_3_tabfieldblock",true);
////////////////////////////////////////////
//K27-5 - Number
	
	$value="";
	$value = ProcessLargeText(GetData($data,"K27-5", "Number"),"","",MODE_VIEW);
	$xt->assign("K27_5_value",$value);
	if(!$pageObject->isAppearOnTabs("K27-5"))
		$xt->assign("K27_5_fieldblock",true);
	else
		$xt->assign("K27_5_tabfieldblock",true);

$jsKeysObj = 'window.recKeysObj = {';
	$jsKeysObj .= "'".jsreplace("Name")."': '".(jsreplace(@$data["Name"]))."', ";
$jsKeysObj = substr($jsKeysObj, 0, strlen($jsKeysObj)-2);
$jsKeysObj .= '};';
$pageObject->AddJsCode($jsKeysObj);	

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables)
{
	$options = array();
	//array of params for classes
	$options["mode"] = LIST_DETAILS;
	$options["pageType"] = PAGE_LIST;
	$options["masterPageType"] = PAGE_VIEW;
	$options["mainMasterPageType"] = PAGE_VIEW;
	$options['masterTable'] = $strTableName;
	$options['firstTime'] = 1;
	
	if(count($dpParams['ids']))
	{
		$xt->assign("detail_tables",true);
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
	}
	
	$dControlsMap = array();
	
	$flyId = $ids+1;
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$strTableName = $dpParams['strTableNames'][$d];
		include("include/".GetTableURL($strTableName)."_settings.php");
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
		{
			$strTableName = "tbl_name";		
			continue;
		}
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];
		$options['flyId'] = $flyId++;
		$mkr=1;
		foreach($mKeys[$strTableName] as $mk)
			$options['masterKeysReq'][$mkr++] = $data[$mk];

		$listPageObject = ListPage::createListPage($strTableName, $options);
		// prepare code
		$listPageObject->prepareForBuildPage();
		$flyId = $listPageObject->recId+1;
		// show page
		if(!$pdf && $listPageObject->isDispGrid())
		{
			//add detail settings to master settings
			$listPageObject->fillSetCntrlMaps();
			$pageObject->jsSettings['tableSettings'][$strTableName]	= $listPageObject->jsSettings['tableSettings'][$strTableName];				
			$dControlsMap[$strTableName]['video'] = $listPageObject->controlsHTMLMap[$strTableName][PAGE_LIST][$dpParams['ids'][$d]]['video'];
			$dControlsMap[$strTableName]['gMaps'] = $listPageObject->controlsHTMLMap[$strTableName][PAGE_LIST][$dpParams['ids'][$d]]['gMaps'];
			foreach($listPageObject->jsSettings['global']['shortTNames'] as $keySet=>$val)
			{
				if(!array_key_exists($keySet,$pageObject->settingsMap["globalSettings"]['shortTNames']))
					$pageObject->settingsMap["globalSettings"]['shortTNames'][$keySet] = $val;
			}		
			
			//Add detail's js files to master's files
			$pageObject->copyAllJSFiles($listPageObject->grabAllJSFiles());
			
			//Add detail's css files to master's files	
			$pageObject->copyAllCSSFiles($listPageObject->grabAllCSSFiles());
		}
		$xt->assign("displayDetailTable_".GoodFieldName($strTableName), array("func" => "showDetailTable","params" => array("dpObject" => $listPageObject, "dpParams" => $strTableName)));
	}	
	$strTableName = "tbl_name";		
	$pageObject->controlsMap['dControlsMap'] = $dControlsMap;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin prepare for Next Prev button
if(!@$_SESSION[$strTableName."_noNextPrev"] && !$inlineview && !$pdf)
{
	$pageObject->getNextPrevRecordKeys($data,"Search",$next,$prev);
}	
//End prepare for Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	
if ($pageObject->googleMapCfg['isUseGoogleMap'])
{
	$pageObject->initGmaps();
}

$pageObject->addCommonJs();

//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();
	
if(!$inlineview)
{
	$pageObject->body["begin"].= "<div id=\"master_details\" onmouseover=\"RollDetailsLink.showPopup();\" onmouseout=\"RollDetailsLink.hidePopup();\"> </div>";
	$pageObject->body["begin"].="<script type=\"text/javascript\" src=\"include/jquery.js\"></script>\r\n";
	$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
	if ($pageObject->debugJSMode === true)
	{			
		/*$pageObject->body["begin"].="<script type=\"text/javascript\" src=\"include/runnerJS/Runner.js\"></script>\r\n".
			"<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>\r\n".
			"<script type=\"text/javascript\" src=\"include/runnerJS/Observer.js\"></script>\r\n";*/
			$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";	
	}
	else
	{
		$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
	}
		$pageObject->jsSettings['tableSettings'][$strTableName]["keys"] = $keys;
	$pageObject->jsSettings['tableSettings'][$strTableName]["prevKeys"] = $prev;
	$pageObject->jsSettings['tableSettings'][$strTableName]["nextKeys"] = $next; 
		
	$pageObject->body["end"].="<script>".$pageObject->PrepareJS()."</script>";	
	
	// assign body end
	$pageObject->body['end'] = array();
	$pageObject->body['end']["method"] = "assignBodyEnd";		
	$pageObject->body['end']["object"] = &$pageObject;	
	
	$xt->assignbyref("body",$pageObject->body);
	$xt->assign("flybody",true);
}
else
{
	$xt->assign("footer","");
	$xt->assign("flybody",$pageObject->body);
	$xt->assign("body",true);
	
	$pageObject->fillSetCntrlMaps();
	
	$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
	$returnJSON['settings'] = $pageObject->jsSettings;	
}
$xt->assign("style_block",true);
$xt->assign("stylefiles_block",true);

if(!$pdf && !$all && !$inlineview)
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin show Next Prev button
    $nextlink=$prevlink="";
	if(count($next))
    {
		$xt->assign("next_button",true);
	 		$nextlink .="editid1=".htmlspecialchars(rawurlencode($next[1]));
		$xt->assign("nextbutton_attrs","id=\"nextButton".$id."\" onclick=\"window.location.href='tbl_name_view.php?".$nextlink."'\"");
	}
	else 
		$xt->assign("next_button",false);	
	if(count($prev))
	{
		$xt->assign("prev_button",true);
			$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1]));
		$xt->assign("prevbutton_attrs","id=\"prevButton".$id."\" onclick=\"window.location.href='tbl_name_view.php?".$prevlink."'\"");
	}
    else 
		$xt->assign("prev_button",false);
//End show Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$xt->assign("back_button",true);
	$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
}

$oldtemplatefile=$templatefile;
$templatefile = "tbl_name_view.htm";

if(!$all)
{
	if($eventObj->exists("BeforeShowView"))
		$eventObj->BeforeShowView($xt,$templatefile,$data);
	
	if(!$pdf)
	{
		if(!$inlineview)
			$xt->display($templatefile);
		else{
				$xt->load_template($templatefile);
				$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('flybody');
				if($pageObject->isShowDetailTables)
					$returnJSON['html'].= $xt->fetch_loaded('detail_tables');
				$returnJSON['idStartFrom'] = $id+1;
				echo (my_json_encode($returnJSON)); 
			}
	}	
	break;
}
}


?>
