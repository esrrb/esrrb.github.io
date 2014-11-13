<?php
$tdatatbl_name=array();
	$tdatatbl_name[".NumberOfChars"]=80; 
	$tdatatbl_name[".ShortName"]="tbl_name";
	$tdatatbl_name[".OwnerID"]="";
	$tdatatbl_name[".OriginalTable"]="tbl_name";


	
//	field labels
$fieldLabelstbl_name = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelstbl_name["English"]=array();
	$fieldToolTipstbl_name["English"]=array();
	$fieldLabelstbl_name["English"]["Name"] = "Name";
	$fieldToolTipstbl_name["English"]["Name"] = "";
	$fieldLabelstbl_name["English"]["Esrrb_Chip"] = "Esrrb-Chip";
	$fieldToolTipstbl_name["English"]["Esrrb-Chip"] = "";
	$fieldLabelstbl_name["English"]["E_0"] = "E-0";
	$fieldToolTipstbl_name["English"]["E-0"] = "";
	$fieldLabelstbl_name["English"]["E_1"] = "E-1";
	$fieldToolTipstbl_name["English"]["E-1"] = "";
	$fieldLabelstbl_name["English"]["E_3"] = "E-3";
	$fieldToolTipstbl_name["English"]["E-3"] = "";
	$fieldLabelstbl_name["English"]["E_5"] = "E-5";
	$fieldToolTipstbl_name["English"]["E-5"] = "";
	$fieldLabelstbl_name["English"]["P_0"] = "P-0";
	$fieldToolTipstbl_name["English"]["P-0"] = "";
	$fieldLabelstbl_name["English"]["P_1"] = "P-1";
	$fieldToolTipstbl_name["English"]["P-1"] = "";
	$fieldLabelstbl_name["English"]["P_3"] = "P-3";
	$fieldToolTipstbl_name["English"]["P-3"] = "";
	$fieldLabelstbl_name["English"]["P_5"] = "P-5";
	$fieldToolTipstbl_name["English"]["P-5"] = "";
	$fieldLabelstbl_name["English"]["M_0"] = "M-0";
	$fieldToolTipstbl_name["English"]["M-0"] = "";
	$fieldLabelstbl_name["English"]["M_1"] = "M-1";
	$fieldToolTipstbl_name["English"]["M-1"] = "";
	$fieldLabelstbl_name["English"]["M_3"] = "M-3";
	$fieldToolTipstbl_name["English"]["M-3"] = "";
	$fieldLabelstbl_name["English"]["M_5"] = "M-5";
	$fieldToolTipstbl_name["English"]["M-5"] = "";
	$fieldLabelstbl_name["English"]["K4_0"] = "K4-0";
	$fieldToolTipstbl_name["English"]["K4-0"] = "";
	$fieldLabelstbl_name["English"]["K4_1"] = "K4-1";
	$fieldToolTipstbl_name["English"]["K4-1"] = "";
	$fieldLabelstbl_name["English"]["K4_3"] = "K4-3";
	$fieldToolTipstbl_name["English"]["K4-3"] = "";
	$fieldLabelstbl_name["English"]["K4_5"] = "K4-5";
	$fieldToolTipstbl_name["English"]["K4-5"] = "";
	$fieldLabelstbl_name["English"]["K27_0"] = "K27-0";
	$fieldToolTipstbl_name["English"]["K27-0"] = "";
	$fieldLabelstbl_name["English"]["K27_1"] = "K27-1";
	$fieldToolTipstbl_name["English"]["K27-1"] = "";
	$fieldLabelstbl_name["English"]["K27_3"] = "K27-3";
	$fieldToolTipstbl_name["English"]["K27-3"] = "";
	$fieldLabelstbl_name["English"]["K27_5"] = "K27-5";
	$fieldToolTipstbl_name["English"]["K27-5"] = "";
	if (count($fieldToolTipstbl_name["English"])){
		$tdatatbl_name[".isUseToolTips"]=true;
	}
}


	
	$tdatatbl_name[".NCSearch"]=true;

	

$tdatatbl_name[".shortTableName"] = "tbl_name";
$tdatatbl_name[".nSecOptions"] = 0;
$tdatatbl_name[".recsPerRowList"] = 1;	
$tdatatbl_name[".tableGroupBy"] = "0";
$tdatatbl_name[".mainTableOwnerID"] = "";
$tdatatbl_name[".moveNext"] = 1;




