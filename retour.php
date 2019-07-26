<?php 
$backUrl = '';
if (isset($controller_report) && isset($fonction_back)) 
{
    $backUrl = '?controller='.$controller_report.'&action='.$fonction_back;
    foreach ($_GET as $key => $value) {
        if (($key != 'controller') && ($key != 'action')) {
            //Paramètre transmis pour le retour!
            $backUrl .= '&'.$key.'='.$value;
        }
    }
} else {
    $backUrl = 'index.php';
}
?>


        <p><?php if (isset($error_msg)) {echo $error_msg;}?></p>
        <a href="<?php echo $backUrl;?>"class="">
            <button name="error_Back" class="btn btn-primary" type="button">Retour page précédente</button>
        </a>
        
