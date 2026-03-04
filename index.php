<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Docker Microsserviços</title>
    <style>
        body { font-family: Arial, sans-serif; background: #1e1e2e; color: #cdd6f4; padding: 40px; }
        .card { background: #313244; border-radius: 10px; padding: 20px; max-width: 600px; margin: auto; }
        h2 { color: #89b4fa; }
        .success { color: #a6e3a1; font-weight: bold; }
        .error   { color: #f38ba8; font-weight: bold; }
        .info    { color: #fab387; }
    </style>
</head>
<body>
<div class="card">
    <h2>🐳 Docker: Microsserviços na Prática</h2>

    <?php
    ini_set("display_errors", 1);

    // Credenciais via variáveis de ambiente (seguro!)
    $servername = getenv('DB_HOST')  ?: 'db';
    $username   = getenv('DB_USER')  ?: 'root';
    $password   = getenv('DB_PASS')  ?: '';
    $database   = getenv('DB_NAME')  ?: 'meubanco';

    $host_name = gethostname();

    echo "<p class='info'>🖥️ <strong>PHP Version:</strong> " . phpversion() . "</p>";
    echo "<p class='info'>📦 <strong>Container (Host):</strong> $host_name</p>";

    $link = new mysqli($servername, $username, $password, $database);

    if (mysqli_connect_errno()) {
        echo "<p class='error'>❌ Falha na conexão: " . mysqli_connect_error() . "</p>";
        exit();
    }

    $valor_rand1 = rand(1, 999);
    $valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 1));

    $stmt = $link->prepare(
        "INSERT INTO dados (AlunoID, Nome, Sobrenome, Endereco, Cidade, Host)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("isssss",
        $valor_rand1,
        $valor_rand2, $valor_rand2,
        $valor_rand2, $valor_rand2,
        $host_name
    );

    if ($stmt->execute()) {
        echo "<p class='success'> Registro inserido com sucesso!</p>";
        echo "<p class='info'> AlunoID: <strong>$valor_rand1</strong> | Dado: <strong>$valor_rand2</strong></p>";
    } else {
        echo "<p class='error'> Erro: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $link->close();
    ?>
</div>
</body>
</html>
