<?php
namespace Document\Service;

use Flower\Model\Service\RepositoryServiceFactory as AbstractRSF;
/**
 * Description of RepositoryServiceFactory
 *
 * @author tomoaki
 */
class RepositoryServiceFactory extends AbstractRSF {
    /**
     *
     * @var string
     */
    protected $configId = 'document_repositories';
    
    /**
     *
     * @var string
     */
    protected $managerClass = 'Document\Service\RepositoryPluginManager';
    
    /**
     * whether or not use DependencyInjector
     * 
     * @var bool
     */
    protected $useDi = true;    
}
