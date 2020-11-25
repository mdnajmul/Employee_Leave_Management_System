<?php

    require('top.inc.php');

    $name='';
    $email='';
    $mobile='';
    $password='';
    $department_id='';
    $address='';
    $birthday='';
    $id=0;

    if(isset($_GET['id'])){
        $id=mysqli_real_escape_string($con,$_GET['id']);
        if($_SESSION['ROLE']==2 && $_SESSION['USER_ID']!=$id){
            die('Access Denied');
        }
        $res=mysqli_query($con,"SELECT * FROM employee WHERE id='$id'");
        $row=mysqli_fetch_assoc($res);
        $name=$row['name'];
        $email=$row['email'];
        $mobile=$row['mobile'];
        $department_id=$row['department_id'];
        $address=$row['address'];
        $birthday=$row['birthday'];
    }
    

    if(isset($_POST['submit'])){
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $mobile=mysqli_real_escape_string($con,$_POST['mobile']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        $department_id=mysqli_real_escape_string($con,$_POST['department_id']);
        $address=mysqli_real_escape_string($con,$_POST['address']);
        $birthday=mysqli_real_escape_string($con,$_POST['birthday']);
        
        if($id>0){
            $sql="UPDATE employee SET name='$name',email='$email',mobile='$mobile',address='$address',birthday='$birthday' WHERE id='$id'";
        }else{
            $sql="INSERT INTO employee(name,email,mobile,password,department_id,address,birthday,role) VALUES('$name','$email','$mobile','$password','$department_id','$address','$birthday','2')";
        }
        
        mysqli_query($con,$sql);
        header('location:employee.php');
        die();
    }

?>

             <div class="content pb-0">
                <div class="orders">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><strong>Employee</strong><small> Form</small></div>
                                <div class="card-body card-block">
                                   <form method="post">
                                        <div class="form-group">
                                            <label for="name" class=" form-control-label">Name</label>
                                            <input type="text" name="name" placeholder="Enter name" value="<?php echo $name?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class=" form-control-label">Email</label>
                                            <input type="email" name="email" placeholder="Enter email" value="<?php echo $email?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile" class=" form-control-label">Mobile</label>
                                            <input type="mobile" name="mobile" placeholder="Enter mobile" value="<?php echo $mobile?>" class="form-control" required>
                                        </div>
                                        <?php if($id<=0){?>
                                            <div class="form-group">
                                                <label for="password" class=" form-control-label">Password</label>
                                                <input type="password" name="password" placeholder="Enter password" class="form-control" required>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label for="department" class=" form-control-label">Department</label>
                                            <select name="department_id" class="form-control" required>
                                                <option value="">Select Department</option>
                                                <?php
                                                    $res=mysqli_query($con,"SELECT * FROM department ORDER BY department_name ASC");
                                                    while($row=mysqli_fetch_assoc($res)){
                                                        if($department_id==$row['id']){
                                                            echo '<option selected="selected" value="'.$row['id'].'">'.$row['department_name'].'</option>';
                                                        }else{
                                                            echo '<option value="'.$row['id'].'">'.$row['department_name'].'</option>';
                                                        }
                                                        
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address" class=" form-control-label">Address</label>
                                            <input type="text" name="address" placeholder="Enter address" value="<?php echo $address?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="birthday" class=" form-control-label">Birthday</label>
                                            <input type="date" name="birthday" value="<?php echo $birthday?>" class="form-control" required>
                                        </div>
                                        <?php if($_SESSION['ROLE']=='1'){?>
                                                    <div>
                                                        <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">Submit</button>
                                                    </div>
                                        <?php } ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
<?php require('footer.inc.php');?>
