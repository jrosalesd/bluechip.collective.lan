<?php
$page_name = "Sold List";
include 'header.php';
$msg=$_GET['msg'];
?>
        <div class="jumbotron">
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
                            <div align="right"><font color="red"><?php echo $msg?></font></div>
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
                            <div align="right"><font color="red"><?php echo $msg?></font></div>
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
                        include 'includes/dbh.inc.php';
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
                                            <a class="btn btn-success" href="emails.php?cs&id=88&LAPro=<?php echo $row[0]; ?>"><span class="fa fa-envelope-o" style="font-size:16px"></span> Send Email</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                        $slq_result->close();
                                }else{
                                    echo "<p>No Records Found</p>";
                                }
                            }   
                        }
                    ?>
                </table>
            </div>
        </div>        
<?php
    include 'footer.php';
?>