<?php

/**
 *
 * @copyright Copyright (c) 2013-2014 KipsProduction (http://www.kips.gr.jp)
 * @license   http://www.kips.gr.jp/newbsd/LICENSE.txt New BSD License
 */

namespace NpAppSkeletonTest;

/**
 * Description of BootstrapTest
 *
 * @author Tomoaki Kosugi <kosugi at kips.gr.jp>
 */
class BootstrapTest extends \PHPUnit_Framework_TestCase
{
    protected $serviceLocator;

    public function setUp()
    {
        $this->serviceLocator = Bootstrap::getServiceManager();
    }

    public function testServiceLocator()
    {
        $this->assertInstanceOf('Zend\ServiceManager\ServiceManager', $this->serviceLocator);
    }

    public function testInjectedConfig()
    {
        $config = $this->serviceLocator->get('Config');
        $this->assertTrue($config);
    }
}
