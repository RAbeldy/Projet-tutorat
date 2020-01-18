<?php
require_once('connexion.php');
require_once('models/users.php');
require_once('models/evenements.php');


class Admin
{
	


    public function __construct(){}


    public static function Get_my_tutores($id_admin) // liste des tutores qui appartiennent à un type de tutorat
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.ecole,u.niveau,u.email,u.phone,a.ville ,a.adress ,a.code_postal,e.libelle as libelle  FROM user as u,adresse as a, avoir_statut as at, tutores as t, se_destine as se, administrer as ad,etat as e WHERE e.id_etat= at.id_etat AND  at.id_user = u.id_user AND t.id_tutores= u.id_user AND   u.id_adresse = a.id_adresse AND t.id_tutores= se.id_user AND  se.id_tutorat= ad.id_tutorat AND se.id_typeTutorat = ad.id_typeTutorat AND ad.id_admin= ?  ORDER BY nom ASC");
        $req->execute(array($id_admin));
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEcole($data['ecole']);
        $users->setNiveau($data['niveau']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        $users->setAdress($data['adress']);
        $users->setVille($data['ville']);
        $users->setCode_postal($data['code_postal']);

        $list []= array('user'=>$users,'etat'=>$data['libelle']);
      }
      return $list ;
        
    }
    
    public static function Get_tutores_signedUp_event($id_admin) // liste des tutores qui ont participé une fois à un de mes evenements
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,a.ville ,a.adress ,a.code_postal FROM user as u, avoir_statut as at, tutores as t, participer_evenement as pe, evenement as e, tutorat as tu, adresse as a WHERE at.id_user = u.id_user AND t.id_tutores= u.id_user AND u.id_adresse = a.id_adresse AND t.id_tutores= pe.id_user AND e.id_evenement= pe.id_evenement AND e.id_tutorat = tu.id_tutorat AND e.id_user= ? AND pe.date_evenement > NOw() ORDER BY nom ASC");
        $req->execute(array($id_admin));
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        $users->setAdress($data['adress']);
        $users->setVille($data['ville']);
        $users->setCode_postal($data['code_postal']);

        $list []= array('user'=>$users);
      }
      return $list ;
    }

    public static function Get_all_tuteurs()  // liste de tous les  tuteurs 
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.ecole,u.niveau,u.email,u.phone,a.ville ,a.adress ,a.code_postal,e.libelle as libelle FROM user as u,adresse as a, avoir_statut as at,tuteurs as t,etat as e WHERE   at.id_user = u.id_user AND at.id_etat = e.id_etat AND   u.id_adresse = a.id_adresse  AND  t.id_tuteurs= u.id_user  ORDER BY nom ASC");
      
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEcole($data['ecole']);
        $users->setNiveau($data['niveau']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        $users->setAdress($data['adress']);
        $users->setVille($data['ville']);
        $users->setCode_postal($data['code_postal']);

        $list []= array('user'=>$users,'etat'=>$data['libelle']);
      }
      return $list ;
        
    }
    public static function Get_all_tutores()  // liste de tous les  tutores
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.ecole,u.niveau,u.email,u.phone,a.ville ,a.adress ,a.code_postal,e.libelle as libelle FROM user as u,adresse as a, avoir_statut as at,tutores as t,etat as e WHERE at.id_user = u.id_user AND at.id_etat = e.id_etat AND u.id_adresse = a.id_adresse AND t.id_tutores= u.id_user  ORDER BY nom ASC");
        
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEcole($data['ecole']);
        $users->setNiveau($data['niveau']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        $users->setAdress($data['adress']);
        $users->setVille($data['ville']);
        $users->setCode_postal($data['code_postal']);

        $list []= array('user'=>$users,'etat'=>$data['libelle']);
      }
      return $list ;
        
    }
    public static function Not_selected_tuteurs($id_admin)  // liste des tuteurs qui n'ont pas déja été sélectionné
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.ecole,u.niveau,u.email,u.phone,a.ville ,a.adress ,a.code_postal FROM user as u,adresse as a, avoir_statut as at,tuteurs as t WHERE   at.id_user = u.id_user AND  u.id_adresse = a.id_adresse  AND  t.id_tuteurs= u.id_user AND u.id_user NOT IN(SELECT id_user FROM se_destine as se, administrer as a WHERE se.id_tutorat = a.id_tutorat AND se.id_typeTutorat = a.id_typeTutorat AND a.id_admin= ?) ORDER BY nom ASC");
        $req->execute(array($id_admin));
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEcole($data['ecole']);
        $users->setNiveau($data['niveau']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        $users->setAdress($data['adress']);
        $users->setVille($data['ville']);
        $users->setCode_postal($data['code_postal']);

        $list []= array('user'=>$users);
      }
      return $list ;
        
    }
    public static function Selected_tuteurs($id_admin) // liste des tuteurs qu'un admin a choisi et qui ont accepté de travailler pour ce tutorat 
    {
      $db = Db::getInstance();
      $list=[];
      $req= $db->prepare("SELECT u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone ,a.ville ,a.adress ,a.code_postal,se.liaison,tt.id_tutorat as id_tutorat,tt.libelle as libelle  FROM user as u,adresse as a, avoir_statut as at,tuteurs as t, se_destine as se,administrer as ad,tutorat as tt WHERE at.id_user = u.id_user AND  u.id_adresse = a.id_adresse AND t.id_tuteurs= u.id_user AND tt.id_tutorat= se.id_tutorat AND  ad.id_tutorat = se.id_tutorat AND ad.id_typeTutorat = se.id_typeTutorat AND ad.id_admin= ? AND t.id_tuteurs= se.id_user AND se.liaison = 'OUI' ORDER BY nom ASC ");
      $req->execute(array($id_admin));

      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        $users->setAdress($data['adress']);
        $users->setVille($data['ville']);
        $users->setCode_postal($data['code_postal']);

        $list []= array('user'=>$users,'se_destine'=>$data['liaison'],'tutorat'=>$data['id_tutorat'],'libelle'=>$data['libelle']);
      }
      return $list ;
    } 
    
    public static function Get_all_proposal($id_admin) // récupère la liste de toutes les propositions envoyées
    {
       $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT tt.libelle as libelle_type, t.id_tutorat as id_tutorat,t.libelle as libelle,u.id_user,u.nom,u.prenom,u.email FROM user as u, administrer as a, type_tutorat as tt, tutorat as t,se_destine as se,tuteurs as tu WHERE a.id_tutorat= se.id_tutorat AND a.id_typeTutorat= se.id_typeTutorat AND se.id_tutorat= t.id_tutorat AND se.id_typeTutorat = t.id_typeTutorat AND tt.id_typeTutorat= t.id_typeTutorat AND u.id_user= se.id_user AND tu.id_tuteurs= se.id_user AND se.liaison='NON' AND  a.id_admin= ?  ");
        $req->execute(array($id_admin));

        foreach ($req->fetchAll() as $data)
                  {
                    $users= new Users();
                    $users->setId_user($data['id_user']);
                    $users->setNom($data['nom']);
                    $users->setPrenom($data['prenom']);
                    $users->setEmail($data['email']);

                    $list []= array( 'user'=>$users,'type_tutorat'=>$data['libelle_type'],'libelle'=>$data['libelle'],'tutorat'=>$data['id_tutorat']);
                  }
                  return $list ;
    }

    public static function Get_sent_proposal($id_tuteur,$id_tutorat,$id_admin) // récupérer les informations d'une proposition(en particulier) de travail envoyée à un tuteur
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT tt.libelle as libelle_type, t.id_tutorat as id_tutorat,t.libelle as libelle,u.id_user,u.nom,u.prenom,u.email FROM user as u, administrer as a, type_tutorat as tt, tutorat as t,se_destine as se WHERE a.id_tutorat= se.id_tutorat AND a.id_typeTutorat= se.id_typeTutorat AND se.id_tutorat= t.id_tutorat AND se.id_typeTutorat = t.id_typeTutorat AND tt.id_typeTutorat= t.id_typeTutorat AND u.id_user= se.id_user AND se.id_user= ? AND se.id_tutorat = ? AND a.id_admin= ?  ");
        $req->execute(array($id_tuteur,$id_tutorat,$id_admin));

        foreach ($req->fetchAll() as $data)
                  {
                    $users= new Users();
                    $users->setId_user($data['id_user']);
                    $users->setNom($data['nom']);
                    $users->setPrenom($data['prenom']);
                    $users->setEmail($data['email']);

                    $list = array( $users,$data['libelle_type'],$data['libelle'],$data['id_tutorat']);
                  }
                  return $list ;

    }
    public static function Send_selection_mail($prenom,$nom,$email,$type_tutorat,$tutorat) // envoyer un mail de confirmation de sélection
    {
        require 'connectToMail.php';
        require 'PHPMailer/PHPMailerAutoload.php';
        $mailAccount = 'contact_admin@tutorat-yncrea.fr';
        
        //Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
        $message_txt = 'Bonjour Mr/Mme '.$prenom.' '.$nom.',\nVous avez été sélectionné pour participer aux évènements qui se déroulent à '.$tutorat.' du tutorat de la '.$type_tutorat.' .\n Veuillez donc vous connecter sur votre espace pour accepter ou non cette offre.\nCe message est généré automatiquement, veuillez ne pas répondre.';
        $message_html ='<html><head></head><body><p>Bonjour Mr/Mme '.$prenom.' '.$nom.', </p><p>Vous avez été sélectionné pour participer aux évènements qui se déroulent à <b>'.$tutorat.'</b> du tutorat de la <b>'.$type_tutorat.'</b>.</p><p>Veuillez donc vous connecter sur votre espace pour accepter ou non cette offre.</b></p><p>Ce message est généré <b>automatiquement</b>, veuillez <b>ne pas répondre</b>.</p></body></html>';
                //Sujet
        $sujet = "[Yncrea tutorat] Sélection pour le tutorat intitulé ".$tutorat." ";
                //envoie du mail
        
        $login_mail= $email;
        include('send_mail.php');
    }

    public static function Send_proposal($id_tuteur,$id_tutorat) // l'admin choisit(envoi une proposition de sélection) un tuteur qui sera d'office inscrit à ses évènements quand il en créera, ceci en passant l'attribut appartenance à la bonne valeur
    {
        $db = Db::getInstance();
         
        $req= $db->prepare("INSERT INTO se_destine(id_user,id_tutorat,id_typeTutorat,demande) VALUES(?,?,(SELECT id_typeTutorat FROM tutorat WHERE id_tutorat = ?),'OUI') ");
        $req->execute(array($id_tuteur,$id_tutorat,$id_tutorat));

        //$req= $db->query("UPDATE tuteurs SET demande = 'OUI' WHERE id_tuteurs= ".$id_tuteur." ");
       
    }
    
    public static function Cancel_proposal($id_tuteur,$id_tutorat) // l'admin annule la participation d'un tuteur  à ses évènements quand il en créera, ceci en passant l'attribut appartenance à la bonne valeur
    {
        $db = Db::getInstance();

        $req = $db->prepare("DELETE FROM se_destine  WHERE id_user = ? AND id_tutorat=?");
        $req->execute(array($id_tuteur,$id_tutorat));

        //$req= $db->query("UPDATE tuteurs SET demande = 'NON' WHERE id_tuteurs= ".$id_tuteur." ");
    }

    
    public static function Get_free_tuteurs() // liste des tutorés affiliés à l'admin et pouvants éffectuer des liaisons avec ses tutorés
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT u.id_user,u.nom,u.prenom FROM user as u, tuteurs as t WHERE u.id_user = t.id_tuteurs AND t.nb_linksmef <= t.nb_max_mef    ");

        foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
         $list []= array('user'=>$users);
      }
      return $list ;
    }

    public static function link($id_tuteur,$id_tutore) // lier un tuteur et un tutoré
    {
        $db = Db::getInstance();
        
        $nb= Admin::Get_nb_links($id_tuteur) ;
        while ( $data= $nb->fetch()) {
           $nb1 = $data['nb_linksmef'];
           $nb2 = $data['nb_max_mef'];
        }
         
        if( $nb1 < $nb2) // on vérifie que le nombre de liaisons est inférieure à celui défini
        {
            
            $req = $db->prepare(" INSERT INTO matchs (id_tuteurs,id_tutores) VALUES (?,?)");
            $req->execute(array($id_tuteur,$id_tutore));
            
            // l'etat du tutoré passe à occupé
            $req = $db->prepare("UPDATE avoir_statut SET id_etat = (SELECT id_etat FROM etat WHERE libelle = 'OCCUPE') WHERE id_user = ?");
            $req->execute(array($id_tutore));

           
            $nb1= ($nb1 + 1);

            $req= $db->query("UPDATE tuteurs SET nb_linksmef= ".$nb1." WHERE id_tuteurs= ".$id_tuteur."");

            return 0;
        }
        else
        {
             // l'etat du tuteur passe à occupé
            $req = $db->prepare("UPDATE avoir_statut SET id_etat = (SELECT id_etat FROM etat WHERE libelle = 'OCCUPE') WHERE id_user = ?");
            $req->execute(array($id_tuteur));
            return 1;
        }  
    }

    public static function Get_nb_links($id_tuteur) // nombre de liaisons dans le cadre de la mef
    {
        $db = Db::getInstance();

        $req= $db->query("SELECT nb_linksmef,nb_max_mef FROM tuteurs  WHERE id_tuteurs= ".$id_tuteur." ");
        
        
        return $req;
    }
    
    /* on ne va pas leur permmettre de mettre fin à leur collaboration seul un admin pourra le faire ou alors automatiquement à la fin d'une année*/
    public static function Delete_link($id_tutore)
    {
       $db= Db::getInstance();
       $id= $db->query("SELECT id_tuteurs FROM matchs WHERE id_tutores= ".$id_tutore.""); // on récupère l'id du tuteur avec qui il est en relation
       $id_tuteur= $id->fetch()['id_tuteurs'];
       
       $nb= Admin::Get_nb_links($id_tuteur) ;
       while ( $data= $nb->fetch()) {
           $nb1 = $data['nb_linksmef'];
           $nb2 = $data['nb_max_mef'];
        }
        $nb1= ($nb1 - 1);

        $req= $db->prepare("UPDATE en_attente SET date_fin= ?, statut_liaison= 'INACTIF' WHERE id_tutores= ? AND statut_liaison ='ACTIF'");
        $req->execute(array(date("Y-m-d H:i:s"),$id_tutore));

        $req= $db->prepare("UPDATE tuteurs SET nb_linksmef= ? WHERE id_tuteurs= ? ");
        $req->execute(array($nb1,$id_tuteur));

        $req = $db->prepare(" DELETE FROM matchs WHERE id_tutores= ? ");
        $req->execute(array($id_tutore)); 

        // l'etat du tutoré passe à libre
        $req = $db->prepare("UPDATE avoir_statut SET id_etat = (SELECT id_etat FROM etat WHERE libelle = 'LIBRE') WHERE id_user = ?");
        $req->execute(array($id_tutore));

        
    }
    
    public static function Validate_hours($id_e,$id_tuteur,$duree)
    {
        $db = Db::getInstance();

        $req= $db->prepare("UPDATE participer_evenement SET valide='OUI' WHERE id_evenement=? AND id_user= ?");
        $req->execute(array($id_e,$id_tuteur));
        
        // on insère dans la table de validation des heures
        $req= $db->prepare("INSERT INTO validation_heure(id_evenement,id_tuteurs,durée) VALUES(?,?,?)");
        $req->execute(array($id_e,$id_tuteur,$duree));
    }
    
    public static function Create_pdf($path,$header)  // la variable header correspond aux titres de colonnes du pdf
    {
       
        

        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Europe/London');

        if (PHP_SAPI == 'cli')
            die('This example should only be run from a Web Browser');

        /** Include PHPExcel */
        require('PHPExcel-1.8/Classes/PHPExcel/PHPExcel.php');


        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                                     ->setLastModifiedBy("Maarten Balliauw")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");


        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Hello')
                    ->setCellValue('B2', 'world!')
                    ->setCellValue('C1', 'Hello')
                    ->setCellValue('D2', 'world!');

        // Miscellaneous glyphs, UTF-8
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A4', 'Miscellaneous glyphs')
                    ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

                //require_once('models/excel.php');


            }





    //gestion compte
    
    public static function WaitCompte($statut)
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT DISTINCT u.id_user,u.nom,u.prenom, at.id_statut as statut FROM user as u,avoir_statut as at, statut_compte as sc WHERE u.id_user= at.id_user AND at.id_statut=? AND at.id_statut_compte= 2 ORDER BY nom ASC");
        $req->execute(array($statut));
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        

        $list []= array('user'=>$users, 'statut'=>$data['statut']);
      }
      return $list ;
    }
    
    
    
    public static function TuteurCompte($id_tuteur)
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,u.niveau, u.ecole,a.ville,a.adress, a.complement_Adress ,a.code_postal FROM user as u, adresse as a, avoir_statut as at WHERE u.id_user= at.id_user AND u.id_adresse= a.id_adresse AND u.id_user=?");
        $req->execute(array($id_tuteur));
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        $users->setAdress($data['adress']);
        $users->setCom_adress($data['complement_Adress']);
        $users->setVille($data['ville']);
        $users->setCode_postal($data['code_postal']);
        $users->setNiveau($data['niveau']);
        $users->setEcole($data['ecole']);

      }
      return $users ;
    }
    
    
    public static function TutoreCompte($id_tutore)
    {
        
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.date_naissance,u.email,u.phone,u.niveau, u.ecole,a.ville,a.adress, a.complement_Adress ,a.code_postal, t.bourse as bourse, t.nationalite as nationalite FROM user as u, adresse as a, avoir_statut as at, tutores as t WHERE u.id_user= at.id_user AND u.id_adresse= a.id_adresse AND t.id_tutores=u.id_user AND u.id_user=?");
        $req->execute(array($id_tutore));
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setDate_naissance($data['date_naissance']);
        $users->setEmail($data['email']);
        $users->setPhone($data['phone']);
        $users->setAdress($data['adress']);
        $users->setCom_adress($data['complement_Adress']);
        $users->setVille($data['ville']);
        $users->setCode_postal($data['code_postal']);
        $users->setNiveau($data['niveau']);
        $users->setEcole($data['ecole']);
        
        $list []= array('user'=>$users, 'bourse'=>$data['bourse'], 'nationalite'=>$data['nationalite']);
      }
      return $list ;
    }
    
    public static function ValiderCompte($id_user)
    {
        require 'connectToMail.php';
        require 'PHPMailer/PHPMailerAutoload.php';

        $db = Db::getInstance();

        $data= Users::Get_info($id_user); 

       
           //Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
        $message_txt = 'Bonjour Mr/Mme '.$data->getPrenom().' '.$data->getNom().',\nNous avons le plaisir de vous annoncer que votre compte a été validé.Vous pouvez dès à présent vous connecter.Pour toute question subsidiaire , veuillez contacter l\'administrateur\n .\nCe message est généré automatiquement, veuillez ne pas répondre.';
        $message_html ='<html><head></head><body><p>Bonjour Mr/Mme '.$data->getPrenom().' '.$data->getNom().', </p><p>Nous avons le plaisir de vous annoncer que votre compte a été validé.Vous pouvez dès à présent vous connecter. Pour toute question subsidiaire  veuillez contacter l\'administrateur.</p><p>Ce message est généré <b>automatiquement</b>, veuillez <b>ne pas répondre</b>.</p></body></html>';
                //Sujet
        $sujet = "[Yncrea tutorat] Compte validé  ";
                //envoie du mail
         
        $login_mail= $data->getEmail();
        include('send_mail.php');
         
    
        $req= $db->prepare("UPDATE avoir_statut as at SET at.id_statut_compte=1 WHERE at.id_user=?");
        $req->execute(array($id_user));
    }
    
    public static function WihtOutBourse()
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.ecole FROM user as u, tutores as t WHERE u.id_user= t.id_tutores AND t.bourse IS NULL ORDER BY nom ASC");
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setEcole($data['ecole']);


        $list []= array('user'=>$users);
      }
      return $list ;
    }
    
    public static function WithBourse()
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->query("SELECT DISTINCT u.id_user,u.nom,u.prenom,u.ecole FROM user as u, tutores as t WHERE u.id_user= t.id_tutores AND t.bourse IS NOT NULL ORDER BY nom ASC");
        
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        $users->setEcole($data['ecole']);

        $list []= array('user'=>$users);
      }
      return $list ;
    }
    
    
    public static function ValiderBourse($id_user)
    {
        $db = Db::getInstance();
        $req= $db->prepare("UPDATE tutores as t SET t.bourse='OUI' WHERE t.id_tutores=?");
        $req->execute(array($id_user));
    }
    
    public static function Compte($id_statut)
    {
        $db = Db::getInstance();
        $list=[];
        $req= $db->prepare("SELECT DISTINCT u.id_user,u.nom,u.prenom, at.id_statut as statut, sc.libelle as libelle, sc.id_statut_compte as id_libelle FROM user as u,avoir_statut as at, statut_compte as sc WHERE u.id_user= at.id_user AND sc.id_statut_compte= at.id_statut_compte AND at.id_statut=? AND u.id_user NOT IN (SELECT u.id_user FROM user as u , suivi_administrateurs as sa WHERE u.id_user=sa.id_user) ORDER BY nom ASC");
        $req->execute(array($id_statut));
        
      foreach ($req->fetchAll() as $data)
      {
        $users= new Users();
        $users->setId_user($data['id_user']);
        $users->setNom($data['nom']);
        $users->setPrenom($data['prenom']);
        

        $list []= array('user'=>$users, 'statut'=>$data['statut'], 'libelle'=>$data['libelle'], 'id_libelle'=>$data['id_libelle']);
      }
      return $list ;
    }
    
    
    public static function AnnulCompte($id_user)
    {
        require 'connectToMail.php';
        require 'PHPMailer/PHPMailerAutoload.php';

        $db = Db::getInstance();

        $data= Users::Get_info($id_user); 

       
           //Déclaration du message au format texte et au format html (selon ce que les webmails supportent)
        $message_txt = 'Bonjour Mr/Mme '.$data->getPrenom().' '.$data->getNom().',\nNous vous annoncons avec infortune que votre compte a été désactivé.Pour toute procédure de recours veuillez contacter l\'administrateur\n .\nCe message est généré automatiquement, veuillez ne pas répondre.';
        $message_html ='<html><head></head><body><p>Bonjour Mr/Mme '.$data->getPrenom().' '.$data->getNom().', </p><p>Nous vous annoncons avec infortune que votre compte a été désactivé. Pour toute procédure de recours veuillez contacter l\'administrateur.</p><p>Ce message est généré <b>automatiquement</b>, veuillez <b>ne pas répondre</b>.</p></body></html>';
                //Sujet
        $sujet = "[Yncrea tutorat] Compte désactivé  ";
                //envoie du mail
         
        $login_mail= $data->getEmail();
        include('send_mail.php');
         

      
        $req= $db->prepare("UPDATE avoir_statut as at SET at.id_statut_compte=2 WHERE at.id_user=?");
        $req->execute(array($id_user));
    }
    
    
}

    