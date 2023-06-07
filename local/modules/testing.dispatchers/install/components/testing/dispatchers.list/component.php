<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

if( !\Bitrix\Main\Loader::includeModule( "testing.dispatchers" ) )return;

$arResult ["TITLE"] = $arParams["TITLE"] ;
if($this->startResultCache())// для кеширования arResult
{
    //$this - экземпляр DispatchersList
    $arResult['TABLE'] = $this->getAll();
    $arResult['DISPATCHERS'] = $this->getAllDispatchers();
    $arResult['OBJECTS'] = $this->getAllObjects();
}
$this->includeComponentTemplate();