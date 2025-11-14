<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Demo | Tu Conjunto Inteligente</title>
  <meta name="description" content="Muestra de audio y video de la plataforma" />
  <link rel="preconnect" href="https://cdn.jsdelivr.net" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <main class="py-5 bg-light">
    <div class="container">
      <header class="mb-4">
        <h1 class="h2">Demo multimedia</h1>
        <p class="text-secondary mb-0">Reproduce el audio de bienvenida o mira el video de recorrido.</p>
      </header>

      <div class="row g-4 align-items-center">
        <div class="col-lg-6">
          <h3 class="h5">Audio de bienvenida</h3>
          <audio controls preload="none">
            <source src="./assets/sounds/Text to Speech.wav" type="audio/mpeg" />
            Tu navegador no soporta audio HTML5.
          </audio>
          <p class="small text-muted mt-2">Archivo de ejemplo: reemplázalo por tu audio real.</p>
        </div>
        <div class="col-lg-6">
          <h3 class="h5">Video de recorrido</h3>
          <video controls width="100%" poster="https://picsum.photos/seed/poster/800/450">
            <source src="./assets/video/invideo-ai-1080 Tu conjunto, 100% digital en 60s 2025-10-11.mp4" />
            Tu navegador no soporta video HTML5.
          </video>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
