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
class Searchentry{


    /**
     * indicates on which search key this entry is shown
     *
     * @var string
     */
    protected $searchkey;


    /**
     * Content shown on searchkey
     *
     * @var string
     *  @ORM\Column(type="text")
     */
    protected $content;

    function __construct($searchkey, $content)
    {
        $this->searchkey = $searchkey;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getSearchkey()
    {
        return $this->searchkey;
    }

    /**
     * @param string $searchkey
     */
    public function setSearchkey($searchkey)
    {
        $this->searchkey = $searchkey;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }



}