//<?php
/**
 * WelcomeStats
 *
 * Dashboard Stats widget plugin for EvoDashboard
 *
 * @author    Nicola Lambathakis
 * @category    plugin
 * @version    3.1.3 RC
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerWelcomePrerender,OnManagerMainFrameHeaderHTMLBlock
 * @internal    @installset base
 * @internal    @modx_category Dashboard
 * @author      Nicola Lambathakis http://www.tattoocms.it/
 * @documentation Requirements: This plugin requires MODX Evolution 1.2 or later
 * @reportissues https://github.com/Nicola1971/WelcomeStats-EvoDashboard-Plugin/issues
 * @link        http://www.tattoocms.it/extras/plugins/welcomestats-dashboard-widget.html
 * @lastupdate  24/10/2016
 * @internal    @properties  &wdgVisibility=Show widget for:;menu;All,AdminOnly;show &WidgetTitle=Widget Title:;string;EVO Stats  &DocCountLabel= Documents count label:;string;Documents &startID= Documents count parent:;string;0 &WebUserCountLabel= Web Users label:;string;Web Users &webGroup= Users Web Group:;string;all &UserCountLabel= Manager Users label:;string;Manager Users &AdminCountLabel= Admin label:;string;Admins &Style= Style:;list;box,round,lite;box &datarow=widget row position:;list;1,2,3,4,5,6,7,8,9,10;1 &datacol=widget col position:;list;1,2,3,4;1 &datasizex=widget x size:;list;1,2,3,4;4 &datasizey=widget y size:;list;1,2,3,4,5,6,7,8,9,10;3
 */

/**
 * WelcomeStats RC 3.1.3
 *
 * Dashboard Stats widget plugin for EvoDashboard
 * Event: OnManagerWelcomePrerender,OnManagerMainFrameHeaderHTMLBlock
 * Configuration:  &wdgVisibility=Show widget for:;menu;All,AdminOnly;show &WidgetTitle=Widget Title:;string;EVO Stats  &DocCountLabel= Documents count label:;string;Documents &startID= Documents count parent:;string;0 &WebUserCountLabel= Web Users label:;string;Web Users &webGroup= Users Web Group:;string;all &UserCountLabel= Manager Users label:;string;Manager Users &AdminCountLabel= Admin label:;string;Admins &Style= Style:;list;box,round,lite;box &datarow=widget row position:;list;1,2,3,4,5,6,7,8,9,10;1 &datacol=widget col position:;list;1,2,3,4;1 &datasizex=widget x size:;list;1,2,3,4;4 &datasizey=widget y size:;list;1,2,3,4,5,6,7,8,9,10;3
 */

// Run the main code
include($modx->config['base_path'].'assets/plugins/welcomestats/welcomestats.php');