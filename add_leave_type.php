<?php

    require('top.inc.php');

    if($_SESSION['ROLE']!=1){
        header('location:index.php');
        die();
    }

    $type='';
    $id=0;

    if(isset($_GET['id'])){
        $id=mysqli_real_escape_string($con,$_GET['id']);
        $res=mysqli_query($con,"SELECT * FROM leave_type WHERE id='$id'");
        $row=mysqli_fetch_assoc($res);
        $type=$row['type'];
    }
    

    if(isset($_POST['leave_type'])){
        $type=mysqli_real_escape_string($con,$_POST['leave_type']);
        
        if($id>0){
            $sql="UPDATE leave_type SET type='$type' WHERE id='$id'";
        }else{
            $sql="INSERT INTO leave_type(type) VALUES('$type')";
        }
        
        mysqli_query($con,$sql);
        header('location:leave_type.php');
        die();
    }

?>

             <div class="content pb-0">
                <div class="orders">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header"><strong>Leave Type</strong><small> Form</small></div>
                                <div class="card-body card-block">
                                   <form method="post">
                                        <div class="form-group">
                                            <label for="leave_type" class=" form-control-label">Leave Type</label>
                                            <input type="text" name="leave_type" placeholder="Enter your leave type" value="<?php echo $type?>" class="form-control" required>
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
