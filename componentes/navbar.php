<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><img class="logo" src="../includes/logo.ico" alt="Logo" style="max-height: 25px;"></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/index.php">Início</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Fotos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/fotos/visualizar_fotos.php">Relatório</a></li>
                        <li><a class="dropdown-item" href="/fotos/registrar_fotos.php">Registrar</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cadastros
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/cadastros/setores.php">Setores</a></li>
                        <li><a class="dropdown-item" href="/cadastros/subsecao.php">Subseção</a></li>
                        <li><a class="dropdown-item" href="/cadastros/local_ocorrencia.php">Local/Ocorrência</a></li>
                    </ul>
                </li>
                <!-- Botão de Backup -->
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white fw-bold" href="#" role="button" onclick="confirmBackup()">Backup</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
function confirmBackup() {
    if (confirm("Tem certeza de que deseja fazer um backup do banco de dados?")) {
        window.location.href = "/backup/backup.php";
    }
}
</script>
