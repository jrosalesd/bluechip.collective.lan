<?php
$page_name = "Sold List";
include 'header.php';
$msg=$_GET['msg'];
?>
        <div class="jumbotron">
            <?php
            if (isset($_GET['msg'])) {
                ?>
                <div class="alert <?php echo $_GET['alert'];?> alert-dismissible text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $msg?>
                </div>
                <?php
            }
            ?>
            
            <div align="right"><font color="red"></font></div>
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <form action="" method='get' class="navbar-form navbar-left">
                            <div class="form-group">
                                <input type="text" name="term" class="form-control" value="<?php echo $_GET['term'];?>" placeholder="Search">
                            </div>
                            <button type="submit"  name="search" class="btn btn-default">Search</button>
                        </form>
                    </div><br/>
                </div>
                <div class="col-md-6 text-right" align="right">
                    <?php
                    if($seclevel<3){
                        ?>
                        
                        <!--
                        <div>
                            <div align="right"><font color="red"><?php //echo $msg?></font></div>
                            <div class="button-group">
                                <div class="dropdown">
                                    <button class="col-md-3 btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">New Records</button>
                                    
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li role="presentation"><a role="menuitem" id="SigleRecord" onclick="SingleRecord()">Signle Record</a></li>
                                    <li role="presentation"><a role="menuitem" id="fileUpload"onclick="upload">Multibple Record</a></li>
                                </ul>
                                </div>
                            </div>
                            <div id="soldlist_landform"></div>
                        </div>
                        -->
                        <div align="right">
                            <div align="right"><h4>Uploan update for SoldList</h4></div>
                            <form class="form-inline" action="includes/soldlist.update.inc.php" method="post" enctype="multipart/form-data">
                                <div class="input-group">
                                    <input type="file" name="file"/>
                                     <div class="input-group-btn">
                                        <button class="btn btn-default" type="submit" name="import">
                                            Upload File
                                        </button>
                                     </div>
                                </div>
                            </form>
                            <div class="row">
                                <div align="right" class="col-md">
                                    <a href="./files/docUpload.csv">
                                        <button align="right" type="button" class="btn btm-default col-md-4">
                                            <span class="glyphicon glyphicon-cloud-download"></span>
                                            Download Template
                                        </button>
                                    </a>
                                </div>
                            </div>
                                
                        </div>
                        
                        <?php
                        /*echo '<div align="right">Uploan update for SoldList</div>';
                        echo '
                            <form action="includes/soldlist.update.inc.php" method="post" enctype="multipart/form-data">
                                <div align="right">
                                    <input type="file" name="file"/>
                                    <input type="submit" name="import" value="Upload"/>
                                </div>
                            </form>';
                        echo '<div align="right"><font color="red">'.$msg.'</font></div>';*/
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="jumbotron">
            <?php
                include 'includes/dbh.inc.php';
                if (isset($_GET['edit'])) {
                    if ($seclevel < 2) {
                        $edit = trim(mysqli_real_escape_string($conn,$_GET['edit']));
                        $sql = "SELECT * FROM soldlist WHERE Loan_ID ='$edit'";
                        $run = mysqli_query($conn, $sql);
                        //Check data
                        $numrows = mysqli_num_rows($run);
                        if ($numrows > 0) {
                            $row_edit =mysqli_fetch_assoc($run);
                        }else {
                            header("Location: ?term=$edit&search=&msg=Unable to find the requested information for $edit");
                        }
                        
                        ?>
                       <form action="" method="post">
                           <input type="hidden" name="id" value="<?php echo $row_edit['id'];?>"/>
                           <div class="row">
                               <div class="col-md-3">
                                   <div class="form-group">
                                       <label for="">
                                           Loan ID (LA Pro)
                                       </label>
                                       <input type="text" class="form-control" name="loanid" value="<?php echo $row_edit['Loan_ID'];?>">
                                   </div>
                               </div>
                               <div class="col-md-3">
                                   <div class="form-group">
                                       <label for="">
                                           Balance when Sold:
                                       </label>
                                       <input type="text" class="form-control" name="balance" value="<?php echo $row_edit['Balance'];?>">
                                   </div>
                               </div>
                               <div class="col-md-3">
                                   <div class="form-group">
                                       <label for="">
                                           Buyer:
                                       </label>
                                       <select class="form-control" name="buyer">
                                           <?php
                                            $checker = $row_edit['Buyer'];
                                            $sql_check = "SELECT * FROM debtsalebuyers";
                                            $run_check = mysqli_query($conn, $sql_check);
                                            $numrows_check = mysqli_num_rows($run_check);
                                            if ($numrows_check > 0) {
                                                while($row_edit_check = mysqli_fetch_assoc($run_check)){
                                                    ?>
                                                    <option value="<?php echo $row_edit_check['Code'];?>" <?php if($row_edit_check['Code'] == $checker){echo "selected";}?>><?php echo $row_edit_check['Code'];?> - <?php echo $row_edit_check['Name'];?></option>
                                                    <?php
                                                }
                                            }
                                           ?>
                                       </select>
                                   </div>
                               </div>
                               <div class="col-md-3">
                                   <div class="form-group">
                                       <label for="">
                                           Sold Date (MM/DD/YYYY):
                                       </label>
                                       <input type="text" class="form-control" name="soldDate" value="<?php echo $row_edit['Sold_Date'];?>">
                                   </div>
                               </div>
                           </div>
                           <div class="text-right">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success" name="save-update">
                                        <span class="glyphicon glyphicon-ok"></span> Save
                                    </button>
                                    <button type="submit" class="btn btn-danger" name="cancel-update">
                                        <span class="glyphicon glyphicon-remove"></span> Cancel
                                    </button>
                                </div>
                           </div>
                       </form>
                       <?php
                       if (isset($_POST['save-update'])) {
                           // Collect Data
                           $id = mysqli_real_escape_string($conn, $_POST['id']);
                           $loanid = mysqli_real_escape_string($conn, $_POST['loanid']);
                           $balance = mysqli_real_escape_string($conn, $_POST['balance']);
                           $buyer = mysqli_real_escape_string($conn, $_POST['buyer']);
                           $soldDate = mysqli_real_escape_string($conn, $_POST['soldDate']);
                           
                           $sql_save = "
                                UPDATE soldlist
                                SET Loan_ID = '$loanid',
                                Balance = '$balance',
                                Buyer  = '$buyer',
                                Sold_Date = '$soldDate'
                                WHERE  id = '$id'
                            ";
                            $run_update = mysqli_query($conn, $sql_save);
                            if ($run_update) {
                                header("refresh: 0; url=?search&term=$loanid&msg=$loanid has been successfully updated&alert=alert-success");
                            }else{
                                $error = mysqli_error($conn);
                                header("refresh: 0; url=?edit=$loanid&msg=Unable to update <b>$loanid</b> because of the following error: <b><i>$error</i></b>&alert=alert-danger");
                            }
                       }
                    }else {
                        echo "<p>You are not autorized on this pasge you will be redirected in 5 seconds</p>";
                        header("refresh:5 ; url=soldlist.php");
                    }
                }else {
                    ?>
                    <div>
                        <table class="table table-responsive">
                            <tr>
                                <th>Loan ID</th>
                                <th>Buyer Code</th>
                                <th>Buyer Name</th>
                                <th>Phone Number</th>
                                <th>Sold Date</th>
                                <th></th>
                            </tr>
                            <?php
                                
                                if(isset($_GET['search'])){
                                    if(!empty($_REQUEST['term'])){
                                        $term = trim(mysqli_real_escape_string($conn,$_GET['term']));
                                        $slq = "SELECT soldlist.Loan_ID, soldlist.Buyer, debtsalebuyers.Name, debtsalebuyers.PhoneNumber, soldlist.Sold_Date FROM soldlist, debtsalebuyers WHERE soldlist.Buyer = debtsalebuyers.Code AND soldlist.Loan_ID LIKE '%$term%' OR debtsalebuyers.Name LIKE '%$term%' OR soldlist.Sold_Date LIKE '%$term%'";
                                        $slq_result = mysqli_query($conn,$slq);
                    
                                        if(mysqli_num_rows($slq_result) != 0){
                                            while($row = mysqli_fetch_array($slq_result)){
                                            ?>
                                            <tr>
                                                <td><?php echo $row[0]; ?></td>
                                                <td><?php echo $row[1]; ?></td>
                                                <td><?php echo $row[2]; ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td><?php echo $row[4]; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-success" href="emails.php?cs&id=88&LAPro=<?php echo $row[0]; ?>" target="_blank"><span class="fa fa-envelope-o" style="font-size:16px"></span> Send Email</a>
                                                        <?php 
                                                        if($seclevel < 2){
                                                            ?>
                                                            <a class="btn btn-warning" href="?edit=<?php echo $row[0];?>">
                                                                <span class="glyphicon glyphicon-edit"></span>Edit record
                                                            </a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    
                                                </td>
                                                
                                            </tr>
                                            <?php
                                                }
                                                
                                        }else{
                                            echo "<p>No Records Found</p>";
                                        }
                                    }   
                                }
                            ?>
                        </table>
                    </div>
                    <?php
                }
                $conn->close();
            ?>
                
        </div>
        
<?php
    include 'footer.php';
?>