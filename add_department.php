<?php

    require('top.inc.php');

    if($_SESSION['ROLE']!=1){
        header('location:index.php');
        die();
    }

    $department='';
    $id=0;

    if(isset($_GET['id'])){
        $id=mysqli_real_escape_string($con,$_GET['id']);
        $res=mysqli_query($con,"SELECT * FROM department WHERE id='$id'");
        $row=mysqli_fetch_assoc($res);
        $department=$row['department_name'];
    }
    

    if(isset($_POST['department'])){
        $department=mysqli_real_escape_string($con,$_POST['department']);
        
        if($id>0){
            $sql="UPDATE department SET department_name='$department' WHERE id='$id'";
        }else{
            $sql="INSERT INTO department(department_name) VALUES('$department')";
        }
        
        mysqli_query($con,$sql);
        header('location:index.php');
        die();
    }

?>

             <div class="content pb-0">
                <div class="orders">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><strong>Department</strong><small> Form</small></div>
                                <div class="card-body card-block">
                                   <form method="post">
                                        <div class="form-group">
                                            <label for="department" class=" form-control-label">Department Name</label>
                                            <input type="text" name="department" placeholder="Enter your department name" value="<?php echo $department?>" class="form-control" required>
                                        </div>
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
<?php require('footer.inc.php');?>
