<?php
/**
 * トップページ用の暫定的実装である。
 * ページリソースを呼び出せるようにリファクタリングしていく。
 * ページリソースとしての動作と、コントローラーとしての動作の両方を実装する。
 */

namespace Document\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        /*
        $objectManager = $this
            ->getServiceLocator()
            ->get('Doctrine\ORM\EntityManager');

        $user = new \Document\Model\Entity\Document;
        $user->setFullName('Tomoaki Kosugi');

        $objectManager->persist($user);
        $objectManager->flush();
         * 
         */
        return array();
    }

    public function sidenavAction()
    {
        return new ViewModel;
    }
    
    public function whatsnewAction()
    {
        //暫定的に、配列を返す
        return array('items' => array('foo' => 'bar'));
        $sl = $this->getServiceLocator();
        if (! $sl->has('Document_Repositories')) {
            $message = "Document_Repositories not found";
            if (isset($this->logger)) {
                $this->logger->log($message);
            }
            else {
                trigger_error($message, E_USER_WARNING);
            }
            return array('error' => ['message' => $message]);
        }
        
        $repositoryManager = $sl->get('Document_Repositories');
        
        $repository = $repositoryManager->byName('Item');

        $whatNew = $repository->getWhatsNew(6);

        return array('items' => $whatNew);
    }

}