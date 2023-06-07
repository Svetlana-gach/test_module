<?php

namespace Testing\Handlers;

use Bitrix\Main\Application,
    Bitrix\Main\Context,
    Bitrix\Main\Request,
    Bitrix\Main\Server,
    Testing\Model\DispatchersTable;

class BaseHandler
{
    public static function OnAfterUserUpdateHandler(&$arFields)
    {
        //если user диспетчера деактивируется, деактивировать и запись в таблице диспетчеров
        if($arFields['ACTIVE'] === 'N'){
            $update = \Testing\Model\DispatchersTable::Update($arFields['ID'], ['ACTIVE' => 'N']);
        }
    }
}

