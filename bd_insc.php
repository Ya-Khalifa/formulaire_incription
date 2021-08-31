<?php
    $serveur = "mysql:host=localhost;dbname=registration_form";
    $login = "root";
    $mdp = "";

    $conn = new PDO($serveur,$login,$mdp);
    try
    {
        $conn = new PDO($serveur,$login,$mdp);
       // echo 'connecté!';
    }
    catch(PDOException $e)
    {

    }
?>