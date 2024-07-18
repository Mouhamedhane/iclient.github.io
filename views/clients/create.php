<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un Client</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Créer un Client</h2>
    <form action="../public/index.php?action=create" method="post">
        <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom" required>
        </div>
        <div class="form-group">
            <label for="address">Adresse:</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Entrez l'adresse" required>
        </div>
        <div class="form-group">
            <label for="phone">Numéro de téléphone:</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Entrez le numéro de téléphone" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez l'email" required>
        </div>
        <div class="form-group">
            <label for="gender">Sexe:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="" disabled selected>Sélectionnez le sexe</option>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Statut:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="" disabled selected>Sélectionnez le statut</option>
                <option value="active">Actif</option>
                <option value="inactive">Inactif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
        <a href="../public/index.php" class="btn btn-default">Annuler</a>
    </form>
</div>
</body>
</html>
