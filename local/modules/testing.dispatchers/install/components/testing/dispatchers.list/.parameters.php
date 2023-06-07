<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

$arComponentParameters = [
    "PARAMETERS" => [
        "TITLE" =>
        [
            "NAME" => GetMessage('TITLE_PARAM_NAME'),
            "PARENT" => "BASE",
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ]
    ]
];
?>
