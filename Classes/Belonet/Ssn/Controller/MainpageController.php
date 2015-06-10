<?php
namespace Belonet\Ssn\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Belonet.Ssn".           *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class MainpageController extends \TYPO3\Flow\Mvc\Controller\ActionController {

  /**
   * @Flow\Inject
   * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
   */
  protected $authenticationManager;

	/**
	 * this will activate the Index.html in Directory Mainpage
	 * here comes the content for Mainpage
	 *
	 * @return void
	 */
	public function indexAction() {
    $user = $this->authenticationManager->getSecurityContext()->getAccount()->getParty();
    $hour = date('H');
    if ($hour < 6)
      $welcome = 'Gute Nacht '.$user->getName().',';
    else if ($hour < 12)
      $welcome = 'Guten Morgen '.$user->getName().',';
    else if ($hour < 18)
      $welcome = 'Guten Tag '.$user->getName().',';
    else
      $welcome = 'Guten Abend '.$user->getName().',';
    $this->view->assign('welcome',$welcome);
	}

  public function showImpressumAction() {

  }

  public function showContactAction() {

  }


}