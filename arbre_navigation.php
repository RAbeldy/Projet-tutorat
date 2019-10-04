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


							<div id="navigation_tree" class="col-9 offset-1 space">
								<span class="navig_flech">
									<a href="?controller=<?=$elt['controller'];?>&action=<?=$elt['action'];?>"><?= $action;?> </a>
									>
								</span>
							</div>
                    <?php
                }
     ?>