$tdatatbl_name[".showAddInPopup"] = false;

$tdatatbl_name[".showEditInPopup"] = false;

$tdatatbl_name[".showViewInPopup"] = false;


$tdatatbl_name[".fieldsForRegister"] = array();

$tdatatbl_name[".listAjax"] = false;

	$tdatatbl_name[".audit"] = false;

	$tdatatbl_name[".locking"] = false;
	
$tdatatbl_name[".listIcons"] = true;
$tdatatbl_name[".view"] = true;

$tdatatbl_name[".exportTo"] = true;

$tdatatbl_name[".printFriendly"] = true;


$tdatatbl_name[".showSimpleSearchOptions"] = false;

$tdatatbl_name[".showSearchPanel"] = true;


$tdatatbl_name[".isUseAjaxSuggest"] = true;

$tdatatbl_name[".rowHighlite"] = true;


// button handlers file names

$tdatatbl_name[".addPageEvents"] = false;

$tdatatbl_name[".arrKeyFields"][] = "Name";

// use datepicker for search panel
$tdatatbl_name[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdatatbl_name[".isUseTimeForSearch"] = false;

$tdatatbl_name[".isUseiBox"] = false;




$tdatatbl_name[".isUseInlineJs"] = $tdatatbl_name[".isUseInlineAdd"] || $tdatatbl_name[".isUseInlineEdit"];

$tdatatbl_name[".allSearchFields"] = array();

$tdatatbl_name[".globSearchFields"][] = "Name";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Name", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "Name";	
}
$tdatatbl_name[".globSearchFields"][] = "Esrrb-Chip";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Esrrb-Chip", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "Esrrb-Chip";	
}
$tdatatbl_name[".globSearchFields"][] = "E-0";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("E-0", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "E-0";	
}
$tdatatbl_name[".globSearchFields"][] = "E-1";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("E-1", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "E-1";	
}
$tdatatbl_name[".globSearchFields"][] = "E-3";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("E-3", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "E-3";	
}
$tdatatbl_name[".globSearchFields"][] = "E-5";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("E-5", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "E-5";	
}
$tdatatbl_name[".globSearchFields"][] = "P-0";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("P-0", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "P-0";	
}
$tdatatbl_name[".globSearchFields"][] = "P-1";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("P-1", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "P-1";	
}
$tdatatbl_name[".globSearchFields"][] = "P-3";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("P-3", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "P-3";	
}
$tdatatbl_name[".globSearchFields"][] = "P-5";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("P-5", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "P-5";	
}
$tdatatbl_name[".globSearchFields"][] = "M-0";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("M-0", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "M-0";	
}
$tdatatbl_name[".globSearchFields"][] = "M-1";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("M-1", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "M-1";	
}
$tdatatbl_name[".globSearchFields"][] = "M-3";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("M-3", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "M-3";	
}
$tdatatbl_name[".globSearchFields"][] = "M-5";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("M-5", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "M-5";	
}
$tdatatbl_name[".globSearchFields"][] = "K4-0";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K4-0", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "K4-0";	
}
$tdatatbl_name[".globSearchFields"][] = "K4-1";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K4-1", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "K4-1";	
}
$tdatatbl_name[".globSearchFields"][] = "K4-3";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K4-3", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "K4-3";	
}
$tdatatbl_name[".globSearchFields"][] = "K4-5";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K4-5", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "K4-5";	
}
$tdatatbl_name[".globSearchFields"][] = "K27-0";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K27-0", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "K27-0";	
}
$tdatatbl_name[".globSearchFields"][] = "K27-1";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K27-1", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "K27-1";	
}
$tdatatbl_name[".globSearchFields"][] = "K27-3";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K27-3", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "K27-3";	
}
$tdatatbl_name[".globSearchFields"][] = "K27-5";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K27-5", $tdatatbl_name[".allSearchFields"]))
{
	$tdatatbl_name[".allSearchFields"][] = "K27-5";	
}


