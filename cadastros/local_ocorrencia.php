<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/gestao_ambiental/config/autoload.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="/gestao_ambiental/includes/estilo.css" rel="stylesheet">

    <title>Local/Ocorrência</title>

</head>

<body>

    <div class="container-fluid">
        <div class="container">
            <h1>Local/Ocorrência</h1>
        </div>
        <div class="row">
            <!-- Tabela de Setores -->
            <div class="col-md-6 mt-3">
                <div class="row justify-content-end mb-2">
                    <div class="col-auto">
                        <button type="button" class="btn btn-dark" id="addBtnLocal">Cadastrar Local</button>
                    </div>
                </div>
                <table width="100%" id="tabela_local" class="table table-striped tabela">
                    <thead>
                        <tr>
                            <th>Local</th>
                            <th>Tipo de Local</th>
                            <th>Descrição</th>
                            <th>Responsável</th>
                            <th>Contato</th>
                            <th>Observações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Seus dados do data table aqui -->
                    </tbody>
                </table>
            </div>

            <!-- Tabela de Ocorrências -->
            <div class="col-md-6 mt-3">
                <div class="row justify-content-end mb-2">
                    <div class="col-auto">
                        <button type="button" class="btn btn-dark" id="addBtnOcorrencia">Cadastrar Ocorrência</button>
                    </div>
                </div>
                <table width="100%" id="tabela_correncia" class="table table-striped tabela">
                    <thead>
                        <tr>
                            <th>Tipo de Ocorrência</th>
                            <th>Observações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Seus dados do data table aqui -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal02" tabindex="-1" aria-labelledby="modal02" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Ocorrência</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulário dentro do modal -->
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="local" class="form-label">Ocorrência:</label>
                                <input type="text" class="form-control" id="local" name="local" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="obs" class="form-label">Observações:</label>
                                <input type="text" class="form-control" id="obs" name="obs">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-dark" id="saveBtn">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal01" tabindex="-1" aria-labelledby="modal01" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Local</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulário dentro do modal -->
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="local" class="form-label">Local:</label>
                                <input type="text" class="form-control" id="local" name="local" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="filtro" class="form-label">Tipo de Local:</label>
                                <select name="filtro" id="filtro" class="form-select">
                                    <option value="" disabled selected>Selecione uma opção...</option>
                                    <option value="I">Interno</option>
                                    <option value="E">Externo</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="descricao" class="form-label">Descrição:</label>
                                <input type="text" class="form-control" id="descricao" name="descricao">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="responsavel" class="form-label">Responsável:</label>
                                <input type="text" class="form-control" id="responsavel" name="responsavel" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="contato" class="form-label">Contato:</label>
                                <input type="text" class="form-control" id="contato" name="contato" value="">
                            </div>
                            <div class="col-md-4">
                                <label for="obs" class="form-label">Observação:</label>
                                <input type="text" class="form-control" id="obs" name="obs" value="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-dark" id="saveBtn">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <footer>Desenvolvido por: Douglas Marcondes.</footer>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            document.getElementById("addBtnLocal").addEventListener("click", function() {
                $('#modal01').modal('show');
            });
            document.getElementById("addBtnOcorrencia").addEventListener("click", function() {
                $('#modal02').modal('show');
            });
        });
    </script>
</body>

</html>