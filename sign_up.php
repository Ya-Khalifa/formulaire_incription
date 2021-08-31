<?php
    require 'header_insc.php';
    require 'bd_insc.php';

    $massageERR ="";
    $messageConf ="";
    $messageMail ="";
    $massage ="";

    if( isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['create_email']) && isset($_POST['passwd']) && isset($_POST['conf_passwd']))
    {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $create_email = $_POST['create_email'];
        $passwd = $_POST['passwd'];
        $conf_passwd = $_POST['conf_passwd'];

        $verif_email = "SELECT create_email FROM inscrit WHERE create_email='$create_email'";
        $charg = $conn->prepare($verif_email);
        $charg->execute();
        $inscrit = $charg->fetch(PDO::FETCH_OBJ);

        if(empty($nom) || empty($prenom) || empty($create_email) || empty($passwd) || empty($conf_passwd))
        {
            $massageERR = "Champ(s) (*) obligatoire(s)";
        }
        elseif($passwd !== $conf_passwd)
        {
                $messageConf = "Erreur! Veillez confirmer le meme mot de passe";
        }
        elseif($verif_email > 0)
        {
            $messageMail = "Désolé! e-maill existant ";
        }
        else
        {
            $insr_sql = "INSERT INTO inscrit(nom,prenom,create_email,passwd,conf_passwd) VALUES (:nom, :prenom, :create_email, :passwd, :conf_passwd)";
            $charg = $conn->prepare($insr_sql);
            $charg->execute([':nom' => $nom, ':prenom' => $prenom, ':create_email' => $create_email, ':passwd' => $passwd, ':conf_passwd' => $conf_passwd]);
            
            $massage = "Données enregistrées avec succès! Maintenant vous pouvez vous connecter";
        }
    }

?>

<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>S'INSCRIRE</h2>
        </div>
        <div class="card-body">
            <?php if($massageERR): ?>
                <div class="alert alert-danger">
                    <?= $massageERR ?>
                </div>   
            <?php elseif($massage): ?>
                <div class="alert alert-info">
                    <?= $massage ?>
                </div>
            <?php else: ?>
                <div>

                </div>
            <?php endif; ?> 
            <form method="post">
                <div class="form-group">
                    <label for="nom"> <font color="red">*</font>Nom</label>
                    <input type="text" name="nom" id="nom" class="form-control">                
                </div>

                <div class="form-group">
                    <label for="prenom"><font color="red">*</font>Prénom</label>
                    <input type="text" name="prenom" id="prenom" class="form-control">                
                </div>

                <div class="form-group">
                    <?php if($messageMail): ?>
                        <div class="alert alert-danger">
                            <?= $messageMail ?>
                        </div>
                    <?php endif; ?>
                    <label for="create_email"><font color="red">*</font>Creer E-mail</label>
                    <input type="text" name="create_email" id="create_email" class="form-control">                
                </div>

                <div class="form-group">
                    <label for="passwd"><font color="red">*</font>Mot de passe</label>
                    <input type="password" name="passwd" id="passwd" class="form-control">                
                </div>

                <div class="form-group">
                    <?php if($messageConf): ?>
                        <div class="alert alert-danger">
                            <?= $messageConf ?>
                        </div>
                    <?php endif; ?>
                    <label for="conf_passwd"><font color="red">*</font>Confirmer mot de passe</label>
                    <input type="password" name="conf_passwd" id="conf_passwd" class="form-control">                
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-info">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</div>