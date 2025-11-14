<!doctype html>
<link rel="preconnect" href="https://cdn.jsdelivr.net" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
<header class="border-bottom bg-white sticky-top">
    <div class="container d-flex align-items-center justify-content-between py-2 gap-2">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('homeView') ?>" aria-label="Ir al inicio">
        <img src="<?= base_url('assets/img/depositphotos_78278034-stock-illustration-abstract-building-logo-design-template.jpg') ?>" alt="Logo plataforma" class="rounded-circle border" id="logoPlat">
        Tu Conjunto Inteligente
        </a>
        <nav aria-label="Principal" class="flex-grow-1">
        <ul class="nav justify-content-end">
            <li class="nav-item"><a class="btn btn-outline-primary" role="button" aria-pressed="false" aria-label="Cerrar sesion" href="<?= site_url('loginView') ?>">Cerrar sesión</a></li>
        </ul>
        </nav>
    </div>
</header>