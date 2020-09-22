<?

use Bitrix\Main\Localization\Loc;


require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php');

Loc::loadMessages(__FILE__);


$APPLICATION->SetTitle(Loc::getMessage('MEIJI_SOLUTION_MONITOR_ADMIN_PAGE_TITLE'));

$allData = \Meiji\BxMonitor\Manager::getVisibleData();

foreach ($allData as $arSite) {
    $tabs[] = [
        'DIV' => 'monitor' . $arSite['SITE']['LID'],
        'TAB' => Loc::getMessage('MEIJI_SOLUTION_MONITOR_TAB1_NAME') . $arSite['SITE']['LID'],
        'TITLE' => Loc::getMessage('MEIJI_SOLUTION_MONITOR_TAB1_TITLE') . $arSite['SITE']['LID'],
    ];

}

$tabControl = new CAdminTabControl('tabControl', $tabs, false, false);


require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php');
?>

<?
$tabControl->Begin();

foreach ($allData as $arVisibleData):
    $tabControl->BeginNextTab();


    ?>
    <table>
        <tr>
            <td>ID</td>
            <td>Имя</td>
            <td>Тип</td>
            <td>Элементов</td>
            <td>Разделов</td>
        </tr>
        <? foreach ($arVisibleData['IBLOCKS'] as $arIblock): ?>
            <tr>
                <td><?= $arIblock['ID'] ?></td>
                <td><?= $arIblock['NAME'] ?></td>
                <td><?= $arIblock['IBLOCK_TYPE_ID'] ?></td>
                <td><?= $arIblock['ELEMENTS_CNT'] ?></td>
                <td><?= $arIblock['SECTIONS_CNT'] ?></td>
            </tr>
        <? endforeach; ?>

    </table>

    <table>
        <tr>
            <td></td>
            <td>Типов инфоблоков</td>
            <td>Инфоблоков</td>
            <td>Разделов</td>
            <td>Элементов</td>
        </tr>
        <tr>
            <td><b>Итого</b></td>
            <td><?= $arVisibleData['ALL']['TYPES'] ?></td>
            <td><?= $arVisibleData['ALL']['IBLOCKS'] ?></td>
            <td><?= $arVisibleData['ALL']['SECTIONS'] ?></td>
            <td><?= $arVisibleData['ALL']['ELEMENTS'] ?></td>
        </tr>

    </table>
<? endforeach; ?>
<?

$tabControl->End();
?>

<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php');
?>