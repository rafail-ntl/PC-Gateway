<?php
require_once 'includes/Database.php';

$db = Database::getInstance()->getConnection();

$sql = "
SELECT 
    p.id,
    p.product_title,
    p.product_description,
    p.main_image,
    p.price,
    t.thumbnail_image
FROM 
    products p
LEFT JOIN 
    product_thumbnails t ON p.id = t.product_id
";

$stmt = $db->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll();

$products = [];

foreach ($rows as $row) {
    $id = $row['id'];
    if (!isset($products[$id])) {
        $products[$id] = [
            'id' => $id,
            'title' => $row['product_title'],
            'description' => $row['product_description'],
            'main_image' => $row['main_image'],
            'price' => $row['price'],
            'thumbnails' => []
        ];
    }
    if ($row['thumbnail_image']) {
        $products[$id]['thumbnails'][] = $row['thumbnail_image'];
    }
}

header('Content-Type: application/json');
echo json_encode(array_values($products));
?>
