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
            <h1 class="text-center">Todo List</h1>
            <div class="col-md-10 col-md-offset-1">
                <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Add Task</button>
                <button class="btn btn-default pull-right" onclick="print()">Print</button>
                <hr>
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form method="post" action="add.php">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Insert Your Task here</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Task Name</label>
                                    <input type="text" name="task" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="save" class="btn btn-primary" value="Save">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

                <form action="index.php" method="get">
                    <div class="input-group">
                        <input type="text" name="cari" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                        </div>
                    </div>
                </form>
                <?php
                    if(isset($_GET['cari'])){
                        $cari = $_GET['cari'];
                        echo "<b>Hasil pencarian : ".$cari."</b>";
                    }
                ?>
                <br><br>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th colspan="3">Task</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $halaman=5;
                            $page=isset($_GET["halaman"])?(int)$_GET["halaman"]:1;
                            $mulai=($page>1)?($page*$halaman)-$halaman:0;
                            $result=$connection->query("SELECT*FROM tb_task");
                            $total=$result->num_rows;
                            $pages=ceil($total/$halaman);

                            if(isset($_GET["cari"])){
                                $sql=$connection->query("SELECT*FROM tb_task WHERE name LIKE '%".$cari."%' LIMIT $mulai,$halaman")or die(mysqli_error($connection));
                            }else{
                                $sql=$connection->query("SELECT*FROM tb_task LIMIT $mulai,$halaman")or die(mysqli_error($connection));
                            }
                            while ($row=$sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td class="col-md-10"><?php echo $row["name"]; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                            </td>
                            <td>
                                <a href="delete.php?id=<?php echo $row['id']; ?>"" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div>
                    <?php 
                        for($i=1;$i<=$pages;$i++){
                            ?>
                            <ul class="pagination">
                                <li>
                                    <a href="?halaman=<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            </ul>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>