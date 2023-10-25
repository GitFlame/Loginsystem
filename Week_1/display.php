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
    }

    .container {
      flex-grow: 1;
    }

    footer {
      text-align: center;
    }
  </style>

  <!-- Welcome box Appear -->
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

  <div class="container">
    <div class="row">
      <div class="col-md-12 text-right my-4">
        <button class="btn btn-primary"><a href="add_user.php" class="text-light">+ Add User</a></button>
        <button class="btn btn-success" id="exportExcel">Export to Excel</button>
      </div>
    </div>

    <!-- Delete Record button with 2-second alert Code -->
    <?php if (isset($_GET['delete_status']) && $_GET['delete_status'] == 'success') { ?>
      <div class="alert alert-success" role="alert">
        <button type="button" class="btn btn-success">Record Deleted Successfully!!</button>
      </div>

      <script>
        setTimeout(function () {
          var successMessages = document.getElementsByClassName('alert alert-success');
          for (var i = 0; i < successMessages.length; i++) {
            successMessages[i].style.display = 'none';
          }
        }, 2000);
      </script>
    <?php } ?>
    <!-- Delete Record button with 2-second alert Code -->

    <!-- Update Record button with 2-second alert Code -->
    <?php if (isset($_GET['update_status']) && $_GET['update_status'] == 'success') { ?>
      <div class="alert alert-success" role="alert">
        <button type="button" class="btn btn-success">Record Updated Successfully!!</button>
      </div>

      <script>
        setTimeout(function () {
          var successMessages = document.getElementsByClassName('alert alert-success');
          for (var i = 0; i < successMessages.length; i++) {
            successMessages[i].style.display = 'none';
          }
        }, 2000);
      </script>
    <?php } ?>
    <!-- Update Record button with 2-second alert Code -->

    <table class="table table-striped" id="myTable">
      <thead>
        <tr>
          <th scope="col"><input type="checkbox" id="select-all-checkbox"></th> <!-- Checkbox in the header -->
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
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
            $email = $row['email_id'];
            $password = $row['password'];

            ?>
            <tr>
              <td><input type="checkbox" data-id="<?php echo $id; ?>"></td>
              <th scope="row">
                <?php echo $id; ?>
              </th>
              <td>
                <?php echo $name; ?>
              </td>
              <td>
                <?php echo $email; ?>
              </td>
              <td>
                <button class="btn btn-primary"><a href="update.php?update_id=<?php echo $id; ?>"
                    class="text-light">Update</a></button>
                <button class="btn btn-danger"><a href="delete.php?delete_id=<?php echo $id; ?>"
                    class="text-light">Delete</a></button>
                    <button class="btn btn-success active-btn" data-id="<?php echo $id; ?>">Active</button>


              </td>
            </tr>
            <?php
          }
        }
        ?>
      </tbody>
    </table>

    <!-- Delete Selected button -->
    <button class="btn btn-danger" id="deleteSelectedBtn" style="display: none">Delete Selected</button>
  </div>

  <script>
    $(document).ready(function () {
      $('#myTable').DataTable({
        "columnDefs": [
          { "orderable": false, "targets": [0, 4] } // Disable sorting for the 4th column (0-based index)
        ]
      });

      // Add an event listener to the Export to Excel button
      $('#exportExcel').on('click', function () {
        window.location.href = 'export_excel.php'; // Redirect to the export script
      });

      // Check if any checkboxes are selected and show/hide "Delete Selected" button accordingly
      $('input:checkbox').change(function () {
        var selectedCheckboxes = $('input:checkbox:checked');
        if (selectedCheckboxes.length > 0) {
          $('#deleteSelectedBtn').show();
        } else {
          $('#deleteSelectedBtn').hide();
        }
      });
      $('#select-all-checkbox').change(function () {
        var isChecked = this.checked;
        $('.select-all-checkbox').prop('checked', isChecked);
      });


      // Add an event listener for the "Delete Selected" button
      $('#deleteSelectedBtn').on('click', function () {
        var selectedIds = [];
        $('input:checkbox:checked').each(function () {
          selectedIds.push($(this).data('id'));
        });

        if (selectedIds.length > 0) {
          // Make an AJAX request to delete the selected records
          $.ajax({
            url: 'delete_selected.php',
            method: 'POST',
            data: { selectedIds: selectedIds },
            dataType: 'json',
            success: function (response) {
              if (response.success) {
                // Reload the page or update the table
                window.location.reload();
              } else {
                console.error('Failed to delete selected records: ' + response.message); // Log the error
                alert('Failed to delete selected records: ' + response.message);
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
              console.error('AJAX request failed:', textStatus, errorThrown); // Log the error
              alert('An error occurred during the request. Check the console for details.');
            }
          });
        }
      });


      
    // Add an event listener for the "Active" button
$('.active-btn').on('click', function () {
    var id = $(this).data('id');
    var activeButton = $(this); // Store $(this) in a variable

    // Make an AJAX request to toggle the is_active status
    $.ajax({
        url: 'toggle_active.php',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                // Update button appearance
                if (response.is_active) {
                    // If now active
                    activeButton.removeClass('btn-success').addClass('btn-warning').text('Inactive');
                } else {
                    // If now inactive
                    activeButton.removeClass('btn-warning').addClass('btn-success').text('Active');
                }
            } else {
                console.error('Failed to toggle active status: ' + response.message); // Log the error
                alert('Failed to toggle active status: ' + response.message);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('AJAX request failed:', textStatus, errorThrown); // Log the error
            alert('An error occurred during the request. Check the console for details.');
        }
    });
});
    });

   
  </script>
</body>

</html>