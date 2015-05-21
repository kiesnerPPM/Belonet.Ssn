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
class Mail{


    /**
     * @var \Belonet\Ssn\Domain\Model\User
     * @ORM\ManyToOne(inversedBy="mail")
     */
    protected $sender;

    /**
     * @var \Belonet\Ssn\Domain\Model\User
     * @ORM\ManyToOne(inversedBy="mail")
     */
    protected $receiver;

    /**
     * receive date of mail
     *
     * @var DateTime
     */
    protected $date;

    /**
     * 1: opened
     * 0: not opened (unread)
     *
     * @var int
     */
    protected $opened;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $content;

    function __construct($sender, $receiver, $date, $opened, $subject, $content)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->date = $date;
        $this->opened = $opened;
        $this->subject = $subject;
        $this->content = $content;
    }


    /**
     * @return User
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param User $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return User
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @param User $receiver
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getOpened()
    {
        return $this->opened;
    }

    /**
     * @param int $opened
     */
    public function setOpened($opened)
    {
        $this->opened = $opened;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
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