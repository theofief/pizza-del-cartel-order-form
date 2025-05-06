<?php
session_start();
$name = $_SESSION['name'] ?? 'Client';
$total = $_SESSION['total'] ?? '0.00';
session_destroy(); // Optionnel si tu veux tout vider après affichage
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Pizza del Cartel - Confirmation</title>
</head>
<body>
    <div class="confirmation">
        <h1>Merci pour votre commande, <?= htmlspecialchars($name) ?> ! 🍕</h1>
        <p>Montant total : <?= $total ?> €</p>
        <a href="index.html">Retour à la page d'accueil</a>
    </div>
</body>
</html>