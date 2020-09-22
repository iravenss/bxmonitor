<?php

namespace Meiji\BxMonitor;

use Bitrix\Main\Context;
use CBXVirtualIo;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\Loader;


/**
 * Class Manager
 *
 * @package Meiji\BxSitemap
 */
class Manager extends \Meiji\BxMarketplace\Fixtures\AbstractSolution
{


    public function getVisibleData()
    {
        \CModule::IncludeModule("iblock");

        $arFullData = [];

        $arSites = self::getAllSites();

        foreach ($arSites as $arSite) {
            $siteData = self::collectDataAboutSite($arSite['ID']);
            $siteData['SITE'] = $arSite;
            $arFullData[] = $siteData;
        }
        return $arFullData;

    }

    /**
     * @return array
     */
    public static function getAllSites()
    {
        $rsSites = \CSite::GetList($by = "sort", $order = "desc", Array());
        while ($site = $rsSites->Fetch()) {
            $sites[] = $site;
        }

        return $sites;
    }

    /**
     * @param $siteId
     * @return mixed
     */
    public static function collectDataAboutSite($siteId)
    {
        $arData['IBLOCKS'] = self::getIblocks($siteId);
        $arData = self::countIblockElements($arData);
        $arData = self::countIblockSections($arData);
        $arData = self::countAll($arData);
        return $arData;
    }

    /**
     * @param $siteId
     * @return array
     */
    public static function getIblocks($siteId)
    {

        $res = \CIBlock::GetList(
            Array(),
            Array(
                'SITE_ID' => $siteId
            ), true
        );
        while ($ar_res = $res->Fetch()) {
            $forRet[] = $ar_res;
        }
        return $forRet;
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function countIblockElements($data)
    {
        foreach ($data['IBLOCKS'] as &$arIblock) {
            $cnt = \CIBlockElement::GetList(
                array(),
                array('IBLOCK_ID' => $arIblock['ID']),
                array(),
                false,
                array('ID', 'NAME')
            );
            $arIblock['ELEMENTS_CNT'] = $cnt;

        }
        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function countIblockSections($data)
    {
        foreach ($data['IBLOCKS'] as &$arIblock) {

            $arFilter = array(
                'IBLOCK_ID' => $arIblock['ID'], // ID инфоблока
            );
            $arIblock['SECTIONS_CNT'] = \CIBlockSection::GetCount($arFilter);


        }
        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function countAll($data)
    {

        foreach ($data['IBLOCKS'] as $arIblock) {
            $countAll['ALL_TYPES'][] = $arIblock['IBLOCK_TYPE_ID'];
            $countAll['IBLOCKS']++;
            $countAll['ELEMENTS'] += $arIblock['ELEMENTS_CNT'];
            $countAll['SECTIONS'] += $arIblock['SECTIONS_CNT'];

        }
        $data['ALL'] = $countAll;
        $data['ALL']['TYPES'] = count(array_unique($countAll['ALL_TYPES']));
        return $data;

    }

}
