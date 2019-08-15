<?php 
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>todolist</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

</head>
<body>
    <div class="container">
        <div class="row" style="margin-top:50px;">
            <h1 class="text-center">Update Todo List</h1>
            <div class="col-md-10 col-md-offset-1">
                <hr><br>
                <?php 
                    $id=$_GET["id"];
                    $sql_task=$connection->query("SELECT*FROM tb_task WHERE id='$id' ");
                    $row=$sql_task->fetch_assoc();
                    if (isset($_POST["save"])) {
                        $name=$_POST["task"];

                        $sql_upt=$connection->query("UPDATE tb_task SET name='$name' WHERE id='$id' ");
                        if ($sql_upt) {
                            header('location:index.php');
                        }
                    }
                 ?>
                <form method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Rewrite Your Task here</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Task Name</label>
                                <input type="text" name="task" class="form-control" value="<?php echo $row['name']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="save" class="btn btn-primary" value="Save">
                            <a href="index.php" type="button" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>