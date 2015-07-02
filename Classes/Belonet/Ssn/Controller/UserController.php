<?php
namespace Belonet\Ssn\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Belonet.Ssn".           *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class UserController extends \TYPO3\Flow\Mvc\Controller\ActionController {

    /**
     * action for displaying standard search page
     */
    protected $persistenceManager;

    /**
     * @var \TYPO3\Flow\Security\Context
     * @Flow\Inject
     */
    protected $securityContext;

    /**
     * the user repo
     * @Flow\Inject
     * @var \Belonet\Ssn\Domain\Repository\UserAccountRepository
     */
    protected $userAccountRepository;


    /**
     */
    public function showMyDataAction() {
        $user = $this->securityContext->getAccount()->getParty();
        $this->view->assign("email", $user->getEmailAddress());
        $this->view->assign("name", $user->getName());
        $this->view->assign("username", $user->getUsername());
    }


    /**
     * Action to change saved datas about person
     * @param string $emailAddress
     * @param string $username
     * @param string $name
     */
    public function changeMyDataAction($emailAddress, $username, $name){
        $user = $this->securityContext->getAccount()->getParty();
        $user->setEmailAddress($emailAddress);
        $user->setUserName($username);
        $user->setName($name);
        $this->userAccountRepository->update($user);
        $this->addFlashMessage('Account wurde gespeichert', "Speichern OK", "OK");
        $this->redirect("showMyData", null, null, array());
    }

}