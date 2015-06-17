<?php
namespace Belonet\Ssn\Domain\Repository;

/**
 * Created by PhpStorm.
 * User: Veronika
 * Date: 10.03.2015
 * Time: 13:47
 */


use TYPO3\Flow\Annotations as Flow;

/**
 * Mail Repo
 * @Flow\Scope("singleton")
 */
class MailRepository extends \TYPO3\Flow\Persistence\Repository {

  /**
   * @param string $userId
   * @return array
   */
  public function getReceivedMails($userId) {
    $query = $this->createQuery();
    $query->setOrderings(Array('date'=> \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING));
    $result = $query->matching(
      $query->logicalAnd(
        $query->equals("recipient", $userId),
        $query->equals("mailOfSender", "0")
      )
    )->execute()->toArray();
    return $result;
  }

  public function getSentMails($userId) {
    $query = $this->createQuery();
    $query->setOrderings(Array('date'=> \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING));
    $result = $query->matching(
      $query->logicalAnd(
        $query->equals("sender", $userId),
        $query->equals("mailOfSender", "1")
      )
    )->execute()->toArray();
    return $result;
  }

}