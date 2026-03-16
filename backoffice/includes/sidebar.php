<aside id="sidebar-wrapper" class="text-white shadow bg-dark">

    <div class="p-3 border-bottom border-secondary text-center mt-2">
        <small class="d-block text-muted">Bem-vindo(a),</small>
        <strong><?= htmlspecialchars($_SESSION['user_nome']); ?></strong>
        <span class="badge bg-secondary d-block mt-2"><?= htmlspecialchars($_SESSION['user_perfil']); ?></span>
    </div>

    <div class="list-group list-group-flush mt-2">
        <a href="dashboard.php" class="p-3 text-center mt-2 border-0 ">📊 Dashboard</a>
        <a href="#" class="p-3 text-center mt-2 border-0">🩺 Equipamentos</a>
        <a href="#" class="p-3 text-center mt-2 border-0">📍 Localizações</a>
        <a href="#" class="p-3 text-center mt-2 border-0">🏢 Fornecedores</a>

        <?php if ($_SESSION['user_perfil'] === 'Admin'): ?>
            <a href="#" class="p-3 text-center mt-2 border-0 text-warning">⚙️ Gerir Utilizadores</a>
        <?php endif; ?>
    </div>
    <div class="d-flex align-items-center">
            <a href="/PROJECTO/login/logout.php" class="d-block text-muted">Sair</a>
        </div>
</aside>

<div id="page-content-wrapper">
    <div class="container-fluid">