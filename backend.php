<?php
$page_name = "Site Editor";
include 'header.php';
include 'includes/dbh.inc.php';

/* Processing */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updaterole'])) {
        $id = $_POST['hidden_id'];
        $previous_name = $_POST['previous_role_name'];
        $updated_name = $_POST['new_role_name'];

        $q_update="UPDATE user_roles SET role_name='$updated_name' WHERE id='$id'";
        $update = mysqli_query($conn, $q_update);
        if ($update) {
            header("Refresh:0; url=backend.php?edit&id=$id&notification=This Role has been updated from <b>$previous_name </b> to <b>$updated_name</b>&class=success");
            exit();
        }else {
            header("Refresh:0; url=backend.php?edit&id=$id&notification=We are sorry but we were not able to update this role from <b>$previous_name </b> to <b>$updated_name</b>&class=danger");
            exit();
        }
    }
    if (isset($_POST['newrole'])) {
        $newrole = $_POST['new_role_name'];
        $q = "INSERT INTO user_roles VALUES('','$newrole')";
        $insert = mysqli_query($conn, $q);
        if ($insert) {
            header("Refresh:0; url=backend.php?notification=The new Role <b>$newrole </b> has been successfully saved.&class=success");
            exit();
        }else {
            header("Refresh:0; url=backend.php?notification=The new Role <b>$newrole </b> could not be saved.&class=danger");
            exit();
        }

    }
    

}

?>
<div class="jumbotron">
<?php
if ($seclevel>1) {
    echo "You are not authorized to be on this page. This page will redirect in 5 second";
    header("Refresh: 5; url=home.php");
}else {
   ?>
   <div class="alert alert-<?php echo htmlspecialchars($_GET['class']);?>">
        <?php
            $notification = $_GET['notification'];
            echo $notification;
        ?>
   </div>
   <div class="role_creation">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="new_role_name">New Role Name:</label>
                        <input class="form-control" name="new_role_name" id="new_role_name" type="text" placeholder="Enter the new loan role name" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <br>
                        <button name="newrole" class="btn btn-success col-md-3" type="submit"><span class="glyphicon glyphicon-floppy-saved"></span> Save</button>
                    </div>                    
                </div>
            </div>
            
        </form>
   </div>
    
   <table class="table table-states table-hover">
        <thead>
            <tr>
                <td>role</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $q = "SELECT * FROM user_roles";
            $stmt = mysqli_query($conn, $q);
            $numrows = mysqli_num_rows($stmt);
            if ($numrows>0) {
                if (isset($_GET['edit'])) {
                    $id = htmlspecialchars($_GET['id']);
                    $q = "SELECT * FROM user_roles WHERE id=$id";
                    $stmt = mysqli_query($conn, $q);
                    $numrows = mysqli_num_rows($stmt);
                    if ($numrows>0) {
                        $row=mysqli_fetch_array($stmt)
                        ?> 
                        <form action="" method="post">
                            <input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $id;?>">
                            <input type="hidden" name="previous_role_name" id="previous_role_name" value="<?php echo $row['role_name'];?>">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="new_role_name">Role Name:</label>
                                        <input class="form-control" name="new_role_name" id="new_role_name" type="text" value="<?php echo $row['role_name']?>">
                                    </div>
                                </td>
                                <td>
                                <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button name="updaterole" type="submit" class="btn btn-success">Update Record</button>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="backend.php"><button type="button" class="btn btn-warning">Cancel/Return</button></a>
                                        </div>
                                    </div>                                    
                                </td>
                            </tr>
                        </form>
                    <?php
                    }                    
                } else {
                    while ($row=mysqli_fetch_array($stmt)) {
                        ?>
                        <tr>
                            <td><?php echo $row['role_name']?></td>
                            <td><a class="text-right" href="?edit&id=<?php echo $row['id']?>"><span class="glyphicon glyphicon-edit"></span>Edit</a></td>
                        </tr>
                        <?php
                    }
                }                     
            } else {
                ?>
                    <div class="msg">No Records Found</div>
                <?php  
            }                               
            ?>           
        </tbody>
   </table>
   <?php
}
?>
</div>


<?php
include 'footer.php';

