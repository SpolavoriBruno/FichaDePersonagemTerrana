<?php

	include("../class/template.class");
	include("../config/config.php");
	include("../config/pass.php");
	include("../lib/connection.php");
	include("../lib/database.php");
    
    require_once "../lib/authCode.php";
    
	$personage = new Template("../templates/sheet.html");

	/************************************************************
	 *	HTML Definitions
	 */
	$personage->set("PageCharset", HTML_CHARSET);
    $personage->set("PageTitle", HTML_TITLE);
	$personage->set("StyleSheetLink", MAIN_CSS);
    
    /*
     *  Playable Character or Master 
     */
    $personage->set("Action", "../php/createPersonage.php");
    if($_GET['type'] == "npc")
    {
        $personage->set("Action", "../php/createNPC.php");   
    }


	/************************************************************
	 *	Race Select from Database
	 */
	$race = new Template("../templates/selectRace.html");
	$data = DBRead("race", "ORDER BY name");
	foreach($data as $row)
	{
		$option = new Template("../templates/optionRace.html");
		$option->set("Id", $row['id']);
		$option->set("Name", $row['name']);
		$option->set("Cost", $row['cost']);
		$option->set("ModPV", $row['modPV']);
		$option->set("ModPM", $row['modPM']);
		$option->set("Description", $row['description']);
		$race->add("OptionRace", $option->output());
	}
	$personage->set("SelectRace", $race->output());
	
	/************************************************************
	 *	Class Select from Database
	 */
	$class = new Template("../templates/selectClass.html");
	$data = DBRead("class", "ORDER BY name");
	foreach($data as $row)
	{
		$option = new Template("../templates/optionClass.html");
		$option->set("Id", $row['id']);
		$option->set("Name", $row['name']);
		$option->set("Cost", $row['cost']);
		$option->set("Description", $row['description']);
		$class->add("OptionClass", $option->output());
	}
	$personage->set("SelectClass", $class->output());
	
	/************************************************************
	 *	Adventure Select from Database
	 */
	$adventure = new Template("../templates/selectAdventure.html");
	$data = DBRead("adventure", "ORDER BY name");
	foreach($data as $row)
	{
		$option = new Template("../templates/optionAdventure.html");
		$option->set("Id", $row['id']);
		$option->set("Name", $row['name']);
		$option->set("InitialLevel", $row['level']);
		$option->set("PersonagePoints", $row['points']);
		$option->set("Description", $row['description']);
		$adventure->add("OptionAdventure", $option->output());
	}
	$personage->set("SelectAdventure", $adventure->output());
	
	/************************************************************
	 *	Benefit Select from Database
	 */
	$benefit = new Template("../templates/selectBenefit.html");
	$data = DBRead("benefit", "ORDER BY name");
	foreach($data as $row)
	{
		$option = new Template("../templates/optionBenefit.html");
		$option->set("Id", $row['id']);
		$option->set("Name", $row['name']);
		$option->set("Cost", $row['cost']);
		$option->set("ModPV", $row['modPV']);
		$option->set("ModPM", $row['modPM']);
		$option->set("Description", $row['description']);
		$benefit->add("OptionBenefit", $option->output());
	}
	$personage->set("SelectBenefit", $benefit->output());
	
	/************************************************************
	 *	Injury Select from Database
	 */
	$injury  = new Template("../templates/selectInjury.html");
	$data = DBRead("injury", "ORDER BY name");
	foreach($data as $row)
	{
		$option = new Template("../templates/optionInjury.html");
		$option->set("Id", $row['id']);
		$option->set("Name", $row['name']);
		$option->set("Cost", $row['cost']);
		$option->set("ModPV", $row['modPV']);
		$option->set("ModPM", $row['modPM']);
		$option->set("Description", $row['description']);
		$injury->add("OptionInjury", $option->output());
	}
	$personage->set("SelectInjury", $injury->output());
	
	/************************************************************
	 *	Knowledge Select from Database
	 */
	$knowledge = new Template("../templates/selectKnowledge.html");
	$data = DBRead("knowledge", "ORDER BY name");
	foreach($data as $row)
	{
		$option = new Template("../templates/optionKnowledge.html");
		$option->set("Id", $row['id']);
		$option->set("Name", $row['name']);
		$option->set("Cost", $row['cost']);
		$option->set("ModPV", $row['modPV']);
		$option->set("ModPM", $row['modPM']);
		$option->set("Description", $row['description']);
		$knowledge->add("OptionKnowledge", $option->output());
	}
	$personage->set("SelectKnowledge", $knowledge->output());

	/************************************************************
	 *	JavaScript
	 */
	$personage->set("JavaScriptLink", "../scripts/createPersonage.js");
	
	echo $personage->output();
?>