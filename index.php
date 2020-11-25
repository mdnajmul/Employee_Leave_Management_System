<?php

    require('top.inc.php');

    if(isset($_GET['id']) && isset($_GET['type']) && $_GET['type']=='delete'){
        $id=mysqli_real_escape_string($con,$_GET['id']);
        mysqli_query($con,"DELETE FROM department WHERE id='$id'");
    }

    $res=mysqli_query($con,"SELECT * FROM department ORDER BY id DESC");

?>

           <?php if($_SESSION['ROLE']==1){?>
                    <div class="content pb-0">
                        <div class="orders">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="box-title">Department Master</h4>
                                            <h4 class="box_title_link"><a href="add_department.php">Add Department</a></h4>
                                        </div>
                                        <div class="card-body--">
                                            <div class="table-stats order-table ov-h">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="serial" width="5%">#</th>
                                                            <th width="5%">ID</th>
                                                            <th width="70%">Department Name</th>
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
                                                                    <td> <span class="name"><?php echo $row['department_name']?></span></td>
                                                                    <td>
                                                                        <span class="badge badge-warning"><a href="add_department.php?id=<?php echo $row['id']?>">Edit</a></span> <span class="badge badge-danger"><a href="index.php?id=<?php echo $row['id']?>&type=delete">Delete</a></span>
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
            <?php }else{ ?>
                    <div class="content pb-0">
                        <div class="orders">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="box-title">Welcome To Dashboard</h4>
                                        </div>
                                        <div class="card-body--">
                                            <div class="table-stats order-table ov-h">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php } ?>
            
<?php require('footer.inc.php');?>
