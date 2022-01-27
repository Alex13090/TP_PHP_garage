<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css">
    <title>4_tyres</title>
</head>
<body>

<h1>DEVIS GRATUIT ET RENDEZ-VOUS IMMEDIAT</h1>
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
        <p>veuillez saisir le date de rdv :</p>
        <input type="date" name="date">
        <br>
        <label for="services">veuillez saisir le type de service :</label>
        <select name="service" id="service">
            <option value="pneu">Remplacement des pneus</option>
            <option value="frein">Remplacement disque & plaquettes</option>
            <option value="revision">Réaliser une révision</option>
            <option value="vidange">Réaliser une Vidange</option>
        </select>
        <br>
        <input type="submit" id="btn" value="Ajouter">
    </form>
    <form action="service.php" method="GET">
        <input type="submit" value="Regarder les prix estimee">
    </form>
    <script src="rdv.js"></script>







<?php




        if (isset($_POST['nom'])&& isset($_POST['prenom']) && isset($_POST['email'])&& isset($_POST['numero']) && isset($_POST['date'])) {
            $name = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $numero = $_POST['numero'];
            $date = $_POST['date'];
            $service = $_POST['service'];


            $bdd=new PDO('mysql:host=localhost;dbname=garage', 'root','', 
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $bdd->exec("set names utf8");
            //echo "Nom : ".$name."";
            //echo "prenom: ".$prenom."";
            //echo "date: ".$date."";
            //var_dump($bdd);
            try {
                $req = $bdd->prepare("INSERT INTO rendezvous SET date_rdv = :dateRdv, type_rdv = :type_rdv");
                $resultat = $req->execute(array(':dateRdv' => $date, ':type_rdv' => $service));

                $req3 = $bdd->prepare("INSERT INTO clients SET nom_client = :nom, prenom_client = :prenom, email_client = :email");
                $resultat1 = $req3->execute(array(':nom' => $name, ':prenom' => $prenom, ':email' =>$email));

                $resultatAll = $resultat + $resultat1;
                //echo $resultatAll;

                if ($resultatAll){
                    $req2 = $bdd->prepare('SELECT clients.nom_client, clients.prenom_client, clients.email_client, rendezvous.date_rdv, rendezvous.type_rdv FROM clients INNER JOIN rendezvous ON clients.id_rdv = rendezvous.id_rdv
        ');
                    $req2->execute();
                    while($donnees = $req2->fetch()){
                        
                    }
                } else {
                        echo "<p>Erreur lors de l'enregistrement</p>";}
                }catch(Exception $e) {
                die('Erreur : ' .$e->getMessage());
                
            }
        }
        ?>
</body>
</html>