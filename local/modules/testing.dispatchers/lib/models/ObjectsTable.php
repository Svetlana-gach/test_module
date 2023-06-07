<?php

namespace Testing\Model;

use Bitrix\Main\Type;
use Bitrix\Main\ORM;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\DatetimeField;
use Bitrix\Main\Entity\DateField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

class ObjectsTable extends DataManager
{

    public static function getTableName()
    {
        return 'testing_objects';
    }

    public static function getMap()
    {
        return [
            new IntegerField('ID', [
                'autocomplete' => true,
                'primary' => true
            ]),

            new DatetimeField('DATE_CREATE', [
                'required' => true,
                'title' => 'Дата и время создания записи',
                'default_value' => new Type\DateTime()
            ]),

            new StringField('NAME', [
                'required' => true,
                'title' => 'Наименование'
            ]),
            new StringField('ADDRESS', [
                'required' => true,
                'title' => 'Адрес',
                'validation' => function () {
                    return [
                        new Validator\Length(null, 255)
                    ];
                },
            ]),
            new StringField('COMMENT', [
                'required' => true,
                'title' => 'Комментарий',
                'validation' => function () {
                    return [
                        new Validator\Length(null, 255)
                    ];
                },
            ]),
        ];
    }


}