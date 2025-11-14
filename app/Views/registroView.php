<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Registro</title>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-3">Crear cuenta</h5>

        <form id="registerForm" method="post" action="<?= site_url('usuarios') ?>" novalidate>
            <?= csrf_field() ?>

            <div class="row g-2">
                <div class="col-12 mb-2">
                    <label for="nombre" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="col-12 mb-2">
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                </div>

                <div class="col-md-12 mb-2">
                    <label for="email" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="col-md-6 mb-2">
                    <label for="unidad" class="form-label">Unidad</label>
                    <input type="text" class="form-control" id="unidad" name="unidad" required>
                </div>

                <div class="col-md-6 mb-2">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="col-md-6 mb-2">
                    <label for="password_confirm" class="form-label">Confirmar contraseña</label>
                    <input type="password" class="form-control" id="password_confirm" required>
                </div>
            </div>

            <div class="d-grid mt-3">
                <button type="submit" id="submitBtn" class="btn btn-primary">Crear cuenta</button>
            </div>
        </form>

        <div class="mt-3 text-center">
            <a href="<?= site_url('loginView') ?>">¿Ya tienes cuenta? Inicia sesión</a>
        </div>

        <div id="result" class="mt-3"></div>
    </div>
</div>

<script>
    (function(){
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');
    const result = document.getElementById('result');

    function clearServerErrors(){
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.invalid-feedback.server').forEach(n => n.remove());
        result.innerHTML = '';
    }

    function attachServerError(fieldName, message){
        const input = form.querySelector(`[name="${fieldName}"]`);
        if (!input) return;
        input.classList.add('is-invalid');
        const feed = document.createElement('div');
        feed.className = 'invalid-feedback server';
        feed.innerText = message;
        if (input.nextElementSibling) input.parentNode.insertBefore(feed, input.nextElementSibling);
        else input.parentNode.appendChild(feed);
    }

    form.addEventListener('submit', async function(e){
        e.preventDefault();
        clearServerErrors();

        const pwd = form.password.value;
        const pwd2 = form.password_confirm.value;
        if (pwd !== pwd2) {
            attachServerError('password_confirm', 'Las contraseñas no coinciden.');
            result.innerHTML = '<div class="alert alert-warning">Las contraseñas no coinciden.</div>';
            return;
        }

        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        submitBtn.disabled = true;
        const action = form.getAttribute('action') || window.location.href;
        const fd = new FormData(form);

        try {
            const res = await fetch(action, {
                method: 'POST',
                body: fd,
                credentials: 'same-origin',
                headers: { 'Accept': 'application/json' }
            });

            const data = await res.json().catch(() => ({}));
            submitBtn.disabled = false;

            if (res.ok && data.message) {
                result.innerHTML = '<div class="alert alert-success">' + (data.message || 'Cuenta creada.') + '</div>';
                form.reset();
                form.classList.remove('was-validated');
                window.location.href = '<?= site_url('loginView') ?>';
            } else {
                const errors = data.errors || data;
                if (errors && typeof errors === 'object') {
                    Object.keys(errors).forEach(k => {
                        const msg = Array.isArray(errors[k]) ? errors[k][0] : errors[k];
                        attachServerError(k, msg);
                    });
                    result.innerHTML = '<div class="alert alert-warning">' + (data.messages.error || '') + '</div>';
                } else {
                    result.innerHTML = '<div class="alert alert-danger">' + (data.message || 'Ocurrió un error.') + '</div>';
                }
            }
        } catch (err) {
            submitBtn.disabled = false;
            result.innerHTML = '<div class="alert alert-danger">Error de red. Intenta nuevamente.</div>';
            console.error(err);
        }
    });
    })();
</script>
</body>