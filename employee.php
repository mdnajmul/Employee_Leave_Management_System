<?php

    require('top.inc.php');

    if($_SESSION['ROLE']!=1){
        header('location:index.php');
        die();
    }

    if(isset($_GET['id']) && isset($_GET['type']) && $_GET['type']=='delete'){
        $id=mysqli_real_escape_string($con,$_GET['id']);
        mysqli_query($con,"DELETE FROM employee WHERE id='$id'");
    }

    $res=mysqli_query($con,"SELECT * FROM employee WHERE role=2 ORDER BY id DESC");

?>

            <div class="content pb-0">
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Employee Master</h4>
                                    <h4 class="box_title_link"><a href="add_employee.php">Add Employee</a></h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="serial" width="5%">#</th>
                                                    <th width="5%">ID</th>
                                                    <th width="25%">Name</th>
                                                    <th width="25%">Email</th>
                                                    <th width="20%">Mobile</th>
                                                    <th width="20%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $i=0;
                                                    while($row=mysqli_fetch_assoc($res)){
                                                    $i++;
                                                ?>
                                                        <tr>
                                                            <td class="serial"><?php echo $i?>.</td>
                                                            <td><?php echo $row['id']?></td>
                                                            <td> <span class="name"><?php echo $row['name']?></span></td>
                                                            <td> <span class="name" style="text-transform: lowercase;"><?php echo $row['email']?></span></td>
                                                            <td> <span class="name"><?php echo $row['mobile']?></span></td>
                                                            <td>
                                                                <span class="badge badge-warning"><a href="add_employee.php?id=<?php echo $row['id']?>">Edit</a></span> <span class="badge badge-danger"><a href="employee.php?id=<?php echo $row['id']?>&type=delete">Delete</a></span>
                                                            </td>
                                                        </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
<?php require('footer.inc.php');?>
