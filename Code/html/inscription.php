<?php

/* Connexion */

$host = 'ec2-34-246-86-78.eu-west-1.compute.amazonaws.com';
$dbname = 'd6jd8juvb86a3p';
$user = 'tncgniwrddfkvg';
$password = '88d421f583b147bb6d8eaee9cd377b48a16d9c9481c094032c12aa17f968e19b';
$bdd = "pgsql:host=$host;port=5432;dbname=$dbname;user=$user;password=$password";

try {
    $conn = new PDO("pgsql:host=$host;port=5432;dbname=$dbname;user=$user;password=$password");
} catch (PDOException $e) {
    echo $e->getMessage();
}

/* Initialisation des varibales pour l'ensemble du code PHP */

$nom = "";
$prenom = "";
$mail = "";
$mail_confirm = "";
$mdp = "";
$mdp_confirm = "";
$estFromager = "FALSE";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inscription.css">
    <link rel="stylesheet" href="../css/connexion.css">
    <link rel="stylesheet" href="../css/header_footer.css"> <!-- Rappel de la feuille de style pour la nav et le footer pour éviter la duplication de code -->
    <title>FromageOpédie</title>
</head>

<body>

    <!-- Début de l'entête de page -->

    <header>

        <nav>

            <div class="titre">
                <a href="accueil.html">
                    <h1>FromageOpédie</h1>
                </a>
            </div>

            <div class="onglets">
                <a href="fromage.php">
                    <p>Fromages</p>
                </a>
                <a href="favoris.php">
                    <p>Favoris</p>
                </a>
                <a href="histoire.html">
                    <p>Histoire</p>
                </a>
                <a href="carte.php">
                    <p>Carte</p>
                </a>
            </div>

            <div class="log">
                <a href="connexion.php">Connexion</a>
                <a href="inscription.php">Inscription</a>
            </div>

        </nav>

    </header>

    <!-- Début du corp de code -->

    <section>

        <div class="header_section">
            <h1>S'inscrire</h1>
        </div>

        <form method="POST" action="">

            <?php

            ?>

            <div class="container">

                <div class="element">
                    <label for="nom">Nom</label>
                    <input name="nom" type="text">
                </div>

                <div class="element">
                    <label for="prenom">Prénom</label>
                    <input name="prenom" type="text">
                </div>

                <div class="element">
                    <label for="mail">Mail</label>
                    <input name="mail" type="text" placeholder="exemple@exemple.XX">
                </div>

                <div class="element">
                    <label for="mail_confirm">Confirmer l'adresse mail</label>
                    <input name="mail_confirm" type="text" placeholder="exemple@exemple.XX">
                </div>

                <div class="element">
                    <label for="mdp">Mot de passe</label>
                    <input name="mdp" type="password">
                </div>

                <div class="element">
                    <label for="mdp_confirm">Confirmer le mot de passe</label>
                    <input name="mdp_confirm" type="password">
                </div>

                <div class="element">
                    <select name="estFromager" id="element_list">
                        <option value="-1" selected>Fromager ou Particuiler ?</option>
                        <option value="TRUE">Fromager</option>
                        <option value="FALSE">Particulier</option>
                    </select>
                </div>

                <input type="submit" value="S'inscrire" name="formulaire_inscription">

                <?php

                if (isset($_POST['formulaire_inscription'])) {
                    if (isset($nom, $prenom, $mail, $mdp, $mdp_confirm, $estFromager)) {

                        $nom = htmlspecialchars($_POST['nom']);
                        $prenom = htmlspecialchars($_POST['prenom']);
                        $mail = htmlspecialchars($_POST['mail']);
                        $mail_confirm = htmlspecialchars(($_POST['mail_confirm']));
                        $mdp = $_POST['mdp'];
                        $mdp_confirm = $_POST['mdp_confirm'];
                        $estFromager = $_POST['estFromager'];

                        if (!empty($nom) || !empty($prenom) || !empty($mail) || !empty($mdp) || !empty($mdp_confirm)) {
                            if ($mail == $mail_confirm) {
                                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                                    $verif_mail = $conn->prepare('SELECT * FROM utilisateur WHERE email = ?;');
                                    $verif_mail->execute(array($mail));
                                    $verif_mail2 = $verif_mail->rowCount();
                                    if ($verif_mail2 == 0) {
                                        if ($mdp == $mdp_confirm) {
                                            if ($estFromager == 'TRUE' || $estFromager == 'FALSE') {
                                                $pass_hash = password_hash($mdp, PASSWORD_DEFAULT);
                                                $inscription = $conn->prepare('INSERT INTO utilisateur(email,nom,prenom,motdepasse,estfromager) VALUES(?,?,?,?,?);');
                                                $inscription->execute(array($mail, $nom, $prenom, $pass_hash, $estFromager));
                                                echo "Votre inscription a bien été prise en compte !!!";
                                            } else {
                                                echo "Veuillez spécifier si vous êtes fromager ou non !!!";
                                            }
                                        } else {
                                            echo "Mot de passe non correspondant !!!";
                                        }
                                    } else {
                                        echo "Adresse e-mail déjà utilisé !!!";
                                    }
                                } else {
                                    echo "Adresse e-mail invalide !!!";
                                }
                            } else {
                                echo "E-mail non correspondant !!!";
                            }
                        } else {
                            echo "Veuillez remplir tous les champs !!!";
                        }
                    }
                }

                ?>


            </div>

        </form>

    </section>

    <!-- Début du pied de page -->

    <footer>

        <div class="global_footer">

            <div class="foot1">
                <h3>Contact</h1>
                    <p>exemple@exemple.fr</p>
            </div>

            <div class="foot2">
                <h3>A propos</h1>
                    <p>Iut Clermont-Ferrand</p>
            </div>

        </div>

    </footer>

</body>

</html>