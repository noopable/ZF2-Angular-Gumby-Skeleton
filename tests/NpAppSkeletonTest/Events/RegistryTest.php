<?php

/**
 *
 * @copyright Copyright (c) 2013-2014 KipsProduction (http://www.kips.gr.jp)
 * @license   http://www.kips.gr.jp/newbsd/LICENSE.txt New BSD License
 */

namespace NpAppSkeletonTest\Events;

use Flower\View\Pane\Factory\AnchorPaneFactory;
use Flower\View\Pane\Entity\ApplicatableCallbackEntity;
use Flower\View\Pane\Entity\ApplicatableCallbackCollection;
use NpAppSkeletonTest\Bootstrap;


/**
 * Description of BootstrapTest
 *
 * @author Tomoaki Kosugi <kosugi at kips.gr.jp>
 */
class RegistryTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected $view;

    protected $manager;

    protected $registryEvents;

    public function setUp()
    {
        $this->serviceLocator = Bootstrap::getServiceManager();
        $viewManager = $this->serviceLocator->get('viewManager');
        $this->view = $viewManager->getRenderer();
        $this->manager = $this->view->plugin('npPaneManager');
        $this->registryEvents = $this->serviceLocator->get('RegistryEventManager');
    }

    public function tearDown()
    {
    }

    public function testEvent()
    {
        $this->registryEvents->notify('pane', 'gumby/skipLink', 'refresh');
    }


}
