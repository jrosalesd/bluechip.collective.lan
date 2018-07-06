<?php
include 'dbh.inc.php';

if (isset($_POST['import'])) {
    if ($_FILES['file']['name']){
        // check if file is CSV
        $filename = explode(".", $_FILES['file']['name']);
        if ($filename[1] == 'csv') {
            // get data from file
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            while($data = fgetcsv($handle)){
                $Loan_ID = mysqli_real_escape_string($conn, $data[0]);
                $Balance = mysqli_real_escape_string($conn, $data[1]);
                $Buyer = mysqli_real_escape_string($conn, $data[2]);
                $Sold_Date = mysqli_real_escape_string($conn, $data[4]).'/'.mysqli_real_escape_string($conn, $data[5]).'/'.mysqli_real_escape_string($conn, $data[6]);
                $sql = "INSERT INTO soldlist(Loan_ID, Balance, Buyer, Sold_Date) VALUES ('$Loan_ID', '$Balance', '$Buyer',' $Sold_Date')";
                mysqli_query($conn, $sql);
            }
            
            fclose($handle);
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                header("Location: ../soldlist.php?msg=Upload successful");
                exit();
            }else {
                header("Location: ../soldlist.php?msg=Something went wrong, Unable to upload your file ");
                exit();
            }
            
        }else {
            header("Location: ../soldlist.php?msg=only csv files are allowed");
            exit();
        }
    }else{
        header("Location: ../soldlist.php?msg=No file selected");
        exit();
    }
}else{
    header("Location: ../soldlist.php");
}
