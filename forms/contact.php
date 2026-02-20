<?php

// Paramètres de connexion
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio_db";

// Connexion à MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Vérifier si formulaire envoyé
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Préparer la requête
    $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "OK";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}
// Fermer la connexion
$conn->close();

?>