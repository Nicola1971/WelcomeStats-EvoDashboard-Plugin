<?php
/**
 * WelcomeStats RC 3.1.3
 *
 * Dashboard MODX Stats widget plugin for EvoDashboard
 * Event: OnManagerWelcomePrerender,OnManagerMainFrameHeaderHTMLBlock
 * Configuration: &WidgetTitle= MODx Stats Title:;string;MODx Stats  &DocCountLabel= Documents count label:;string;Documents &startID= Documents count parent:;string;0 &WebUserCountLabel= Web Users label:;string;Web Users &webGroup= Users Web Group:;string;all &UserCountLabel= Manager Users label:;string;Manager Users &AdminCountLabel= Admin label:;string;Admins &Style= Style:;list;box,round,lite;box &datarow=widget row position:;list;1,2,3,4,5,6,7,8,9,10;1 &datacol=widget col position:;list;1,2,3,4;1 &datasizex=widget x size:;list;1,2,3,4;4 &datasizey=widget y size:;list;1,2,3,4,5,6,7,8,9,10;3
 */
/*widget name*/
$WidgetID = isset($WidgetID) ? $WidgetID : 'DashboardStats';
// size and position
$datarow = isset($datarow) ? $datarow : '1';
$datacol = isset($datacol) ? $datacol : '2';
$datasizex = isset($datasizex) ? $datasizex : '2';
$datasizey = isset($datasizey) ? $datasizey : '2';
//output
$WidgetOutput = isset($WidgetOutput) ? $WidgetOutput : '';
//events
$EvoEvent = isset($EvoEvent) ? $EvoEvent : 'OnManagerWelcomePrerender';


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
if($e->name == ''.$EvoEvent.'') {
	if ($Style == box) {$StatsContainerSize = 'col-sm-12';}
/*Widget Box */

$WidgetOutput = '
<li id="'.$WidgetID.'" data-row="'.$datarow.'" data-col="'.$datacol.'" data-sizex="'.$datasizex.'" data-sizey="'.$datasizey.'">
                    <div class="panel panel-default widget-wrapper">
                      <div class="panel-headingx widget-title sectionHeader clearfix">
                          <span class="pull-left"><i class="fa fa-bar-chart-o"></i> '.$WidgetTitle.'</span>
                            <div class="widget-controls pull-right">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-default btn-xs panel-hide hide-full fa fa-minus" data-id="'.$WidgetID.'"></a>
                                </div>     
                            </div>

                      </div>
                      <div class="panel-body widget-stage sectionBody">
                      <div class="col-md-3 col-sm-6"><div class="statbox sblue"><div class="staticon"><i class="fa fa-file fa-4x"></i></div><div class="count"><h3> '.$num.' </h3> '.$DocCountLabel.' </div></div> </div>
<div class="col-md-3 col-sm-6"><div class="statbox sgreen"><div class="staticon"><i class="fa fa-users fa-4x"></i></div><div class="count"><h3> '.$count.' </h3> '.$WebUserCountLabel.' </div></div> </div>
<div class="col-md-3 col-sm-6"><div class="statbox syellow"><div class="staticon"><i class="fa fa-user fa-4x"></i></div><div class="count"><h3> '.$userscount.' </h3> '.$UserCountLabel.' </div></div> </div>
<div class="col-md-3 col-sm-6"><div class="statbox sred"><div class="staticon"><i class="fa fa-user-md fa-4x"></i></div><div class="count"><h3> '.$admincount.' </h3> '.$AdminCountLabel.' </div></div> </div>
                      </div>
                    </div>           
                </li>

';

}
$output .= $cssOutput.$WidgetOutput;
$e->output($output);
return;
?>