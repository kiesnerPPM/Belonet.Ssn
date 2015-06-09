<?php
namespace Belonet\Ssn\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Weblabcenter.Crowdtask".  *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * An User Account
 *
 * @Flow\Entity
 */
class UserAccount extends \TYPO3\Party\Domain\Model\AbstractParty {

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Security\Cryptography\HashService
     */
    protected $hashService;

    /**
     * Email Address
     * @Flow\Validate(type="EmailAddress")
     * @Flow\Validate(type="NotEmpty")
     * @var string
     */
    protected $emailAddress;

    /**
     *in options evtl rollen auf Admin reduzieren, dann aber überall!    
     * @var string
     * @Flow\Validate(type="RegularExpression", options={"regularExpression"="/^(BelonetUser|Worker|Employer)$/"})
     */
    protected $role;

    /**
     * created
     * @var \DateTime
     */
    protected $created;

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="String")
     * @Flow\Validate(type="StringLength", options={"minimum"=1, "maximum"=40})
     */
    protected $username;

    /**
     * @var string
     *@ORM\Column(nullable=true)
     */
    protected $name;


    /**
     * @var \Doctrine\Common\Collections\Collection<\Belonet\Ssn\Domain\Model\Mail>
     * @ORM\OneToMany(mappedBy="UserAccount")
     * @ORM\Column(nullable=true)
     */
    protected $sentMails;


    /**
     * @var \Doctrine\Common\Collections\Collection<\Belonet\Ssn\Domain\Model\Mail>
     * @ORM\OneToMany(mappedBy="UserAccount")
     * @ORM\Column(nullable=true)
     */
    protected $receivedMails;

     /**
     * Constructs a new abstract user account
     */
    public function __construct() {
        parent::__construct();
        $account = new \TYPO3\Flow\Security\Account();
        $account->setAuthenticationProviderName('DefaultProvider');
        $this->addAccount($account);
        $this->created = new \DateTime();
        $this->setRole("BelonetUser");
    }


    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
        $account = $this->getPrimaryAccount();
        $account->setAccountIdentifier($emailAddress);
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }



    /**
     * @param string $role
     */
    public function setRole($role) {
        $this->role = $role;
        $account = $this->getPrimaryAccount();
        $roles = array();
        $policyService = new \TYPO3\Flow\Security\Policy\PolicyService();
        $roles[] = $policyService->getRole("Belonet.Ssn:".$role);
        $account->setRoles($roles);
    }



    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $password
     */
    public function setPassword($password) {
        $account = $this->getPrimaryAccount();
        $account->setCredentialsSource($this->hashService->hashPassword($password, "default"));
    }

    /**
     * @return \TYPO3\Flow\Security\Account
     */
    public function getPrimaryAccount() {
        $result = NULL;
        foreach($this->accounts as $account){
            if($account->getAuthenticationProviderName() == "DefaultProvider"){
                $result = $account;
                break;
            }
        }
        return $result;
    }

    /**
     * @param \DateTime() $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime()
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSentMails()
    {
        return $this->sentMails;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $sentMails
     */
    public function setSentMails($sentMails)
    {
        $this->sentMails = $sentMails;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReceivedMails()
    {
        return $this->receivedMails;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $receivedMails
     */
    public function setReceivedMails($receivedMails)
    {
        $this->receivedMails = $receivedMails;
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
?>