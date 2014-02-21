<?php

/**
 *
 * @copyright Copyright (c) 2013-2014 KipsProduction (http://www.kips.gr.jp)
 * @license   http://www.kips.gr.jp/newbsd/LICENSE.txt New BSD License
 */

namespace NpAppSkeletonTest\Pane\Gumby;

use Flower\View\Pane\Factory\AnchorPaneFactory;
use Flower\View\Pane\Entity\ApplicatableCallbackEntity;
use Flower\View\Pane\Entity\ApplicatableCallbackCollection;
use NpAppSkeletonTest\Bootstrap;


/**
 * Description of BootstrapTest
 *
 * @author Tomoaki Kosugi <kosugi at kips.gr.jp>
 */
class SkipLinkTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected $view;

    protected $manager;

    public function setUp()
    {
        $this->serviceLocator = Bootstrap::getServiceManager();
        $viewManager = $this->serviceLocator->get('viewManager');
        $this->view = $viewManager->getRenderer();
        $this->manager = $this->view->plugin('npPaneManager');
    }

    public function tearDown()
    {
        $this->manager->refresh('gumby/skipLink');
    }

    public function testWithApplicatableCallbackEntity()
    {
        $expects = str_replace("\r\n", "\n",
'<!-- begin Renderer -->
<ul id="sidebar-nav" gumby-fixed="1" gumby-top="top">
  <!-- start content CallbackRender -->
  <li>
  <a gumby-offset="-100" gumby-update gumby-duration="600" gumby-goto="[data-target=\'c1\']" class="skip" href="#c1">c1-label</a>
  </li>
  <!-- end content CallbackRender -->
  <!-- start content CallbackRender -->
  <li>
  <a gumby-offset="-100" gumby-update gumby-duration="600" gumby-goto="[data-target=\'c2\']" class="skip" href="#c2">c2-label</a>
  </li>
  <!-- end content CallbackRender -->
</ul>
<!-- end Renderer -->
');
        $callback = function ($pane, $params = array()) {
            $pane->href = sprintf($pane->href, $params['href']);
            $pane->attributes['gumby-goto'] = sprintf($pane->attributes['gumby-goto'], $params['target']);
            $pane->label = sprintf($pane->label, $params['label']);
            AnchorPaneFactory::parseBeginEnd($pane, $params);
        };
        $array = array(
            array(
                'href' => '#c1',
                'target' => 'c1',
                'label' => 'c1-label',
            ),
            array(
                'href' => '#c2',
                'target' => 'c2',
                'label' => 'c2-label',
            ),
        );
        $collection = new \ArrayIterator(array());
        foreach ($array as $entry) {
            $entity = new ApplicatableCallbackEntity($callback, $entry);
            $collection->append($entity);
        }
        $pane = $this->manager->get('gumby/skipLink');
        $pane->setCollection(new \ArrayIterator($collection));
        $this->assertEquals($expects, $this->manager->renderPane($pane));
    }

    public function testApplicatableCallbackCollectionTest()
    {
        $expects = str_replace("\r\n", "\n",
'<!-- begin Renderer -->
<ul id="sidebar-nav" gumby-fixed="1" gumby-top="top">
  <!-- start content CallbackRender -->
  <li>
  <a gumby-offset="-100" gumby-update gumby-duration="600" gumby-goto="[data-target=\'c1\']" class="skip" href="#c1">c1-label</a>
  </li>
  <!-- end content CallbackRender -->
  <!-- start content CallbackRender -->
  <li>
  <a gumby-offset="-100" gumby-update gumby-duration="600" gumby-goto="[data-target=\'c2\']" class="skip" href="#c2">c2-label</a>
  </li>
  <!-- end content CallbackRender -->
</ul>
<!-- end Renderer -->
');
        $callback = function ($pane, $params = array()) {
            $pane->href = sprintf($pane->href, $params['href']);
            $pane->attributes['gumby-goto'] = sprintf($pane->attributes['gumby-goto'], $params['target']);
            $pane->label = sprintf($pane->label, $params['label']);
            AnchorPaneFactory::parseBeginEnd($pane, $params);
        };
        $array = array(
            array(
                'href' => '#c1',
                'target' => 'c1',
                'label' => 'c1-label',
            ),
            array(
                'href' => '#c2',
                'target' => 'c2',
                'label' => 'c2-label',
            ),
        );
        $collection = new ApplicatableCallbackCollection($callback, $array);
        $pane = $this->manager->get('gumby/skipLink');
        $pane->setCollection($collection);
        $this->assertEquals($expects, $this->manager->renderPane($pane));
    }
}
