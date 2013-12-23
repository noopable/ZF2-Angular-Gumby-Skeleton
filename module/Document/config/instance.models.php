<?php
return array(
    'alias' => array( //add alias first !
        //リソースfactoryでブリッジ指定したサービスは、Aliasを張ることでDIで使用可能になる。
        //このalias指定がないと、パラメーターとして指定したときインスタンスと解釈してくれない。
        //ちなみに、Alias指定の対象クラスはなんでもいい！
        'DocumentCollection' => 'Document\Model\Repository\Document\DocumentCollection',
        'ItemTable' => 'Zend\Db\TableGateway\TableGateway',
        'ClientTable' =>   'Zend\Db\TableGateway\TableGateway',
    ),
    'preferences' => array(
    ),
    'ClientTable' => array(
        'parameters' => array(
            'table' => 'client',
            'adapter' => 'dbAdapter',
        ),
    ),
    'Zend\InputFilter\InputFilter' => array(),
    'Document\Model\Client\Client' => array(
        'parameters' => array(
            'array' => array(),
        ),
    ),
    'Document\Model\Repository\ClientDb' => array(
        'parameters' => array(
            'name' => 'client',
            'entityPrototype' => 'Document\Model\Client\Client',
            'tableGateway' => 'ClientTable',
        ),
    ),
    'Document\Model\Repository\ClientSession' => array(
        'parameters' => array(
            'name' => 'cart',
            'entityPrototype' => 'Document\Model\Client\Client',
            'namespace' => 'Document\Client',
        ),
    ),
);