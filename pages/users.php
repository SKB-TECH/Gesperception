<?php
    error_reporting( E_ALL );
    ini_set( 'display_errors', 1);
    include_once ("../Classes/crud.php"); 

$crud= new crud(); 

if(isset($_POST['submit'])){ 
          $data= array( 
              "noms"  => $crud->escape_string($_POST['noms']),            
              "fonction"  => $crud->escape_string($_POST['fonction']), 
              "password"  => $crud->escape_string($_POST['password']), 
              "login"  => $crud->escape_string($_POST['login']) 
            ); 
          
          $crud->insert($data,"User"); 
          if($data) { 
            echo 'insert successfully'; 
            header('location:users.php'); 
          }else { 
             echo 'try again' ; 
          }          
} 

if(!empty($_GET['delid'])){ 
  $id=$_GET['delid']; 

  $crud= new crud(); 
  $crud->deletedata("User","code_user",$id); 
  header('location:users.php'); 
  } 

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./Styles/index.css">
  <title>Nyalukemba: Users</title>
</head>

<body class="grid ">
  <header>
    <div>logo</div>
    <nav>notification</nav>
  </header>
  <main>
    <aside>
      side bar menu principale
    </aside>
    <section id="content">
      <article>
        <form method="POST" name="form">

          <label>Noms : </label>
          <input type="text" name="noms"><br />

          <label>fonction</label>
          <input type="text" name="fonction"><br />

          <label>password</label>
          <input type="text" name="password"><br />

          <label>login</label>
          <input type="text" name="login"><br />

          <input type="submit" name="submit">

        </form>
      </article>
      <article>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Noms</th>
              <th>Fonction</th>
              <th>Password</th>
              <th>login</th>
              <th>Edit</th>
              <th>delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $crud = new crud();
            $result = $crud->selectalldata("User");

            while ($data = $result->fetch()) {
            ?>

              <tr>
                <td><?php echo $data['noms']; ?></td>
                <td><?php echo $data['fonction']; ?></td>
                <td><?php echo $data['password']; ?></td>
                <td><?php echo $data['login']; ?></td>
                <td><a href="users.php?editid=<?php echo $data['code_user']; ?>">edit</td>
                <td><a href="users.php?delid=<?php echo $data['code_user']; ?>" onclick=" return confirm('Do You really want to delete this data')">delete</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </article>
    </section>
  </main>
</body>

</html>