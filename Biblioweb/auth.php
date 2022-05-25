<?php include"header.php"; ?>
</head>
<body>
<a href="index.php" id="titre"><h1>Biblioweb</h1></a>
            <form action="verif.php" method="post" name="connexion">
                <div>
                     <label for="pseudo">Nom d'utilisateur :</label>
                <input type="text" id="pseudo" name="pseudo">
                </div>
                <div>
                    <label for="motdepasse">Mot de passe :</label>
                <input type="password" id="motdepasse" name="motdepasse">
                </div>
                <div>
                    <button id="btLogin" name="btLogin">Se connecter</button>
                </div>
            </form>   

<?php include"footer.php"; ?>