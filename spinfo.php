<?php
$page_name = "Spotloan Information";
include 'header.php';

if ($_GET['edit']==on){
    if($_GET['change']==on) {
        $agencyId = $_GET['id'];
        ?>
        <div class="jumbotron">
            <p class="msg"><?php echo $_GET['msg'];?></p>
            <?php
            include 'includes/dbh.inc.php';
            $q="SELECT * FROM debtsalebuyers where id=$agencyId";
            $result= mysqli_query($conn, $q);
            $numrows= mysqli_num_rows($result);
            if ($numrows>0) {
                $row=mysqli_fetch_array($result);
            }
            ?>
            <form  class="form" method="post">
               <table class="table table-states table-hover">
                   <thead>
                        <tr>
                            <th>Agency Name</th>
                            <th>Code</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>
                            <?php echo $row['Name'];?>
                        </td>
                        <td>
                            <?php echo $row['Code'];?>
                        </td>
                        <td>
                            <input class="col-md-3 form-control" name="dc_num" value="<?php echo $row['PhoneNumber'];?>"/>
                        </td>
                        
                        <td>
                            <button type="submit" class="form-control btn btn-success col-sm-3" name="agency_update">Update</button>
                            <br>
                            <?php
                            if($seclevel==1){
                                ?>
                                <button type="submit" class="form-control btn btn-danger col-sm-3" name="agency_delete">Delete</button>
                                <?php
                            }
                            ?>
                            <a href="spinfo.php?edit=on">
                                <button type="button" class="form-control btn btn-info col-sm-3" name="update_cancel">
                                    Cancel/Return
                                </button>
                            </a>
                            <br>
                        </td>
                    </tbody>
                </table>
            </form>
            <?php
            if (isset($_POST['agency_update'])){
                include 'includes/dbh.inc.php';
                $phone = mysqli_real_escape_string($conn, $_POST['dc_num']);
                $q = "UPDATE debtsalebuyers SET PhoneNumber='$phone' WHERE id='$agencyId'";
                $update = mysqli_query($conn, $q);
                if ($update) {
                    header("Location: spinfo.php?edit=on&msg=".$row['Name']."  has bee succesfully updated");
                    exit();
                }else{
                   header("Location: spinfo.php?edit=on&id=".$_GET['id']."&msg=".$row['Name']." could not be updated, an error has occurred");
                }
                $conn->close();
            }
            if (isset($_POST['agency_delete'])){
                //ask for confirmation
                ?>
                <div class="text-center">
                    <form class="form" method="post">
                        <p>Do you really want delete <?php echo $row['Name'];?></p>
                        <div class="col-md-6">
                            <button type="submit" class="form-control btn btn-danger col-sm-3" name="delete_confirm">Delete</button>
                            <br>
                        </div>
                        <div class="col-md-6">
                            <a href="spinfo.php?edit=on&change=on&id=<?php echo $_GET['id'];?>">
                                <button type="button" class="form-control btn btn-info col-sm-3" name="delete_cancel">
                                    Cancel/Return
                                </button>
                            </a>
                        </div>
                    </form>
                </div>
                <?php
            } 
            if (isset($_POST['delete_confirm'])){
                include 'includes/dbh.inc.php';
                $q = "DELETE FROM debtsalebuyers WHERE ID='$agencyId'";
                $update = mysqli_query($conn, $q);
                if ($update) {
                    header("Location: spinfo.php?edit=on&msg=Agency successfully deleted.");
                    exit();
                }else{
                   header("Location: spinfo.php?edit=on&id=$agencyId&change=on&msg=Something went wrong, please try again.");
                }
                $conn->close();
            }
            ?>
        </div>    
        <?php
    }
    elseif(isset($_GET['upd'])) {
        $addid = $_GET['id'];
        //Open DB connection
        include 'includes/dbh.inc.php';
        $dbquery = "SELECT * FROM `sp_contact` WHERE id='$addid'";
        $queryinit = mysqli_query($conn, $dbquery);
        $ctdbrows = mysqli_num_rows($queryinit);
        if($ctdbrows >0)
        {
            $row=mysqli_fetch_array($queryinit);
            
        }
        //Close Db Connection
        $conn->close();
        ?>
        <div class="jumbotron">
            <?php
            if(isset($_GET['msg']))
            {
                ?>
                <div>
                    <div class="text-center alert alert-danger alert-dismissible msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_GET['msg'];?>
                    </div>
                </div>
                <?php
            }
            ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $addid;?>"/>
                <table class="table table-states">
                    <thead>
                        <tr>
                            <th>Adress Type</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'includes/dbh.inc.php';
                        $dbquery = "SELECT * FROM `sp_contact` WHERE id='$addid'";
                        $dbinit = mysqli_query($conn, $dbquery);
                        $dbrow = mysqli_num_rows($dbinit);
                        if($dbrow > 0)
                        {
                            while ($dbrow=mysqli_fetch_array($dbinit))
                            {
                                ?>
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" name="addessname" value="<?php echo $dbrow['address_type'];?>"/>
                                    </td>
                                    <td>
                                       <div class="form-group">
                                           <label for="address1">Address:</label>
                                           <input class="form-control input-sm col-sm-3" type="text" name="address1" id="address1" value="<?php echo $dbrow['address1'];?>"/>
                                       </div>
                                       <div class="form-group">
                                           <label for="address1">City:</label>
                                           <input class="form-control input-sm col-sm-3" type="text" name="city" id="city" value="<?php echo $dbrow['city'];?>"/>
                                       </div>
                                       <div class="form-group">
                                           <label for="state">City:</label>
                                           <select class="form-control input-sm col-sm-3" id="state" name="state">
                                                <option value="">Select State</option>
                                                <?php
                                                $dbquery = "SELECT * FROM servicing_states";
                                                $dbinit = mysqli_query($conn,$dbquery);
                                                $dbrows = mysqli_num_rows($dbinit);
                                                if ($dbrows > 0) 
                                                {
                                                    while($dbrower = mysqli_fetch_array($dbinit))
                                                    {
                                                        ?>
                                                        <option value="<?php echo $dbrower['state_abr'];?>" <?php if($dbrower['state_abr'] == $dbrow['state']){echo "selected";}?>>
                                                            <?php echo $dbrower['state_abr']." - ".$dbrower['state_name'];?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                       </div>
                                       <div class="form-group">
                                           <label for="zipcode">Zip Code:</label>
                                           <input class="form-control input-sm col-sm-3" type="text" name="zipcode" id="zipcode" value="<?php echo $dbrow['zipcode'];?>"/>
                                       </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning" type="submit" name="update">Update</button>
                                            <button class="btn btn-info" type="submit" name="cancel">Cancel</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        $conn->close();
                        ?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </form>
        </div>
        <?php
        if(isset($_POST['update']))       
        {
            include 'includes/dbh.inc.php';
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $addtittle = mysqli_real_escape_string($conn, $_POST['addessname']);
            $add1 = mysqli_real_escape_string($conn, $_POST['address1']);
            $city = mysqli_real_escape_string($conn, $_POST['city']);
            $state = mysqli_real_escape_string($conn, $_POST['state']);
            $zip = mysqli_real_escape_string($conn, $_POST['zipcode']);
            
            $sql = "UPDATE sp_contact SET address_type='$addtittle', address1='$add1', city='$city', state='$state', zipcode='$zip' WHERE id='$id'";
            $dbrun = mysqli_query($conn, $sql);
            if ($dbrun) {
                header("Refresh:0; url=?edit=on&msg=$addtittle has been updated successfully");
                exit();
            } else {
                $error = mysqli_error($conn);
                header("Refresh:0; url=?edit=on&upd&id=$id&msg=Error updating record: $error");
                exit();
            }
            $conn->close();

        }
        elseif(isset($_POST['cancel']))
        {
            header("Location: ?edit=on");
            exit();
        }
    }
    elseif(isset($_GET['del'])){
        //Delete
        ?>
        <div class="jumbotron">
            <div class="text-center header">
                <h2>Are you sure you want to delete this address</h2>
            </div>
            <div class="text-center body">
                <div>
                    <?php
                    include 'includes/dbh.inc.php';
                    $id=$_GET['id'];
                    $sql = "SELECT * FROM sp_contact WHERE id=$id";
                    $sqlnit = mysqli_query($conn, $sql);
                    $dbrow = mysqli_num_rows($sqlnit);
                    if($dbrow > 0){
                        $dbrow=mysqli_fetch_array($sqlnit);
                        ?>
                           <div>
                               <b><?php echo $dbrow['address_type'].":";?></b>
                               <br><?php echo $dbrow['address1'];
                               if(!empty($dbrow['address2']))
                               {
                                   ?><br><?php echo $dbrow['address2'];
                               }
                               ?>
                               <br><?php echo $dbrow['city'].", ".$dbrow['state']." ".$dbrow['zipcode'];?>
                           </div>
                           <br />
                           <?php
                        
                    }
                    $conn->close();
                    
                    if (isset($_POST['delete'])) {
                        include 'includes/dbh.inc.php';
                        $id = mysqli_real_escape_string($conn, $_POST['id']);
                        $del = "DELETE FROM sp_contact WHERE id=$id";
                        $de_init = mysqli_query($conn, $del);
                        if ($de_init) {
                            header("Location: ?edit=on&msg=This address has been deleted.");
                            exit();
                        }else {
                            $error = mysqli_error($conn);
                            header("Refresh:0; url=?edit=on&msg=Unalble to delete Address. Error: $error.");
                            exit();
                        }
                        $conn->close();
                    }
                    ?>
                </div>
                <p> If you Delete this address, you will not be able to retrieve it.</p>
            </div>
            <div class="footer">
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $id;?>"/>
                            <button class="btn btn-success" name="delete">Yes - Delete</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <a href="?edit=on#address"><button class="btn btn-default">Close</button></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    elseif(isset($_GET['act'])){
        include 'includes/dbh.inc.php';
        $id= $_GET['id'];
        $act= $_GET['act'];
        if($act==1){
             $act=0;    
        }elseif ($act==0) {
            $act=1;
        }
        $sql_act = "UPDATE sp_contact SET status='$act' WHERE id='$id'";
        $ypdate = mysqli_query($conn, $sql_act);
        if ($ypdate) {
            header("Location: ?edit=on&msg=Address status has been updated.");
            exit();
        }else {
            $error = mysqli_error($conn);
            header("Location: ?edit=on&msg=Address could not be updated. Error: $error.");
            exit();
        }
        $conn->close();
    }
    else {
        ?>
        <div class="jumbotron">
            <?php
            if(isset($_GET['msg']))
            {
                ?>
                <div>
                    <div class="text-center alert alert-danger alert-dismissible msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_GET['msg'];?>
                    </div>
                </div>
                <?php
            }
            ?>
            <table class="table table-states table-hover">
                <thead>
                    <tr>
                        <th>Agency Name</th>
                        <th>Code</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'includes/dbh.inc.php';
                    $q="SELECT * FROM debtsalebuyers";
                    $result= mysqli_query($conn, $q);
                    $numrows= mysqli_num_rows($result);
                    if ($numrows>0){
                        while($row=mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td><?php echo $row['Name'];?></td>
                                <td><?php echo $row['Code'];?></td>
                                <td><?php echo $row['PhoneNumber'];?></td>
                                <td><a class="text-right" href="spinfo.php?edit=on&change=on&id=<?php echo $row['ID']?>"><span class="glyphicon glyphicon-edit"></span>Edit</a></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <div class="text-left">
                    <a class="col-md-6 btn btn-success active" href="spinfo.php?newagency">
                        <span class="glyphicon glyphicon-edit"></span>
                        Add New Agency
                    </a>
                </div>
                <div class="text-right">
                    <a class="col-md-6 btn btn-warning active" href="spinfo.php">
                        <span class="glyphicon glyphicon-edit"></span>
                        Close Edition Page
                    </a>
                </div>
            </div>
            <br>
            <br>
            <hr>
            <div class="title text-center">
                <h2>Spotloan Address Management</h2>
            </div>
            <div id="address">
                <table class="table table-states table-hover">
                    <thead>
                        <tr>
                            <th>Adress Type</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'includes/dbh.inc.php';
                        $dbquery = "SELECT * FROM sp_contact";
                        $dbinit = mysqli_query($conn, $dbquery);
                        $dbrow = mysqli_num_rows($dbinit);
                        if($dbrow > 0)
                        {
                            while ($dbrow=mysqli_fetch_array($dbinit))
                            {
                                ?>
                                <tr>
                                    <td><?php echo $dbrow['address_type'];?></td>
                                    <td>
                                        <b><?php echo $dbrow['address_type'];?></b>
                                       <br><?php echo $dbrow['address1'];
                                       if(!empty($dbrow['address2']))
                                       {
                                           ?><br><?php echo $dbrow['address2'];
                                       }
                                       ?>
                                       <br><?php echo $dbrow['city'].", ".$dbrow['state']." ".$dbrow['zipcode'];?>
                                       <br>
                                       <b>Status: </b>
                                       <?php 
                                        if($dbrow['status']==1)
                                        {
                                            echo "Active";
                                        }
                                        else
                                        {
                                            echo "In-Active";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="?edit=on&act=<?php echo $dbrow['status'];?>&id=<?php echo $dbrow['id'];?>" class="btn btn-<?php if($dbrow['status']==1){echo "danger";}else{echo "success";}?>">
                                                <?php 
                                                if($dbrow['status']==1)
                                                {
                                                    echo "De-Activate";
                                                }
                                                else
                                                {
                                                    echo "Activate";
                                                }
                                                ?>
                                            </a>
                                            <a class="btn btn-info" href="?edit=on&del&id=<?php echo $dbrow['id'];?>">Delete</a>
                                            <a href="?edit=on&upd&id=<?php echo $dbrow['id'];?>" class="btn btn-warning">
                                                Edit
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        $conn->close();
                        ?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
                <div>
                    <div class="text-left">
                        <a class="col-md-6 btn btn-success active" href="spinfo.php?newaddress">
                            <span class="glyphicon glyphicon-edit"></span>
                            Add New address
                        </a>
                    </div>
                    <div class="text-right">
                        <a class="col-md-6 btn btn-warning active" href="spinfo.php">
                            <span class="glyphicon glyphicon-edit"></span>
                            Close Edition Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }        
}elseif(isset($_GET['newagency'])){
    ?>
    <div class="jumbotron">
        <p class="msg"><?php echo $_GET['msg'];?></p>
        <form class="form" method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="acode">
                            Agency Code:
                        </label>
                        <input class="form-control" type="text" name="acode" required/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="aname">
                            Agency Name:
                        </label>
                        <input class="form-control" type="text" name="aname" required/>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="aphone">
                            Agency Phone Number:
                        </label>
                        <input class="form-control" type="text" name="aphone" maxlength="12" placeholder="888-321-8856" required/>
                    </div>
                </div>
            </div>
                   <div>
            <div class="col-md-6 text-left">
                <button type="submit" class="form-control btn btn-success" name="add_agency">Add</button>
            </div>
            </table>
            <div class="col-md-6 text-right">
                <a class="col-md-12 btn btn-warning" href="spinfo.php?edit=on">
                  Cancel
               </a>
            </div>
                </div>
            </div>
        </div> 
        </form>
        <?php
        if(isset($_POST['add_agency'])){
            include 'includes/dbh.inc.php';
            $code=mysqli_real_escape_string($conn, $_POST['acode']);
            $name=mysqli_real_escape_string($conn, $_POST['aname']);
            $phone=mysqli_real_escape_string($conn, $_POST['aphone']);
            $q= "INSERT INTO debtsalebuyers (Code, Name, PhoneNumber) VALUES('$code', '$name', '$phone')";
            $update = mysqli_query($conn, $q);
            if ($update) {
                header("Location: spinfo.php?edit=on&msg=New Agency successfully added");
                exit();
            }else{
               header("Location: spinfo.php?newagency&msg=Something went wrong, please try again.");
            }
            $conn->close();
        }
        ?>
    </div>
    <?php
}
elseif(isset($_GET['newaddress']))
{
    ?>
    <div class="jumbotron">
        <form method="post" class="form-horizontal">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="address_type">
                            Address Name:
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="address_type" name="address_type" placeholder="Enter Address Name" alt="The Name that will descrie this address e.i Phisycal Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="address1">
                            Street Address:
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="address1" name="address1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="address2">
                            Street Address 2:
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="address2" name="address2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="city">
                            City:
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="state">
                            State:
                        </label>
                        <div class="col-sm-8">
                            <select class="form-control" id="state" name="state">
                                <option value="">Select State</option>
                                <?php
                                include 'includes/dbh.inc.php';
                                $dbquery = "SELECT * FROM servicing_states";
                                $dbinit = mysqli_query($conn,$dbquery);
                                $dbrows = mysqli_num_rows($dbinit);
                                if ($dbrows > 0) 
                                {
                                    while($dbrow = mysqli_fetch_array($dbinit))
                                    {
                                        ?>
                                        <option value="<?php echo $dbrow['state_abr'];?>">
                                            <?php echo $dbrow['state_abr']." - ".$dbrow['state_name'];?>
                                            </option>
                                        <?php
                                    }
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="zipcode">
                            Zip Code:
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="zipcode" name="zipcode">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="btn-group">
                        <button class="btn btn-success" type="submit" name="saveaddress">Save</button>
                        <button class="btn btn-warning" type="submit" name="cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
    //address saver
    if(isset($_POST['saveaddress']))
    {
        //DBConnection
        include 'includes/dbh.inc.php';
        //set variabless
        $addtittle = mysqli_real_escape_string($conn, $_POST['address_type']);
        $add1 = mysqli_real_escape_string($conn, $_POST['address1']);
        $add2 = mysqli_real_escape_string($conn, $_POST['address2']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $zip = mysqli_real_escape_string($conn, $_POST['zipcode']);
        $addsave = "INSERT INTO sp_contact(address_type, address1, address2, city, state, zipcode, status) VALUES ('$addtittle', '$add1', '$add2', '$city', '$state', '$zip', 0)";
        $addinit = mysqli_query($conn, $addsave);
        if($addinit)
        {
            $lastId = mysqli_insert_id($conn);
            header("Refresh:0; url=?edit=on&id=$lastId&msg=New address has been saved. The current status is inactive");
        }
        else
        {
            $error= mysqli_error($conn);
            header("Refresh:0; url=?newaddress&msg=something went wrong, please try again. DB error: $error");
        }
        //closeDB connection
        $conn->close();
    }
    elseif(isset($_POST['cancel']))
    {
       header("Refresh:0; url=?edit=on");
    }
}
else{
?>
<div class="jumbotron">
    <div class="row">
        <div class="col-lg-3">
            <h2 class="text-center" style="color:#3793D2;"><b>Spotloan Information</b></h2>
        </div>
        <div class="col-lg-9" style="border-left: solid;">
            <h3 class="text-center" style="color:#3399FF;"><b>Spotloan has been in business since July 2012</b></h3>
            <div class="row">
                <div class="col-sm-5" style="border-right: 1px solid #000;">
                    <div>
                        <b>Fax Number: </b><br>
                        1 (701) 248-7277
                    </div>
                    <br>
                    <?php
                    include 'includes/dbh.inc.php';
                    $dbquery = "SELECT * FROM sp_contact where status=1";
                    $dbinit = mysqli_query($conn, $dbquery);
                    $dbrow = mysqli_num_rows($dbinit);
                    if($dbrow > 0)
                    {
                        while ($dbrow=mysqli_fetch_array($dbinit)) 
                        {
                           ?>
                           <div>
                               <b><?php echo $dbrow['address_type'].":";?></b>
                               <br><?php echo $dbrow['address1'];
                               if(!empty($dbrow['address2']))
                               {
                                   ?><br><?php echo $dbrow['address2'];
                               }
                               ?>
                               <br><?php echo $dbrow['city'].", ".$dbrow['state']." ".$dbrow['zipcode'];?>
                           </div>
                           <br />
                           <?php
                        }
                    }
                    $conn->close();
                    ?>
                    <b>Working Hours:</b><br>
                    Monday - Friday: 7:00AM - 8:00PM CST<br>
                    Saturday: 9:00AM - 6:00PM CST
                    <br><br>
                    <?php
                    include 'includes/dbh.inc.php';
                    $q="SELECT * FROM debtsalebuyers WHERE NOT PhoneNumber='N/A'";
                    $result= mysqli_query($conn, $q);
                    $numrows= mysqli_num_rows($result);
                    if ($numrows>0) {
                        echo "<b><u>Collection Agency</u></b>";
                        while($row=mysqli_fetch_array($result)){
                            echo "<br><i><b>".$row['Name'].":</b></i></br>";
                            echo "Phone Number: <i>".$row['PhoneNumber']."</i>";
                        }
                        $conn->close();
                    }
                    
                    ?>
                </div>
                <div class="col-sm-7">
                    <h5 class="text-center">PAID ON:</h5>
                    <ul class="text-center" type="none">
                        <li><b>1<sup>st</sup> week</b> on any day should be set for <b>7<sup>th</sup></b></li>
                        <li><b>2<sup>nd</sup> week</b> on any day should be set for <b>14<sup>th</sup></b></li>
                        <li><b>3<sup>rd</sup> week</b> on any day should be set for <b>21<sup>st</sup></b></li>
                        <li><b>4<sup>th</sup> week</b> on any day should be set for <b>28<sup>th</sup></b></li>
                    </ul>
                    <div class="row list-inline">
                        <div class="col-sm-5">
                            <b>Restricted States</b><br>
                            Reference <a href="tz.php#restricted">Time Zone Map</a>
                        </div>
                        <div class="col-sm-7">
                            <b>Interest Rate: </b><br>
                            <?php
                            include 'includes/dbh.inc.php';
                            $q="SELECT * FROM rates";
                            $result= mysqli_query($conn, $q);
                            $numrows= mysqli_num_rows($result);
                            while($row= mysqli_fetch_array($result)){
                                echo $row['desc'].": ".$row['rate']."%<br>";
                            }
                            if ($seclevel<3) {
                                ?>
                                <button type="button" class="btn btn-info." data-toggle="collapse" data-target="#rates">Edit Rates</button>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <br>
                    <div id="rates" class="collapse <?php if(isset($_GET['rate']) || isset($_GET['ratesaved']) ){echo "in";}?>" >
                        <?php
                        if(isset($_GET['rate'])) {
                            include 'includes/dbh.inc.php';
                            $id= $_GET['id'];
                            $q="SELECT * FROM rates WHERE id=$id";
                            $result= mysqli_query($conn, $q);
                            $numrows= mysqli_num_rows($result);
                            while($row= mysqli_fetch_array($result)){
                                ?>
                                <p>Update</p>
                                <form class="form" method="POST">
                                    <div class="row">
                                        <div class="col-md-4"><?php echo $row['desc'];?></div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                              <label for="rate_update">Rate:</label>
                                              <input class="form-control" type="text" value="<?php echo $row['rate']; ?>" id="rate_update" name="rate_update">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="form-control btn btn-success" name="rate_update_submit">Update</button>
                                            <br>
                                            <a href="spinfo.php?ratesaved">
                                                <button type="button" class="form-control btn btn-info col-sm-3" name="editcancel">
                                                    Cancel
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                if(isset($_POST['rate_update_submit'])){
                                    $rate = $_POST['rate_update'];
                                    $id = $_GET['id'];
                                    $q="UPDATE `rates` SET `rate`='$rate' WHERE id=$id";
                                    $update= mysqli_query($conn, $q);
                                    if ($update) {
                                        header("Location: spinfo.php?ratesaved");
                                        exit();
                                    }else{
                                        header("Location: spinfo.php?rate&id=$id");
                                        exit();
                                    }
                                }
                            }
                            $conn->close();
                        } else {
                            ?>
                            <table>
                                <thead>
                                    <th >Description</th>
                                    <th>Rate</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'includes/dbh.inc.php';
                                    $q="SELECT * FROM rates";
                                    $result= mysqli_query($conn, $q);
                                    $numrows= mysqli_num_rows($result);
                                    while($row= mysqli_fetch_array($result)){
                                        ?>
                                        <tr>
                                            <td><?php echo $row['desc'];?></td>
                                            <td><?php echo $row['rate']."%";?></td>
                                            <td><a href="spinfo.php?rate&id=<?php echo $row['id'];?>"><button class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span>Edit</button></a></td>
                                        </tr>
                                        <?php
                                    }
                                    $conn->close();
                                    ?>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                            <?php
                        }
                        ?>
                        
                        
                    </div>
                </div>
            </div>
                <?php
                if ($seclevel<3){
                        ?>
                        <div class="text-left">
                            <a class="col-md-4 btn btn-default active" href="spinfo.php?edit=on">
                                <span class="glyphicon glyphicon-edit"></span>
                                Edit Page
                            </a>
                        </div>
                        <?php    
                    }
                ?>
        </div>
    </div>
</div>
<?php
}
include 'footer.php';
?>