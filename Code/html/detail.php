<?php

/* Connexion */

$host = 'ec2-34-246-86-78.eu-west-1.compute.amazonaws.com';
$dbname = 'd6jd8juvb86a3p';
$user = 'tncgniwrddfkvg';
$password = '88d421f583b147bb6d8eaee9cd377b48a16d9c9481c094032c12aa17f968e19b';
$bdd = "pgsql:host=$host;port=5432;dbname=$dbname;user=$user;password=$password";

try {
    $conn = new PDO($bdd);
} catch (PDOException $e) {
    echo $e->getMessage();
}


$queryDetail = "";
$nom = "";
$departementFabrication = "";
if (isset($_POST['form_detail'])) {
    if (isset($nom, $departementFabrication)) {
        $nom = htmlspecialchars($_POST['nomFromage']);
        $departementFabrication = htmlspecialchars($_POST['departementFabrication']);
        if (!empty($nom) && !empty($departementFabrication)) {
            $query = $conn->prepare('SELECT * FROM fromage WHERE nom = ? AND departementfabrication = ?');
            $query->execute(array($nom, $departementFabrication));
            $queryDetail = $query->fetch();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/detail.css">
    <link rel="stylesheet" href="../css/header_footer.css">
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

        <div class="entete">

            <div class="image">
                <?php echo '<img src="../images/' . $queryDetail['image'] . '" alt="Image de ' . $queryDetail['image'] . '">' ?>
            </div>

            <div class="titre">
                <h1><?= $queryDetail['nom'] ?></h1>
            </div>

            <div class="moyenne">
                <h2>5/5</h2>
            </div>

        </div>

        <div class="corps">

            <div class="informations">
                <div class="departement">
                    <h2>Département : <?= $queryDetail['departementfabrication'] ?></h2>
                </div>

                <div class="lait">
                    <h2>Type de lait : <?= $queryDetail['lait'] ?></h2>
                </div>

                <div class="vin">
                    <h2>Vin associé : <?= $queryDetail['vinassocie'] ?></h2>
                </div>
            </div>

            <div class="description">
                <h1>Description</h1>
                <p>Ce fromage communément appelé "<?= $queryDetail['nom'] ?>" est notamment présent dans le département suivant : <?= $queryDetail['departementfabrication'] ?>.<br>
                    Sa pâte <?= $queryDetail['typepate'] ?> est constituée de lait de <?= $queryDetail['lait'] ?>.<br>
                    En bonus pour le consommer, il est conseillé de se diriger vers un <?= $queryDetail['vinassocie'] ?>.</p>
                <div class="wiki">
                    <h2>En savoir plus : <a href="<?= $queryDetail['urlwikipedia'] ?>"><?= $queryDetail['urlwikipedia'] ?></a></h2>
                </div>
            </div>

            <div class="avis">
                <div class="note">
                    <h2>Noter ce fromage !</h2>

                    <div class="etoile etoile2">
                        <!--
                            --><a href="#5" title="5/5">★</a>
                        <!--
                            --><a href="#4" title="4/5">★</a>
                        <!--
                            --><a href="#3" title="3/5">★</a>
                        <!--
                            --><a href="#2" title="2/5">★</a>
                        <!--
                            --><a href="#1" title="1/5">★</a>
                    </div>

                </div>

                <div class="commentaire">
                    <div class="commenter">
                        <h2>Laisser un commentaire !</h2>
                    </div>


                </div>
            </div>

        </div>

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