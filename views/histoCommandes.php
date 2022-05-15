<?php
session_start();
include('database/connexion.php');
if ($_SESSION['role'] == "a" | $_SESSION['role'] == "e"){

?>
<form method="post">
    <input type="datetime-local" name="dateDebut">
    <input type="datetime-local" name="dateFin">
    <button type="submit" class="btn btn-primary" name="filtrer">Filtrer <i class="bi bi-funnel"></i></button>
</form>
<?php

global $databaseConnexion;
$query = $databaseConnexion->prepare("SELECT dateDebut_hist, dateFin_hist FROM historique WHERE fk_user_id =:id ORDER BY dateInsertion_hist DESC LIMIT 1");
$query->bindParam("id", $_SESSION['id'], PDO::PARAM_STR);
$query->execute();
$dateHisto = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['filtrer'])){
    global $databaseConnexion;
    $query = $databaseConnexion->prepare("INSERT INTO historique (dateDebut_hist,dateFin_hist,fk_user_id) VALUES (:dateD,:dateF,:id)");
    $query->bindParam("id", $_SESSION['id'], PDO::PARAM_STR);
    $query->bindParam("dateD", $_POST['dateDebut'], PDO::PARAM_STR);
    $query->bindParam("dateF", $_POST['dateFin'], PDO::PARAM_STR);
    $query->execute();

    global $databaseConnexion;
    $query = $databaseConnexion->prepare("SELECT id_com, chips_com, date_heure_com, date_heure_livraison_com, nom_sandwich, nom_boisson, nom_dessert, annule_com FROM commande INNER JOIN sandwich ON commande.fk_sandwich_id = sandwich.id_sandwich INNER JOIN boisson ON commande.fk_boisson_id = boisson.id_boisson INNER JOIN dessert ON commande.fk_dessert_id = dessert.id_dessert WHERE fk_user_id = :id AND `date_heure_livraison_com` >= :dateD AND `date_heure_livraison_com`<= :dateF ORDER BY date_heure_livraison_com DESC;");
    $query->bindParam("id", $_SESSION['id'], PDO::PARAM_STR);
    $query->bindParam("dateD", $_POST['dateDebut'], PDO::PARAM_STR);
    $query->bindParam("dateF", $_POST['dateFin'], PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

} else {

    if (isset($dateHisto)){
        global $databaseConnexion;
        $query = $databaseConnexion->prepare("SELECT id_com, chips_com, date_heure_com, date_heure_livraison_com, nom_sandwich, nom_boisson, nom_dessert, annule_com FROM commande INNER JOIN sandwich ON commande.fk_sandwich_id = sandwich.id_sandwich INNER JOIN boisson ON commande.fk_boisson_id = boisson.id_boisson INNER JOIN dessert ON commande.fk_dessert_id = dessert.id_dessert WHERE fk_user_id = :id AND `date_heure_livraison_com` >= :dateD AND `date_heure_livraison_com`<= :dateF ORDER BY date_heure_livraison_com DESC;");
        $query->bindParam("id", $_SESSION['id'], PDO::PARAM_STR);
        $query->bindParam("dateD", $dateHisto['0']['dateDebut_hist'], PDO::PARAM_STR);
        $query->bindParam("dateF", $dateHisto['0']['dateFin_hist'], PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        global $databaseConnexion;
        $query = $databaseConnexion->prepare("SELECT id_com, chips_com, date_heure_com, date_heure_livraison_com, nom_sandwich, nom_boisson, nom_dessert, annule_com FROM commande INNER JOIN sandwich ON commande.fk_sandwich_id = sandwich.id_sandwich INNER JOIN boisson ON commande.fk_boisson_id = boisson.id_boisson INNER JOIN dessert ON commande.fk_dessert_id = dessert.id_dessert WHERE fk_user_id =:id ORDER BY date_heure_livraison_com DESC");
        $query->bindParam("id", $_SESSION['id'], PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
    if (!$result) {
        echo '<p>Erreur !</p>';
    } else {
        ?>

        <table class="table table-bordered">
            <tr>
                <th>Date de Livraison</th>
                <th>Sandwich choisi</th>
                <th>Boisson choisie</th>
                <th>Dessert choisie</th>
                <th>Chips</th>
                <th>Modifier</th>
                <th>Annuler</th>
            </tr>

        <?php
        foreach ($result as $commande){
            echo '<tr>';
            echo'<td>'.$commande['date_heure_livraison_com'].'</td>';
            echo'<td>'.$commande['nom_sandwich'].'</td>';
            echo'<td>'.$commande['nom_boisson'].'</td>';
            echo'<td>'.$commande['nom_dessert'].'</td>';
            if ($commande['chips_com'] == 1){
             echo'<td><i class="bi bi-check-circle" style="color: #0acf06"></i></td>';
            } else {
                echo'<td></i><i class="bi bi-x-circle" style="color: #ff0000"></i></td>';
               }

            if ($commande['annule_com'] == 0){
                if ($commande['date_heure_livraison_com'] >= date("Y-m-d H:i:s")){
                    echo'<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifModal'.$commande['id_com'].'">
                  <i class="bi bi-pencil-square"></i>
                </button></td>';

                    echo'<td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#annuleModal'.$commande['id_com'].'">
                  <i class="bi bi-trash-fill"></i></i>
                </button></td>';
                } else {
                    echo'<td>Commande livrée <i class="bi bi-check-circle" style="color: #0acf06"></i></td>';
                    echo'<td>Commande livrée <i class="bi bi-check-circle" style="color: #0acf06"></i></td>';
                }

            } else {
                echo'<td>Commande annulée <i class="bi bi-x-circle" style="color: #ff0000"></i></td>';
                echo'<td>Commande annulée <i class="bi bi-x-circle" style="color: #ff0000"></i></td>';
            }

            echo'</tr>';

        ?>
            <div class="modal fade" id="modifModal<?php echo $commande['id_com'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifier la date de livraison de la commande N°<?php echo $commande['id_com'] ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                        <div class="modal-body">
                                <input type="datetime-local" name="date_modif">
                                <input type="hidden" name="id_modif" value="<?php echo $commande['id_com'] ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary" name="modifier">Modifier</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="annuleModal<?php echo $commande['id_com'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Annuler la commande N°<?php echo $commande['id_com'] ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Etes vous sur d'annuler la commande N°<?php echo $commande['id_com'] ?> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">NON</button>
                            <form method="post">
                                <input type="hidden" name="id_annule" value="<?php echo $commande['id_com'] ?>">
                                <button type="submit" class="btn btn-danger" name="annuler">OUI</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        </table>
        <?php
    }

if (isset($_POST['modifier'])){
    global $databaseConnexion;
    $query = $databaseConnexion->prepare("UPDATE commande SET date_heure_livraison_com = :date_modif WHERE id_com = :id_com AND fk_user_id =:id_user");
    $query->bindParam("id_user", $_SESSION['id'], PDO::PARAM_STR);
    $query->bindParam("id_com", $_POST['id_modif'], PDO::PARAM_STR);
    $query->bindParam("date_modif", $_POST['date_modif'], PDO::PARAM_STR);
    $query->execute();
    echo("<meta http-equiv='refresh' content='1'>");
}
if (isset($_POST['annuler'])){
    global $databaseConnexion;
    $query = $databaseConnexion->prepare("UPDATE commande SET annule_com = '1' WHERE id_com = :id_com AND fk_user_id =:id_user");
    $query->bindParam("id_user", $_SESSION['id'], PDO::PARAM_STR);
    $query->bindParam("id_com", $_POST['id_annule'], PDO::PARAM_STR);
    $query->execute();
    echo("<meta http-equiv='refresh' content='1'>");
}
}
?>