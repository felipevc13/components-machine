<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Catálogo de Componentes',
    'defaultController'=>'componentes',
    'import'=>array(
        'application.components.*',
    ),
    'components'=>array(
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false, // Add this line to hide index.php
            'rules'=>array(
                'componentes/<action:\w+>' => 'componentes/<action>',
                // Add more specific rules if needed above generic ones
            ),
        ),
    ),
);
