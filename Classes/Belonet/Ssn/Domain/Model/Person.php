<?php
/**
 * Created by PhpStorm.
 * User: Veronika
 * Date: 10.03.2015
 * Time: 13:11
 */

namespace Belonet\Ssn\Domain\Model;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Person{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Doctrine\Common\Collections\Collection<\Belonet\Ssn\Domain\Model\Mail>
     * @ORM\OneToMany(mappedBy="person")
     */
    protected $sentMails;

    /**
     * @var \Doctrine\Common\Collections\Collection<\Belonet\Ssn\Domain\Model\Mail>
     * @ORM\OneToMany(mappedBy="person")
     */
    protected $receivedMails;

    function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}