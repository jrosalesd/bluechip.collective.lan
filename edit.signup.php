<?php

?>

<div class="jumbotron">
    <form action="includes/user.update.inc.php?id=<?php echo $_GET['id'];?>" method="post">
        <div class="row">
            <?php
            $id = $_GET['id'];
            include 'includes/dbh.inc.php';
            $q = "SELECT * FROM users WHERE user_id='$id'";
            $q_query = mysqli_query($conn, $q);
            $numrows = mysqli_num_rows($q_query);
            if ($numrows > 0) {
               $row =mysqli_fetch_array($q_query);
               ?>
                <div class="col-lg-6 border-right">
                    <p class="first-capital">
                       <strong>Name:</strong><br>
                       First Name: <input class="form-control" type="text" name="user_first" id="user_first" value="<?php echo $row['user_first']; ?>"/>
                       Last Name: <input class="form-control" type="text" name="user_last"  id="user_last" value="<?php echo $row['user_last']; ?>"/>
                   </p>
                   <p class="first-capital">
                       <strong>Admin Name:</strong><br>
                       <input class="form-control" type="text" name="user_shortname" id="user_shortname" value="<?php echo $row['user_shortname']; ?>"/>
                   </p>
                   <p>
                       <strong>Email Address:</strong><br>
                       <input class="form-control" type="text" name="user_email" value="<?php echo $row['user_email']; ?>"/>
                       
                   </p>
                   <p>
                       <strong>Role:</strong><br>
                       <select class="form-control" name="user_role" id="user_role" required>
                            <option value ="">Select One</option>
                            <?php
                            $roleq= "SELECT * FROM user_roles";
                            $roleq_run=mysqli_query($conn, $roleq);
                            $numrows_sec=mysqli_num_rows($roleq_run);
                            if($numrows_sec > 0){
                                while($row_role=mysqli_fetch_array($roleq_run)){
                                    ?>
                                    <option value ="<?php echo $row_role['role_name']?>" <?php if($row['user_role'] == $row_role['role_name']){ echo 'selected="selected"';} ?> ><?php echo $row_role['role_name']?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                   </p>
                   <p>
                       <strong>Username:</strong><br>
                       <?php echo $row['user_uid']; ?>
                   </p>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                       <div class="col-md-6">
                           <p class="text-center">
                               <strong>User Status</strong><br>
                               <input type="hidden" name="user_status" value="<?php echo $row['user_status'];?>"/>
                               <?php
                               if($row['user_status'] == 1){
                                   echo "Active";
                               }else {
                                   echo "Inactive";
                               }
                               ?>
                               <br>
                               <button type="submit" class="btn btn-<?php if($row['user_status'] == 0){echo "success";}else {echo "danger";} ?>" name="statuschange">
                                   <?php
                                   if($row['user_status'] == 1){
                                       echo "De-Activate";
                                   }else {
                                       echo "Activate";
                                   }
                               ?>
                               </button>
                           </p>
                           
                       </div>
                       <div class="col-md-6">
                           <p class="text-center">
                               <strong>Profile Type</strong><br>
                               <?php
                               $level= $row['user_sec_profile'];
                               
                                if($seclevel > $level  ){
                                   
                                   $q_sec="SELECT * FROM sec_profile WHERE id='$level'";
                                   $q_sec_query=mysqli_query($conn, $q_sec);
                                   $numrows_sec=mysqli_num_rows($q_sec_query);
                                   if($numrows_sec > 0){
                                       $row_sec=mysqli_fetch_array($q_sec_query);
                                       echo $row_sec['sec_desc'];
                                   } else{
                                       echo "No Security Assign";
                                   }
                               }else {
                                   if ($seclevel>1) {
                                       $q_sec="SELECT * FROM sec_profile Where id > 1 ";
                                   }else {
                                       $q_sec="SELECT * FROM sec_profile";
                                   }
                                   
                                   $q_sec_query=mysqli_query($conn, $q_sec);
                                   $numrows_sec=mysqli_num_rows($q_sec_query);
                                   if($numrows_sec > 0){
                                       ?>
                                       <select class="form-control" name="user_sec_profile"> 
                                           <option value="">Choose One</option>
                                            <?php
                                            while($row_sec=mysqli_fetch_array($q_sec_query)){
                                                ?>
                                                <option value="<?php echo $row_sec['id']?>" <?php if($level==$row_sec['id']){ echo 'selected="selected"';} ?>><?php echo $row_sec['sec_desc']?></option>
                                                <?php
                                            }
                                   }
                               }
                               ?>
                                   </select>
                            </p>
                            <p class="text-center">
                                <label><b>User Timezone</b></label>
                                <?php
                                $tz = $row['user_timezone'];
                                $q_time_zones="SELECT * FROM time_zones";
                                $q_time_zones_query=mysqli_query($conn, $q_time_zones);
                                $numrows_time_zones=mysqli_num_rows($q_time_zones_query);
                                if($numrows_time_zones > 0){
                                    ?>
                                    <select class="form-control" name="user_timezone" id="user_timezone"> 
                                        <option value="">Choose One</option>
                                        <?php
                                        while($row_time_zones=mysqli_fetch_array($q_time_zones_query)){
                                            ?>
                                            <option value="<?php echo $row_time_zones['id']?>" <?php if($tz==$row_time_zones['id']){ echo 'selected="selected"';} ?>><?php echo $row_time_zones['timezone_name']." - ".$row_time_zones['timezone'];?></option>
                                            <?php
                                        }
                               }   
                               ?>
                            </select>
                            </p>
                       </div>
                   </div>
                   <br><br><br>
                   <div class="text-center">
                       <button type="submit" class="btn btn-success" name="btnupdate">
                           <span class="glyphicon glyphicon-save"></span>
                           Save Changes
                       </button>
                       <a href="./signup.php?c=1&id=<?php echo $id;?>">
                           <button type="button" class="btn btn-primary">
                               Cancel Edit
                           </button>
                       </a>
                       <a href="./signup.php?statuscheck=active">
                           <button type="button" class="btn btn-danger">
                               <span class="glyphicon glyphicon-remove"></span>
                               Close
                           </button>
                       </a>
                       <br><br>
                       <p class="error">
                           <?php echo $_GET['error']; ?>
                       </p>
                   </div>
               </div>
               <?php
            }
            ?>
        </div>
    </form>
</div>
<script>
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    document.getElementById('user_last').onchange=function() {shortName()};

    function shortName() {
        var fName = document.getElementById('user_first').value;
        var lName = document.getElementById('user_last').value;
        var replace = fName + " " + lName.substring(0,1);
        var replaceuid = fName + lName.substring(0,1);
    
        var x = document.getElementById('user_shortname');
        var z = document.getElementById('user_uid');
        x.value = replace;
        z.value = replaceuid.toLowerCase();
    }
</script>