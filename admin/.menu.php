<?
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$aAdminMenuLinks = [
	'meiji_bx_monitor' => [
		'parent_menu' => 'global_menu_settings',
		'sort'        => 20,
		'text'        => Loc::getMessage('MEIJI_SOLUTION_MONITOR_ADMINMENU_ITEM_TEXT'),
		'title'       => Loc::getMessage('MEIJI_SOLUTION_MONITOR_ADMINMENU_ITEM_TITLE'),
		'icon'        => 'iblock_menu_icon_settings'
	]
];
