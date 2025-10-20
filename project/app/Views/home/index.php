<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= \Project\Core\CSRF::token(); ?>">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="/assets/css/theme.css">
    <link rel="stylesheet" href="/assets/css/customer.css">
</head>
<body>
    <div class="container">
        <header class="profile-header">
            <div>
                <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
                <p>Premium e-pin, lisans anahtarı ve dijital hesap mağazanıza hoş geldiniz.</p>
            </div>
            <button class="button">Koleksiyonu İncele</button>
        </header>

        <section class="orders-grid">
            <article class="card">
                <h2 class="card-title">Anında Teslimat</h2>
                <p>Stoktaki anahtarlarınız sipariş sonrası otomatik dağıtılır.</p>
            </article>
            <article class="card">
                <h2 class="card-title">Güvenli Ödeme</h2>
                <p>PayTR, Papara ve banka transferi dahil çoklu ödeme adaptörleri.</p>
            </article>
        </section>
    </div>

    <script type="module" src="/assets/js/app.js"></script>
    <script type="module" src="/assets/js/customer.js"></script>
</body>
</html>
