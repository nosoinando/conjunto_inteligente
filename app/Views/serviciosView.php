<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Servicios | Tu Conjunto Inteligente</title>
  <meta name="description" content="Listado de servicios clave de la plataforma" />
  <link rel="preconnect" href="https://cdn.jsdelivr.net" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <main class="py-5 bg-light">
    <div class="container">
      <header class="mb-4">
        <h1 class="h2">Servicios principales</h1>
        <p class="text-secondary mb-0">Funcionalidades clave para la propiedad horizontal.</p>
      </header>

      <div class="row mb-3">
        <div class="col-md-6">
          <label for="serviceSearch" class="form-label">Filtrar servicios</label>
          <input id="serviceSearch" type="search" class="form-control" placeholder="Escribe: pagos, PQRS, reservas, comunicados...">
          <div class="form-text">Búsqueda instantánea por título o contenido.</div>
        </div>
      </div>

      <div class="row g-4" id="gridServicios">
        <article class="col-md-6 col-lg-3">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h3 class="h5">Pagos y estados de cuenta</h3>
              <ul>
                <li>Generación de cuotas por periodo</li>
                <li>Historial y comprobantes</li>
                <li>Conciliación rápida</li>
              </ul>
              <a href="https://www.gov.co/" target="_blank" rel="noopener" class="stretched-link">Más sobre normatividad</a>
            </div>
          </div>
        </article>

        <article class="col-md-6 col-lg-3">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h3 class="h5">PQRS con SLA</h3>
              <ul>
                <li>Categorización y prioridades</li>
                <li>Notificaciones por vencimiento</li>
                <li>Trazabilidad completa</li>
              </ul>
              <a href="contacto.html" class="stretched-link">Solicitar demo</a>
            </div>
          </div>
        </article>

        <article class="col-md-6 col-lg-3">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h3 class="h5">Reservas de áreas comunes</h3>
              <ul>
                <li>Reglas, aforos y no-show</li>
                <li>Recordatorios automáticos</li>
                <li>Calendario responsivo</li>
              </ul>
              <a href="demo.html" class="stretched-link">Ver demo</a>
            </div>
          </div>
        </article>

        <article class="col-md-6 col-lg-3">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h3 class="h5">Comunicaciones y avisos</h3>
              <ul>
                <li>Segmentación por torre/unidad</li>
                <li>Tablero de anuncios</li>
                <li>Boletines por email</li>
              </ul>
              <a href="contacto.html" class="stretched-link">Contáctanos</a>
            </div>
          </div>
        </article>
      </div>
    </div>
  </main>
</body>
</html>
