<?php
header('Content-Type: application/json; charset=utf-8');

$input = json_decode(file_get_contents('php://input'), true);

$snack = trim($input['snack'] ?? '');
$price = (float)($input['price'] ?? 0);
$cash = (float)($input['cash'] ?? 0);
$quantity = (int)($input['quantity'] ?? 0);

if (empty($snack) || $price <= 0 || $cash <= 0 || $quantity <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Please fill out all fields correctly.'
    ]);
    exit;
}

$total = $price * $quantity;

if ($cash < $total) {
    echo json_encode([
        'success' => false,
        'message' => "Insufficient cash! You need ₱" . number_format($total, 2) . " to buy $quantity × $snack.",
        'required_amount' => $total,
        'received_cash' => $cash
    ]);
    exit;
}

$change = $cash - $total;

echo json_encode([
    'success' => true,
    'message' => "Salamat! You bought $quantity × $snack successfully.",
    'snack' => $snack,
    'quantity' => $quantity,
    'price_each' => $price,
    'total' => $total,
    'cash_given' => $cash,
    'change' => $change,
    'formatted' => [
        'total' => '₱' . number_format($total, 2),
        'cash' => '₱' . number_format($cash, 2),
        'change' => '₱' . number_format($change, 2)
    ]
]);
?>