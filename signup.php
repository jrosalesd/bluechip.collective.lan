<?php
$page_name = "Users";
include 'header.php';

//if ($seclevel>2) {
//    header("Location: home.php");
//}
$msg = $_GET['msg'];

?>
<div class="jumbotron">

<div class="row">
    <div class="col-lg-6">
        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;"> <span class="fa fa-user-plus"></span> New User</button>
        
        <div class="error0">
            <p>
                <?php echo $_GET['message'];?>
            </p>
        </div>
        <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
            <form class="modal-content animate" action="includes/signup.inc.php" method="post">
                <div class="container">
                    <div class="error">
                        <p>
                            <?php echo $_GET['message'];?>
                        </p>
                    </div>
                    <label><b>First Name</b></label>
                    <input type="text" placeholder="First Name" name="user_first" id="user_first" value="<?php echo $_GET['user_first']; ?>" required>

                    <label><b>Last Name</b></label>
                    <input type="text" placeholder="Last Name" name="user_last" id="user_last" value="<?php echo $_GET['user_last']; ?>" required>
    
                    <label><b>Short Name</b></label>
                    <input type="text" placeholder="Short Name" name="user_shortname" id="user_shortname" value="<?php echo $_GET['user_shortname']; ?>" required>
    
                    <label><b>Username</b></label>
                    <input  type="text" placeholder="Username" name="user_uid" id="user_uid" value="<?php echo $_GET['user_uid']; ?>" required>
      
                    <label><b>E-mail</b></label>
                    <input  type="email" placeholder="E-mail" name="user_email" id="user_email" value="<?php echo $_GET['user_email']; ?>" required>
      
                    <label><b>Role</b></label>
                    <select name="user_role" id="user_role" required>
                        <option value ="">Select One</option>
                        <?php
                        include 'includes/dbh.inc.php';
                        $roleq= "SELECT * FROM user_roles";
                        $roleq_run=mysqli_query($conn, $roleq);
                        $numrows_sec=mysqli_num_rows($roleq_run);
                        if($numrows_sec > 0){
                            while($row_role=mysqli_fetch_array($roleq_run)){
                                ?>
                                <option value ="<?php echo $row_role['id']?>" <?php if($_GET['user_role']==$row_role['id']){ echo 'selected="selected"';} ?> ><?php echo $row_role['role_name']?></option>
                                <?php
                            }
                        }
                        $conn->close();
                        ?>
                    </select>
            
                    <label><b>Security Level</b></label>
                        <?php
                        include 'includes/dbh.inc.php';
                        if ($seclevel==1) {
                            $q_sec="SELECT * FROM sec_profile";
                        }else {
                           $q_sec="SELECT * FROM sec_profile WHERE id>1";
                        }
                        
                        $q_sec_query=mysqli_query($conn, $q_sec);
                        $numrows_sec=mysqli_num_rows($q_sec_query);
                        if($numrows_sec > 0){
                            ?>
                            <select name="user_sec_profile" id="user_sec_profile" required>
                                <option value="">Choose One</option>
                                <?php
                                while($row_sec=mysqli_fetch_array($q_sec_query)){
                                    ?>
                                    <option value="<?php echo $row_sec[0]?>" <?php if($_GET['user_sec_profile']==$row_sec[0]){ echo 'selected="selected"';} ?>><?php echo $row_sec[1]?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php
                       } 
                       $conn->close();
                       ?>
                    <label><b>User Timezone</b></label>
                    <?php
                    include 'includes/dbh.inc.php';
                        $q_time_zones="SELECT * FROM time_zones";
                        $q_time_zones_query=mysqli_query($conn, $q_time_zones);
                        $numrows_time_zones=mysqli_num_rows($q_time_zones_query);
                        if($numrows_time_zones > 0){
                            ?>
                            <select name="user_timezone" id="user_timezone" required> 
                                <option value="">Choose One</option>
                                <?php
                                while($row_time_zones=mysqli_fetch_array($q_time_zones_query)){
                                    ?>
                                    <option value="<?php echo $row_time_zones[0]?>" <?php if($_GET['user_sec_profile']==$row_time_zones[0]){ echo 'selected="selected"';} ?>><?php echo $row_time_zones[1]." - ".$row_time_zones[2];?></option>
                                    <?php
                                }
                       }   
                       ?>
                    </select>
                    <input type="hidden" name="user_status" value="1"/>
                    <input type="hidden" name="pass_status" value="0"/>

                    <div class="clearfix">
                        <button type="submit" name="usercreate" class="signupbtn">Sign Up</button>
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <?php
        include 'includes/dbh.inc.php';
        $q="SELECT * FROM users WHERE user_id='$userid'";
        $result=mysqli_query($conn, $q);
        $row=mysqli_fetch_array($result);
        if($row[9] == 1){
            ?>
            <div class="form">
                <div><h4>Uploan users in bulk</h4></div>
                <div>
                    <form action="includes/newbulkuser.inc.php" method="post" enctype="multipart/form-data">
                        <div>
                            <input class="form-control" type="file" name="file"/>
                            <input class="btn btn-success" type="submit" name="import" value="Upload"/>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
        $conn->close();
        ?>
    </div>
    <?php echo $msg;?>
</div>    
</div>
<?php
if (isset($_GET['c'])) {
    if($_GET['c']==1){
        include 'profile.signup.php';
    }else{
        if ($_GET['c']==2) {
            include 'edit.signup.php';
        }else{
            
        }
    }
}else {
    include 'main.signup.php';
}
?>
<?php
include 'footer.php';
?>
