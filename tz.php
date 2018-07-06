<?php
$page_name = "TimeZone";
include 'header.php';
?>

<div class="jumbotron">
    <?php
    if ($_GET['edit']==on) {
        // code...
        if ($seclevel<3) {
            if (!empty($_GET['id'])) {
               $state_id = $_GET['id'];
               include 'includes/dbh.inc.php';
               $q = "SELECT * FROM servicing_states WHERE id=$state_id";
               $query = mysqli_query($conn, $q);
               $numrow = mysqli_num_rows($query);
               if ($numrow > 0) {
                   $row = mysqli_fetch_array($query);
               }
               $conn->close();
               ?>
               <p class="msg"><?php echo $_GET['msg'];?></p>
               <form class="form" method="post">
                   <table class="table table-states-edit">
                       <thead>
                            <tr>
                                <th>State Name</th>
                                <th>Do we Lend?</th>
                                <th>Do we Process DC?</th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input class="col-md-1 form-control" name="state" value="<?php echo $row['state_name'];?>">
                                </td>
                                <td>
                                    <select class="col-md-1 form-control" name="state_status">
                                        <option value=""></option>
                                        <option value="Yes" <?php if($row['state_status'] == "Yes"){echo "selected";}?>>Yes</option>
                                        <option value="No" <?php if($row['state_status'] == "No"){echo "selected";}?>>No</option>
                                    </select>
                                </td>
                                <td> 
                                    <select class="col-md-3 form-control" name="state_dc_status">
                                        <option value=""></option>
                                        <option value="Yes" <?php if($row['state_dc_status'] == "Yes"){ echo "selected";}?>>Yes</option>
                                        <option value="No" <?php if($row['state_dc_status'] == "No"){ echo "selected";}?>>No</option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="form-control btn btn-success col-sm-3" name="state_update">Update</button>
                                    <br>
                                    <a href="tz.php?edit=on">
                                        <button type="button" class="form-control btn btn-danger col-sm-3" name="update_cancel">
                                            Cancel/Return
                                        </button>
                                    </a>
                                    <br>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot></tfoot>
                   </table>
               </form>
               <?php
               if (isset($_POST['state_update'])) {
                   //update state
                   include 'includes/dbh.inc.php';
                   $state = mysqli_real_escape_string($conn, $_POST['state']);
                   $state_status = mysqli_real_escape_string($conn, $_POST['state_status']);
                   $state_dc_status = mysqli_real_escape_string($conn, $_POST['state_dc_status']);
                   
                   $q = "UPDATE servicing_states SET state_name='$state', state_status='$state_status', state_dc_status='$state_dc_status' WHERE id='$state_id'";
                   $update = mysqli_query($conn, $q);
                   if ($update) {
                        header("Location: tz.php?edit=on&msg=".$row['state_name']." state has bee succesfully updated");
                        exit();
                   }else{
                       header("Location: tz.php?edit=on&id=".$_GET['id']."&msg=".$row['state_name']." state could not be updated, an error has occurred");
                   }
                   $conn-> close();
               }
               
            }else{
            ?>
            <div>
                <h3 class="text-center">Edit States</h3>
                <p class="error"><?php echo $_GET['msg'];?></p>
            </div>
            <div class="btn-close">
                <a href="tz.php" class="btn btn-warning col-md-3 text-right">Close</a>
            </div>
            <table class="table table-states table-hover">
                <thead>
                    <tr>
                        <th>State</th>
                        <th>Do we Lend?</th>
                        <th>Do we Process DC?</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include 'includes/dbh.inc.php';
                $q = "SELECT * FROM servicing_states ORDER BY state_status DESC, state_name ASC, state_dc_status ASC";
                $query = mysqli_query($conn, $q);
                $numrow = mysqli_num_rows($query);
                if ($numrow > 0) {
                    $row = mysqli_fetch_array($query);
                    while($row = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $row['state_abr']." - ".$row['state_name'];?></td>
                            <td><?php echo $row['state_status'];?></td>
                            <td><?php echo $row['state_dc_status'];?></td>
                            <td><a class="text-right" href="tz.php?edit=on&id=<?php echo $row['id']?>"><span class="glyphicon glyphicon-edit"></span>Edit</a></td>
                        </tr>
                        <?php
                    }
                }
                $conn->close();
                ?>
                </tbody>
                <tfoot></tfoot>
            </table>
            <?php
            }
        }else{
            header("Location: tz.php");
            exit();
        }
        
    }else{
    ?>
    <h2 Class="text-center"><font color="purple">Time Zone Map and Servicing States</font></h2>
    <hr>
    <div class="centered" >
        <table class="timezone_table" onload="startTime()">
            <tr>
                <th class="text-center " id="hawai"> Hawaii Time </th>
                <th class="text-center" id="alaska"> Alaska Time </th>
                <th class="text-center" id="pacific"> Pacific Time </th>
            </tr>
            <tr>
                <td class="bd text-center centered">
                    <iframe src="https://freesecure.timeanddate.com/clock/i69q96z0/n103/tt0/tw0/tm1/td1/ts1/tb2" frameborder="0" width="183" height="18"></iframe>
                </td>
                <td class="bd text-center centered">
                    <iframe src="https://freesecure.timeanddate.com/clock/i69q96z0/n18/tt0/tw0/tm1/td1/ts1/tb2" frameborder="0" width="183" height="18"></iframe>
                </td>
                <td class="bd text-center centered">
                    <iframe src="https://freesecure.timeanddate.com/clock/i69q96z0/n137/tt0/tw0/tm1/td1/ts1/tb2" frameborder="0" width="183" height="18"></iframe>
                </td>
            </tr>
            <tr>
                <th class="text-center" id="mountain"> Mountain Time </th>
                <th class="text-center" id="central"> Central Time </th>
                <th class="text-center" id="eastern"> Eastern Time </th>
            </tr>
            <tr>
                <td class="bd text-center centered">
                	<iframe src="https://freesecure.timeanddate.com/clock/i69q96z0/n80/tt0/tw0/tm1/td1/ts1/tb2" frameborder="0" width="183" height="18"></iframe>
                </td>  
                <td class="bd text-center centered">
                	<iframe src="https://freesecure.timeanddate.com/clock/i69q96z0/n155/tt0/tw0/tm1/td1/ts1/tb2" frameborder="0" width="183" height="18"></iframe>
                </td>
                <td class="bd text-center centered">
                	<iframe src="https://freesecure.timeanddate.com/clock/i69q96z0/n179/tt0/tw0/tm1/td1/ts1/tb2" frameborder="0" width="183" height="18"></iframe>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <img class="map-image" src="format/img/timezone.png" alt="USA Map" style="max-width: 100%;  height: auto; padding-left: 10%; padding-right: 10%; align-self: center middle;" />
    </div>
    <br/>
    <hr>
    <div>
        <h3 Class="text-center"><font color="purple">States Where We Lend</font></h3>
        <?php
        if($seclevel<3){
            ?>
            <div class="text-left">
                <a class="col-md-3 btn btn-warning active" href="tz.php?edit=on">
                    <span class="glyphicon glyphicon-edit"></span>
                    Edit States
                </a>
            </div>
            <?php
        }
        ?>
        
        <div id="allowed">
        <table class="table table-bordered">
            <tr id="header-table">
                <th  class="text-center">State Name</th>
                <th class="text-center">Abreviation</th>
                <th class="text-center">Debit Card</th>
                <th class="text-center">TimeZone</th>
            </tr>
            <?php
            include 'includes/dbh.inc.php';
            $q = 
                "SELECT st.state_name, st.state_abr, st.state_dc_status, tzn.zone_name, tzn.time_zone_id, st.id
                FROM servicing_states AS st, state_time_zone AS stz, time_zone_name AS tzn
                WHERE st.state_abr = stz.state_abr
                AND stz.zone_code = tzn.zone_code
                AND st.state_status =  'yes'
                ORDER BY tzn.zone_name ASC";
            $result = mysqli_query($conn, $q);
            $numrow = mysqli_num_rows($result);
            if ($numrow > 0) {
                while($row = mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td id="<?php echo $row[4]; ?>"><b><?php echo $row[0]; ?></b></td>
                        <td id="<?php echo $row[4]; ?>"><?php echo $row[1]; ?></td>
                        <td id="<?php echo $row[4]; ?>"><?php echo $row[2]; ?></td>
                        <td id="<?php echo $row[4]; ?>"><?php echo $row[3]; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        </div>
    </div>
    <?php
    }
    ?>
</div>

<?php
include 'footer.php';
?>