$tdatatbl_name[".googleLikeFields"][] = "Name";
$tdatatbl_name[".googleLikeFields"][] = "Esrrb-Chip";
$tdatatbl_name[".googleLikeFields"][] = "E-0";
$tdatatbl_name[".googleLikeFields"][] = "E-1";
$tdatatbl_name[".googleLikeFields"][] = "E-3";
$tdatatbl_name[".googleLikeFields"][] = "E-5";
$tdatatbl_name[".googleLikeFields"][] = "P-0";
$tdatatbl_name[".googleLikeFields"][] = "P-1";
$tdatatbl_name[".googleLikeFields"][] = "P-3";
$tdatatbl_name[".googleLikeFields"][] = "P-5";
$tdatatbl_name[".googleLikeFields"][] = "M-0";
$tdatatbl_name[".googleLikeFields"][] = "M-1";
$tdatatbl_name[".googleLikeFields"][] = "M-3";
$tdatatbl_name[".googleLikeFields"][] = "M-5";
$tdatatbl_name[".googleLikeFields"][] = "K4-0";
$tdatatbl_name[".googleLikeFields"][] = "K4-1";
$tdatatbl_name[".googleLikeFields"][] = "K4-3";
$tdatatbl_name[".googleLikeFields"][] = "K4-5";
$tdatatbl_name[".googleLikeFields"][] = "K27-0";
$tdatatbl_name[".googleLikeFields"][] = "K27-1";
$tdatatbl_name[".googleLikeFields"][] = "K27-3";
$tdatatbl_name[".googleLikeFields"][] = "K27-5";



$tdatatbl_name[".advSearchFields"][] = "Name";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Name", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "Name";	
}
$tdatatbl_name[".advSearchFields"][] = "Esrrb-Chip";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Esrrb-Chip", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "Esrrb-Chip";	
}
$tdatatbl_name[".advSearchFields"][] = "E-0";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("E-0", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "E-0";	
}
$tdatatbl_name[".advSearchFields"][] = "E-1";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("E-1", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "E-1";	
}
$tdatatbl_name[".advSearchFields"][] = "E-3";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("E-3", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "E-3";	
}
$tdatatbl_name[".advSearchFields"][] = "E-5";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("E-5", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "E-5";	
}
$tdatatbl_name[".advSearchFields"][] = "P-0";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("P-0", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "P-0";	
}
$tdatatbl_name[".advSearchFields"][] = "P-1";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("P-1", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "P-1";	
}
$tdatatbl_name[".advSearchFields"][] = "P-3";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("P-3", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "P-3";	
}
$tdatatbl_name[".advSearchFields"][] = "P-5";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("P-5", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "P-5";	
}
$tdatatbl_name[".advSearchFields"][] = "M-0";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("M-0", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "M-0";	
}
$tdatatbl_name[".advSearchFields"][] = "M-1";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("M-1", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "M-1";	
}
$tdatatbl_name[".advSearchFields"][] = "M-3";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("M-3", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "M-3";	
}
$tdatatbl_name[".advSearchFields"][] = "M-5";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("M-5", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "M-5";	
}
$tdatatbl_name[".advSearchFields"][] = "K4-0";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K4-0", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "K4-0";	
}
$tdatatbl_name[".advSearchFields"][] = "K4-1";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K4-1", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "K4-1";	
}
$tdatatbl_name[".advSearchFields"][] = "K4-3";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K4-3", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "K4-3";	
}
$tdatatbl_name[".advSearchFields"][] = "K4-5";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K4-5", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "K4-5";	
}
$tdatatbl_name[".advSearchFields"][] = "K27-0";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K27-0", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "K27-0";	
}
$tdatatbl_name[".advSearchFields"][] = "K27-1";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K27-1", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "K27-1";	
}
$tdatatbl_name[".advSearchFields"][] = "K27-3";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K27-3", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "K27-3";	
}
$tdatatbl_name[".advSearchFields"][] = "K27-5";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("K27-5", $tdatatbl_name[".allSearchFields"])) 
{
	$tdatatbl_name[".allSearchFields"][] = "K27-5";	
}

$tdatatbl_name[".isTableType"] = "list";


	

$tdatatbl_name[".isDisplayLoading"] = true;

$tdatatbl_name[".isResizeColumns"] = false;





$tdatatbl_name[".pageSize"] = 20;

$gstrOrderBy = "";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdatatbl_name[".strOrderBy"] = $gstrOrderBy;
	
$tdatatbl_name[".orderindexes"] = array();

