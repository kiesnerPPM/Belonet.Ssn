<?php
namespace Belonet\Ssn\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Belonet.Ssn".           *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class MailController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager;

	/**
	 * @Flow\Inject
	 * @var \Belonet\Ssn\Domain\Repository\MailRepository
	 */
	protected $mailRepository;

	/**
	 * Action which shows all received mails
	 *
	 */
	public function showReceivedMailsAction() {
		// TODO: Fix this to get only the mails for the current user
		$allMails = $this->mailRepository->findAll()->toArray();
		$this->view->assign("allMails", $allMails);
	}

	/**
	 * @param \Belonet\Ssn\Domain\Model\Mail $mail
	 * @return void
	 */
	public function showReceivedMailItemAction(\Belonet\Ssn\Domain\Model\Mail $mail) {
		$this->view->assign("mail", $mail);
	}


	/**
	 * Action which shows all sent mails
	 *
	 */
	public function showSendMailsAction() {
		// TODO: Fix this to get only the mails for the current user
		$allMails = $this->mailRepository->findAll()->toArray();
		$this->view->assign("allMails", $allMails);
	}

	/**
	 * @param \Belonet\Ssn\Domain\Model\Mail $mail
	 * @return void
	 */
	public function showSendMailItemAction(\Belonet\Ssn\Domain\Model\Mail $mail) {
		$this->view->assign("mail", $mail);
	}



	/**
	 * Action which creates a new Mail
	 */
	public function newMailAction() {

	}

}