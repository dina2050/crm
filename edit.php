<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<?php
$db = new PDO('mysql:host=localhost;dbname=crm', "root", "plop");

if (isset($_POST["id_client"])){
  $reqo = $db->query('UPDATE clients SET name = "'.$_POST['name'].'",  address = "'.$_POST['address'].'" WHERE id = "'.$_POST["id_client"].'" ');
  $bla= $db->query('UPDATE Connection SET id_entreprise = "'.$_POST['id_entreprise'].'" WHERE id_client = "'.$_POST["id_client"].'"');
  
}
$req = $db->query('SELECT * FROM clients WHERE id = '.$_GET["profile"]);
 $updateClient = $req->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./static/css/style.css">
    <title>Create Customer</title>
</head>
<body>
   <div class="container">
       <div class="row">
           <div class="col-12">
               <h3 class="text-center"> Mise à jour de <?php echo $updateClient["name"] ?></h3>
            <form method="POST">
                <input type="hidden" name="id_client" value="<?php echo $updateClient['id']?>">
                <div class="form-row">
                  <div class="col">
                    <input type="text" name="name" class="form-control" value="<?php echo $updateClient['name']?>">
                  </div>
                  <div class="col">
                    <input type="text" name="name" class="form-control" value="<?php echo $updateClient['name']?>">
                  </div>
                </div>
                <div class="form-row mt-2">
                    <div class="col">
                      <input type="text" name="address" class="form-control" value="<?php echo $updateClient['address']?>">
                    </div>
                   
                  </div>
                  <div class="form-row mt-2">
                    <div class="col-4">
                        <select id="inputState" class="form-control" name='id_entreprise'>
                  <?php
                  
                  $requ = $db->query('SELECT * FROM Connection WHERE id_client='.$updateClient["id"] );
                  $into = $requ->fetch();
                  $reqi = $db->query('SELECT * FROM entreprises' );
                  foreach ( $reqi as $updateEntreprise) {
                    
                  ?>
                            <option <?php if(($updateEntreprise["id"] == $into["id_entreprise"])){ echo "selected"; } ?> value='<?php echo $updateEntreprise['id']?>'><?php echo $updateEntreprise['name']?></option>
                            <?php } ?>
                          </select>
                    </div>
                    <div class="col-8 ">  <button type="submit" class="btn btn-primary">Sign in</button> </div>
                  </div>
              </form>
           </div>
       </div>
   </div> 
   <script src="./node_modules/jquery/dist/jquery.min.js"></script>
   <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>