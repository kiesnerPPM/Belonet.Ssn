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
class Wiki{


    /**
     * for exmple doctor, club, ...
     *
     * @var string
     */
    protected $entryType;

    /**
     * information about entry
     * Opening hours
     * telephone number
     * TODO: maybe split up
     *
     * @var string
     * @ORM\Column(type="text")
     */
    protected $information;

    /**
     * maybe there is a contact person
     *
     * @var string
     *@ORM\Column(nullable=true)
     */
    protected $responsiblePerson;

    function __construct($entryType, $information)
    {
        $this->entryType = $entryType;
        $this->information = $information;
    }


    /**
     * @return string
     */
    public function getEntryType()
    {
        return $this->entryType;
    }

    /**
     * @param string $entryType
     */
    public function setEntryType($entryType)
    {
        $this->entryType = $entryType;
    }

    /**
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param string $information
     */
    public function setInformation($information)
    {
        $this->information = $information;
    }

    /**
     * @return string
     */
    public function getResponsiblePerson()
    {
        return $this->responsiblePerson;
    }

    /**
     * @param string $responsiblePerson
     */
    public function setResponsiblePerson($responsiblePerson)
    {
        $this->responsiblePerson = $responsiblePerson;
    }




}