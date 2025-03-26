<?php
// Product mappings
$products = [
    'tom-ford' => 'product1-info.php',    // Parfum
    'gisada' => 'product3-info.php',      // Geur
    'jean-paul' => 'product2-info.php'    // Eau de Toilette
];

// Categorieën met hun vaste productverwijzing
$category_products = [
    'parfums' => 'tom-ford',      // Parfums categorie gaat altijd naar Tom Ford
    'geuren' => 'gisada',         // Geuren categorie gaat altijd naar Gisada
    'eau-du' => 'jean-paul'       // Eau de Toilette gaat altijd naar Jean Paul
];

// Welke producten horen bij welke categorie
$product_categories = [
    'tom-ford' => 'parfums',
    'gisada' => 'geuren',
    'jean-paul' => 'eau-du'
];

// Input verwerken
$query = isset($_GET['query']) ? trim(htmlspecialchars($_GET['query'], ENT_QUOTES, 'UTF-8')) : '';
$category = isset($_GET['categorie']) ? trim(htmlspecialchars($_GET['categorie'], ENT_QUOTES, 'UTF-8')) : '';

// Eerst zoekopdracht verwerken
if (!empty($query)) {
    $query = strtolower(preg_replace('/\s+/', '-', $query));
    
    // Als er een categorie is geselecteerd
    if (!empty($category)) {
        // Controleer of het product bij de geselecteerde categorie hoort
        if (array_key_exists($query, $product_categories) && $product_categories[$query] !== $category) {
            header("Location: error-zoeken.php");
            exit();
        }
    }
    
    if (array_key_exists($query, $products)) {
        header("Location: " . $products[$query]);
        exit();
    }
    
    header("Location: error-zoeken.php");
    exit();
} 
// Anders categorie verwerken
elseif (!empty($category)) {
    if (array_key_exists($category, $category_products)) {
        $product = $category_products[$category];
        header("Location: " . $products[$product]);
        exit();
    }
}

// Als alles mislukt, ga naar error pagina
header("Location: error-zoeken.php");
exit();
?>