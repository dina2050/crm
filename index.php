<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<?php
$db = new PDO('mysql:host=localhost;dbname=crm', "root", "plop");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./static/css/style.css">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <a class="navbar-brand" href="#">My mini CRM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.html">Listings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_customer.html">Ajouter Client</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create_company.html">Ajouter Entreprise</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="row">
            <div class="col-12">
                <h1>Listing clients/entreprises</h1>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Entreprises</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                       
                        <form class="form-inline my-2">
                            <input class="form-control mr-sm-2 process" name="q" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0 find" type="submit"><i class="fas fa-search"></i></button>
                            <button class="btn btn-primary ml-5 my-2 my-sm-0" type="submit"><i class="fas fa-power-off"></i></button>
                        </form>
                        <div id="accordion">
                            <!-- <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            Thibault De Tourdonnet
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                            Alban Tiberghien
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>  -->

                        <?php
                        if(isset($_GET["q"])) {
                            
                            $req=$db->query('SELECT * FROM clients WHERE name LIKE  "%'.$_GET["q"].'%"');
                        }
                        else {

                            $req = $db->query('SELECT * FROM clients');
                        }
                         foreach ($req as $row) {
                        
                        ?>


                            <div class="card" id="customer<?php echo $row["id"]?>">
                                <div class="card-header" >
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            <?php echo $row["name"]?>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="card mb-3">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <img src="./static/images/<?php echo $row["image"]?>" class="card-img" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-8">
                                                    <?php $req2 = $db->query('SELECT * FROM Connection, entreprises WHERE Connection.id_entreprise = entreprises.id AND id_client =' .$row["id"]);
                                                          $client = $req2->fetch();
                                                    ?>
                                                                <h5 class="card-title"><?php echo $row["name"]?></h5>
                                                                <p class="card-text"><?php echo $row["address"]?></p>
                                                                <p class="card-text"><small class="text-muted"><?php echo $client["name"]?></small></p>
                                                            </div>
                                                            <div class="col-4 buttons">
                                                                 
                                                                <a href="edit.php?profile=<?php echo $row["id"]?>" class="btn btn-primary" type="button">
                                                               <i class="fas fa-edit"></i></a>
                                                                
                                                                       
                                                                <form class="deleteline" action="deleteline.php" method="post">
                                                                <input type="hidden" value = "<?php echo $row["id"]?>">
                                                                    <button class="btn btn-primary ml-2" type="submit">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form class="form-inline my-2">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                            <button class="btn btn-primary ml-5 my-2 my-sm-0" type="submit"><i class="fas fa-power-off"></i></button>
                        </form>
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="ENheadingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#ENcollapseOne"
                                            aria-expanded="true" aria-controls="ENcollapseOne">
                                            Num'n Coop
                                        </button>
                                    </h5>
                                </div>

                                <div id="ENcollapseOne" class="collapse show" aria-labelledby="ENheadingOne"
                                    data-parent="#accordion">
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="ENheadingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#ENcollapseTwo" aria-expanded="false"
                                            aria-controls="ENcollapseTwo">
                                            Maire de Mende
                                        </button>
                                    </h5>
                                </div>
                                <div id="ENcollapseTwo" class="collapse" aria-labelledby="ENheadingTwo"
                                    data-parent="#accordion">
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="ENheadingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#ENcollapseThree" aria-expanded="false"
                                            aria-controls="ENcollapseThree">
                                            Conseil départemental de la Lozère
                                        </button>
                                    </h5>
                                </div>
                                <div id="ENcollapseThree" class="collapse" aria-labelledby="ENheadingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="card mb-3">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <img src="https://picsum.photos/200/200" class="card-img" alt="...">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-8">

                                                                <h5 class="card-title">Conseil départemental de la Lozère
                                                                </h5>
                                                               
                                                                <p class="card-text">2 Rue de la Rovère, 48000 Mende</p>
                                                                <p class="card-text"><small class="text-muted">Alban
                                                                        Tiberghien</small></p>
                                                            </div>
                                                            <div class="col-4">
                                                                    <i class="fas fa-edit"></i> <i class="fas fa-trash-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
     $(document).ready(function(){
        $(".deleteline").submit(function(){
                var customerId = $(this).find("input").val();
                var currentLineId = "#customer"+customerId
               var postData = {
                 id:customerId
               }
                 
              $.post('deleteline.php',postData, function(data){
                $(currentLineId).remove()
             });
             return false;
             })

             $(".find").click(function(){}
                var customer = $(".process").val()
                 url:"search.php?value=",
                 name: customer
                 
               }
                 
              $.post('search.php',postData, function(data){
               
             });
             return false;
             })


     })
    
    </script>
</body>

</html>