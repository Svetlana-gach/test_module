<?php

namespace Testing\Model;

use Bitrix\Main\Type;
use Bitrix\Main;
use Bitrix\Main\UserTable;
use Bitrix\Main\ORM;
use Bitrix\Main\ORM\Fields;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\DatetimeField;
use Bitrix\Main\Entity\DateField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\Localization\Loc;
use Testing\Model\ObjectsTable;


class DispatchersTable extends DataManager
{

    public static function getTableName()
    {
        return 'testing_dispatchers';
    }

    public static function getMap()
    {
        return [
            
            new IntegerField('ID', [
                'primary' => true,
                'autocomplete' => true,
            ]),

            new IntegerField('USER_ID', [
                'required' => true,
                'validation' => function () {
                    return [
                        new Validator\Unique,
                    ];
                },
            ]),

            new DatetimeField('DATE_CREATE', [
                'required' => true,
                'title' => 'Дата и время создания записи',
                'default_value' => new Type\DateTime()
            ]),


            new Fields\BooleanField('ACTIVE', [
                'values' => ['N', 'Y'],
                "default_value" => "Y",
            ]),


            new DateField('LAST_ACTIVITY_DATE', [
                'required' => true,
                'title' => 'Дата окончания активности',
            ]),

            new ReferenceField(
                'USER',
                'Bitrix\Main\UserTable',
                ['=this.USER_ID' => 'ref.ID']
            ),

            new StringField('COMMENT', [
                'title' => 'Комментарий',
                'validation' => function () {
                    return [
                        new Validator\Length(null, 255),
                    ];
                },
            ]),

            new IntegerField('ACCESS_LEVEL', [
                'required' => true,
                'title' => 'Уровень доступа',
                'validation' => function () {
                    return [
                        new Validator\Range(1, 12)
                    ];
                }
            ]),

            new IntegerField('OBJECT_ID'),

            new ReferenceField(
                'OBJECT',
                '\Testing\Model\ObjectsTable',
                ['this.OBJECT_ID' => 'ref.ID']
            ),
        ];
    }
}