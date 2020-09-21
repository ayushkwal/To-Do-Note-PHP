<?php
  $severname = "localhost";
  $username = "root";
  $password = "";
  $database = "php_project";

  $conn = mysqli_connect($severname,$username,$password,$database);
  if(!$conn)
  {
    die("Sorry,There's some error:". mysqli_connect_error());
  }
  else{
    echo "Connected to your Management<br>";
  }
  echo $_SERVER['REQUEST_METHOD'];

  if($_SERVER['REQUEST_METHOD']=='POST')
  {
    $title = $_POST["title"];
    $description = $_POST["description"];
  }
 $sql = "INSERT INTO `notes` (`S.No.`, `Title`, `Description`, `Time_Added`) VALUES ('', '$title', '$description', current_timestamp())";

 $result = mysqli_query($conn,$sql);

 if($result)
 {
   echo "Inserted Success";
 }
 else{
   echo "failed";
 }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <title>Project</title>
  </head>
  
  <style>
      .container form{
          margin-top: 50px;
          border: 1px solid black;
          background-color: rgba(136, 5, 5,0.06);
          height: 400px;
          padding: 20px 20px;
      }

       

  </style>
  <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">PHP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Other Products
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">BMI Calculator</a>
                    <a class="dropdown-item" href="#">Generate Univ. Roll No.</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Make My Food</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
            </div>
          </nav>

          <div class = "container">
           
            <form action="/crud/index.php" method = "POST">
                <div class="form-group">
                  <label for="exampleInputEmail1">Note Title</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name = "title" aria-describedby="emailHelp">
                   </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Note Description</label>
                  <input type="textarea" class="form-control" name="description" id="exampleInputPassword1">
                </div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">I read all terms and conditions.</label>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>

                <?php
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
              $title = $_POST['title'];
              $description = $_POST['description'];
            }
           // $sql = "INSERT INTO `notes` (`S.No.`, `Title`, `Description`, `Time_Added`) VALUES ('40', '$title', '$description', current_timestamp());";

             $sql =  "SELECT * FROM `notes`";
            
             $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            echo $num;
             
            ?>
              </form>
              <table class="table" id = "myTable">
  <thead>
    <tr>
      <th scope="col">SNO</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
              $title = $_POST['title'];
              $description = $_POST['description'];
            }
           // $sql = "INSERT INTO `notes` (`S.No.`, `Title`, `Description`, `Time_Added`) VALUES ('40', '$title', '$description', current_timestamp());";

             $sql =  "SELECT * FROM `notes`";
            
             $result = mysqli_query($conn,$sql);
           
              while($row = mysqli_fetch_assoc($result))
              {
                {
                  echo " <tr>
                  <th scope='row'>".$row['S.No.']."</th>
                  <td>".$row['Title'] ."</td>
                  <td>".$row['Description']."</td>
                  <td><button class='delete btn btn-sm btn-primary' id=d".$row['S.No.'].">Delete</button></td>
                </tr>";
                }
              }
            
            ?>
            
   
  </tbody>
</table>
             
          </div>

   

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready( function() {
    $('#myTable').DataTable();
} );
</script>
<script>
deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${SNO}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })

</script>
  </body>
</html>