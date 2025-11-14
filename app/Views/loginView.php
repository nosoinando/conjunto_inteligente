<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-3">Iniciar sesión</h5>

        <form id="loginForm" method="post" action="<?= site_url('auth') ?>">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="email" class="form-label">Correo o usuario</label>
                <input type="text" class="form-control" id="email" name="email" required autocomplete="username">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <a href="<?= site_url('registroView') ?>">Crear cuenta</a>
        </div>

        <div id="loginResult" class="mt-3"></div>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e){
    // Evitar doble envío y usar fetch JSON (si prefieres form submit elimina este handler)
    e.preventDefault();
    const url = this.action;
    const data = {
        email: document.getElementById('email').value.trim(),
        password: document.getElementById('password').value
    };

    const resEl = document.getElementById('loginResult');
    resEl.textContent = 'Procesando...';

    try {
        const resp = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        const json = await resp.json();
        if (resp.ok) {
            resEl.innerHTML = '<div class="alert alert-success">Inicio de sesión correcto.</div>';
            // redirigir o manejar sesión aquí
            window.location.href = '<?= site_url('dashboardView') ?>';
        } else {
            resEl.innerHTML = '<div class="alert alert-danger">' + (json.message || 'Error') + '</div>';
        }
    } catch (err) {
        resEl.innerHTML = '<div class="alert alert-danger">Error de conexión</div>';
    }
});
</script>
</body>