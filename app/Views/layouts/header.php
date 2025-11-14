<!doctype html>
<link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
<header class="border-bottom bg-white sticky-top">
    <div class="container d-flex align-items-center justify-content-between py-2 gap-2">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= site_url('homeView') ?>" aria-label="Ir al inicio">
        <img src="<?= base_url('assets/img/depositphotos_78278034-stock-illustration-abstract-building-logo-design-template.jpg') ?>" alt="Logo plataforma" class="rounded-circle border" id="logoPlat">
        Tu Conjunto Inteligente
        </a>
        <nav aria-label="Principal" class="flex-grow-1">
        <ul class="nav justify-content-end">
            <li class="nav-item"><a class="nav-link" href="<?= site_url('serviciosView') ?>">Servicios</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('tarifasView') ?>">Tarifas</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('demoView') ?>">Demo</a></li>
            <li class="nav-item"><a class="nav-link px-3 ms-2" href="<?= site_url('contactoView') ?>">Contacto</a></li>
            <li class="nav-item"><a class="btn btn-primary" role="button" aria-pressed="false" aria-label="Iniciar sesión" href="<?= site_url('loginView') ?>">Iniciar sesión</a></li>
            <li class="nav-item"><a class="btn btn-outline-primary" role="button" aria-pressed="false" aria-label="Crear cuenta" href="<?= site_url('registroView') ?>">Crear cuenta</a></li>
        </ul>
        </nav>
    </div>
</header>