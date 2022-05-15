<?php
     
    require '../resa-sandwitch/database/connexion.php';
 
    $id_user = $role_user = $email_user = $password_user = $nom_user = $prenom_user = $active_user = "";

    if(!empty($_POST)) {
        $id_user               = checkInput($_POST['id_user']);
        $role_user        = checkInput($_POST['role_user']);
        $email_user              = checkInput($_POST['email_user']);
        $password_user           = checkInput($_POST['password_user']); 
        $nom_user           = checkInput($_POST['nom_user']);
        $prenom_user           = checkInput($_POST['prenom_user']);
        $active_user           = checkInput($_POST['active_user']);
        $isSuccess          = true;
        
        if(empty($id_user)) {
            $id_user = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($role_user)) {
            $role_user = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($email_user)) {
            $email_user = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        } 
        if(empty($password_user)) {
            $password_user = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($nom_user)) {
            $nom_user = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($prenom_user)) {
            $prenom_user = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        if(empty($active_user)) {
            $active_user = 'Ce champ ne peut pas être vide';
            $isSuccess = false;
        }
        
        if($isSuccess) {
            $statement = $db->prepare("INSERT INTO utilisateur (id_user,role_user,email_user,password_user,nom_user,prenom_user,active_user) values(?, ?, ?, ?, ?)");
            $statement->execute(array($id_user,$role_user,$email_user,$password_user,$nom_user,$prenom_user,$active_user));
            header("Location: index.php");
        }
    }
    
        
        
    
    

    function checkInput($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/insert.css">
        <script src="https://kit.fontawesome.com/568733c487.js" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <h1 class="text-logo"><span class="bi-shop"></span> Ajouter un utilisateur <span class="bi-shop"></span></h1>
        <div class="container admin">
            <div class="row">
                <br>
                <form class="form" action="insert.php" role="form" method="post" enctype="multipart/form-data">
                    <br>
                    <div>
                        <label class="form-label" for="role">Role:</label>
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role" value="<?php echo $role_user;?>">
                        <span class="help-inline"><?php echo $role_user;?></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="email">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email_user;?>">
                        <span class="help-inline"><?php echo $email_user;?></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password_user;?>">
                        <span class="help-inline"><?php echo $password_user;?></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php echo $nom_user;?>">
                        <span class="help-inline"><?php echo $nom_user;?></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="prenom">Prenom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" value="<?php echo $prenom_user;?>">
                        <span class="help-inline"><?php echo $prenom_user;?></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="active">Active:</label>
                        <input type="text" class="form-control" id="active" name="active" placeholder="Active" value="<?php echo $active_user;?>">
                        <span class="help-inline"><?php echo $active_user;?></span>
                    </div>
                    <br>
                    <div>
                        <a type="submit" class="btn btn-success" target="_blank"><i class="fa-solid fa-plus"></i>Ajouter</a>
                        <a class="btn btn-primary" href="index.php"><span class="bi-arrow-left"></span> Retour</a>
                   </div>
                    <!-- <div>
                        <label class="form-label" for="category">Catégorie:</label>
                        <select class="form-control" id="category" name="category">
                        <?php
                           foreach ($db->query('SELECT * FROM categories') as $row) {
                                echo '<option value="'. $row['id'] .'">'. $row['name'] . '</option>';;
                           }
                        ?>
                        </select>
                        <span class="help-inline"><?php echo $categoryError;?></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="image">Sélectionner une image:</label>
                        <input type="file" id="image" name="image"> 
                        <span class="help-inline"><?php echo $imageError;?></span>
                    </div>
                    <br> -->
                </form>
            </div>
        </div>
    </body>
</html>
