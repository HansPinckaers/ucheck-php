<?
## Copyright (c) 2011 by Hans Pinckaers 
##
## This work is licensed under the Creative Commons 
## Attribution-NonCommercial-ShareAlike 3.0 Unported License. 
## To view a copy of this license, visit 
## http://creativecommons.org/licenses/by-nc-sa/3.0/ 
##
## ucheck-php: https://github.com/HansPinckaers/ucheck-php
## ucheck-node: https://github.com/HansPinckaers/ucheck-node
##


// http://localhost:3000/raw/inschrijven_op_id.php?nummer=1&aantal_check=3&q=3010PMCG9Y
include("setup.php");
include("user_info.php");

$id = $_GET['nummer'];
$gids_id = $_GET['q'];
$aantal = $_GET['aantal_check'];

$keep_cookie = true;

// $cookiefile = $DOCUMENT_ROOT."raw/cookies/".$user."_vakken".time().".txt";

include $DOCUMENT_ROOT."raw/details.php";

if(isset($aantal) && count($onderdelen) != $aantal)
{
	echo "<span style='color:orange;'>Er is iets misgegaan. Probeer het later opnieuw.</span> ";
	echo "BUG: Aantal klopt niet. aantal = ".count($onderdelen)." check: ".$aantal;
	exit();
}


if($demo){
	echo "<span style='color:orange;'>Inschrijven is niet ondersteund in het demo-account.</span>";
	exit();
}


$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SNS_CUSTOMIZATIONS_NLD.SNS_SSENRL_CART.GBL';
// $post_str = "ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_CLASS_SELECT_PB&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=C4Dv5nH55Q7cctCCvCuF0eADRvXX2QiwGR2hpzep140%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=ENG&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$23$=0100&SNS_SS_DERIVED_SELECTED\$chk$1=Y&SNS_SS_DERIVED_SELECTED$1=Y&SNS_SS_DERIVED_SELECTED\$chk$2=&SNS_SS_DERIVED_SELECTED\$chk$3=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$174$=0100";
$post_str = "ICAJAX=1&ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=SNS_DERIVED_CLASS_SELECT_PB&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=okPpeuAW5HBVlLNOw8ao1i2ZvpAFw0Sxu%2F4hoevly90%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$23$=0100&SNS_SS_DERIVED_SELECTED\$chk$".$id."=Y&SNS_SS_DERIVED_SELECTED$".$id."=Y&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$174$=0100";
$html = req($url, $post_str, $cookiefile);

preg_match("/class='SSSMSGWARNINGTEXT' >(.*)<\/span>/", $html, $fout);

if(isset($fout[0]))
{
	$melding = $fout[1];
	echo "<span style='color:red;'>".$melding."</span>";
	die();
}

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSR_SSENRL_CART.GBL?Page=SSR_SSENRL_CART&Action=A&ACAD_CAREER=CAR&EMPLID=0924121&ENRL_REQUEST_ID=&INSTITUTION=INST&STRM=TERM';
$post_str = "";
$html = req($url, $post_str, $cookiefile);

// die();

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES_2.SSR_SSENRL_CART.GBL?Page=SSR_SSENRL_CART&Action=A&ACAD_CAREER=CAR&EMPLID=0924121&ENRL_REQUEST_ID=&INSTITUTION=INST&STRM=TERM';
$post_str = "ICType=Panel&ICElementNum=0&ICAction=DERIVED_SSS_SCT_SSS_TERM_LINK&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=1&ICSID=0QsQOKMTB5SvMCz9%2B5nJU4mlD6xHj%2FRBSbwamcLk7iA%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&%23ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO%2423%24=0100&P_SELECT%24chk%240=N&DERIVED_SSTSNAV_SSTS_MAIN_GOTO%24154%24=0100";
$html = req($url, $post_str, $cookiefile);

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_CART.GBL';
$post_str = "ICNAVTYPEDROPDOWN=0&ICType=Panel&ICElementNum=0&ICAction=DERIVED_SSS_SCT_SSR_PB_GO&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=0&ICSID=0QsQOKMTB5SvMCz9%2B5nJU4mlD6xHj%2FRBSbwamcLk7iA%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&#ICDataLang=DUT&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$23$=0100&SSR_DUMMY_RECV1\$sels$0=".$year_index."&DERIVED_SSTSNAV_SSTS_MAIN_GOTO$67$=0100";
$html = req($url, $post_str, $cookiefile);

preg_match("/class='SSSMSGWARNINGTEXT' >(.*)<\/span>/", $html, $fout);

if(isset($fout[0]))
{
	$melding = $fout[1];
	echo "<span style='color:red;'>".$melding."</span>";
	die();
}

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_CART.GBL';
$post_str = "ICType=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_LINK_ADD_ENRL%24125%24&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=1&ICSID=C4Dv5nH55Q7cctCCvCuF0eADRvXX2QiwGR2hpzep140%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&%23ICDataLang=ENG&DERIVED_SSTSNAV_SSTS_MAIN_GOTO%2422%24=0100&P_SELECT%24chk%240=Y&P_SELECT%240=Y&DERIVED_SSTSNAV_SSTS_MAIN_GOTO%24167%24=0100";
$html = req($url, $post_str, $cookiefile);

preg_match("/class='SSSMSGWARNINGTEXT' >(.*)<\/span>/", $html, $fout);

if(isset($fout[0]))
{
	$melding = $fout[1];
	echo "<span style='color:red;'>".$melding."</span>";
	die();
}

$url = 'https://usis.leidenuniv.nl/psc/S040PRD/EMPLOYEE/HRMS/c/SA_LEARNER_SERVICES.SSR_SSENRL_CART.GBL';
$post_str = "ICType=Panel&ICElementNum=0&ICAction=DERIVED_REGFRM1_SSR_PB_SUBMIT&ICXPos=0&ICYPos=0&ResponsetoDiffFrame=-1&TargetFrameName=None&ICFocus=&ICSaveWarningFilter=0&ICChanged=-1&ICResubmit=1&ICSID=C4Dv5nH55Q7cctCCvCuF0eADRvXX2QiwGR2hpzep140%3D&ICModalWidget=0&ICZoomGrid=0&ICZoomGridRt=0&ICModalLongClosed=&ICActionPrompt=false&ICFind=&ICAddCount=&%23ICDataLang=ENG&DERIVED_SSTSNAV_SSTS_MAIN_GOTO%244%24=0100&DERIVED_SSTSNAV_SSTS_MAIN_GOTO%2474%24=0100";
$result = req($url, $post_str, $cookiefile);

preg_match("/<B>(.*)./", $result, $matches);

// echo ($result);

unlink($cookiefile);

try {
include('Galvanize.php');
$GA = new Galvanize('UA-4063156-10');
$GA->trackPageView("inschrijven_op_id.php", "inschrijven");
} catch (Exception $e) {}
?>