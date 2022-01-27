<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4_tyres</title>
</head>
<body>

<h1>DEVIS GRATUIT ET RENDEZ-VOUS IMMÉDIAT</h1>
    <form action="" method="POST"> 
        <p>veuillez saisir votre nom:</p>
        <input type="text" name="nom">
        <br>
        <p>veuillez saisir votre prenom :</p>
        <input type="text" name="prenom">
        <br>
        <p>veuillez saisir votre Email :</p>
        <input type="text" name="email">
        <br>
        <p>veuillez saisir votre numero :</p>
        <input type="text" name="numero">
        <br>
        <p>veuillez saisir votre mot de passe :</p>
        <input type="text" name="mdp">
        <br>
        <input type="submit" value="Ajouter">
    </form>
<?php

        if (isset($_POST['nom'])&& isset($_POST['prenom']) && isset($_POST['email'])&& isset($_POST['mdp'])&& isset($_POST['numero'])) {
            $name = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $numero = $_POST['numero'];
            $mdp = $_POST['mdp'];

            $bdd=new PDO('mysql:host=localhost;dbname=garage', 'root','', 
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $bdd->exec("set names utf8");
            //echo "Nom : ".$name."";
            //echo "prenom: ".$prenom."";
            //var_dump($bdd);
            try {
                $req = $bdd->prepare("INSERT INTO client SET nom_client = :nom, prenom_client = :prenom, email_client = :email, tel_client = :numero");
                $resultat = $req->execute(array(':nom' => $name, ':prenom' => $prenom, ':email' =>$email, ':numero'=>$numero));

                if ($resultat){
                    $req2 = $bdd->prepare('SELECT * FROM client');
                    $req2->execute();
                    while($donnees = $req2->fetch()){
                        //affichage des donnes
                        //echo '<br>'.$donnees['id_client'].'</br><p><br><h2>'.$donnees['nom_client'].'</br> '.$donnees['email_client'].'</h2></p>';
                    } 
                } else {
                    echo "<p>Erreur lors de l'enregistrement</p>";
                }
            } catch(Exception $e) {
                die('Erreur : ' .$e->getMessage());
            }
        }
        ?>
</body>
</html>