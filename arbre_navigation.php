    <?php      
              
              if(isset($tab))
              {      
			         if(preg_match('#interface#', $action))
			         	$tab=[];
			         else
			            array_push($tab, array('controller'=>$controller, 'action'=>$action));
			  }
              else
              	$tab [] = array('controller'=>$controller, 'action'=>$action);
                
                foreach ($tab as $elt) 
                {
                	?>
                
                            <div class="row">
                                <div class="offset-md-2 col-md-10 space">
                                    <span class="navig_flech">
                                        <a href="?controller=<?=$elt['controller'];?>&action=<?=$elt['action'];?>"><?= $action;?> </a>
                                        > 
                                        
                                    </span>
                                </div>
                            </div>
                    <?php
                }
     ?>