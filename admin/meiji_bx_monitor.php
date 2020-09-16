<?

use Bitrix\Main\Localization\Loc;


require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php');

Loc::loadMessages(__FILE__);



$APPLICATION->SetTitle(Loc::getMessage('MEIJI_SOLUTION_MONITOR_ADMIN_PAGE_TITLE'));



$tabControl = new CAdminTabControl('tabControl', [
	[
		'DIV'   => 'edit' . $arSite['LID'],
		'TAB'   => Loc::getMessage('MEIJI_SOLUTION_SETTINGS_ADMIN_PAGE_TAB1_NAME'),
		'TITLE' => Loc::getMessage('MEIJI_SOLUTION_SETTINGS_ADMIN_PAGE_TAB1_TITLE')
	]
], false, false);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php');
?>

<?
$tabControl->Begin();
$tabControl->BeginNextTab();


?>


    <?
$tabControl->End();
?>

<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php');
?>