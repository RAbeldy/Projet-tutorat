<?php
require_once('connexion.php');

$db = Db::getInstance();

$id=$_GET['id_e'];
$user= $_GET['id'];

function Subscribe_event($id,$user) // souscrire à un évènement
    {
       $db = Db::getInstance();
       

       $nb_part= Get_nb_places($id);
       $nb_insc= Get_nb_inscrits($id);
       $nb= 1; //  ($nb_part->fetch()['nb_tuteurs'] - $nb_insc->fetch()['rowcount']);
       if($nb > 0) // encore de la place pour inscription
       {
        $req= $db->prepare("INSERT INTO participer_evenement (id_evenement,id_user,date_inscription) VALUES(?,?,NOW())");
        $req->execute(array($id,$user));

        $req= $db->prepare("INSERT INTO evenement(nb_places) VALUES (?) WHERE id_evenement= $id");
        $req->execute(array(($nb-'1')));
        }
    
        return $nb;
        
    }

     function Cancel_participation($id,$user)
    {
        $db = Db::getInstance();
       

        $nb_part= Get_nb_places($id);
        $nb_insc= Get_nb_inscrits($id);
        $nb=  ($nb_part->fetch()['nb_tuteurs'] - $nb_insc->fetch()['rowcount']);

        $req= $db->query("DELETE FROM participer_evenement WHERE id_evenement= $id  AND id_user= $user ");
        $req= $db->prepare("INSERT INTO evenement(nb_places) VALUES (?)");  // on met à jour le nombre de places
        $req->execute(array(($nb+'1')));
    }

     function Get_nb_inscrits($id) // le nombre de tuteurs deja. inscrits à l'évènement
    {
        $db = Db::getInstance(); 
       

        $req= $db->prepare("SELECT count(id_evenement) as rowcount FROM participer_evenement WHERE id_evenement= ?");
        $req->execute(array($id));

        return $req;
    }

      function Get_nb_places($id) // nombre de places à pourvoir pour l'évènement
    {
        $db = Db::getInstance();
        

        $req= $db->prepare("SELECT nb_tuteurs FROM evenement  WHERE id_evenement= ?");
        $req->execute(array($id));

        return $req;
    }




                if(isset($_GET['action']) AND $_GET['action']== 'inscrire')
				{
	                 
	                 if(Subscribe_event($id,$user) > 0)
	                 require_once('index.php?controller=evenements&action=Display_future_events');
	                else
	                {   
	                    $message = 'l\'évènement est complet';
	                    $controller_report='evenements';
	                    $fonction_back='Display_future_events';
	                    require_once('views/system/error.php');
	                }
                }
                elseif(isset($_GET['action']) AND $_GET['action']== 'annuler')
                {
	                 if(isset($_GET['id_e']) )
	                 {
	                  Cancel_participation($id,$user);
	                  header('location:index.php?controller=evenements&action=Display_subscribed_events');
	                 }
	                 else
	                {   $message = 'erreur lors de l\'annulation';
	                    $controller_report='evenements';
	                    $fonction_back='Display_subscribed_events';
	                    require_once('views/system/error.php');
	                }
                }
			    else
			      {
			        require_once('views/login.php');
			      }
    
                



            
         

?>
 <td><a href="traitement.php?id_e=<?=$data['id_evenement']?>&amp;action=inscrire&amp;id=<?=$_SESSION['id_user']?>"><button class="btn" type="button" name="s'inscrire" onclick="javascript:alert();">S'inscrire</button></a></td>
