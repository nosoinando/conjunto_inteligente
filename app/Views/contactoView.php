<!doctype html>
<html lang="es">
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

      <form class="row g-3 needs-validation" action="#" method="post" novalidate>
        <div class="col-md-6">
          <label for="nombre" class="form-label">Nombre completo</label>
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre"
                 autocomplete="name" required autofocus />
          <div class="invalid-feedback">Por favor ingresa tu nombre.</div>
        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Correo electrónico</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="tucorreo@dominio.com"
                 autocomplete="email" required />
          <div class="invalid-feedback">Ingresa un email válido.</div>
        </div>

        <div class="col-md-6">
          <label for="unidad" class="form-label">Unidad / Apto</label>
          <input type="text" class="form-control" id="unidad" name="unidad" placeholder="Torre 2 - 302"
                 autocomplete="address-line2" required />
          <div class="invalid-feedback">Indica tu unidad o apartamento.</div>
        </div>

        <div class="col-md-6">
          <label for="fecha" class="form-label">Fecha preferida para demo</label>
          <input type="date" class="form-control" id="fecha" name="fecha" required />
          <div class="invalid-feedback">Selecciona una fecha.</div>
        </div>

        <div class="col-12">
          <label for="mensaje" class="form-label">Mensaje</label>
          <textarea class="form-control" id="mensaje" name="mensaje" rows="4" placeholder="Cuéntanos tus necesidades"
                    required></textarea>
          <div class="invalid-feedback">Escríbenos un breve mensaje.</div>
        </div>

        <div class="col-12 d-flex align-items-center gap-2">
          <input class="form-check-input" type="checkbox" value="" id="acepto" required />
          <label class="form-check-label" for="acepto">
            Acepto la <a href="<?= site_url('politicaView') ?>">política de tratamiento de datos</a>.
          </label>
          <div class="invalid-feedback d-block">Debes aceptar la política.</div>
        </div>

        <div class="col-12">
          <button class="btn btn-primary btn-lg" type="submit">Enviar solicitud</button>
        </div>
      </form>
    </div>
  </main>
</body>
</html>
