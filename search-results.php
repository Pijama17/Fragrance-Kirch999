<?php
// search-results.php

// Sanitize and validate query and category inputs
$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

// Maak de zoekterm en categorie veiliger door HTML-entities te converteren
$query = htmlspecialchars($query, ENT_QUOTES, 'UTF-8');
$category = htmlspecialchars($category, ENT_QUOTES, 'UTF-8');

// Log zoekopdrachten voor analyse (simpel loggen in een tekstbestand)
function logSearch($query, $category) {
    $logfile = 'search_log.txt';
    $logentry = date('Y-m-d H:i:s') . " - Zoekopdracht: " . $query . " | Categorie: " . $category . "\n";
    file_put_contents($logfile, $logentry, FILE_APPEND);
}

// Als er geen zoekterm of categorie is opgegeven, laat een foutmelding zien
if (empty($query) && empty($category)) {
    echo "Geen zoekterm of categorie opgegeven. Vul een zoekopdracht in.";
    exit();
}

// Log de zoekopdracht voor later gebruik
logSearch($query, $category);

// Simuleer een databasequery: producten die passen bij de zoekterm en categorie
// Dit zou normaal gesproken een echte databasequery zijn, bijvoorbeeld met PDO of MySQLi.
$producten = [
    [
        'name' => 'Tom Ford Oud Wood',
        'price' => 150.00,
        'category' => 'parfums',
        'image' => 'images/tomford.jpg',
        'description' => 'Een luxe geur van Tom Ford'
    ],
    [
        'name' => 'Jean Paul Gaultier Le Male',
        'price' => 75.00,
        'category' => 'parfums',
        'image' => 'images/jeanpaul.jpg',
        'description' => 'Een iconische geur van Jean Paul Gaultier'
    ],
    [
        'name' => 'Creed Aventus',
        'price' => 300.00,
        'category' => 'luxury',
        'image' => 'images/creed.jpg',
        'description' => 'De ultieme geur van Creed, luxe en elegantie'
    ],
    // Voeg meer producten toe voor testdoeleinden
];

// Filter de producten op basis van de zoekterm en categorie
$filtered_products = array_filter($producten, function($product) use ($query, $category) {
    $matches_query = (strpos(strtolower($product['name']), strtolower($query)) !== false);
    $matches_category = (empty($category) || strtolower($product['category']) === strtolower($category));
    return $matches_query && $matches_category;
});

// Toon zoekresultaten
if (count($filtered_products) > 0) {
    echo "<h3>Zoekresultaten voor: <strong>" . $query . "</strong></h3>";
    echo "<p>Categorie: <strong>" . ($category ? $category : 'Alle categorieën') . "</strong></p>";
    echo "<div class='product-list'>";

    // Toon alle gefilterde producten
    foreach ($filtered_products as $product) {
        echo "<div class='product-item'>";
        echo "<img src='" . $product['image'] . "' alt='" . $product['name'] . "' style='width:150px;'>";
        echo "<h4>" . $product['name'] . "</h4>";
        echo "<p>Prijs: €" . number_format($product['price'], 2, ',', '.') . "</p>";
        echo "<p>" . $product['description'] . "</p>";
        echo "<a href='product-detail.php?name=" . urlencode($product['name']) . "' class='btn btn-primary'>Bekijk Details</a>";
        echo "</div>";
    }

    echo "</div>";

    // Paginering (voor nu een simpele mock-up)
    $total_results = count($filtered_products);
    $results_per_page = 2; // Aantal resultaten per pagina
    $total_pages = ceil($total_results / $results_per_page);

    if ($total_pages > 1) {
        echo "<div class='pagination'>";
        for ($page = 1; $page <= $total_pages; $page++) {
            echo "<a href='search-results.php?query=" . urlencode($query) . "&category=" . urlencode($category) . "&page=$page'>" . $page . "</a> ";
        }
        echo "</div>";
    }

} else {
    // Geen producten gevonden
    echo "<p>Geen producten gevonden voor je zoekopdracht: <strong>" . $query . "</strong> in de categorie: <strong>" . ($category ? $category : 'Alle categorieën') . "</strong>.</p>";
}
?>
