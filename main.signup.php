<?php

?>

<div class="jumbotron">
    <h3 class="text-center">Users</h3>
    <div class="pull-right">
        <form class="form-inline" method="get" action="signup.php">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" name="search" value="<?php echo $_GET['search']; ?>">
            </div>
            <div class="form-group">
                <select name="statuscheck" id="statuscheck" class="form-control col-md-3 pull-right">
                    <option value=""></option>
                    <option value="active" <?php if($_GET['statuscheck']=="active"){echo "selected";}?>>Active</option>
                    <option value="inactive" <?php if($_GET['statuscheck']=="inactive"){echo "selected";}?>>In-Active</option>
                </select>
            </div>
            <button type="submit" class="form-control btn btn-default col-md-3 pull-right" name="searchbtn">
                <span class="glyphicon glyphicon-search"></span> Search
            </button>
            
        </form>
    </div>
    <div>
        <table class="table table-states table-bordered table-condensed table-hover">
            <thead>
            <tr class="text-center">
                <th>Name</th>
                <th>Short Name</th>
                <th>Username</th>
                <th>Role</th>
                <th>E-Mail</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                <?php
                include 'includes/dbh.inc.php';
                if ($_GET['statuscheck']=='inactive'){
                        $statuscheck = 0;
                    }elseif($_GET['statuscheck']=='active'){
                        $statuscheck = 1;    
                    }
                    
                    if (isset($_GET['searchbtn'])) {
                        $srchitem = trim(mysqli_real_escape_string($conn, $_GET['search']));
                       if (!empty($_GET['statuscheck'])) {
                           if (empty($_GET['search'])) {
                               $query = "SELECT * FROM users Where user_status=$statuscheck ORDER BY user_sec_profile ASC,user_status DESC ";
                           }elseif (!empty($_GET['search'])) {
                               $query = "SELECT * FROM users WHERE user_status=$statuscheck AND user_first LIKE '%$srchitem%' OR user_last LIKE '%$srchitem%' OR user_shortname  LIKE '%$srchitem%' OR user_email LIKE '%$srchitem%' OR user_uid LIKE '%$srchitem%' OR user_role LIKE '%$srchitem%' ORDER BY user_sec_profile ASC, user_status DESC";
                           }
                       }if (empty($_GET['statuscheck'])) {
                           if (!empty($_GET['search'])) {
                                $query = "SELECT * FROM users WHERE user_first LIKE '%$srchitem%' OR user_last LIKE '%$srchitem%' OR user_shortname  LIKE '%$srchitem%' OR user_email LIKE '%$srchitem%' OR user_uid LIKE '%$srchitem%' OR user_role LIKE '%$srchitem%' BY user_sec_profile ASC, user_status DESC";
                           }else {
                                $query = "SELECT * FROM users ORDER BY user_sec_profile ASC, user_status DESC";
                           }
                       }
                    }elseif(isset($_GET['statuscheck'])){
                        $query = "SELECT * FROM users Where user_status=$statuscheck ORDER BY user_sec_profile ASC, user_status DESC";
                    }else {
                        $query = "SELECT * FROM users ORDER BY user_sec_profile ASC, user_status DESC";
                    }
                    
                    $result = mysqli_query($conn, $query);
                    $numrows = mysqli_num_rows($result);
                    if($numrows >0){
                        while($row= mysqli_fetch_array($result)){
                            ?>
                            <tr class="clickable-row " data-href="./signup.php?c=1&id=<?php echo $row['user_id'];?>">
                                <td class="first-capital">
                                    <?php echo $row['user_first']." ".$row['user_last'];?>
                                </td>
                                <td class="first-capital">
                                    <?php echo $row['user_shortname'].".";?>
                                </td>
                                <td>
                                    <?php echo $row['user_uid']; ?>
                                </td>
                                <td class="first-capital">
                                    <?php echo $row['user_role']; 
									$qforrole="SELECT * FROM user_roles WHERE id=".$row['user_role'];
									$runquery = myspli_query($conn, $$qforrole);
									$numrowsrole=mysqli_num_rows($runquery);
									if($numrowsrole>0){
										$rowforrole = mysqli_fetch_array($runquery);
										echo ucfirst($rowforrole['role_name']);
									}
									?>
                                </td>
                                <td>
                                    <?php echo $row['user_email']; ?>
                                </td>
                                <td>
                                    <?php if($row['user_status']==1){echo "Active";}else{echo "In-Active";} ?>
                                </td>
                            </tr>    
                            <?php
                        }
                    }else{
                        ?>
                        <tr colspan="7">
                            <td class="text-center"><h3><b><?php echo $numrows;?> Records Found</b></h3></td>
                        </tr>
                        <?php
                    }
                $conn->close();
                ?>
            </tbody>
            <tfoot>
                <?php
                    echo "<p>".$numrows." items found</p>";
                ?> 
            </tfoot>
        </table>
    </div>
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
        var email = fName + "." +  lName.substring(0,1) + "@spotloan.com";
        
    
        var x = document.getElementById('user_shortname');
        var y = document.getElementById('user_email');
        var z = document.getElementById('user_uid');
        x.value = replace;
        y.value = email.toLowerCase();
        z.value = replaceuid.toLowerCase();
    }
    document.getElementById('statuscheck').onchange=function() {updatelist()};
    
    function updatelist(){
        var statuscheck = document.getElementById('statuscheck').value
    }
    
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    }); 
</script>


