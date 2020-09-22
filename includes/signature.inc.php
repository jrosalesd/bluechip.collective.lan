
<?php 
if (isset($status) && $status == false) {
    hoursOfOperation($status);
}else {
    hoursOfOperation();
}
?>
<p>Sincerely,</p>
<div>
    <p>
        <g class="text-capitalize">
            <?php 
                echo $SysName.".";
            ?>
        </g>
        <?php 
        echo "<br>".$role."<br>";
        echo $email."<br>";
        echo   "1 (888) 681-6811"."<br>";
        echo "www.spotloan.com";
        ?>
    </p>
</div>
        
        
</div>
