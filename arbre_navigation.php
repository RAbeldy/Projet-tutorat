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
            return $tab;
 ?>
