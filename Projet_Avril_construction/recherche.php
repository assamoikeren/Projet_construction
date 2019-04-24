<?php 
session_start();
require "php/connexion.php";

    $city = $category = $statut = "" ;
    $Error = $indisponible = "" ;




    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $city = ($_POST["city"]);
        $category= ($_POST["category"]);
        $statut = ($_POST["statut"]);
        $req = $bdd->prepare("SELECT * FROM publication where (city =? AND category =? AND statut =?)");
        $req->execute(array($city,$category,$statut));
        $publication = $req->fetch();


        if (empty($city) or empty($category) or empty($statut)) 
        {
           $Error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                            <strong>
                                Veuillez selectionner une commune, une categorie et un statut pour plus de precision dans la recherche
                            </strong>
                    </div>';
        }
             else if (($publication["city"] != $city)  AND ($publication["category"] !=$category) AND ($publication["statut"] !=$statut))
                {
                    $indisponible = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                    <strong>
                        Pas de maison disponible !
                    </strong>
                    Vous pouvez voir toutes les publications qui ont été faites
                    </div>';
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/recherche.css">
<link rel="icon" href="img/habitat.png">
<title>Mon Habitat | recherche</title>
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
        <h2 class="text-center">Trouvez le Meilleur maintenant sur
                <img src="img/habitat.png" alt="logo" width="100px">
        </h2>
        <div class="row">
            <div class="col-md-3 icon">
                <i class="fa fa-building" aria-hidden="true"></i><br>
                <small>appartement</small>
            </div>
            <div class="col-md-3 icon">
                <i class="fa fa-city" aria-hidden="true"></i><br>
                <small>haut-standing</small>
            </div>
            <div class="col-md-3 icon">
                <i class="fa fa-hotel" aria-hidden="true"></i><br>
                <small>villa</small>
            </div>
            <div class="col-md-3 icon-dne">
                <i class="fa fa-home" aria-hidden="true"></i><br>
                <small>studio</small>
            </div>

        </div>
        <div id="search">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="city">commune</label>
                        <select id="city" class="form-perso" name="city">
                            <option value="">Choisissez une commune</option>
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
                    <div class="form-group col-md-3">
                        <label for="category">categories</label>
                        <select id="category" class="form-perso" name="category">
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
                    <div class="form-group col-md-3">
                        <label for="statut">statuts</label>
                        <select id="statut" class="form-perso" name="statut">
                            <option value="">Choisissez un statut</option>
                            <option value="En vente">vente</option>
                            <option value="En location">Location</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-outline-warning btn-lg" onclick="result()">
                            <i class="fa fa-search" aria-hidden="true"></i> chercher
                        </button>
                    </div>
                </div>
            </form>
            <div class="mt-3">
                <?php echo $Error;?>
            </div>
            <div class="jumbotron mt-5" id="tableau">
                <h3 class="text-center text-primary">Resultat de la recherche</h3>
                <hr class="bg-info">
                <table class="table table-striped">
                <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>nom de l'agence</th>
                            <th>commune</th>
                            <th>categorie</th>
                            <th>statut</th>
                            <th>contact</th>
                            <th class="text-center">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $req = $bdd->prepare("SELECT * FROM publication where (city =? AND category =? AND statut =?) ORDER BY id DESC");
                            $req->execute(array($city,$category,$statut));
                            
                            $i = 1;
                            while ($publication = $req->fetch()) 
                            {
                                echo "<tr>";
                                echo "<td>" . $i ."</td>";
                                echo "<td>" . $publication['str_name'] . "</td>";
                                echo "<td>" . $publication['city'] . "</td>";
                                echo "<td>" . $publication['category'] . "</td>"; 
                                echo "<td>" . $publication['statut'] . "</td>";
                                echo "<td>" . $publication['contact_1'] . "</td>";
                                echo "<td width='200'>";
                                echo "<a class='btn btn-outline-success btn-block' href='info.php?id=".$publication["id"] ."'>plus d'infos</a>";   
                                echo "</tr>";
                                $i=$i+1;   

                            }

                            echo $indisponible;
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                    <h4 class="mb-5 text-center text-danger text-underline"><strong>Informations</strong></h4>
                        <form method="POST" action="" id="publication">
                            <div class="form-row">
                                <?php 
                                    $id = $_GET["id"];

                                    $req = $bdd->prepare("SELECT * FROM publication where id = ?");
                                    $req->execute(array($id));
                                    $publication = $req->fetch() 
                                ?>
                                <div class="form-group col-md-12">
                                    <label for="name"> Publication faite par  : </label> <?php echo $publication["surname"] . " " . $publication["name"]?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="str_name">Nom de l'agence  : </label> <?php echo $publication["str_name"]?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="my-1 mr-2" for="city">situé à  :  </label> <?php echo $publication["city"]?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="category">Categories   :  </label> <?php echo $publication["category"]?>
                                </div>
                                <div class="form-group col-md-12">
                                        <label for="statut">statuts  :  </label> <?php echo $publication["statut"]?>
                                    </div>
                                <div class="form-group col-md-12">
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
                                    <label for="description">DESCRIPTION  :  </label> <?php echo $publication["description"]?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="image">image  </label> <?php echo $publication["image"]?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</section>
<section id="resultat">
    <div class="container">

    </div>
</section>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="logo">
                <div class="copy">
                   <h4>
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