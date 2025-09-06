<?php
require "../config.php";
require "../auth/auth_check.php";

$data = json_decode(file_get_contents('php://input'), true);

if(!$data) {
    echo json_encode(['success'=>false, 'error'=>'Invalid input']); exit;
}

$order_type = $data['order_type'];
$items = json_encode($data['items']); // store items as JSON
$payment = $data['payment'];
$user_id = $_SESSION['user_id'];

// Check if user exists
$user_check = $pdo->prepare("SELECT id FROM users WHERE id = ?");
$user_check->execute([$user_id]);
if (!$user_check->fetch()) {
    echo json_encode(['success'=>false, 'error'=>'User not found. Please login again.']);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO orders (user_id, order_type, items, payment_method) VALUES (?, ?, ?, ?)");

try {
    $stmt->execute([$user_id, $order_type, $items, $payment]);
    echo json_encode(['success'=>true]);
} catch(PDOException $e){
    echo json_encode(['success'=>false, 'error'=>$e->getMessage()]);
}
