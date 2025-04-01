<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <!-- Link do Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    // Itens da navbar
    $menuItems = [
        ["name" => "Início", "link" => "#", "active" => true],
        ["name" => "Features", "link" => "#", "active" => false],
        ["name" => "Pricing", "link" => "#", "active" => false]
    ];

    // Itens do dropdown
    $dropdownItems = [
        ["name" => "Action", "link" => "#"],
        ["name" => "Another action", "link" => "#"],
        ["name" => "Something else here", "link" => "#"]
    ];
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <?php foreach ($menuItems as $item): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $item['active'] ? 'active' : ''; ?>" aria-current="page"
                            href="<?= $item['link']; ?>">
                            <?= $item['name']; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach ($dropdownItems as $dropdown): ?>
                            <li><a class="dropdown-item" href="<?= $dropdown['link']; ?>"><?= $dropdown['name']; ?></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Link do Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>