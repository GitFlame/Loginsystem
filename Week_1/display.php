<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/display_style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  



  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
     /* background-color: #1BECE2; */
    }

    .container {
      flex-grow: 1;
    }

    footer {
      text-align: center;
    }
  </style>
</head>



<body>
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <img src="css/dashboard.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Dashboard
    </a>
    <form action="logout.php" method="post" class="form-inline">
      <button type="submit" class="btn btn-link text-light">Logout</button>
    </form>
  </nav>


  <div class="container">
    <button class="btn btn-primary my-5"><a href="add_user.php" class="text-light">+ Add User</a></button>


<!--     
  <div class="container">
  <div class="row mb-4">
    <div class="col-md-6">
      <div class="input-group">
        <input type="text" class="form-control" id="searchInput" placeholder="Search by ID or Name">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
        </div>
      </div>
    </div>
  </div>
</div> -->
    



    <?php if(isset($_GET['update_status']) && $_GET['update_status'] == 'success'){ ?>
    <div class="alert alert-success" role="alert">
        <button type="button" class="btn btn-success">Record Updated Successfully!!</button>
    </div>

    <script>
        //success msg will disappear  after 4 seconds
        setTimeout(function() {
            var successMessages = document.getElementsByClassName('alert alert-success');
            for (var i = 0; i < successMessages.length; i++) {
                successMessages[i].style.display = 'none';
            }
        }, 4000);
    </script>
<?php } ?>

    <table class="table table-striped" id="myTable">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col"> Name</th>
          <th scope="col">Email Id</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "Select * from `details`";
        $result = mysqli_query($conn, $sql);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['username'] . ' ' . $row['lastname']; 
            $lastname=$row['lastname'];
            $email = $row['email_id'];
            $password = $row['password'];


            // Check if the user is present in the database
            $statusButton = (mysqli_num_rows($result) > 0) ? '<button class="btn btn-success">Active</button>' : '<button class="btn btn-danger">Inactive</button>';
            echo '<tr>
                        <th scope="row">' . $id . '</th>
                        <td>' . $name . '</td>
                        <td>' . $email . '</td>
                     

                        
                        <td>

                        <button class="btn btn-primary"><a href="update.php?update_id=' . $id . '" class="text-light">Update</a></button>

                            <button class="btn btn-danger"><a href="delete.php?delete_id=' . $id . '" class="text-light">Delete</a></button>
                            ' . $statusButton . '
                  </td>
                </tr>';
          }
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
        <th scope="col">Id</th>
          <th scope="col"> Name</th>
          <th scope="col">Email Id</th>
          <th scope="col">Action</th>
        </tr>
    </tfoot>
    </table>
  </div>

  <div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Welcome to the Dashboard</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          This is your dashboard. Explore and manage your data here.
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.onload = function () {
      $('#welcomeModal').modal('show');
    }
  </script>

  <!-- <footer>
    <p>&copy; 2023 Indusnet Technologies</p>
    <p>All Copyright Reserved!</p>
  </footer> -->

  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>

</body>

</html>