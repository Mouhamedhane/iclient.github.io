<?php
require_once("config/connexion.php");

$database = new Database();
$connect = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login"]) && isset($_POST["passwd"])) {
        $login = $_POST['login'];
        $passwd = $_POST['passwd'];

        if ($connect) {
            try {
                $sql_admin = "SELECT * FROM admin WHERE login_admin = ? AND password_admin = ?";
                $query_admin = $connect->prepare($sql_admin);

                $sql_super_admin = "SELECT * FROM super_admin WHERE login_super_admin = ? AND password_super_admin = ?";
                $query_super_admin = $connect->prepare($sql_super_admin);

                $query_admin->execute([$login, $passwd]);
                $query_super_admin->execute([$login, $passwd]);

                if ($query_admin->rowCount() === 1 || $query_super_admin->rowCount() === 1) {
                    if ($query_admin->rowCount() === 1) {
                        header("Location: ../public/index.php");
                        exit();
                    } else {
                        header("Location: views/super_admin/index.php");
                        exit();
                    }
                } else {
                    $error_message = "Vérifiez vos identifiants";
                }
            } catch (PDOException $e) {
                $error_message = "Erreur de requête : " . $e->getMessage();
            }
        } else {
            $error_message = "Erreur de connexion à la base de données";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/index1.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="login-page">
        <h2 class="form-title">Iclients</h2>
        <img src="assets/img/clients1.jpeg" alt="" class="img">
        <div class="form">
            <form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="login" placeholder="E-mail" required/>
                <input type="password" name="passwd" placeholder="Mot de passe" required/>
                <button type="submit">Connecter</button>
                <div id="error"></div>
            </form>
        </div>
    </div>
    <?php if(isset($error_message)): ?>
    <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <script>
    </script>
</body>
</html>
