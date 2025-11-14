<!doctype html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contacto | Tu Conjunto Inteligente</title>
  <meta name="description" content="Formulario de contacto para información y demo" />
  <link rel="preconnect" href="https://cdn.jsdelivr.net" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>
<body>
  <main class="py-5">
    <div class="container">
      <header class="mb-4">
        <h1 class="h2">Contacto</h1>
        <p class="text-secondary">Completa el formulario y te contactaremos.</p>
      </header>

      <form id="contactForm" class="row g-3 needs-validation" action="<?= site_url('contacto') ?>" method="post" novalidate>
        <?= csrf_field() ?>
        <div class="col-md-6">
          <label for="nombre_completo" class="form-label">Nombre completo</label>
          <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" placeholder="Tu nombre"
                 autocomplete="name" required autofocus />
        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Correo electrónico</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="tucorreo@dominio.com"
                 autocomplete="email" required />
        </div>

        <div class="col-md-6">
          <label for="unidad" class="form-label">Unidad / Apto</label>
          <input type="text" class="form-control" id="unidad" name="unidad" placeholder="Torre 2 - 302"
                 autocomplete="address-line2" required />
        </div>

        <div class="col-12">
          <label for="notas" class="form-label">Mensaje</label>
          <textarea class="form-control" id="notas" name="notas" rows="4" placeholder="Cuéntanos tus necesidades"
                    required></textarea>
        </div>

        <div class="col-12 d-flex align-items-center gap-2">
          <input class="form-check-input" type="checkbox" value="" id="acepto" required />
          <label class="form-check-label" for="acepto">
            Acepto la <a href="<?= site_url('politicaView') ?>">política de tratamiento de datos</a>.
          </label>
        </div>

        <div class="col-12">
          <button class="btn btn-primary btn-lg" type="submit">Enviar solicitud</button>
        </div>
      </form>

      <script>
      (function(){
        const form = document.getElementById('contactForm');
        const submitBtn = form.querySelector('button[type="submit"]');
        const alertPlaceholder = document.createElement('div');
        form.parentNode.insertBefore(alertPlaceholder, form);

        function showAlert(type, msg){
          alertPlaceholder.innerHTML = `<div class="alert alert-${type} alert-dismissible" role="alert">
            ${msg}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`;
        }

        function clearErrors(){
          form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
          form.querySelectorAll('.invalid-feedback.server').forEach(n => n.remove());
        }

        function attachError(fieldName, message){
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
          clearErrors();

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

            if (res.ok && (data.message || data.success)) {
              showAlert('success', data.message || 'Enviado correctamente.');
              form.reset();
              form.classList.remove('was-validated');
            } else {
              const errors = data.errors || data.messages || data;
              if (errors && typeof errors === 'object') {
                Object.keys(errors).forEach(k => {
                  const msg = Array.isArray(errors[k]) ? errors[k][0] : errors[k];
                  attachError(k, msg);
                });
                showAlert('warning', 'Corrige los errores del formulario.');
              } else {
                showAlert('danger', data.message || 'Ocurrió un error al enviar.');
              }
            }
          } catch (err) {
            submitBtn.disabled = false;
            showAlert('danger', 'Error de red. Intenta de nuevo.');
            console.error(err);
          }
        });
      })();
      </script>
    </div>
  </main>
</body>
