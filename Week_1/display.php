<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Userlist</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/display_style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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



<!-- Welcome box Appear-->
<div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Welcome to the Userlist</h5>
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
</head>
<!-- Welcome box Appear-->




<!-- Logout Button Code-->
<body>
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <img src="css/dashboard.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Userlist
    </a>
    <form action="logout.php" method="post" class="form-inline">
      <button type="submit" class="btn btn-link text-light">Logout</button>
    </form>
  </nav>
  <!-- Logout Button Code-->


<!-- Add User button Code-->
  <div class="container">
  <div class="row">
    <div class="col-md-12 text-right my-4">
      <!-- Add User button -->
      <button class="btn btn-primary"><a href="add_user.php" class="text-light">+ Add User</a></button>
      <button class="btn btn-success" id="exportExcel">Export to Excel</button>
    </div>
  </div>



<!-- Add User button Code-->


<!-- Delete Record button with 2 second alert Code-->
    <?php
    if (isset($_GET['delete_status']) && $_GET['delete_status'] == 'success') { ?>
      <div class="alert alert-success" role="alert">
        <button type="button" class="btn btn-success">Record Deleted Successfully!!</button>
      </div>

      <script>
        //success msg will disappear after 2 seconds
        setTimeout(function () {
          var successMessages = document.getElementsByClassName('alert alert-success');
          for (var i = 0; i < successMessages.length; i++) {
            successMessages[i].style.display = 'none';
          }
        }, 2000);
      </script>
    <?php } ?>

<!-- Delete Record button with 2 second alert Code-->


<!-- Update Record button with 2 second alert Code-->
    <?php if (isset($_GET['update_status']) && $_GET['update_status'] == 'success') { ?>
      <div class="alert alert-success" role="alert">
        <button type="button" class="btn btn-success">Record Updated Successfully!!</button>
      </div>

      <script>
        //success msg will disappear  after 4 seconds
        setTimeout(function () {
          var successMessages = document.getElementsByClassName('alert alert-success');
          for (var i = 0; i < successMessages.length; i++) {
            successMessages[i].style.display = 'none';
          }
        }, 2000);
      </script>
    <?php } ?>
<!-- Update Record button with 2 second alert Code-->


<!--Userlist table creation-->
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
        <!-- Display Data from database on the table -->
        <?php
        $sql = "Select * from `details`";
        $result = mysqli_query($conn, $sql);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['username'] . ' ' . $row['lastname'];
            $lastname = $row['lastname'];
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
    </table>
    <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  </div>
 

</body>
</html>