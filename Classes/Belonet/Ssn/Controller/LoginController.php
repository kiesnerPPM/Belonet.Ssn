<?php
namespace Belonet\Ssn\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Weblabcenter.Crowdtask".              *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * LoginController controller for the package
 */
class LoginController extends \TYPO3\Flow\Mvc\Controller\ActionController
{

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
     */
    protected $authenticationManager;

    /**
     * the user account repo
     * @Flow\Inject
     * @var \Belonet\Ssn\Domain\Repository\UserAccountRepository
     */
    protected $userAccountRepository;

    /**
     * index action, does only display the form
     * @param array $error
     */
    public function adminLoginAction($error=array()) {
        $this->view->assign("error", $error);
        if($this->authenticationManager->isAuthenticated()){
            $this->redirect("index", "Mainpage");
        }

    }


    /**
     *wird von adminLoginAction aufgerufen bei Click auf Login
     *         
     * @return void
     * @throws \TYPO3\Flow\Security\Exception\AuthenticationRequiredException
     */
    public function adminAuthenticateAction() {

            try {
                $this->authenticationManager->authenticate();
                $user = $this->authenticationManager->getSecurityContext()->getAccount()->getParty();

                if (strstr($user->getRole(),"User") === false){
                    $this->authenticationManager->logout();
                    $error=array('message'=>'Access denied.', 'errorCode'=>null, 'referenceCode'=>null);
                    $error=base64_encode(json_encode($error));
                    $this->addFlashMessage('abc');
                    $this->redirect('adminLogin','Login', null, array("error" => $error));
                }else{
                
                //evtl ist update überflüssig, schauen, ob ichs löschen kann

                    $this->userAccountRepository->update($user);

                    $this->redirect('index','Mainpage');
                }

            } catch (\TYPO3\Flow\Security\Exception\AuthenticationRequiredException $exception) {
                $this->addFlashMessage('Wrong username or password.', null, "Warning");
                $this->redirect('adminLogin');

            }
    }

    /**
     * logs out the current user
     */
    public function logoutAdminAction() {
        $this->authenticationManager->logout();
        $this->addFlashMessage('Logout Successful');
        $this->redirect('adminLogin');
    }

}

