<?php
$rows_capital = get_field('repartition_du_capital');
$count_financer = 0;
$count_financer_2 = 0;

$total_capital = 0;

$array_citoyen_labels = array();
$array_prive_labels = array();
$array_citoyen_datas = array();
$array_prive_datas = array();

if($rows_capital){ 
	// Label loop
	foreach($rows_capital as $row){
		$id_financer='';
		$total_capital = $total_capital + $row['capital'];					
		if($row['financement_prive'] == 1):
			$type_financer = ' prive';
			$count_financer++;
			$id_financer = 'id="segment-prive-' . $count_financer . '"';						
			$array_prive_labels [] = '<div class="graphbar__segment' . $type_financer . '" ' . $id_financer . ' style="width:20%;"></div>';
		else:
			$type_financer = ' citoyen';						
			$array_citoyen_labels [] = '<div class="graphbar__segment' . $type_financer . '" ' . $id_financer . ' style="width:20%;"></div>';
		endif;					
	}
	// Data loop
	foreach($rows_capital as $row){                    
    	$id_financer='';
		if($row['financement_prive'] == 1):
			$type_financer = ' prive';
			$count_financer_2++;
			$id_financer = 'id="financer-prive-' . $count_financer_2 . '"';
			$array_prive_datas [] = '<li class="financer' . $type_financer . '" ' . $id_financer . '><div class="dot"></div><span class="legende">' . $row['nom_financeur'] . '</span><span>' . $row['capital'] .'</span></li>';
		else:
			$type_financer = ' citoyen';
			$array_citoyen_datas [] = '<li class="financer' . $type_financer . '" ' . $id_financer . '><div class="dot"></div><span class="legende">' . $row['nom_financeur'] . '</span><span>' . $row['capital'] .'</span></li>';
		endif;	               
    }
	// Output	
	?>
    
    <aside class="repartition">
       <h3 class="h3">Répartition du capital</h3>
    
       <p><?php echo get_field('text_intro_capital'); ?></p>        
       
       <?php          
       echo '<div class="graphbar wrap-extend">';				
		   
		   // Print citoyen first
			foreach ($array_citoyen_labels as $key => $val) {
				echo $val;
			}
			// Print prive second
			foreach ($array_prive_labels as $key => $val) {
				echo $val;
			}		   
		   	
       echo '</div>';            
       ?>
    
        <div class="infosbloc">
          <div class="pointe--up" style="left:60%;"></div>
          <h4>Projet citoyen à <?php echo $total_capital;?><span class="percent">60%</span></h4>
          <?php
          
            echo '<ul>';	
               // Print citoyen first
				foreach ($array_citoyen_datas as $key => $val) {
					echo $val;
				}
				// Print prive second
				foreach ($array_prive_datas as $key => $val) {
					echo $val;
				}	
            echo '</ul>';
            
          ?>      
        </div>
    </aside>
<?php } ?>