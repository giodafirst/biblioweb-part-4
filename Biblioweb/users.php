
<?php
require('config.php');

$message='';


$mysqli = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE); //var_dump($mysqli);

    if($mysqli){
        $query = "SELECT `id`,`login`,`statut` FROM `users`";

        $result = mysqli_query($mysqli, $query); 

        if($result){
           $user = mysqli_fetch_all($result); //var_dump($user);die;
           
           } mysqli_free_result($result);
        }
        
        mysqli_close($mysqli);
    


if(isset($_POST['btUpStatus'])){ //var_dump($_POST['btUpStatus']);die;
    $mysqli = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE); //var_dump($mysqli);
    if($mysqli){
        mysqli_set_charset($mysqli,'utf-8');
         if($_POST['id']){
             $id=mysqli_real_escape_string($mysqli,$_POST['id']);
             $query  = "UPDATE `users` SET `statut`='habitué'
             WHERE `statut`='novice' AND `id`= '$id'";
        $result = mysqli_query($mysqli, $query); 
        //var_dump($result);die;
            if($result && mysqli_affected_rows ($mysqli)>0){
                $message = 'Modification réussie !' ;
            } else {
                $message = "Erreur de modification !";
            }  
         } 
    }mysqli_close($mysqli);
}elseif(isset($_POST['btDownStatus'])){
    $mysqli = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE); //var_dump($mysqli);die;
    if($mysqli){
        mysqli_set_charset($mysqli,'utf-8');
        if($_POST['id']){
            $id = mysqli_real_escape_string($mysqli,$_POST['id']); //var_dump($id);die;
            $query = "UPDATE `users` SET `statut`='novice'WHERE `statut`='habitué' AND `id`= '$id'";
            $result = mysqli_query($mysqli,$query); //var_dump($result);die;
            if($result && mysqli_affected_rows($mysqli)>0){
                $message = "Modification réussie !";
            } else {
                $message = "Erreur de modification";
            }
        }
    }
}

    
?>
<?php include"header.php"; ?>

</head>
<body>
    <table>
        <tr>
            <th>Login</th>
            <th>Statut</th>
            <th>Promouvoir</th>
            <th>Rétrograder</th>
        </tr>
        <tr><?php foreach($user as $u){ ?>
            <td><?= $u[1]?></td>
            <td><?= $u[2]?></td>
            <td>
            <?php if($u[2] != 'expert') { ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="hidden" name="id" value="<?= $u[0] ?> ">
                <button name="btUpStatus">Promouvoir</button>
                </form>
            <?php } ?>
            </td>
            <td>
            <?php if($u[2] != 'novice') { ?>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="hidden" name="id" value="<?= $u[0] ?> ">
                <button name="btDownStatus">Rétrograder</button>
                </form>
            <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
    <p><?= $message ?></p>

<?php include"footer.php"; ?>