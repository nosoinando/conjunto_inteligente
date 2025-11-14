<div class="container mt-4">
    <h1>Dashboard</h1>
    <div class="card mt-3">
        <div class="card-body">
            <p class="mb-1"><strong>Visitas en esta sesión:</strong> <span id="vis-session"><?= esc($sessionVisits ?? 0) ?></span></p>
            <p class="mb-1"><strong>Visitas en esta página (global):</strong> <span id="vis-global"><?= esc($globalVisits ?? 0) ?></span></p>
            <p class="mb-0"><strong>Total de visitas (todas las páginas):</strong> <span id="vis-total"><?= esc($totalVisits ?? 0) ?></span></p>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch('visits')
            .then(r => r.json())
            .then(data => {
            document.getElementById('vis-session').textContent = data.sessionVisits ?? 0;
            document.getElementById('vis-global').textContent = data.globalVisits ?? 0;
            document.getElementById('vis-total').textContent = data.totalVisits ?? 0;
            })
            .catch(console.error);
        });
</script>