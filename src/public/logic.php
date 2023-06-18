<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\SpendingAnalyzer;

$analyzer = new SpendingAnalyzer("root", "password");
$totalSpendingsAmount = $analyzer->getTotalSpendingsAmount();
echo "9月の支出の合計: " . $totalSpendingsAmount;

?>