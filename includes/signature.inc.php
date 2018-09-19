
<?php hoursOfOperation($status);?>
<p>Sincerely,</p>
<div>
    <p >
        <g class="text-capitalize">
            <?php 
            if($role == "Help@ Representative"){
                echo "Spotloan Help Team";
            }else{
                echo $SysName.".";
            }
            ?>
        </g>
        
            <?php 
            if($role != "Help@ Representative"){
                echo "<br>".$role;
            }
            ?>
        <br>
        <?php
        if($role == "Debt Consolidation"){
            echo "debtconsolidation@spotloan.com"."<br>";
        }elseif($role == "Relationship Manager" || $role == "Help@ Representative"){
            echo "help@spotloan.com"."<br>";
        }else{
            echo $email."<br>";
        }
        
        if($role !="Relationship Manager" && $role !="Collection Manager" && $role != "Help@ Representative"){
            echo "1 (888) 681-6811 <br>1 (701) 248-7277(Fax)"."<br>";
        }else{
            echo   "1 (888) 681-6811"."<br>";
        }
        ?>
        www.spotloan.com 
    </p>
</div>
        
        
</div>
