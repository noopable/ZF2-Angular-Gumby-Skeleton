<?php
return array(
    'name' => 'sidebar',
    'options' => array(
        'template'=>'document/index/sidenav',
        'captureTo' => 'sidebar',
        'order' => 100,
        'viewModelAppend' => true,
        'viewModelBuilder' => array(
            'policy' => 'dispatch',
            'options' => array(
                'controller' => 'Document\Controller\Index',
                'action' => 'sidenav',
            ),
            'signature' => ['controller', 'action'],
         ),
    ),
    'properties' => array (
    ),
);