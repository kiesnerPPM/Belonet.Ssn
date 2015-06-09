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
	 * the user repo
	 * @Flow\Inject
	 * @var \Belonet\Ssn\Domain\Repository\UserAccountRepository
	 */
	protected $userAccountRepository;

	/**
	 * @var \TYPO3\Flow\Security\Context
	 * @Flow\Inject
	 */
	protected $securityContext;

	/**
	 * Action which shows all received mails
	 *
	 */
	public function showReceivedMailsAction() {
		$recipient = $this->securityContext->getAccount()->getParty();
		$recipientId = $this->persistenceManager->getIdentifierByObject($recipient);
		$allMails = $this->mailRepository->getReceivedMails($recipientId);
		$this->view->assign("allMails", $allMails);
	}

	/**
	 * @param \Belonet\Ssn\Domain\Model\Mail $mail
	 * @param string $editor
	 * @return void
	 */
	public function showReceivedMailItemAction(\Belonet\Ssn\Domain\Model\Mail $mail, $editor = 'show') {
		if ($editor == 'deleteConfirmed') {
			$this->mailRepository->remove($mail);
			$this->persistenceManager->persistAll();
			$this->redirect('showReceivedMails');
		}
		$mail->setOpened(1);
		$this->mailRepository->update($mail);
		$this->persistenceManager->persistAll();
		$this->view->assign('mail', $mail);
		$this->view->assign('editor', $editor);
	}


	/**
	 * Action which shows all sent mails
	 *
	 */
	public function showSendMailsAction() {
		$recipient = $this->securityContext->getAccount()->getParty();
		$recipientId = $this->persistenceManager->getIdentifierByObject($recipient);
		$allMails = $this->mailRepository->getSentMails($recipientId);
		$this->view->assign("allMails", $allMails);
	}

	/**
	 * @param \Belonet\Ssn\Domain\Model\Mail $mail
	 * @param string $editor
	 * @return void
	 */
	public function showSendMailItemAction(\Belonet\Ssn\Domain\Model\Mail $mail, $editor = 'show') {
		if ($editor == 'deleteConfirmed') {
			$this->mailRepository->remove($mail);
			$this->persistenceManager->persistAll();
			$this->redirect('showSendMails');
		}
		$this->view->assign('mail', $mail);
		$this->view->assign('editor', $editor);
	}


	/**
	 * Action which creates a new Mail
	 */
	public function newMailAction() {

	}

	/**
	 * @param string $recipient
	 * @param string $subject
	 * @param string $content
	 */
	public function sendMailAction($recipient, $subject, $content) {

		$recipientList = $this->userAccountRepository->findByEmailAddress($recipient);
		if (count($recipientList) === 1) {
			$sender = $this->securityContext->getAccount()->getParty();
			$date = new \DateTime();
			// create mail for sender and recipient
			$mail1 = new \Belonet\Ssn\Domain\Model\Mail($sender, $recipientList[0], $date, 1, $subject, $content, 1);
			$mail2 = new \Belonet\Ssn\Domain\Model\Mail($sender, $recipientList[0], $date, 0, $subject, $content, 0);
			// write to database
			$this->mailRepository->add($mail1);
			$this->mailRepository->add($mail2);
			$this->persistenceManager->persistAll();
		}

	}

}