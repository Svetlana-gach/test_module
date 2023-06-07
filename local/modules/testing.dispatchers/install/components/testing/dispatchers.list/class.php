<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Type;
use Bitrix\Main\Localization\Loc;
use Testing\Model\DispatchersTable;
use Bitrix\Main\Entity\ReferenceField;
use Testing\Model\ObjectsTable;
use Bitrix\Main\ORM\Query\Join;

class DispatchersList extends CBitrixComponent
{

    public function onPrepareComponentParams($arParams)
    {
        $result = array(
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => isset($arParams["CACHE_TIME"]) ? $arParams["CACHE_TIME"] : 36000000,
            "TITLE" => $arParams["TITLE"],
        );

        $this->arResult = $this->arParams;
        return $result;
    }

    public static function getAll()
    {
        $result = ObjectsTable::getList([
                'select' =>
                    [
                        'ID',
                        'NAME',
                        'COMMENT',
                        'USER_IDISHNIK' => '\Testing\Model\DispatchersTable:OBJECT.USER_ID',
                        'DISPATCHER_NAME' => 'USER.NAME',
                        'DISPATCHER_LAST_NAME' => 'USER.LAST_NAME',
                        'DISPATCHER_ID' => 'USER.ID',
                        'ACCESS_LEVEL' => '\Testing\Model\DispatchersTable:OBJECT.ACCESS_LEVEL',
                        'LAST_ACTIVITY_DATE' => 'USER.LAST_LOGIN',
                        'ACTIVE' => '\Testing\Model\DispatchersTable:OBJECT.ACTIVE',
                    ],
                'filter' => [
                    'DISPATCHER_ID' > 0,
                    'ACTIVE' => 'Y'
                ],
                'runtime' => [
                    new ReferenceField(
                        'USER',
                        \Bitrix\Main\UserTable::class,
                        Join::on('this.USER_IDISHNIK', 'ref.ID')
                    ),
                ],
            ]
        );
        return $result->fetchAll();
    }

    public static function getAllDispatchers()
    {
        $result = DispatchersTable::getList([
                'select' => ['*'],
            ]
        )->FetchAll();

        return $result;
    }

    public static function getAllObjects()
    {
        $result = ObjectsTable::getList([
                'select' => ['*'],
            ]
        )->FetchAll();

        return $result;
    }

}