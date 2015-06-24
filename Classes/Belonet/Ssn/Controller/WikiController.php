<?php
namespace Belonet\Ssn\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Belonet.Ssn".           *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class WikiController extends \TYPO3\Flow\Mvc\Controller\ActionController {

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
     */
    protected $persistenceManager;

    /**
     * @Flow\Inject
     * @var \Belonet\Ssn\Domain\Repository\WikiRepository
     */
    protected $wikiRepository;

	/**
     * action to show all entries
     *
     * @param \Belonet\Ssn\Domain\Model\Wiki $currentEntry
     * @param string $ssf
	 * @return void
	 */
	public function showEntriesAction(\Belonet\Ssn\Domain\Model\Wiki $currentEntry = null, $ssf = null) {

        $allEntries = array_filter($this->wikiRepository->findAll()->toArray(),
                                   function($e) use ($ssf) {return is_null($ssf) ||
                                                            $ssf === "" ||
                                                            strpos($e->getEntryType() .
                                                                   $e->getOpeningHours() .
                                                                   $e->getTelephoneNumber().
                                                                   $e->getInformation().
                                                                   $e->getKeyWords(), $ssf) !== false;});
        echo $ssf;
        $this->view->assign("searchStringFilter", $ssf);
        $this->view->assign("currentEntry", $currentEntry);
        $this->view->assign("allEntries", $allEntries);
	}

    public function createNewEntryAction(\Belonet\Ssn\Domain\Model\Wiki  $entry) {
        $this->wikiRepository->add($entry);
        $this->redirect("showEntries", null, null, array());
    }

    public function showCreateNewEntryFormAction() {

    }
}

