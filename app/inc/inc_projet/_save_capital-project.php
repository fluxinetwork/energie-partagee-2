<?php
$rows_capital = get_field('repartition_du_capital');
$count_financer = 0;
$count_financer_2 = 0;

$total_capital = 0;

$array_citoyen = array();
$array_prive = array();

if($rows_capital){ ?>
    <aside class="repartition">
       <h3 class="h3">Répartition du capital</h3>
    
       <p><?php echo get_field('text_intro_capital'); ?></p>        
       
       <?php          
       echo '<div class="graphbar wrap-extend">';				
		   foreach($rows_capital as $row){
				$id_financer='';
				$total_capital = $total_capital + $row['capital'];
				
			   if($row['financement_prive'] == 1):
					$type_financer = ' prive';
					$count_financer++;
					$id_financer = 'id="segment-prive-' . $count_financer . '"';
					
					//$array_prive [] = '<div class="graphbar__segment' . $type_financer . '" ' . $id_financer . ' style="width:20%;"></div>';
				else:
					$type_financer = ' citoyen';
					
					//$array_citoyen [] = '<div class="graphbar__segment' . $type_financer . '" ' . $id_financer . ' style="width:20%;"></div>';
				endif;					
							
			   echo '<div class="graphbar__segment' . $type_financer . '" ' . $id_financer . ' style="width:20%;"></div>';
		   }	
       echo '</div>';            
       ?>
    
        <div class="infosbloc">
          <div class="pointe--up" style="left:60%;"></div>
          <h4>Projet citoyen à <?php echo $total_capital;?><span class="percent">60%</span></h4>
          <?php
          
            echo '<ul>';	
                foreach($rows_capital as $row){                    
                     $id_financer='';
					   if($row['financement_prive'] == 1):
							$type_financer = ' prive';
							$count_financer_2++;
							$id_financer = 'id="financer-prive-' . $count_financer_2 . '"';
						else:
							$type_financer = ' citoyen';
						endif;	
                    
                    echo '<li class="financer' . $type_financer . '" ' . $id_financer . '><div class="dot"></div><span class="legende">' . $row['nom_financeur'] . '</span><span>' . $row['capital'] .'</span></li>';
                }	
            echo '</ul>';
            
          ?>      
        </div>
    </aside>
<?php } ?>