<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'ticketing_app';
$username = 'root';
$password = 'root';

try {
    // Création de l'objet PDO (la connexion)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // On configure PDO pour qu'il nous affiche les vraies erreurs SQL si on se trompe
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // On veut récupérer les données sous forme de tableau associatif
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // Si la connexion échoue, on arrête tout et on affiche l'erreur
    die("Erreur de connexion à la BDD : " . $e->getMessage());
}
?>