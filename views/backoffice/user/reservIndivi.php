<?php 

    require (__DIR__ . '../../../../database/connexion.php');
    require (__DIR__ . '../../../../database/querie/querie.php');

    // Récupération de l'ID
    if (!empty($_GET['id'])) 
    {
        $id = verifyInput($_GET['id']);
    }

    // Variable permettant l'envoi du formulaire en fonction des fonction de vérification
    $isSuccess = true;

    // Récupération de l'heure et la date du jour
    date_default_timezone_set('Europe/Paris');
    $dateNow = date('y-m-d');
    $timeNow = date('h:i');
    $dateTimeNow = $dateNow . " " . $timeNow;

    // Date et heure du formulaire mit à 0
    $dateForm = "";
    $timeForm = "";

    // Variable déclaré pour les erreur ou validation du formulaire
    $sandwichError = $boissonError = $dessertError = $dateError = $timeError = $raisonError = $sendError = $sendForm = "";

    // Variable pour la disponibilité des produits
    $dispo = "Non";

    if (isset($_GET['submit'])) 
    {
        // Variable associé au formulaire
        $sandwichForm = verifyInput($_GET['selectSandwich']);
        $boissonForm = verifyInput($_GET['selectBoisson']);
        $dessertForm = verifyInput($_GET['selectDessert']);
        $chipsForm = verifyInput($_GET['selectChips']);
        $dateForm = $_GET['selectDate'];
        $timeForm = $_GET['selectTime'];

        $conversionDate = strtotime($dateForm);
        $jourLivraison = date("w", $conversionDate);

        $dateTimeForm = $dateForm . " " . $timeForm;

        // Requête sql pour afficher les sandwichs
        $statement = $databaseConnexion->query("SELECT * FROM utilisateur");

        // Liaison avec la BDD pour la parcourir avec le php
        while($item = $statement->fetch())
        {
            if ($item['id_user']==$id)
            {
                if ($item['active_user']==0)
                {
                    $sendForm = "Votre utilisateur est désactivé, vous ne pouvez pas faire de commande !";
                    $isSuccess = false;
                }
            }
        }

        // Vérification des champs du formulaire et affichage des erreurs
        // Requête sql pour afficher les projets
        $statement = $databaseConnexion->query("SELECT * FROM sandwich");

        // Liaison avec la BDD pour la parcourir avec le php
        while($item = $statement->fetch())
        {
            if ($item['id_sandwich']==$sandwichForm)
            {
                if ($item['dispo_sandwich']==0)
                {
                    $sandwichError = "Le sandwich choisi n'est plus disponible veuillez en choisir un autre";
                    $isSuccess = false;
                }
            } 
        }
        // Requête sql pour afficher les projets
        $statement = $databaseConnexion->query("SELECT * FROM dessert");

        // Liaison avec la BDD pour la parcourir avec le php
        while($item = $statement->fetch())
        {
            if ($item['id_dessert']==$dessertForm)
            {
                if ($item['dispo_dessert']==0)
                {
                    $dessertError = "Le dessert choisi n'est plus disponible veuillez en choisir un autre";
                    $isSuccess = false;
                }
            } 
        }
        // Requête sql pour afficher les projets
        $statement = $databaseConnexion->query("SELECT * FROM boisson");

        // Liaison avec la BDD pour la parcourir avec le php
        while($item = $statement->fetch())
        {
            if ($item['id_boisson']==$boissonForm)
            {
                if ($item['dispo_boisson']==0)
                {
                    $boissonError = "La boisson choisi n'est plus disponible veuillez en choisir un autre";
                    $isSuccess = false;
                }
            } 
        }
        // Vérification du jour de livraison
        if ($jourLivraison == 6 || $jourLivraison == 0)
        {
            $dateError = "Vous ne pouvez pas reserver pour samedi ou dimanche !";
            $isSuccess = false;
        }
        if (strtotime($dateTimeForm) < strtotime($dateTimeNow))
        {
            $dateError = "Vous ne pouvez pas reserver pour un jour passer !";
            $isSuccess = false;
        }
        if (strtotime($dateForm) == strtotime($dateNow))
        {
            if (strtotime($timeForm) > strtotime("09:30"))
            {
                $timeError = "Vous ne pouvez pas reserver pour le même jour après 9h30 passer !";
                $isSuccess = false;
            }
        }
        var_dump($boissonForm);
        if ($isSuccess)
        {
            /** Saisie des données du formulaire **/
            $saisieProjet = $databaseConnexion->prepare("INSERT INTO commande(fk_user_id, fk_sandwich_id, fk_boisson_id, fk_dessert_id, chips_com, date_heure_com, date_heure_livraison_com, annule_com) VALUES(?,?,?,?,?,?,?,?);");
            $saisieProjet->execute(array($id, $sandwichForm, $boissonForm, $dessertForm, $chipsForm, $dateTimeNow, $dateTimeForm, $annule_com));
            
            header("Location: reservIndivi.php?$id");
            $sendForm = "Votre réservation a bien été enregistrée !";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>

        <!-- Lien pour JQuery, JS, Bootstrap et Google Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
        <meta name="viewport" content="width=device-width, initiale-scale=1"/>

        <!-- Lien pour fichier CSS et Langue défini en Français -->
        <link href="../../../style/main.css" rel="stylesheet">

        <meta charset="utf-8"/>
        <title>Lycée Saint-Vincent réservation sandwich</title>

    </head>

    <body id="bodyReserv">
        <header id="headerReserv">
            
            <div class="d-flex column align-start">
                <div class="logo t-center">
                    <img src="assets/logo.png" alt="">
                    <h1 class="playfair">Lycée Saint-Vincent</h1>
                    <p>Enseignement secondaire & supérieur</p>
                </div>
                <a href="../index.php">Accueil</a>
                <a href="../../../database/processing/deconnexion.php" class="logOut">Se deconnecter</a>
            </div>
        </header>

        <section id="secReserv">
            
            <h2>Faire une commande individuelle</h2>

            <!-- Div englobant les carousel des sandwichs et des boissons -->
            <div id="divSand" class="divPrincipale">
                <h3>Les sandwichs :</h3>
                <div class="sousDivSand">
                    <?php
                        // Requête sql pour afficher les sandwichs
                        $statement = $databaseConnexion->query("SELECT * FROM sandwich");

                        // Liaison avec la BDD pour la parcourir avec le php
                        while($item = $statement->fetch())
                        {
                            if ($item['dispo_sandwich']==1)
                            {
                                $dispo = "Oui";
                            }
                            echo "<div class='itemInfo'>";
                                echo "<div class='divItemInfo'>";
                                    // Div englobant les infos et l'image de l'item
                                    echo "<img src='../../../assets/menu/sandwich/" . $item['img_sandwich'] . "' alt='Image de sandwich'>";
                                    echo "<div class='itemDesc'>";
                                        // Infos du sandwich
                                        echo "<p>" . $item['nom_sandwich'] . "</p>";
                                        echo "<p>Disponible : $dispo</p>";
                                        echo "<p> Ingrédients : " . $item['ingredient_sandwich'] . "</p>";
                                    echo"</div>";
                                echo"</div>";
                            echo "</div>";
                        }
                    ?> 
                </div>  
            </div>

            <div id="divDessert" class="divPrincipale">
                <h3>Les desserts :</h3>
                <div class="sousDivSand">
                    <?php
                        // Requête sql pour afficher les sandwichs
                        $statement = $databaseConnexion->query("SELECT * FROM dessert");

                        // Liaison avec la BDD pour la parcourir avec le php
                        while($item = $statement->fetch())
                        {
                            if ($item['dispo_dessert']==1)
                            {
                                $dispo = "Oui";
                            }
                            echo "<div class='itemInfo'>";
                                echo "<div class='divItemInfo'>";
                                    // Div englobant les infos et l'image de l'item
                                    echo "<img src='../../../assets/menu/dessert/" . $item['img_dessert'] . "' alt='Image de dessert'>";
                                    echo "<div class='itemDesc'>";
                                        // Infos du dessert
                                        echo "<p>" . $item['nom_dessert'] . "</p>";
                                        echo "<p>Disponible : $dispo</p>";
                                        echo "<p> Ingrédients : " . $item['ingredient_dessert'] . "</p>";
                                    echo"</div>";
                                echo"</div>";
                            echo "</div>";
                        }
                    ?> 
                </div>  
            </div>

            <div id="divBoisson" class="divPrincipale">
                <h3>Les boissons :</h3>
                <div class="sousDivSand">
                    <?php
                        // Requête sql pour afficher les sandwichs
                        $statement = $databaseConnexion->query("SELECT * FROM boisson");

                        // Liaison avec la BDD pour la parcourir avec le php
                        while($item = $statement->fetch())
                        {
                            if ($item['dispo_boisson']==1)
                            {
                                $dispo = "Oui";
                            }
                            echo "<div class='itemInfo'>";
                                echo "<div class='divItemInfo'>";
                                    // Div englobant les infos et l'image de l'item
                                    echo "<img src='../../../assets/menu/boisson/" . $item['img_boisson'] . "' alt='Image de la boisson'>";
                                    echo "<div class='itemDesc'>";
                                        // Infos de la boisson
                                        echo "<p>" . $item['nom_boisson'] . "</p>";
                                        echo "<p>Disponible : $dispo</p>";
                                    echo"</div>";
                                echo"</div>";
                            echo "</div>";
                        }
                    ?> 
                </div>  
            </div>

            <!-- Formulaire pour la commande individuelle -->
            <form id="formSaisieInfo" method="get" action="<?php echo $_SERVER['PHP_SELF'];?>" role="form">
                <h3>Choisissez votre repas :</h3>
                <div class="saisieInfo">
                    <!-- Div de liste déroulante pour les sanwichs et les desserts -->
                    <div class="divSaisieInfo">
                        <!-- Choix du sandwich -->
                        <div class="saisieList">
                            <label for="selectSandwich">Choisir un sandwich<span class="obligation">*</span> :</label>
                            <!-- Liste déroulante des sandwich -->
                            <select id="selectSandwich" class='optionMenu' name="selectSandwich">
                                <?php
                                    // Requête sql pour afficher les projets
                                    $statement = $databaseConnexion->query("SELECT * FROM sandwich");

                                    // Liaison avec la BDD pour la parcourir avec le php
                                    while($item = $statement->fetch())
                                    {
                                        echo "<option value='" . $item['id_sandwich'] . "'>" . $item['nom_sandwich'] . "</option>";
                                    }
                                ?>
                            </select>
                            <p class="erreurForm"><?php echo $sandwichError; ?></p>
                        </div>
                        <!-- Choix du dessert -->
                        <div class="saisieList">
                            <label for="selectDessert">Choisir un dessert<span class="obligation">*</span> :</label>
                            <!-- Liste déroulante des dessert -->
                            <select id="selectDessert" class='optionMenu' name="selectDessert">
                                <?php
                                    // Requête sql pour afficher les projets
                                    $statement = $databaseConnexion->query("SELECT * FROM dessert");

                                    // Liaison avec la BDD pour la parcourir avec le php
                                    while($item = $statement->fetch())
                                    {
                                        echo "<option value='" . $item['id_dessert'] . "'>" . $item['nom_dessert'] . "</option>";
                                    }
                                ?>
                            </select>
                            <p class="erreurForm"><?php echo $dessertError; ?></p>
                        </div>
                    </div>
                    <!-- Div de liste déroulante pour les boissons et les chips -->
                    <div class="divSaisieInfo">
                        <!-- Choix d'une boisson -->
                        <div class="saisieList">
                            <label for="selectBoisson">Choisir une boisson<span class="obligation">*</span> :</label>
                            <!-- Liste déroulante des boisson -->
                            <select id="selectBoisson" class='optionMenu' name="selectBoisson">    
                                <?php
                                    // Requête sql pour afficher les projets
                                    $statement = $databaseConnexion->query("SELECT * FROM boisson");

                                    // Liaison avec la BDD pour la parcourir avec le php
                                    while($item = $statement->fetch())
                                    {
                                        echo "<option value='" . $item['id_boisson'] . "'>" . $item['nom_boisson'] . "</option>";
                                    }
                                ?>
                            </select>
                            <p class="erreurForm"><?php echo $boissonError; ?></p>
                        </div>
                        <!-- Choix de chips -->
                        <div class="saisieList">
                            <label for="selectChips">Prendre des chips<span class="obligation">*</span> :</label>
                            <!-- Liste déroulante chips -->
                            <select id="selectChips" class='optionMenu' name="selectChips">
                                <option value=1>Oui</option>
                                <option value=0>Non</option> 
                            </select>
                        </div>
                    </div>
                    <!-- Div de saisie de l'heure et la date pour la livraison --> 
                    <div class="divSaisieInfo">
                        <!-- Div du formulaire de la date -->
                        <div class="saisieList">
                            <label for="dateForm">Date de livraison<span class="obligation">*</span> :</label>
                            <input id='dateForm' class='optionMenu' type='date' name='selectDate' value="<?php echo $dateForm;?>" required>
                            <p class="erreurForm"><?php echo $dateError; ?></p>
                        </div>
                        <!-- Div du formulaire de l'heure pour la livraison -->
                        <div class="saisieList">
                            <label for="timeForm">Heure de livraison<span class="obligation">*</span> :</label>
                            <input id='timeForm' class='optionMenu' type='time' name='selectTime' value="<?php echo $timeForm;?>" required>
                            <p class="erreurForm"><?php echo $timeError; ?></p>
                        </div>
                    </div>
                    <!-- Message de prévention pour la saisie de la date -->
                    <p class="blockTimeSaisie">Attention : Vous ne pouvez pas commander pour le jour même après 9h30 !</p>

                    <div class="sendForm">
                        <!-- Button envoyer pour le formulaire de création de projet -->
                        <button class='sendButton' type='button' data-toggle='modal' data-target='#verifCommande'>Enregistrer ma commande.</button>
                        <!-- Message de validation de l'envoi du formulaire dans la BDD -->
                        <p><?php echo $sendForm;?></p>

                        <!-- Modal afin de s'assurer de la validation de la commande -->
                        <div id='verifCommande' class='modal'>
                            <!-- Information sur le projet -->
                            <h5>Êtes vous sûr de vouloir valider la commande ?</h5>
                            <!-- Div englobant les bouttons de la modal -->
                            <div class="buttonVerif">
                                <input class="buttonMod" type="submit" name="submit" value="Oui">
                                <button class='buttonMod' data-dismiss='modal'>Non</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Button pour fermer la modal d'ajout -->
            <a href="../../../views/backoffice/user/backoffice.php" class="back">Annuler la commande</a>
        </section>
    </body>
</html>