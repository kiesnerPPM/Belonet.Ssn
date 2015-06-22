<?php
namespace Belonet\Ssn\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Belonet.Ssn".           *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class SearchController extends \TYPO3\Flow\Mvc\Controller\ActionController {

    /**
     * action for displaying standard search page
     */
    protected $persistenceManager;
    protected $searchentryRepository;


    /**
     * @param \Belonet\Ssn\Domain\Model\Searchentry $currentEntry
     */
    public function showSearchPageAction(\Belonet\Ssn\Domain\Model\Searchentry $currentEntry = null) {
        $user = $this->authenticationManager->getSecurityContext()->getAccount()->getParty();

        $allEntries = $this->searchentryRepository->findAll()->toArray();
        if (is_null($currentEntry)) {
            $currentEntry = $allEntries[0];
        }
        $this->view->assign("currentEntry", $currentEntry);
        $this->view->assign("allEntries", $allEntries);


    }
    public function createNewEntryAction(\Belonet\Ssn\Domain\Model\Searchentry $entry)
    {
        $this->searchentryRepository->add($entry);
        $this->redirect("showSearchPage", null, null, array());
    }
    /**
     * action for displaying search results
     */
   public function showSearchResultsAction(){

   }
}