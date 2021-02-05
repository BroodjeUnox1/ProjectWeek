<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Wiki Battlefield 1</title>
  </head>
  <body>
    <div id="edit_modal" class="modal fade" role="dialog">
      <div class="modal-dialog">

    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit data</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <input type="hidden" id="edit_id">
                <div class="col-md-6">
                    <label>Shoe</label>
                    <input type="text" class="form-control" id="edit_title">
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="text" class="form-control" id="edit_thread">
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success" style="float: right;margin-top: 7px" onclick="update()"><i class="fas fa-check"></i> Save data</button>
                </div>

            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- Start navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gameProperties">Spel eigenschappen</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./uitbreidingen.html">Uitbreidingen</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <button class="btn btn-outline-success my-2 my-sm-0">Login</button>
          </form>
        </div>
      </nav>
    <!--End Navbar-->






    <!-- Optional JavaScript -->
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript">
        function edit(el){
        console.log(el)
        var data = el.dataset;

        Object.keys(data).forEach(function (key) {
            let value = data[key];
            console.log(`${key} - ${value}`)

            $(`#edit_${key}`).val(value)

        });

        $('#edit_modal').modal('toggle')
    }


function update(){
    var title = $('#edit_title').val()      
    var thread = $('#edit_thread').val()
    var id = $('#edit_id').val()

    $.post('./api/update/update.php', {title: title, thread: thread, id: id}, function(response){
        console.log(response)
        if(response == 'Success'){
            location.reload();
        }
    })
}
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

<?php 

$servername = 'localhost';
$username = 'id15304214_projectweek';
$password = '%/[fWDDH4W25$i\Q';
$dbname = 'id15304214_users';
// Connecting DB
$conn = new mysqli($servername, $username, $password, $dbname);
// check conn
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM threads";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $id = $row["id"];
    $user = $row["user"];
    $title = $row["title"];
    $thread = $row["thread"];

    $html = "<div class='card' style='width: 50rem; margin-top: 20px;'>
                <div class='card-body'>
                    <h5 class='card-title' style='border-bottom: 1px solid #dee0e4;'>$title</h5>
                    <p class='card-text'>$thread</p> 
                    <input value='Edit' onclick='edit(this)' data-id='$id' data-title='$title' data-thread='$thread' class='btn btn-block btn-success'>
                </div>
            </div>";
    echo $html;
  }
} else {
  echo "0 results";
}

mysqli_close($conn);

?>
