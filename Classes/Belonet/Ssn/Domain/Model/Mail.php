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
     * @var \Belonet\Ssn\Domain\Model\UserAccount
     * @ORM\ManyToOne(inversedBy="mail")
     */
    protected $sender;

    /**
     * @var \Belonet\Ssn\Domain\Model\UserAccount
     * @ORM\ManyToOne(inversedBy="mail")
     */
    protected $recipient;

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
     * @ORM\Column(nullable=true)
     */
    protected $subject;

    /**
     * @var int
     */
    protected $mailOfSender;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $content;

    function __construct($sender, $recipient, $date, $opened, $subject, $content, $mailOfSender)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->date = $date;
        $this->opened = $opened;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * @return UserAccount
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param UserAccount $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return UserAccount
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param UserAccount $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
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
     * @return int
     */
    public function getMailOfSender()
    {
        return $this->mailOfSender;
    }

    /**
     * @param int $mailOfSender
     */
    public function setMailOfSender($mailOfSender)
    {
        $this->mailOfSender = $mailOfSender;
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