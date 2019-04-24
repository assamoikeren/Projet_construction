<?php 

    require "php/connexion.php";
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
<link rel="stylesheet" href="css/pub.css">
<link rel="icon" href="img/habitat.png">
<title>Mon Habitat | toutes les publications</title>
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
                   <li class="nav-item">
                       <a class="nav-link" href="publication.php">
                            <i class="fa fa-upload" aria-hidden="true"></i>   faire une publication
                        </a>
                   </li>
                   <li class="nav-item active">
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
        <h3 class="text-center text-info">TOUTES LES PUBLICATIONS</h3>
        <hr>
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
                            $req = $bdd->prepare("SELECT * FROM publication ORDER BY id DESC");
                            $req->execute();
                            
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
                                echo "<a class='btn btn-outline-success btn-block' href='view.php?id=".$publication["id"] ."'>plus d'infos</a>";   
                                echo "</tr>";
                                $i=$i+1;   

                            }
                        ?>

                    </tbody>
                </table>
        
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