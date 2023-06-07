<?php
Bitrix\Main\Loader::registerAutoloadClasses(
    "testing.dispatchers",
    [
        "Testing\\Model\\DispatchersTable" => "/lib/models/DispatchersTable.php",
        "Testing\\Model\\ObjectsTable" => "/lib/models/ObjectsTable.php",
        "Testing\\Handlers\\BaseHandler" => "lib/handlers/BaseHandler.php",
    ]
);