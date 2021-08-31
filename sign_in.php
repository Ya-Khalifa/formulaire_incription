<?php
    require 'header_insc.php';
    require 'bd_insc.php';
    $msgE ="";
    session_start();

    if( isset($_POST['email']) && isset($_POST['passwd']) )
    {
        $email = $_POST['email'];
        $passwd = $_POST['passwd'];
        $recup_sql = $conn->prepare('SELECT * FROM inscrit WHERE create_email = ? AND passwd = ?');
        $recup_sql->execute(array($email,$passwd));
        if($recup_sql->rowCount() > 0)
        {
            $_SESSION['create_email'] = $email;
            $_SESSION['passwd'] = $passwd;
            $_SESSION['id'] = $recup_sql->fetch()['id'];
            header("Location: index_insc.php");
        }
        else
        {
            $msgE = " E-mail incorrect! veillez réessayer ";
        }
    }

?>

<div class="container">
        <div class="card mt-5">
            <h2>SE CONNECTER</h2>
            <div class="card-hearder">

            </div>

            <div class="card-body">
                <form method="post">
                    <?php if($msgE): ?>
                        <div class="alert alert-danger">
                            <?= $msgE ?>
                        </div>   
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="passwd">Mot de passe</label>
                        <input type="password" name="passwd" id="passwd" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info mt-4">Connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>