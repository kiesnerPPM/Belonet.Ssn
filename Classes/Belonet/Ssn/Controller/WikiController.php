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
	 * @return void
	 */
	public function showEntriesAction(\Belonet\Ssn\Domain\Model\Wiki  $currentEntry = null) {
        $allEntries = $this->wikiRepository->findAll()->toArray();
        if (is_null($currentEntry)) {
            $currentEntry = $allEntries[0];
        }
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