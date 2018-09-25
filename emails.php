<?php
$page_name = "Email Templates";
include 'header.php';
$one_day_sec = 86400;
$current = date("Y");
if (strtotime("now") < strtotime("first Sunday of November $current") && strtotime("now")>strtotime("second Sunday of March $current")) {
	$setDst = 1;
}else{
	$setDst = 0;
}

include 'includes/dbh.inc.php';
if (isset($_GET['cs'])) {
	//email Template
	$emID = $_GET['id'];
	$q_em = "Select * FROM email WHERE ID=$emID";
	$db_init = mysqli_query($conn, $q_em);
	$em_rows = mysqli_num_rows($db_init);
	if ($em_rows>0) {
		$row_em = mysqli_fetch_array($db_init);
		$emtype = $row_em['type'];
		$emname = $row_em['name'];
		$emcat = $row_em['catID'];
		$emid2 = $row_em['emID'];
	}
	?>
	
	
	<div class="jumbotron">
	    <div class="text-right">
	        <?php
	        if($seclevel < 2)
	        {
	            ?>
	            <a class="btn btn-info" href="?edit&id=<?php echo $emID;?>" target="_blank">Edit Email</a>
	            <?php
	        }
	        ?>
	    </div>
	    <hr>
	    <div class="row">
	        <?php
	        $previous = "SELECT * FROM email WHERE type='$emtype' AND ID<$emID AND catID=$emcat AND status=1";
	        $query1 = mysqli_query($conn, $previous);
	        $numrow_prev = mysqli_num_rows($query1);
	        if ($numrow_prev >0) 
	        {
	           $prev = 1;
	        }
	        else
	        {
	           $prev = 0; 
	        }
	        
	        $next = "SELECT * FROM email WHERE type='$emtype' AND ID>$emID AND catID=$emcat AND status=1";
	        $query2 = mysqli_query($conn, $next);
	        $numrow_next = mysqli_num_rows($query2);
	        if ($numrow_next > 0) 
	        {
	           $next = 1;
	        }
	        else
	        {
	           $next = 0; 
	        }
	        
	        ?>
            <ul class="list-inline text-center">
                <?php
                if ($prev == 1) {
                    ?>
                    <li class="col-md-4">
                        <a class="btn btn-success" data-toggle="modal" href="#previous">
                            <span class="glyphicon glyphicon-arrow-left"></span> Previous Emails
                        </a>
                    </li>
                    <?php
                }else{
                    ?>
                    <li class="col-md-4"></li>
                    <?php
                }
                
                ?>
                <li class="col-md-4">
                    <a href="emails.php?<?php echo $emtype;?>" class="btn btn-primary" role="button">
            				<span class="glyphicon glyphicon-menu-hamburger"></span>
            				<?php
            				$typesearch = "SELECT * FROM emtype WHERE code='".$emtype."'";
            				$db_type_init = mysqli_query($conn, $typesearch);
            				$row = mysqli_fetch_array($db_type_init);
            				echo $row['description'];
            				?>
            		</a>
                </li>
                <?php
                if ($next == 1) {
                    ?>
                    <li class="col-md-4">
                        <a class="btn btn-success" data-toggle="modal" href="#next">
                            Next Emails <span class="glyphicon glyphicon-arrow-right"></span>
                        </a>
                    </li>
                    <?php
                }else{
                    ?>
                    <li class="col-md-4"></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <hr>
        <?php
        if (!file_exists("./email/$emtype/$emcat-$emid2.php")) {
            $page_name = "Error: #404 page Not Found";
            ?>
            <div>
                <h2>Error: Page Not Found</h2>
                <p>The Page you are looking for could not be found. Please try again later. If this error continues to happen, please contact the Administrator.</p>
            </div>
                
            <?php
        }else{
            $subpage = $emname;
            include "./email/$emtype/$emcat-$emid2.php";
        }
        ?>
	</div>
	
	</div>
    <div id="Modals">
        <!-- Previous emails -->
        <div id="previous" class="modal fade" role="dialog">
            <div class="modal-dialog modal-ku">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close text-right" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Previous Emails</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <ul class="zest">
                                <?php
                                $i = 1;
                                 while($row = mysqli_fetch_array($query1))
                                 {
                                    ?>
                                    <li class="col-md-4"><a href="./emails.php?cs&id=<?php echo $row['ID'];?>"><?php echo $row['name'];?></a></li>
                                    <?php
                                    if ($i > 3) 
                                    {
                                      $i = 1;
                                    }
                                    if($i++ == 3)
                                    {
                                        ?>
                                            </ul>
                	                    </div>
                	                    <br />
                	                    <div class="row">
                	                        <ul class="zest">
                                        <?php
                                    }
                                 }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Previous emails -->
        <!-- Next emails -->
        <div id="next" class="modal fade" role="dialog">
            <div class="modal-dialog modal-ku">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close text-right" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Previous Emails</h4>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="row">
                                <ul class="zest">
                                    <?php
                                    $i = 1;
                                     while($row = mysqli_fetch_array($query2))
                                     {
                                        ?>
                                        <li class="col-md-4"><a href="./emails.php?cs&id=<?php echo $row['ID'];?>"><?php echo $row['name'];?></a></li>
                                        <?php
                                        if ($i > 3) 
                                        {
                                          $i = 1;
                                        }
                                        if($i++ == 3)
                                        {
                                            ?>
                                                </ul>
                    	                    </div>
                    	                    <br />
                    	                    <div class="row">
                    	                        <ul class="zest">
                                            <?php
                                        }
                                     }
                                    ?>
                                </ul>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <!-- End Next emails -->
    </div>
	<?php
} else if (isset($_GET['rm'])){
    //RM Email Menu
    $subpage =  "RM";
    ?>
    <div class="jumbotron">
    		<div class="tab-content">
                <br>
                <div>
                    <h2 class="text-center"><font color="#3793D2">Customer Service<br>
                        Email Templates</font></h2>  
                </div>
                <hr>
                <div>
                    <h3 class="text-center"><font color="#3793D2">Payment Related Emails</font></h3>
                </div>
                <br>
                <div>
                    <div class="row">
                        <ul class="zest">
                    <?php
                    $em_menu = "SELECT * FROM email WHERE type='rm' AND catID=1 AND status>0";
        		    $db_menu_init = mysqli_query($conn, $em_menu);
        		    $menu_rows = mysqli_num_rows($db_menu_init);
        		    $i = 1;
                    if ($menu_rows>0){
                        while($menurow=mysqli_fetch_array($db_menu_init)){
                            
                            
        	                ?>
	                        <li class="col-md-4"><a href="./emails.php?cs&id=<?php echo $menurow['ID'];?>"><?php echo $menurow['name'];?></a></li>
        	                <?php
        	                
            	            if ($i > 3) {
                              $i = 1;
                            }
                            if($i++ == 3){
                                
        	                    ?>
        	                        </ul>
        	                   </div>
        	                   <div class="row">
        	                       <ul class="zest">
        	                    <?php
        	                }
                        }
                    }
                    ?>
        		        </ul>
        		    </div>
                </div>
                
                <div>     
                    <h3 class="text-center"><font color="#3793D2">Servicing Related Emails</font></h3>  
                </div>
                <div>
                    <div class="row">
                        <ul class="zest">
                    <?php
                    $em_menu = "SELECT * FROM email WHERE type='rm' AND catID=2 AND status>0";
        		    $db_menu_init = mysqli_query($conn, $em_menu);
        		    $menu_rows = mysqli_num_rows($db_menu_init);
        		    $i = 1;
                    if ($menu_rows>0){
                        while($menurow=mysqli_fetch_array($db_menu_init)){
                            
                            
        	                ?>
        	                        <li class="col-md-4"><a href="./emails.php?cs&id=<?php echo $menurow['ID'];?>"><?php echo $menurow['name'];?></a></li>
        	                <?php
        	                
            	            if ($i > 3) {
                              $i = 1;
                            }
                            if($i++ == 3){
                                
        	                    ?>
        	                        </ul>
        	                   </div>
        	                   <div class="row">
        	                       <ul class="zest">
        	                    <?php
        	                }
                        }
                    }
                    ?>
        		        </ul>
        		    </div>
                </div>
                <!--
                <div>  
                    <h3 class="text-center"><font color="#3793D2">General Emails</font></h3>  
                </div>
                <div>
                    <div class="row">
                        <ul class="zest">
                    <?php
                    $em_menu = "SELECT * FROM email WHERE type='rm' AND catID=3 AND status>0";
        		    $db_menu_init = mysqli_query($conn, $em_menu);
        		    $menu_rows = mysqli_num_rows($db_menu_init);
        		    $i = 1;
                    if ($menu_rows>0){
                        while($menurow=mysqli_fetch_array($db_menu_init)){
                            
                            
        	                ?>
        	                        <li class="col-md-4"><a href="./emails.php?cs&id=<?php echo $menurow['ID'];?>"><?php echo $menurow['name'];?></a></li>
        	                <?php
        	                
            	            if ($i > 3) {
                              $i = 1;
                            }
                            if($i++ == 3){
                                
        	                    ?>
        	                        </ul>
        	                   </div>
        	                   <div class="row">
        	                       <ul class="zest">
        	                    <?php
        	                }
                        }
                    }
                    ?>
        		        </ul>
        		    </div>
                </div>
                -->
            </div>
        </div>
    <?php
}else if (isset($_GET['fr'])) {
    //cm Email Menu
    $subpage =  "CM";
    ?>
    <div class="jumbotron">
    		<div class="tab-content">
                <br>
                <div>
            	    <h2 class="text-center">
            	        <font color="#3793D2">
            	            Collection
            	            <br>Email Templates
            	        </font>
            	    </h2>
            	</div>
                <hr>
                <div>
            	    <h3 class="text-center">
            	        <font color="#3793D2">
            	            Settlement Emails
            	        </font>
            	    </h3>
            	</div>
                <br>
                <div>
                    <div class="row">
                        <ul class="zest">
                    <?php
                    $em_menu = "SELECT * FROM email WHERE type='fr' AND status>0";
        		    $db_menu_init = mysqli_query($conn, $em_menu);
        		    $menu_rows = mysqli_num_rows($db_menu_init);
        		    $i = 1;
                    if ($menu_rows>0){
                        while($menurow=mysqli_fetch_array($db_menu_init)){
                            
                            
        	                ?>
        	                        <li class="col-md-4"><a href="./emails.php?cs&id=<?php echo $menurow['ID'];?>"><?php echo $menurow['name'];?></a></li>
        	                <?php
        	                
            	            if ($i > 3) {
                              $i = 1;
                            }
                            if($i++ == 3){
                                
        	                    ?>
        	                        </ul>
        	                   </div>
        	                   <div class="row">
        	                       <ul class="zest">
        	                    <?php
        	                }
                        }
                    }
                    ?>
        		        </ul>
        		    </div>
                </div>
            </div>
        </div>
    <?php
}else{
    
    if ($seclevel >= 2) {
    header("Location: index.php");
    }else{
    $subpage = "EM Editor";
    
    ?>
    <div class=jumbotron>
        <div id="message">
            <?php
            if(isset($_GET['msg']))
            {
                ?>
                <div class="alert alert-info alert-dismissible fade in text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_GET['msg'];?>
                </div>
                <?php
            }
            ?>
        </div>
        <div id=formcheck>
            <div id="nav">
                <div class="btn-group">
                    <a href="?all" class="btn btn-primary">All Emails</a>
                    <a href="?rml" class="btn btn-success">RM Emails</a>
                    <a href="?frl" class="btn btn-warning">FR Emails</a>
                    <a href="?new" class="btn btn-primary">New</a>
                </div>
            </div>
            <hr>
            <div>
                <?php
                if (isset($_GET['new'])) {
                    emails(1);
                    
                    if (isset($_POST['addem'])) {
                        $name = mysqli_real_escape_string($conn,$_POST['tempname']);
                        $type = mysqli_real_escape_string($conn,$_POST['emtype']);
                        $group = mysqli_real_escape_string($conn,$_POST['catid']);
                        //check DB
                        $sql1 = "SELECT MAX(ID) FROM email WHERE catID='$group' AND type='$type'";
                        $sql1init = mysqli_query($conn, $sql1);
                        $numrows = mysqli_num_rows($sql1init);
                        if ($numrows > 0) {
                           $rows=mysqli_fetch_assoc($sql1init);
                           $dbid= implode(" ",$rows);
                           $sql2="SELECT * FROM email WHERE ID=$dbid";
                           $sql2init = mysqli_query($conn, $sql2);
                           $numrows2 = mysqli_num_rows($sql2init);
                           if ($numrows2 > 0) {
                               $rows2=mysqli_fetch_assoc($sql2init);
                               $emid= $rows2['emID']+1;
                           }
                        }
                       if(!empty($name)||!empty($type)||!empty($group)||!empty($id)){
                           $add = "INSERT INTO email (type, name, catID, emID, status)  VALUES ('$type', '$name', '$group', '$emid', '0')";
                           $sentdat = mysqli_query($conn, $add);
                           
                           if ($sentdat) {
                               $lastId = mysqli_insert_id($conn);
                               header("Refresh:0; url=emails.php?edit&id=$lastId&msg=Record Created");
                                exit();
                           }else {
                               $error= mysqli_error($conn);
                               header("Refresh:0; url=emails.php?msg=something went wrong, please try again. SQL Error: $error");
                           }
                       }
                           
                    }
                }
                ?>
            </div>
                
        </div>
        <?php
        
        if (isset($_GET['status'])) {
            $id = $_GET['id'];
            $status = $_GET['status'];
            if ($status == 1) {
                $status = 0;
            }elseif ($status == 0) {
                $status = 1;
            }
            if (isset($_GET['rml'])) {
            $urlset = "rml";
            }if (isset($_GET['all'])) {
                $urlset = "all";
            }if (isset($_GET['frl'])) {
                $urlset = "frl";
            }if (isset($_GET['new'])) {
                $urlset = "new";
            }else {
                $urlset = "";
            }
            
            $delete = "UPDATE email SET status = '$status' WHERE ID='$id'";
            $init = mysqli_query($conn, $delete);
            if ($init) {
                header("Refresh:0; url=?$urlset&msg=Update complete ");
                exit();
            }else{
                header("Refresh:0; url=?$urlset&msg=Something went wrong, please try again.");
                exit();
            }
            
        }else if (isset($_GET['edit'])){ 
            $id = $_GET['id'];
            $sel_item = "Select * FROM email WHERE ID='$id'";
            $init = mysqli_query($conn, $sel_item);
            $numrows = mysqli_num_rows($init);
            if ($numrows>0) {
               $row= mysqli_fetch_array($init);
               $doclocation = "email/".$row['type'];
               $docname = $row['catID']."-".$row['emID'];
               ?>
               <table class="table table-bordered">
                    <tr>
                        <td class="wrap">
                            <?php 
                            echo ucwords($row['name'])." [Filename: $docname.php]";
                            ?>
                        </td>
                        <td>
                           <div id="form">
                               <?php
                                if (!file_exists("$doclocation/$docname.php")) 
                                {
                                    ?>
                                    <form class="form" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                        <div class="text-centered">
                                            <input class="form-control" type="file" name="file"/>
                                        </div>
                                        <br />
                                        <div class="row">
                                            <input type="submit" class="col-md-4 btn btn-success" name="upem" value="Upload">
                                            <input type="submit" class="col-md-4 btn btn-danger" name="delete" value="DeleteFromDB">
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="row">
                                        <a class="col-md-4 btn btn-warning" href="emails.php">Cancel</a>
                                    </div>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <a class="col-md btn btn-success" href="?cs&id=<?php echo $_GET['id'];?>" target="_blank"><span class="glyphicon glyphicon-new-window"></span> Open Template</a>
                                                <a class="col-md btn btn-warning" href="editor.php?p=<?php echo "$doclocation&edit=$docname.php&env=ace";?>&return=emails.php?edit&id=<?php echo $_GET['id'];?>">Edit Code</a>
                                                <a class="col-md btn btn-warning" href="editor.php?p=<?php echo "$doclocation&dl=$docname.php";?>">Download</a>                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <form method="POST">
                                                    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>"/>
                                                    <input type="submit" class="col-md btn btn-danger" name="unlink" value="Delete File">
                                                    <input type="submit" class="col-md btn btn-danger" name="delete" value="DeleteFromDB">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <a class="col-md-4 btn btn-warning" href="emails.php">Cancel</a>
                                    </div>
                                    <?php
                                }
                                ?>
                           </div> 
                               
                        </td>
                    </tr>  
               </table>
               <?php
            }else{
  
            }
        }else{
        ?>
        <div id="data">
            <?php
            if (isset($_GET['all'])) {
                $dataquety = "Select * FROM email ORDER BY catID ASC, ID ASC";
            }elseif (isset($_GET['rml'])) {
                $dataquety = "Select * FROM email WHERE type='rm' ORDER BY catID ASC, ID ASC";
            }elseif (isset($_GET['frl'])) {
                $dataquety = "Select * FROM email WHERE type='fr' ORDER BY catID ASC, ID ASC";
            }else {
                $dataquety = "Select * FROM email ORDER BY catID ASC, ID ASC";
            }
            if (isset($_GET['rml'])) {
    $urlset = "rml";
    }if (isset($_GET['all'])) {
        $urlset = "all";
    }if (isset($_GET['frl'])) {
        $urlset = "frl";
    }if (isset($_GET['new'])) {
        $urlset = "new";
    }else {
        $urlset = "";
    }
            $dbrun = mysqli_query($conn, $dataquety);
            $numrows = mysqli_num_rows($dbrun);
            if ($numrows > 0) {
                ?>
                <table class='table'>
                    <thead>
                        <tr class="row">
                            <th class="col-md-5">Type - Title - File</th>
                            <th class="col-md-7">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        while($row = mysqli_fetch_array($dbrun)){
                            ?>
                            <tr class="row">
                                <td class="col-md-5"><?php echo strtoupper($row['type'])." - ".ucwords($row['name'])." - (".$row['catID']."-".$row['emID'].".php)";?></td>
                                <td class="col-md-7">
                                    <div class="btn-group">
                                        <a href="?status=<?php echo $row['status'];?>&id=<?php echo $row['ID'];?>&<?php echo $urlset;?>" class="btn btn-<?php if($row['status'] == 1){echo "danger";}else{echo "Success";}?>">
                                            <?php if($row['status'] == 1){echo "De-Activate";}else{echo "Activate";}?>
                                        </a>
                                        <a href="?edit&id=<?php echo $row['ID'];?>" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-edit"></span> Edit
                                        </a>
                                        <a href="?cs&id=<?php echo $row['ID'];?>" target="_blank" class="btn btn-info">
                                            <span class="glyphicon glyphicon-new-window"></span> Open Template
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                        
            }
        }
            ?>
        </div>
    </div>
        <?php
    }
}
//script
if ($_POST['delete']) {
    $id= mysqli_real_escape_string($conn, $_POST['id']);
    $query="SELECT * FROM email WHERE ID=$id";
    $init = mysqli_query($conn, $query);
    $numrows = mysqli_num_rows($init);
    if ($numrows>0) 
    {
        $row = mysqli_fetch_array($init);
        $type= $row['type'];
        $name = $row['name'];
        $cat= $row['catID'];
        $em = $row['emID'];
    }
    if (file_exists("./email/$type/$cat-$em.php")) 
    {
       unlink("./email/$type/$cat-$em.php");
       if(unlink)
       {
           $query = "DELETE FROM email WHERE ID=$id";
           $query_init = mysqli_query($conn, $query);
           if ($query_init) 
           {
                $error= mysqli_error($conn);
                header("Refresh:0; url=?msg=<b>'$name'</b> and file located at <b>'$cat-$em.php'</b> have been successfully deleted");
                exit();
           }
           else
           {
                header("Refresh:0; url=?msg=File located at <b>'$cat-$em.php'</b> has been deleted; However, <b>'$name'</b> could not be deleted, SQL Error: $error");
               exit();
           }
       }
       else
       {
           header("Refresh:0; url=?msg=We were not able to delete <b>'$cat-$em.php'</b>, please try again.");
           exit();
       }
    }
    else
    {
        $query = "DELETE FROM email WHERE ID=$id";
        $query_init = mysqli_query($conn, $query);
        if ($query_init) 
        {
            header("Refresh:0; url=?msg=Deletion of <b>'$name'</b> is  Successful");
            exit();
        }
        else 
        {
            $error= mysqli_error($conn);
            header("Refresh:0; url=?msg=Something went wrong, <b>'$name'</b> could not be deleted. SQL Error: $error");
            exit();
        }
    }
    
        
}
if (isset($_POST['unlink'])) 
{
    $id= mysqli_real_escape_string($conn, $_POST['id']);
    $query="SELECT * FROM email WHERE ID=$id";
	$init = mysqli_query($conn, $query);
	$numrows = mysqli_num_rows($init);
	if ($numrows>0) 
	{
	    $row = mysqli_fetch_array($init);
	    $type= $row['type'];
	    $cat= $row['catID'];
	    $em = $row['emID'];
	}
	unlink("./email/$type/$cat-$em.php");
	header("Refresh:0; url=?edit&id=$id&msg='$cat-$em.php' has bee delted");
}
if ($_POST['upem']) 
{
    $id= mysqli_real_escape_string($conn, $_POST['id']);
    $query="SELECT * FROM email WHERE ID=$id";
    $init = mysqli_query($conn, $query);
    $numrows = mysqli_num_rows($init);
    if ($numrows>0) {
        $row = mysqli_fetch_array($init);
        $type= $row['type'];
        $cat= $row['catID'];
        $em = $row['emID'];
    }
    
    $filename = $_FILES["file"]["name"];
    $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
    $file_ext = substr($filename, strripos($filename, '.')); // get file name
    $allowed_file_types = array('.php','.doc','.docx','.rtf','.pdf');
    if (in_array($file_ext,$allowed_file_types))
    {	
        //Check Permisions
        if ($seclevel > 1)
        {
            header("Refresh:0; url=?edit&id=$id&msg=You are not authorized to upload.");
            exit();   
        }
    	// Rename file
    	$newfilename = $cat."-".$em . $file_ext;
    	if (file_exists("./email/$type/" . $newfilename))
    	{
    		// file already exists error
    		header("Refresh:0; url=?edit&id=$id&msg=You have already uploaded this file.");
            exit();	
    	}
    	else
    	{		
    		move_uploaded_file($_FILES["file"]["tmp_name"], "./email/$type/" . $newfilename);
    		header("Refresh:0; url=?edit&id=$id&msg=File Saved!");
            exit();		
    	}
    }
    elseif (empty($file_basename))
    {	
    	// file selection error
    	header("Refresh:0; url=?edit&id=$id&msg=Please select a file to upload.");
        exit();	
    	
    } 
    else
    {
    	// file type error
    	$extension = implode(', ',$allowed_file_types);
    	header("Refresh:0; url=?edit&id=$id&msg=Only these file typs are allowed for upload: $extension");
    	unlink($_FILES["file"]["tmp_name"]);
        exit();
    }
}

$conn->close();
include 'footer.php';
?>