<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/index.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="../assets/img/clients1.jpeg" alt="#" style="height: 40px;">
            IClient
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=create">Créer un Client</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=exportCSV">Exporter CSV</a>
                </li>
    
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="../index.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Liste des Clients</h2>
        <div class="mb-4">
            <form action="index.php" method="get" class="form-inline">
                <input type="text" name="filter_value" class="form-control mr-2" placeholder="Recherche">
                <select name="filter_field" class="form-control mr-2">
                    <option value="name">Nom</option>
                    <option value="address">Adresse</option>
                    <option value="phone">Numéro de téléphone</option>
                </select>
                <button type="submit" name="action" value="filter" class="btn btn-primary">Filtrer</button>
            </form>
        </div>
        <div class="mb-4">
            <form action="index.php" method="get" class="form-inline">
                <select name="sort_field" class="form-control mr-2">
                    <option value="name">Nom</option>
                    <option value="address">Adresse</option>
                    <option value="phone">Numéro de téléphone</option>
                    <option value="status">Statut</option>
                </select>
                <select name="sort_order" class="form-control mr-2">
                    <option value="asc">Ascendant</option>
                    <option value="desc">Descendant</option>
                </select>
                <button type="submit" name="action" value="sort" class="btn btn-primary">Trier</button>
            </form>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom Complet</th>
                    <th>Adresse</th>
                    <th>Numéro de téléphone</th>
                    <th>Email</th>
                    <th>Sexe</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clients)): ?>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?= htmlspecialchars($client['id']) ?></td>
                            <td><?= htmlspecialchars($client['name']) ?></td>
                            <td><?= htmlspecialchars($client['address']) ?></td>
                            <td><?= htmlspecialchars($client['phone']) ?></td>
                            <td><?= htmlspecialchars($client['email']) ?></td>
                            <td><?= htmlspecialchars($client['gender']) ?></td>
                            <td><?= htmlspecialchars($client['status']) ?></td>
                            <td>
                                <a href="index.php?action=edit&id=<?= htmlspecialchars($client['id']) ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="index.php?action=delete&id=<?= htmlspecialchars($client['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Aucun client trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
