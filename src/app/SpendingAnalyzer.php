<?php
namespace App;
use PDO;

class SpendingAnalyzer {
  private $pdo;

  public function __construct($dbUserName, $dbPassword) {
    $this->pdo = new PDO("mysql:host=mysql; dbname=tq_quest; charset=utf8", $dbUserName, $dbPassword);
  }

  public function getTotalSpendingsAmount() {
    $sql = "SELECT * FROM spendings";
    $statement = $this->pdo->prepare($sql);
    $statement->execute();
    $spendings = $statement->fetchAll(PDO::FETCH_ASSOC);

    $totalSpendingsAmount = 0;
    foreach($spendings as $spending) {
      $date = explode('-', $spending["accrual_date"]);
      $month = abs($date[1]);
      $day = abs($date[2]);

      if($month != 9) {
        continue;
      }
      $totalSpendingsAmount += $spending["amount"];

      if(strpos($day, "1") !== false) {
        $totalSpendingsAmount -= 2000;
      }
    }

    return $totalSpendingsAmount;
  }
}
?>