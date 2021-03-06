<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Médiathèque de quartier</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="Projet BTS SIO - SLAM" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style/bootstrap-dev/css/bootstrap.css" >
    <link rel="stylesheet" href="style/main.css" />
    <!-- <script type="text/javascript" src="script/emprunter.js"></script>-->

</head>

<body>
<div class="container">
    <header class="row">
        <nav class="navbar navbar-expand-md navbar-dark col-sm-12">
            <a class="navbar-brand" href="index.html">La médiathèque</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a class="nav-link" href="index.html">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="catalogue.html">Catalogue</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Emprunts</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="emprunter.php?rep=">Emprunter</a>
                            <a class="dropdown-item" href="retourner.php?rep=">Retourner</a>
                            <a class="dropdown-item" href="emprunts.html?">Mes emprunts</a>
                        </div>
                    </li>
                </ul>
                <a class="btn btn-warning my-2 my-sm-0" href="membres.html">Adhérents</a>
            </div>
        </nav>
    </header>


                    <?php
                    try
                    {
                        $bdd = new PDO('mysql:host=localhost;dbname=projet;charset=utf8', 'root', '');
                    }
                    catch (Exception $e)
                    {
                        die('Erreur : ' . $e->getMessage());
                    }

                    $nomAuteur = $_GET['nom_auteur'];
                    $nomEditeur = $_GET['nom_editeur'];



                    //requete nom auteur
                    $requeteEcrite = $bdd->query("SELECT titre_Ouvrage, vignette_Ouvrage FROM ouvrage 
WHERE id_officielle_Ouvrage = (
SELECT id_officielle_Ouvrage FROM cree_par WHERE id_createur_Createur = (
SELECT id_createur_Createur FROM createur WHERE nom_createur_Createur = '$nomAuteur'))");



                    if ($requeteEcrite != null) {
                        while ($donnees = $requeteEcrite->fetch()) {
                            echo '<tr>';
                            echo '<td>' .'ouvrage correspondant à votre recherche:  '. $donnees["titre_Ouvrage"] . '</td>' .'<br />';
                            echo '<td>'. '<img src="images/'.$donnees["vignette_Ouvrage"].'.jpg" /></td>' . '<br />';
                            echo '<tr/>';
                        }
                    }


                    //requete editeur
                    $requeteEditeur = $bdd->query("SELECT titre_Ouvrage, vignette_Ouvrage FROM ouvrage
WHERE id_officielle_Ouvrage = (
SELECT id_officielle_Ouvrage FROM edite_par WHERE id_editeur_Editeur = (
SELECT id_editeur_Editeur FROM editeur WHERE nom_editeur_Editeur LIKE '%$nomEditeur%'))");



                    if ($requeteEditeur != null) {
                        while ($donnees = $requeteEditeur->fetch()) {
                            echo '<tr>';
                            echo '<td>' .'ouvrage correspondant à votre recherche:  '. $donnees["titre_Ouvrage"] . '</td>' . '<br />';
                            echo '<td>'. '<img src="images/'.$donnees["vignette_Ouvrage"].'.jpg" /></td>' . '<br />';
                            echo '<tr/>';
                        }
                    }

                    ?>
                </div>
            </div>
        </section>
    </div>

    <footer class="row ">
        <div class="card footer col-sm-12">
            <p>Tous droits réservés...</p>
        </div>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.js"></script>
<script src="style/bootstrap-dev/js/popper.js"></script>
<script src="style/bootstrap-dev/js/bootstrap.js"></script>
</body>

</html>
<?php
