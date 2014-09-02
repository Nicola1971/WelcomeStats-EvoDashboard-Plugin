//<?php
/**
 * WelcomeStats
 *
 * Dashboard MODX Stats widget plugin for OnManagerWelcomeCustom
 *
 * @author    Nicola Lambathakis
 * @category    plugin
 * @version    2.0 RC
 * @license	 http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @internal    @events OnManagerWelcomeHome,OnManagerWelcomeRender,OnManagerMainFrameHeaderHTMLBlock
 * @internal    @installset base
 * @internal    @modx_category Welcome
 * @internal    @properties  &StatsEvent= System Event:;list;OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeHome &StatsBoxSize= Stats Box size:;list;dashboard-block-full,dashboard-block-half;dashboard-block-full &MODxStatsTitle= MODx Stats Title:;string;MODx Stats  &DocCountLabel= Documents count label:;string;Documents &startID= Documents count parent:;string;0 &WebUserCountLabel= Web Users label:;string;Web Users &webGroup= Users Web Group:;string;all &UserCountLabel= Manager Users label:;string;Manager Users &AdminCountLabel= Admin label:;string;Admins &Style= Style:;list;box,round,lite;box
 */

/**
 * WelcomeStats RC 2.0
 *
 * Dashboard MODX Stats widget plugin for OnManagerWelcomeCustom
 * Event: OnManagerWelcomeHome,OnManagerWelcomeRender,OnManagerMainFrameHeaderHTMLBlock
 * Configuration: &StatsEvent= System Event:;list;OnManagerWelcomeHome,OnManagerWelcomeRender;OnManagerWelcomeHome &StatsBoxSize= Stats Box size:;list;dashboard-block-full,dashboard-block-half;dashboard-block-full &MODxStatsTitle= MODx Stats Title:;string;MODx Stats  &DocCountLabel= Documents count label:;string;Documents &startID= Documents count parent:;string;0 &WebUserCountLabel= Web Users label:;string;Web Users &webGroup= Users Web Group:;string;all &UserCountLabel= Manager Users label:;string;Manager Users &AdminCountLabel= Admin label:;string;Admins &Style= Style:;list;box,round,lite;box
 */

// Run the main code
include($modx->config['base_path'].'assets/plugins/welcomestats/welcomestats.php');