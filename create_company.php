<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<?php
$db = new PDO('mysql:host=localhost;dbname=crm', "root", "plop");
if (isset($_POST["denomination"]) && isset ($_POST["adresse_complete"])){
    echo 'INSERT INTO entreprises(name,address) values("'.$_POST['denomination'].'","'.$_POST['adresse_complete'].'")';
    $req =$db->query('INSERT INTO entreprises(name,address) values("'.$_POST['denomination'].'","'.$_POST['adresse_complete'].'")');
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./static/css/style.css">
    <title>Create Company</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.html">Listings </a>
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
                <h2 class="text-center">Ajouter d'une nouvelle entreprise</h2>
                <form method="POST">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Dénomination" name="denomination">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Adresse complète" name="adresse_complete">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Enregister</button>
                </form>
            </div>
        </div>

    </div>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>