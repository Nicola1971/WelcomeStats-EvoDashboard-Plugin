<?php
/**
 * WelcomeStats RC 2.0
 *
 * Dashboard MODX Stats widget plugin for OnManagerWelcomeCustom
 * Event: OnManagerWelcomeHome,OnManagerWelcomeRender,OnManagerMainFrameHeaderHTMLBlock
 * Configuration: &StatsEvent= System Event:;list;OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeHome &StatsBoxSize= Stats Box size:;list;dashboard-block-full,dashboard-block-half;dashboard-block-full &MODxStatsTitle= MODx Stats Title:;string;MODx Stats  &DocCountLabel= Documents count label:;string;Documents &startID= Documents count parent:;string;0 &WebUserCountLabel= Web Users label:;string;Web Users &webGroup= Users Web Group:;string;all &UserCountLabel= Manager Users label:;string;Manager Users &AdminCountLabel= Admin label:;string;Admins &Style= Style:;list;box,round,lite;box
 */

$StatsBoxSize = isset($StatsBoxSize) ? $StatsBoxSize : 'dashboard-block-full';
$StatsContainerSize = isset($StatsContainerSize) ? $StatsContainerSize : 'col-sm-6';
//widget grid size
if ($StatsBoxSize == 'dashboard-block-full') {
$StatsBoxWidth = 'col-sm-12';
} else {
$StatsBoxWidth = 'col-sm-6';
}
//styles
$Style = isset($Style) ? $Style : 'box';
// documents counter
$doctable = $modx->getFullTableName('site_content');
$countDocQuery = "SELECT (id) FROM $doctable";
$resource = $modx->db->query($countDocQuery);
$num = $modx->db->getRecordCount($resource);

// webusers counter
$webGroup = isset($webGroup) ? $webGroup : '';
// from: ShowMembers v1.1c
$wua= $modx->getFullTableName('web_user_attributes');
$wgn= $modx->getFullTableName('webgroup_names');
$wg= $modx->getFullTableName('web_groups');

if($webGroup == "all") {
  $sql= "SELECT (id) FROM {$wua} wua ORDER BY wua.fullname ASC";
} else {
  $sql= "SELECT (id) FROM {$wua} wua JOIN {$wg} wg ON wg.webuser = wua.internalKey JOIN {$wgn} wgn ON wgn.name

= '{$webGroup}' AND wgn.id = wg.webgroup ORDER BY wua.fullname ASC";
}

$webusers = $modx->db->query($sql);
$count = $modx->db->getRecordCount($webusers);
// end users counter

$userstable = $modx->getFullTableName('user_attributes');
$countusersQuery = "SELECT (id) FROM $userstable WHERE role > 1";
$users = $modx->db->query($countusersQuery);
$userscount = $modx->db->getRecordCount($users);

$countAdminQuery = "SELECT (id) FROM $userstable WHERE role = 1";
$admins = $modx->db->query($countAdminQuery);
$admincount = $modx->db->getRecordCount($admins);

// events

$e = &$modx->Event;
$output ='';
/*load styles with OnManagerMainFrameHeaderHTMLBlock*/
if($e->name == 'OnManagerMainFrameHeaderHTMLBlock') {
	if ($Style == box) {$cssOutput = '<link type="text/css" rel="stylesheet" href="../assets/plugins/welcomestats/box.css">';}
    if ($Style == round) {$cssOutput = '<link type="text/css" rel="stylesheet" href="../assets/plugins/welcomestats/round.css">';}
    if ($Style == lite) {$cssOutput = '<link type="text/css" rel="stylesheet" href="../assets/plugins/welcomestats/lite.css">';}
}
if($e->name == ''.$StatsEvent.'') {
	if ($Style == box) {$StatsContainerSize = 'col-sm-12';}
   $Statsoutput = '<div class="'.$StatsBoxWidth.'"><div class="widget-wrapper"> <div class="widget-title sectionHeader"><i class="fa fa-bar-chart-o"></i> '.$MODxStatsTitle.'</div><div class="widget-stage sectionBody"><div class="statcontainer '.$StatsContainerSize.'">
<div class="col-md-3 col-sm-6"><div class="statbox sblue"><div class="staticon"><i class="fa fa-file fa-4x"></i></div><div class="count"><h3> '.$num.' </h3> '.$DocCountLabel.' </div></div> </div>
<div class="col-md-3 col-sm-6"><div class="statbox sgreen"><div class="staticon"><i class="fa fa-users fa-4x"></i></div><div class="count"><h3> '.$count.' </h3> '.$WebUserCountLabel.' </div></div> </div>
<div class="col-md-3 col-sm-6"><div class="statbox syellow"><div class="staticon"><i class="fa fa-user fa-4x"></i></div><div class="count"><h3> '.$userscount.' </h3> '.$UserCountLabel.' </div></div> </div>
<div class="col-md-3 col-sm-6"><div class="statbox sred"><div class="staticon"><i class="fa fa-user-md fa-4x"></i></div><div class="count"><h3> '.$admincount.' </h3> '.$AdminCountLabel.' </div></div> </div>
<div class="clear"></div> </div>
	</div></div></div>';
}
$output .= $cssOutput.$Statsoutput;
$e->output($output);
return;
?>