<?php

    require('top.inc.php');
    

    if(isset($_POST['submit'])){
        $leave_id=mysqli_real_escape_string($con,$_POST['leave_id']);
        $leave_from=mysqli_real_escape_string($con,$_POST['leave_from']);
        $leave_to=mysqli_real_escape_string($con,$_POST['leave_to']);
        $employee_id=$_SESSION['USER_ID'];
        $leave_description=mysqli_real_escape_string($con,$_POST['leave_description']);
        
        $sql="INSERT INTO leave_apply(employee_id,leave_id,leave_from,leave_to,leave_description,leave_status) VALUES('$employee_id','$leave_id','$leave_from','$leave_to','$leave_description','1')";
        
        mysqli_query($con,$sql);
        header('location:leave.php');
        die();
    }

?>

             <div class="content pb-0">
                <div class="orders">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><strong>Leave Apply</strong><small> Form</small></div>
                                <div class="card-body card-block">
                                   <form method="post">
                                        <div class="form-group">
                                            <label for="leave_id" class=" form-control-label">Leave Type</label>
                                            <select name="leave_id" class="form-control" required>
                                                <option value="">Select Leave Type</option>
                                                <?php
                                                    $res=mysqli_query($con,"SELECT * FROM leave_type ORDER BY type ASC");
                                                    while($row=mysqli_fetch_assoc($res)){
                                                        echo '<option value="'.$row['id'].'">'.$row['type'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="leave_from" class=" form-control-label">From Date</label>
                                            <input type="date" name="leave_from" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="leave_to" class=" form-control-label">To Date</label>
                                            <input type="date" name="leave_to" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="leave_description" class=" form-control-label">Leave Description</label>
                                            <textarea name="leave_description" placeholder="Enter leave details" class="form-control"></textarea>
                                        </div>
                                        <div>
                                            <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
<?php require('footer.inc.php');?>
