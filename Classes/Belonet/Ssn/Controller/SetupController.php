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
           $account->setEmailAddress("marwin@belonet.de");

           $this->accountRepository->add($account->getPrimaryAccount());
           $this->userAccountRepository->add($account);

           $account2 = new \Belonet\Ssn\Domain\Model\UserAccount();
           $account2->setPassword("password");

           $account2->setUsername("Stefan");
           $account2->setEmailAddress("stefan@belonet.de");

           $this->accountRepository->add($account2->getPrimaryAccount());
           $this->userAccountRepository->add($account2);

           $account3 = new \Belonet\Ssn\Domain\Model\UserAccount();
           $account3->setPassword("password");

           $account3->setUsername("Veronika");
           $account3->setEmailAddress("veronika@belonet.de");

           $this->accountRepository->add($account3->getPrimaryAccount());
           $this->userAccountRepository->add($account3);

           $account4 = new \Belonet\Ssn\Domain\Model\UserAccount();
           $account4->setPassword("password");

           $account4->setUsername("Max");
           $account4->setEmailAddress("max@belonet.de");

           $this->accountRepository->add($account4->getPrimaryAccount());
           $this->userAccountRepository->add($account4);

           $account5 = new \Belonet\Ssn\Domain\Model\UserAccount();
           $account5->setPassword("password");

           $account5->setUsername("Frank");
           $account5->setEmailAddress("frank@belonet.de");

           $this->accountRepository->add($account5->getPrimaryAccount());
           $this->userAccountRepository->add($account5);

           $account6 = new \Belonet\Ssn\Domain\Model\UserAccount();
           $account6->setPassword("password");

           $account6->setUsername("Anna");
           $account6->setEmailAddress("anna@belonet.de");

           $this->accountRepository->add($account6->getPrimaryAccount());
           $this->userAccountRepository->add($account6);
       }
       $this->persistenceManager->persistAll();
       $this->addFlashMessage('Created Default Accounts');
       $this->redirect("AdminLogin", "Login");

   }
}