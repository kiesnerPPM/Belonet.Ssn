<?php
namespace Belonet\Ssn\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Belonet.Ssn".           *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class SetupController extends \TYPO3\Flow\Mvc\Controller\ActionController {


    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Security\AccountRepository
     */
    protected $accountRepository;

    /**
     * the user repo
     * @Flow\Inject
     * @var \Belonet\Ssn\Domain\Repository\UserAccountRepository
     */
    protected $userAccountRepository;

    /**
     * index Action for Setup
     */
   public function indexAction(){
       if ($this->userAccountRepository->countAll() == 0) {

           $account = new \Belonet\Ssn\Domain\Model\UserAccount();
           $account->setPassword("password");

           $account->setUsername("Marwin");
           $account->setEmailAddress("marwin@email.com");

           $this->accountRepository->add($account->getPrimaryAccount());
           $this->userAccountRepository->add($account);

           $account2 = new \Belonet\Ssn\Domain\Model\UserAccount();
           $account2->setPassword("password");

           $account2->setUsername("Stefan");
           $account2->setEmailAddress("stefan@email.com");

           $this->accountRepository->add($account2->getPrimaryAccount());
           $this->userAccountRepository->add($account2);

           $account3 = new \Belonet\Ssn\Domain\Model\UserAccount();
           $account3->setPassword("password");

           $account3->setUsername("veronika");
           $account3->setEmailAddress("veronika@email.com");

           $this->accountRepository->add($account3->getPrimaryAccount());
           $this->userAccountRepository->add($account3);
       }
       $this->persistenceManager->persistAll();
       $this->addFlashMessage('Created Default Accounts');
       $this->redirect("AdminLogin", "Login");

   }
}