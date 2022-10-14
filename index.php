<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./node_modules//sweetalert2/dist/sweetalert2.min.css">
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" href="./node_modules/datatables.net-dt/css/jquery.dataTables.min.css">
    <script src="./node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="./node_modules/popper.js/dist/popper.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./font/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./styele.css">
    <title>Connexion a la base des donnees</title>
</head>
<body>
<div class="container">
  <div class="forme">
  <form action="./pages/Menus/action_page.php" method="POST" class="was-validated w-25" id="form-data">
   <div>
   <div class="form-group">
      <label for="uname">Nom utilisateur</label>
      <input type="text" name="logine" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label for="pwd">Mot de passe:</label>
      <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <input type="submit" class="btn btn-primary" value="Connexion"/>
   </div>
  </form>
  </div> 
</body>
</html>
