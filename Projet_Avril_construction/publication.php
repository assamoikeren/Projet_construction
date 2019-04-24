<?php 
session_start();
require "php/connexion.php";
require "function/verification.php";

    $name = $surname = $str_name = $city = $category = $statut = $contact_1 = $contact_2 = $description = $image = "" ;
    $Error = "" ;
    $isSuccess = true;




    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $name = Verification(($_POST["name"]));
        $surname = Verification(($_POST["surname"]));
        $str_name = Verification(($_POST["str_name"]));
        $city = ($_POST["city"]);
        $category = ($_POST["category"]);
        $statut = ($_POST["statut"]);
        $contact_1 = ($_POST["contact_1"]);
        $contact_2 = ($_POST["contact_2"]);
        $description = ($_POST["description"]);
        $image = ($_POST["image"]);
        $isSuccess = true;
        $imageName = $_FILES["image"]["name"];
        $imageTemp = $_FILES["image"]["tmp_name"];
        $folder ="img_home/". $imageName;
        move_uploaded_file($imageTemp,$folder);
        


        if (empty($name) or empty($surname) or empty($str_name) or empty($city) or empty($category) or empty($statut) or empty($contact_1) or empty($description)or empty($image)) 
        {
             $Error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> 
                            <strong>veuillez remplir tous les champs obligatoire ! </strong>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                    </div>" . $folder;
            $isSuccess = false;     
        }
        else if (!empty($description) AND strlen($description)<50) 
        {
            $Error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> 
                        <strong>Courte desciption !</strong>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
            $isSuccess = false; 
        }
        else if (!isPhone($contact_1) or !isPhone($contact_2) ) 
        {
            $Error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'> 
                        <strong>Format de numéro de téléphone pas valide !</strong>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
            $isSuccess = false; 
        }
        else
        {
            $isSuccess = true;
        }
        if ($isSuccess)
        {
            $Error = "<div class='alert alert-success alert-dismissible fade show' role='alert'> 
                            <strong>
                            Publication enregistrée ! toutes les personnes intéressées vous contacteront.<br>
                            Merci d'avoir utilisé notre plateforme.
                            </strong>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                    </div>";
                $db_table = "publication"; 
                $db_value = "name,surname,str_name,contact_1,contact_2,city,category,statut,description,image";
                $db_inconnue = "?,?,?,?,?,?,?,?,?,?";
                $data_value = array($name,$surname,$str_name,$contact_1,$contact_2,$city,$category,$statut,$description,$image);
                
                include "function/insert.php";
                $result = insertData($db_table,$db_value,$db_inconnue,$data_value,$bdd);
                

        } 
     } 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="css/publication.css">
<link rel="icon" href="img/habitat.png">
<title>Mon Habitat | publication</title>
</head>
<body>
<header>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
           <a class="navbar-brand" href="index.html"><img src="img/habitat.png" alt="logo" width="100px"></a>
           <button class="navbar-toggler" data-target="#navigation" data-toggle="collapse" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div id="navigation" class="collapse navbar-collapse navbar-right">
               <ul class="navbar-nav mr-auto ml-5 text-center navbar-right">
                   <li class="nav-item">
                       <a class="nav-link" href="index.html"><i class="fa fa-home" aria-hidden="true"></i>   accueil</a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="recherche.php">
                            <i class="fa fa-search" aria-hidden="true"></i></span>   recherche
                        </a>
                   </li>
                   <li class="nav-item active">
                       <a class="nav-link" href="publication.php">
                            <i class="fa fa-upload" aria-hidden="true"></i>  faire une publication
                        </a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="pub.php">
                            <i class="fa fa-eye" aria-hidden="true"></i>   voir toutes les publications
                        </a>
                   </li>
               </ul>
           </div>
       </nav>
    </div>
</header>
<section id="publish">
    <div class="container">
    <div class="jumbotron">
        <h3 class="text-center text-secondary">PUBLICATION</h3>
        <hr>
        <div class="return"><?php echo $Error; ?></div>
        <form method="POST" action="" id="publication" enctype="">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="name">Nom <span class="obli">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="votre nom svp !" value="<?php echo $name; ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="surname">Prenoms <span class="obli">*</span></label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="votre prenom svp" value="<?php echo $surname; ?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="str_name">Nom de l'agence <span class="obli">*</span></label>
                    <input type="text" class="form-control" id="str_name" name="str_name" placeholder="le nom de votre agence" value="<?php echo $str_name; ?>">
                    <small>si vous êtes un particulier veuillez entrer votre nom comme nom de l'agence.</small>
                </div>
                <div class="form-group col-md-4">
                    <label class="my-1 mr-2" for="city">Commune <span class="obli">*</span></label>
                    <select class="custom-select my-1 mr-sm-2" id="city" name="city">
                        <option value="">Choisissez votre commune</option>
                        <option value="abobo">ABOBO</option>
                        <option value="adjame">ADJAME</option>
                        <option value="attecoube">ATTECOUBE</option>
                        <option value="cocody">COCODY</option>
                        <option value="koumassi">KOUMASSI</option>
                        <option value="marcory">MARCORY</option>
                        <option value="plateau">PLATEAU</option>
                        <option value="port-bouet">PORT-BOUET</option>
                        <option value="treichville">TREICHVILLE</option>
                        <option value="yopougon">YOPOUGON</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="category">Categories <span class="obli">*</span></label>
                    <select id="category" class="form-control" name="category">
                        <option value="">Choisissez une categorie</option>
                        <option value="villa">villa</option>
                        <option value="appartement">Appartement</option>
                        <option value="haut_standing">Haut standing</option>
                        <option value="ancienne_cours">ancienne cours</option>
                        <option value="2pieces">2 pieces</option>
                        <option value="3pieces">3 pieces</option>
                        <option value="4pieces">4 pieces</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                        <label for="statut">statuts <span class="obli">*</span></label>
                        <select id="statut" class="form-control" name="statut">
                            <option value="">Choisissez un statut</option>
                            <option value="En vente">vente</option>
                            <option value="En location">Location</option>
                        </select>
                    </div>
                <div class="form-group col-md-6">
                    <label for="num_1">contact 1 <span class="obli">*</span></label>
                    <input type="tel" class="form-control" id="num_1" name="contact_1" placeholder="Votre contact" value="<?php echo $contact_1; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="num_2">contact 2 </label>
                    <input type="tel" class="form-control" id="num_2" name="contact_2" placeholder="votre contact 2 si possible" value="<?php echo $contact_2; ?>">
                    <small>Pas obligatoire</small>
                </div>
                <div class="form-group col-md-12">
                    <label for="description">DESCRIPTION <span class="obli">*</span></label>
                    <textarea id="description" name="description" class="form-control" rows="5"><?php echo $description; ?></textarea>
                </div>
                <div class="form-group col-md-3">
                    <label for="image">image</label>
                    <input type="file" name="image" id="image" value="">
                </div>
                <button type="submit" class="btn btn-outline-primary btn-block  mt-3">Publier</button>
            </div> 
        </form>
    </div>
</section>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="logo">
                <div class="copy">
                   <h4 class="text-center">
                   <img src="img/habitat.png" alt="logo" width="100px">
                       IsO NaN 3.0 &copy; 2019
                    </h4>
                </div>
            </div>
        </div>
    </div>
</footer>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>