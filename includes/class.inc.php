<?php
class Sch{
    public $schedule;
    
    public function __construct($schedule =""){
        $this->schedule = $schedule;
    }
    
    public function schedule(){
        $schedule = str_ireplace("\t"," ",$this->schedule);
        $schedule = str_ireplace("\n"," ",$schedule);
        $schedule = str_ireplace("  "," ",$schedule);
        $schedule = str_ireplace(" ",",",$schedule);
        $schedule = explode(",",$schedule);
        
        $i=-1;
        foreach($schedule as $key => $item){
            if ($key % 6 == 0) {
               $i++;
            }
            
            $main[$i][] = trim(str_ireplace("$","",$item));
        }
        return $main;
    }
    
    public function SchPost(){
        $schedule = $this->schedule();
        //create schedule
        
        ?>
        <h3 class="offset25px">Payment Schedule</h3>
        <div class="offset25px">
            <ul class="schl">
                <li> Date - Amount</li>
                <?php
                for ($i = 0; $i < count($schedule); $i++) {
                    ?>
    				<li><?php echo date_format(date_create($schedule[$i][0]),"D, M jS");?> - <?php echo "$".number_format($schedule[$i][1],2,".",",");?></li>
    				<?php
                }
                ?>
            </ul>
        </div>
        <?php
    }
    
    public function CompleteSchedule() {
        $schedule = $this->schedule();
        
        //Create Schedule
        ?>
        <h3 class="offset25px">Payment Schedule</h3>
        
        <div class="offset25px">
            <ul class="schl">
                <li>Date - Amount - Principal - Interest</li>
                <?php
                for ($i = 0; $i < count($schedule); $i++) {
                    ?>
    				<li>
    				    <?php 
    				    for ($j = 0; $j < count($schedule[$i]); $j++) {
    				        
    				    }
    				    echo date_format(date_create($schedule[$i][0]),"D, M jS");?> - <?php echo "$".number_format($schedule[$i][1],2,".",",");?> - <?php echo "$".number_format($schedule[$i][3],2,".",",");?> - <?php echo "$".number_format($schedule[$i][4],2,".",",");?>
    				</li>
    				<?php
                }
                ?>
            </ul>
        </div>
        <?php
        
    }
    
    public function forms(){
        ?>
			<div class="form-group">
				<label for="schType">Schedule Outcome</label>
				<select name="schType" id="schType" class="form-control" required>
					<option value="">Select One</option>
					<option value="0">Date-Amount</option>
					<option value="1">Complete Schedule</option>
				</select>
			</div>
			<div class="form-group">
				<label for="brwName">
					Payment Schedule
				</label>
				<textarea class="form-control text-left " name="pmthist" rows="10" required></textarea>
			</div>
        <?php
    }
}






