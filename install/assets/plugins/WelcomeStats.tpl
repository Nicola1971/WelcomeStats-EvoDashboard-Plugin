//<?php
/**
 * WelcomeStats
 *
 * Dashboard MODX Stats widget plugin for OnManagerWelcomeCustom
 *
 * @author    Nicola Lambathakis
 * @category    plugin
 * @version    1.3 RC
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerWelcomeHome,OnManagerWelcomeRender
 * @internal    @installset base
 * @internal    @modx_category Welcome
 * @internal    @properties  &EvoEvent= System Event:;list;OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeHome &MODxStatsTitle= MODx Stats Title:;string;MODx Stats  &DocCountLabel= Documents count label:;string;Documents &startID= Documents count parent:;string;0 &WebUserCountLabel= Web Users label:;string;Web Users &webGroup= Users Web Group:;string;all &UserCountLabel= Manager Users label:;string;Manager Users &AdminCountLabel= Admin label:;string;Admins
 */

/**
 * WelcomeStats RC 1.3
 *
 * Dashboard MODX Stats widget plugin for OnManagerWelcomeCustom
 * Event: OnManagerWelcomeHome,OnManagerWelcomeRender
 * Configuration: &StatsEvent= System Event:;list;OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeHome &StatsBoxSize= Stats Box size:;list;dashboard-block-full,dashboard-block-half;dashboard-block-full &MODxStatsTitle= MODx Stats Title:;string;MODx Stats  &DocCountLabel= Documents count label:;string;Documents &startID= Documents count parent:;string;0 &WebUserCountLabel= Web Users label:;string;Web Users &webGroup= Users Web Group:;string;all &UserCountLabel= Manager Users label:;string;Manager Users &AdminCountLabel= Admin label:;string;Admins
 */

$StatsEvent = isset($EvoEvent) ? $EvoEvent : 'OnManagerWelcomeHome';
$StatsBoxSize = isset($StatsBoxSize) ? $StatsBoxSize : 'dashboard-block-full';

// documents counter
$doctable = $modx->getFullTableName('site_content');
$countDocQuery = "SELECT (id) FROM $doctable";
$resource = $modx->db->query($countDocQuery);
$num = $modx->db->getRecordCount($resource);
$resource = $modx->getActiveChildren($resourceparent, 'id', 'ASC', $fields='*');

// webusers counter
$webGroup = isset($webGroup) ? $webGroup : '';
// from: ShowMembers v1.1c
$wua= $modx->getFullTableName('web_user_attributes');
$wgn= $modx->getFullTableName('webgroup_names');
$wg= $modx->getFullTableName('web_groups');

if($webGroup == "all") {
  $sql= "SELECT {$fields} FROM {$wua} wua ORDER BY wua.fullname ASC";
} else {
  $sql= "SELECT {$fields} FROM {$wua} wua JOIN {$wg} wg ON wg.webuser = wua.internalKey JOIN {$wgn} wgn ON wgn.name

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

switch($e->name) {
    case ''.$StatsEvent.'':
 $output = '
	<style>
	.statbox {	float:left;
	padding:10px;
	margin:5px;
    color: #FFFFFF;
	display:block;
	width:22%;
	border-radius: 8px;
	height: 73px;
	overflow: hidden;
}
.statcontainer {width: 100%;}
.icon{float:left; padding:5px;}
.icon i{color: #FFFFFF!important;}
.count{float:right; text-align:right;}
.count h3{font-size:30px; margin-bottom: 2px;}

.sred {background-color:  #d9534f;}
.syellow {background-color: #f0ad4e;}
.sgreen {background-color: #5cb85c;}
.sblue {background-color: #428bca;}
</style>
	<div class="'.$StatsBoxSize.'"> <div class="sectionHeader"><i class="fa fa-signal"></i> '.$MODxStatsTitle.'<a href="javascript:void(null);" onclick="doHideShow(\'idShowHide11\');"><i class="fa fa-bars expandbuttn"></i></a></div>
<div id="idShowHide11" class="sectionBody"><div class="statcontainer">
<div class="statbox sblue"><div class="icon"><i class="fa fa-file fa-4x"></i></div><div class="count"><h3> '.$num.' </h3> '.$DocCountLabel.' </div></div>
<div class="statbox sgreen"><div class="icon"><i class="fa fa-users fa-4x"></i></div><div class="count"><h3> '.$count.' </h3> '.$WebUserCountLabel.' </div></div>
<div class="statbox syellow"><div class="icon"><i class="fa fa-user fa-4x"></i></div><div class="count"><h3> '.$userscount.' </h3> '.$UserCountLabel.' </div></div>
<div class="statbox sred"><div class="icon"><i class="fa fa-user-md fa-4x"></i></div><div class="count"><h3> '.$admincount.' </h3> '.$AdminCountLabel.' </div></div>
<div class="clear"></div> </div>
	</div></div>';

break;
default:
$output = '';
break;
}
$e->output($output);
return;