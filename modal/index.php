<!DOCTYPE html>
<html>
<head>
    <title>Table with Update and Delete Buttons</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <button class="btn btn-success" style="float:right; margin-top:40px;" data-toggle="modal" data-target="#addEmployeeModal">Add</button>
        <br>
        <h2>Employee List</h2>
        <br>
        <?php
        if(isset($_GET['message'])){
            echo "<h6 style='text-align: center; color: red;'>".$_GET['message']."</h6>";
        }
        ?>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conn.php';

                $query = "SELECT * FROM `modal`";

                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("Query failed: " . mysqli_error($conn));
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td class="stud_id">' . $row['id'] . '</td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['age'] . '</td>';
                        echo '<td>';
                        echo '<button class="btn btn-primary edit_btn" data-toggle="modal" data-target="#editmodal">Edit</button>';
                        echo '<a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger">Delete</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- add modal button -->
    <form action="add.php" method="POST">
        <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Employee Form -->
                        <form id="employeeForm">
                            <div class="form-group">
                                <label for="employeeName">Name:</label>
                                <input type="text" class="form-control" name="name" id="employeeName" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="employeeAge">Age:</label>
                                <input type="text" class="form-control" name="age" id="employeeAge" placeholder="Enter Age">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- edit modal -->
    <form action="edit.php" method="POST">
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEmployeeModalLabel">Edit Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Employee Form -->
                        <input type="hidden" name="edit_id" id="edit_id">
                        <div class="form-group">
                            <label for="employeeName">Name:</label>
                            <input type="text" class="form-control" name="name" id="edit_employeeName" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="employeeAge">Age:</label>
                            <input type="text" class="form-control" name="age" id="edit_employeeAge" placeholder="Enter Age">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="edit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.edit_btn').click(function(e) {
                e.preventDefault();
                
                var stud_id = $(this).closest('tr').find('.stud_id').text();
                
                $.ajax({
                    type: "POST",
                    url: "edit.php",
                    data: {
                        'checking_edit_btn': true,
                        'student_id': stud_id,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('#edit_employeeName').val(response.data.name);
                            $('#edit_employeeAge').val(response.data.age);
                            $('#edit_id').val(stud_id);
                            $('#editmodal').modal('show');
                        } else {
                            console.log("Error fetching data.");
                        }
                    }
                });
            });
        });




        // this is the delete ajax code

    </script>
</body>
</html>
