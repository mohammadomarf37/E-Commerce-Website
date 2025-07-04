<?php
include 'config.php'; // your db connection

$q = $_GET['q'] ?? '';

if (!empty($q)) {
    $stmt = $conn->prepare("SELECT id, name FROM products WHERE name LIKE CONCAT('%', ?, '%') LIMIT 5");
    $stmt->bind_param("s", $q);
    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row;
    }

    echo json_encode($suggestions);
}
?>
