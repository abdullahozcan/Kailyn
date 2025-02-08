<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hata</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Veritabanı Bağlantı Hatası</h4>
            <p>Veritabanı bağlantısı kurulamadı. Lütfen daha sonra tekrar deneyin.</p>
            <hr>
            <p class="mb-0"><?php echo htmlspecialchars($message); ?></p>
        </div>
    </div>
</body>
</html>