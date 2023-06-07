<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();
require_once __DIR__ . '/../lib/models/DispatchersTable.php';
require_once __DIR__ . '/../lib/models/ObjectsTable.php';

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Entity;
use Testing\Model\DispatchersTable;
use Testing\Model\ObjectsTable;

class testing_dispatchers extends CModule
{
    var $MODULE_ID = "testing.dispatchers";
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;

    function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");

        $this->MODULE_NAME = GetMessage("testing.dispatchers_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("testing.dispatchers_MODULE_DESC");
        $this->PARTNER_NAME = GetMessage("testing.dispatchers_PARTNER_NAME");
        $this->PARTNER_URI = GetMessage("testing.dispatchers_PARTNER_URI");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
    }

    function DoInstall()
    {
        global $DB, $APPLICATION, $step, $USER;

        if ($USER->IsAdmin()) {
            $this->InstallFiles();
            $this->InstallDB();
            ModuleManager::registerModule($this->MODULE_ID);//регистрируется в b_module

            $this->registerEvents();
        }
    }

    function DoUninstall()
    {
        global $DB, $APPLICATION, $step;

        $this->UnInstallFiles();
        $this->UnInstallDB();
        $this->unregisterEvents();
    }

    public function InstallDB($arParams = [])
    {

        $dispatchersRes = Testing\Model\DispatchersTable::getEntity()->createDbTable();
        $objectsres = Testing\Model\ObjectsTable::getEntity()->createDbTable();
        return true;


    }

    public function UnInstallDB($arParams = [])
    {

        UnRegisterModule($this->MODULE_ID);
        if (Application::getConnection()->isTableExists(Entity\Base::getInstance('\Testing\Model\DispatchersTable')->getDBTableName())) {
            $connection = Application::getInstance()->getConnection();
            $connection->dropTable(Testing\Model\DispatchersTable::getTableName());
        }
        if (Application::getConnection()->isTableExists(Entity\Base::getInstance('\Testing\Model\ObjectsTable')->getDBTableName())) {
            $connection = Application::getInstance()->getConnection();
            $connection->dropTable(Testing\Model\ObjectsTable::getTableName());
        }
        return true;

    }

    public function InstallFiles()
    {
        //Установка компонента
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"] . "/local/modules/{$this->MODULE_ID}/install/components",
            $_SERVER["DOCUMENT_ROOT"] . "/bitrix/components", true, true);

        return true;
    }

    public function UnInstallFiles()
    {
        \Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"] . "/bitrix/components/testing");
        return true;
    }

    function registerEvents()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $eventManager->registerEventHandlerCompatible("main", "OnAfterUserUpdate", $this->MODULE_ID, "Testing\Handlers\BaseHandler", "OnAfterUserUpdateHandler");
    }

    function unregisterEvents()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $eventManager->unRegisterEventHandler("main", "OnAfterUserUpdate", $this->MODULE_ID, "Testing\Handlers\BaseHandler", "OnAfterUserUpdateHandler");
    }
}