$tdatatbl_name[".sqlHead"] = "SELECT Name,  `Esrrb-Chip`,  `E-0`,  `E-1`,  `E-3`,  `E-5`,  `P-0`,  `P-1`,  `P-3`,  `P-5`,  `M-0`,  `M-1`,  `M-3`,  `M-5`,  `K4-0`,  `K4-1`,  `K4-3`,  `K4-5`,  `K27-0`,  `K27-1`,  `K27-3`,  `K27-5`";
$tdatatbl_name[".sqlFrom"] = "FROM tbl_name";
$tdatatbl_name[".sqlWhereExpr"] = "";
$tdatatbl_name[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatatbl_name[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatatbl_name[".arrGroupsPerPage"] = $arrGPP;

	$tableKeys = array();
	$tableKeys[] = "Name";
	$tdatatbl_name[".Keys"] = $tableKeys;

//	Name
	$fdata = array();
	$fdata["strName"] = "Name";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Name";
	
		$fdata["FullName"]= "Name";
	
		
		
		
		
		
				$fdata["Index"]= 1;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=13";
		
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["Name"]=$fdata;
//	Esrrb-Chip
	$fdata = array();
	$fdata["strName"] = "Esrrb-Chip";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Esrrb_Chip";
	
		$fdata["FullName"]= "`Esrrb-Chip`";
	
		
		
		
		
		
				$fdata["Index"]= 2;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["Esrrb-Chip"]=$fdata;
//	E-0
	$fdata = array();
	$fdata["strName"] = "E-0";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "E_0";
	
		$fdata["FullName"]= "`E-0`";
	
		
		
		
		
		
				$fdata["Index"]= 3;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["E-0"]=$fdata;
//	E-1
	$fdata = array();
	$fdata["strName"] = "E-1";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "E_1";
	
		$fdata["FullName"]= "`E-1`";
	
		
		
		
		
		
				$fdata["Index"]= 4;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["E-1"]=$fdata;
//	E-3
	$fdata = array();
	$fdata["strName"] = "E-3";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "E_3";
	
		$fdata["FullName"]= "`E-3`";
	
		
		
		
		
		
				$fdata["Index"]= 5;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["E-3"]=$fdata;
//	E-5
	$fdata = array();
	$fdata["strName"] = "E-5";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "E_5";
	
		$fdata["FullName"]= "`E-5`";
	
		
		
		
		
		
				$fdata["Index"]= 6;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["E-5"]=$fdata;
//	P-0
	$fdata = array();
	$fdata["strName"] = "P-0";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "P_0";
	
		$fdata["FullName"]= "`P-0`";
	
		
		
		
		
		
				$fdata["Index"]= 7;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["P-0"]=$fdata;
//	P-1
	$fdata = array();
	$fdata["strName"] = "P-1";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "P_1";
	
		$fdata["FullName"]= "`P-1`";
	
		
		
		
		
		
				$fdata["Index"]= 8;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["P-1"]=$fdata;
//	P-3
	$fdata = array();
	$fdata["strName"] = "P-3";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "P_3";
	
		$fdata["FullName"]= "`P-3`";
	
		
		
		
		
		
				$fdata["Index"]= 9;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["P-3"]=$fdata;
//	P-5
	$fdata = array();
	$fdata["strName"] = "P-5";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "P_5";
	
		$fdata["FullName"]= "`P-5`";
	
		
		
		
		
		
				$fdata["Index"]= 10;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["P-5"]=$fdata;
//	M-0
	$fdata = array();
	$fdata["strName"] = "M-0";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "M_0";
	
		$fdata["FullName"]= "`M-0`";
	
		
		
		
		
		
				$fdata["Index"]= 11;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["M-0"]=$fdata;
//	M-1
	$fdata = array();
	$fdata["strName"] = "M-1";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "M_1";
	
		$fdata["FullName"]= "`M-1`";
	
		
		
		
		
		
				$fdata["Index"]= 12;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["M-1"]=$fdata;
//	M-3
	$fdata = array();
	$fdata["strName"] = "M-3";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "M_3";
	
		$fdata["FullName"]= "`M-3`";
	
		
		
		
		
		
				$fdata["Index"]= 13;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["M-3"]=$fdata;
//	M-5
	$fdata = array();
	$fdata["strName"] = "M-5";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "M_5";
	
		$fdata["FullName"]= "`M-5`";
	
		
		
		
		
		
				$fdata["Index"]= 14;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["M-5"]=$fdata;
//	K4-0
	$fdata = array();
	$fdata["strName"] = "K4-0";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "K4_0";
	
		$fdata["FullName"]= "`K4-0`";
	
		
		
		
		
		
				$fdata["Index"]= 15;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["K4-0"]=$fdata;
//	K4-1
	$fdata = array();
	$fdata["strName"] = "K4-1";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "K4_1";
	
		$fdata["FullName"]= "`K4-1`";
	
		
		
		
		
		
				$fdata["Index"]= 16;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["K4-1"]=$fdata;
//	K4-3
	$fdata = array();
	$fdata["strName"] = "K4-3";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "K4_3";
	
		$fdata["FullName"]= "`K4-3`";
	
		
		
		
		
		
				$fdata["Index"]= 17;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["K4-3"]=$fdata;
//	K4-5
	$fdata = array();
	$fdata["strName"] = "K4-5";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "K4_5";
	
		$fdata["FullName"]= "`K4-5`";
	
		
		
		
		
		
				$fdata["Index"]= 18;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["K4-5"]=$fdata;
//	K27-0
	$fdata = array();
	$fdata["strName"] = "K27-0";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "K27_0";
	
		$fdata["FullName"]= "`K27-0`";
	
		
		
		
		
		
				$fdata["Index"]= 19;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["K27-0"]=$fdata;
//	K27-1
	$fdata = array();
	$fdata["strName"] = "K27-1";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "K27_1";
	
		$fdata["FullName"]= "`K27-1`";
	
		
		
		
		
		
				$fdata["Index"]= 20;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["K27-1"]=$fdata;
//	K27-3
	$fdata = array();
	$fdata["strName"] = "K27-3";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "K27_3";
	
		$fdata["FullName"]= "`K27-3`";
	
		
		
		
		
		
				$fdata["Index"]= 21;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["K27-3"]=$fdata;
//	K27-5
	$fdata = array();
	$fdata["strName"] = "K27-5";
	$fdata["ownerTable"] = "tbl_name";
		
		
		
	$fdata["FieldType"]= 14;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "K27_5";
	
		$fdata["FullName"]= "`K27-5`";
	
		
		
		
		
		
				$fdata["Index"]= 22;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		
		
		
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		$fdata["bPrinterPage"]=true; 
	
		$fdata["bExportPage"]=true; 
	
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatatbl_name["K27-5"]=$fdata;

	
$tables_data["tbl_name"]=&$tdatatbl_name;
$field_labels["tbl_name"] = &$fieldLabelstbl_name;
$fieldToolTips["tbl_name"] = &$fieldToolTipstbl_name;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["tbl_name"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["tbl_name"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "Name,  `Esrrb-Chip`,  `E-0`,  `E-1`,  `E-3`,  `E-5`,  `P-0`,  `P-1`,  `P-3`,  `P-5`,  `M-0`,  `M-1`,  `M-3`,  `M-5`,  `K4-0`,  `K4-1`,  `K4-3`,  `K4-5`,  `K27-0`,  `K27-1`,  `K27-3`,  `K27-5`";
$proto0["m_strFrom"] = "FROM tbl_name";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto1=array();
$proto1["m_sql"] = "";
$proto1["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
$proto1["m_strCase"] = "";
$proto1["m_havingmode"] = "0";
$proto1["m_inBrackets"] = "0";
$proto1["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto1);

$proto0["m_where"] = $obj;
$proto3=array();
$proto3["m_sql"] = "";
$proto3["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto3["m_column"]=$obj;
$proto3["m_contained"] = array();
$proto3["m_strCase"] = "";
$proto3["m_havingmode"] = "0";
$proto3["m_inBrackets"] = "0";
$proto3["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto3);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto5=array();
			$obj = new SQLField(array(
	"m_strName" => "Name",
	"m_strTable" => "tbl_name"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "Esrrb-Chip",
	"m_strTable" => "tbl_name"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "E-0",
	"m_strTable" => "tbl_name"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "E-1",
	"m_strTable" => "tbl_name"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "E-3",
	"m_strTable" => "tbl_name"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "E-5",
	"m_strTable" => "tbl_name"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "P-0",
	"m_strTable" => "tbl_name"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "P-1",
	"m_strTable" => "tbl_name"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "P-3",
	"m_strTable" => "tbl_name"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "P-5",
	"m_strTable" => "tbl_name"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "M-0",
	"m_strTable" => "tbl_name"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "M-1",
	"m_strTable" => "tbl_name"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "M-3",
	"m_strTable" => "tbl_name"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$obj = new SQLField(array(
	"m_strName" => "M-5",
	"m_strTable" => "tbl_name"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto33=array();
			$obj = new SQLField(array(
	"m_strName" => "K4-0",
	"m_strTable" => "tbl_name"
));

$proto33["m_expr"]=$obj;
$proto33["m_alias"] = "";
$obj = new SQLFieldListItem($proto33);

$proto0["m_fieldlist"][]=$obj;
						$proto35=array();
			$obj = new SQLField(array(
	"m_strName" => "K4-1",
	"m_strTable" => "tbl_name"
));

$proto35["m_expr"]=$obj;
$proto35["m_alias"] = "";
$obj = new SQLFieldListItem($proto35);

$proto0["m_fieldlist"][]=$obj;
						$proto37=array();
			$obj = new SQLField(array(
	"m_strName" => "K4-3",
	"m_strTable" => "tbl_name"
));

$proto37["m_expr"]=$obj;
$proto37["m_alias"] = "";
$obj = new SQLFieldListItem($proto37);

$proto0["m_fieldlist"][]=$obj;
						$proto39=array();
			$obj = new SQLField(array(
	"m_strName" => "K4-5",
	"m_strTable" => "tbl_name"
));

$proto39["m_expr"]=$obj;
$proto39["m_alias"] = "";
$obj = new SQLFieldListItem($proto39);

$proto0["m_fieldlist"][]=$obj;
						$proto41=array();
			$obj = new SQLField(array(
	"m_strName" => "K27-0",
	"m_strTable" => "tbl_name"
));

$proto41["m_expr"]=$obj;
$proto41["m_alias"] = "";
$obj = new SQLFieldListItem($proto41);

$proto0["m_fieldlist"][]=$obj;
						$proto43=array();
			$obj = new SQLField(array(
	"m_strName" => "K27-1",
	"m_strTable" => "tbl_name"
));

$proto43["m_expr"]=$obj;
$proto43["m_alias"] = "";
$obj = new SQLFieldListItem($proto43);

$proto0["m_fieldlist"][]=$obj;
						$proto45=array();
			$obj = new SQLField(array(
	"m_strName" => "K27-3",
	"m_strTable" => "tbl_name"
));

$proto45["m_expr"]=$obj;
$proto45["m_alias"] = "";
$obj = new SQLFieldListItem($proto45);

$proto0["m_fieldlist"][]=$obj;
						$proto47=array();
			$obj = new SQLField(array(
	"m_strName" => "K27-5",
	"m_strTable" => "tbl_name"
));

$proto47["m_expr"]=$obj;
$proto47["m_alias"] = "";
$obj = new SQLFieldListItem($proto47);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto49=array();
$proto49["m_link"] = "SQLL_MAIN";
			$proto50=array();
$proto50["m_strName"] = "tbl_name";
$proto50["m_columns"] = array();
$proto50["m_columns"][] = "Name";
$proto50["m_columns"][] = "Esrrb-Chip";
$proto50["m_columns"][] = "E-0";
$proto50["m_columns"][] = "E-1";
$proto50["m_columns"][] = "E-3";
$proto50["m_columns"][] = "E-5";
$proto50["m_columns"][] = "P-0";
$proto50["m_columns"][] = "P-1";
$proto50["m_columns"][] = "P-3";
$proto50["m_columns"][] = "P-5";
$proto50["m_columns"][] = "M-0";
$proto50["m_columns"][] = "M-1";
$proto50["m_columns"][] = "M-3";
$proto50["m_columns"][] = "M-5";
$proto50["m_columns"][] = "K4-0";
$proto50["m_columns"][] = "K4-1";
$proto50["m_columns"][] = "K4-3";
$proto50["m_columns"][] = "K4-5";
$proto50["m_columns"][] = "K27-0";
$proto50["m_columns"][] = "K27-1";
$proto50["m_columns"][] = "K27-3";
$proto50["m_columns"][] = "K27-5";
$obj = new SQLTable($proto50);

$proto49["m_table"] = $obj;
$proto49["m_alias"] = "";
$proto51=array();
$proto51["m_sql"] = "";
$proto51["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto51["m_column"]=$obj;
$proto51["m_contained"] = array();
$proto51["m_strCase"] = "";
$proto51["m_havingmode"] = "0";
$proto51["m_inBrackets"] = "0";
$proto51["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto51);

$proto49["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto49);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

$queryData_tbl_name = $obj;
$tdatatbl_name[".sqlquery"] = $queryData_tbl_name;

$tableEvents["tbl_name"] = new eventsBase;

?>
