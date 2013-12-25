<?php

/*
 *
 *
 * @copyright Copyright (c) 2013-2013 KipsProduction (http://www.kips.gr.jp)
 * @license   http://www.kips.gr.jp/newbsd/LICENSE.txt New BSD License
 */

namespace Document\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Description of Document
 *
 * @author tomoaki
 * @ORM\Entity
 */
class Document {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $fullName;


    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }
    
    public function getFullName()
    {
        return $this->fullName;
    }
}
