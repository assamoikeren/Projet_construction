<?php 
require "php/connexion.php";
require "function/verification.php";
    if (!empty($_GET["id"]))
    {
        $id = verification($_GET["id"]);
    }
        

        $req = $bdd->prepare("SELECT * FROM publication where id = ?");
        $req->execute(array($id));
        $publication = $req->fetch() 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/info.css">
<link rel="icon" href="img/habitat.png">
<title>Mon Habitat | Informations</title>
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
               <ul class="navbar-nav ml-5 text-center navbar-right">
                   <li class="nav-item">
                       <a class="nav-link" href="index.html"><i class="fa fa-home" aria-hidden="true"></i> accueil</a>
                   </li>
                   <li class="nav-item active">
                       <a class="nav-link" href="recherche.php">
                            <i class="fa fa-search" aria-hidden="true"></i></span> recherche
                        </a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="publication.php">
                        <i class="fa fa-upload" aria-hidden="true"></i> faire une publication
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
<section id="contenu">
    <div class="container">
        <div class="jumbotron">
            <h4 class="mb-5 text-center text-danger text-uppercase"><strong>Informations</strong></h4>
            <hr>
                <form method="POST" action="" id="publication" class="mt-3">
                    <div class="form-row">
                        <?php 
                            $id = $_GET["id"];

                            $req = $bdd->prepare("SELECT * FROM publication where id = ?");
                            $req->execute(array($id));
                            $publication = $req->fetch() 
                        ?>
                                <div class="form-group col-md-6">
                                    <label for="name"> Publication faite par  : </label> <?php echo $publication["surname"] . " " . $publication["name"]?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="str_name">Nom de l'agence  : </label> <?php echo $publication["str_name"]?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="my-1 mr-2" for="city">situé à  :  </label> <?php echo $publication["city"]?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="category">Categories   :  </label> <?php echo $publication["category"]?>
                                </div>
                                <div class="form-group col-md-6">
                                        <label for="statut">statuts  :  </label> <?php echo $publication["statut"]?>
                                    </div>
                                <div class="form-group col-md-6">
                                    <label for="num_1">contacts   :  </label> 
                                    <?php echo $publication["contact_1"];?>
                                    <?php
                                        if ($publication["contact_2"] == 0) 
                                        {
                                            $publication["contact_2"] = "";
                                        }
                                         echo "  /  " . $publication["contact_2"]
                                    ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">DESCRIPTION  :  </label><p> <?php echo $publication["description"]?></p>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="image">image  </label> 
                                    <img src="img_home/<?php echo $publication["image"] ;?>" alt="impossible de charger" class="img-fluid rounded"/>
                                </div>
                            </div>
                        </form>
                        <div class="mt-3">
                            <a class="btn btn-outline-success btn-block" href="recherche.php" >Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<footer>
    <div class="container-fluid">
        <h4 class="text-center text-light">
            IsO NaN 3.0 &copy; 2019
        </h4>
    </div>
</footer>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
        $('#modal_info').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM
            
        });
    </script>
</body>
</html>