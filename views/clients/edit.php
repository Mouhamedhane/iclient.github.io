<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Client</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Modifier le Client</h2>
    <?php if (isset($client) && $client): ?>
        <form action="index.php?action=edit&id=<?= htmlspecialchars($client['id']) ?>" method="post">
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($client['name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Adresse:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($client['address']) ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Numéro de téléphone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($client['phone']) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($client['email']) ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Sexe:</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="male" <?= ($client['gender'] === 'male') ? 'selected' : '' ?>>Homme</option>
                    <option value="female" <?= ($client['gender'] === 'female') ? 'selected' : '' ?>>Femme</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Statut:</label>
                <input type="text" class="form-control" id="status" name="status" value="<?= htmlspecialchars($client['status']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Sauvegarder</button>
            <a href="index.php" class="btn btn-default">Annuler</a>
        </form>
    <?php else: ?>
        <p>Client non trouvé.</p>
    <?php endif; ?>
</div>
</body>
</html>
