<?php

    require('top.inc.php');

    if(isset($_GET['id']) && isset($_GET['type']) && $_GET['type']=='delete'){
        $id=mysqli_real_escape_string($con,$_GET['id']);
        mysqli_query($con,"DELETE FROM leave_apply WHERE id='$id'");
    }

    if(isset($_GET['id']) && isset($_GET['type']) && $_GET['type']=='update'){
        $id=mysqli_real_escape_string($con,$_GET['id']);
        $status=mysqli_real_escape_string($con,$_GET['status']);
        mysqli_query($con,"UPDATE leave_apply SET leave_status='$status' WHERE id='$id'");
        header('location:leave.php');
        die();
    }

    if($_SESSION['ROLE']=='1'){
        $sql="SELECT leave_apply.*,employee.name,employee.id as eid FROM leave_apply,employee WHERE leave_apply.employee_id=employee.id ORDER BY leave_apply.id DESC"; 
    }else{
        $employee_id=$_SESSION['USER_ID'];
        $sql="SELECT leave_apply.*,employee.name,employee.id as eid FROM leave_apply,employee WHERE leave_apply.employee_id=employee.id AND leave_apply.employee_id='$employee_id' ORDER BY leave_apply.id DESC";   
    }
    
    $res=mysqli_query($con,$sql);

?>

                    <div class="content pb-0">
                        <div class="orders">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="box-title">Leave Master</h4>
                                            <?php if($_SESSION['ROLE']=='2'){?>
                                                    <h4 class="box_title_link"><a href="add_leave.php">Add Leave</a></h4>
                                            <?php } ?>
                                        </div>
                                        <div class="card-body--">
                                            <div class="table-stats order-table ov-h">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="serial" width="5%">#</th>
                                                            <th width="3%">ID</th>
                                                            <th width="15%">Name</th>
                                                            <th width="15%">From</th>
                                                            <th width="15%">To</th>
                                                            <th width="20%">Description</th>
                                                            <th width="25%">Leave Status</th>
                                                            <th width="7%"></th>
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
                                                            <td><?php echo $row['name'].' ( E-ID: '.$row['eid'].' )'?></td>
                                                            <td> <span class="name"><?php echo $row['leave_from']?></span></td>
                                                            <td> <span class="name"><?php echo $row['leave_to']?></span></td>
                                                            <td> <span class="name"><?php echo $row['leave_description']?></span></td>
                                                            <td> 
                                                                <?php 
                                                                    if($row['leave_status']==1){
                                                                        echo '<span class="badge badge-pill badge-primary">Applied</span>';
                                                                    }
                                                                    if($row['leave_status']==2){
                                                                        echo '<span class="badge badge-pill badge-success">Approved</span>';
                                                                    }
                                                                    if($row['leave_status']==3){
                                                                        echo '<span class="badge badge-pill badge-danger">Rejected</span>';
                                                                    }
                                                                ?>
                                                                
                                                                <?php if($_SESSION['ROLE']=='1'){?>
                                                                    <select class="form-control" style="margin-top:8px;" onchange="update_leave_status('<?php echo $row['id']?>',this.options[this.selectedIndex].value)">
                                                                        <option value="">Update Status</option>
                                                                        <option value="2">Applied</option>
                                                                        <option value="3">Rejected</option>
                                                                    </select>
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <?php if($row['leave_status']==1){?>
                                                                        <span class="badge badge-danger"><a href="leave.php?id=<?php echo $row['id']?>&type=delete">Delete</a></span>
                                                                <?php } ?>
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
                    
                    <script>
                        function update_leave_status(id,select_value){
                            window.location.href='leave.php?id='+id+'&type=update&status='+select_value;
                        }
                    </script>
                    
<?php require('footer.inc.php');?>
