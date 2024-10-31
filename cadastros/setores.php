<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/config/autoload.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="/includes/estilo.css" rel="stylesheet">
    <title>Setores</title>

</head>

<body>

    <div class="container">
        <div class="container-fluid">
            <h1>Setores</h1>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-md-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-dark" id="addBtnSetor">Cadastrar Setor</button>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table width="100%" id="tabela_setor" class="table table-striped tabela">
                        <thead>
                            <tr>
                                <th>Setor</th>
                                <th>Num. funcionários</th>
                                <th>Responsável</th>
                                <th>Localização</th>
                                <th>Contato</th>
                                <th>Observação</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Seus dados do data table aqui -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal01" tabindex="-1" aria-labelledby="modal01" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Setor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulário dentro do modal -->
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="setor" class="form-label">Setor:</label>
                                <input type="text" class="form-control" id="setor" name="setor" value="">
                            </div>
                            <div class="col-md-6">
                                <label for="numfuncionarios" class="form-label">Num. funcionarios:</label>
                                <input type="text" class="form-control" id="numfuncionarios" name="numfuncionarios" value="">
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-md-12">
                                <label for="obs" class="form-label">Observação:</label>
                                <input type="text" class="form-control" id="obs" name="obs" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="responsavel" class="form-label">Responsável:</label>
                                <input type="text" class="form-control" id="responsavel" name="responsavel">
                            </div>
                            <div class="col-md-6">
                                <label for="contato" class="form-label">Contato:</label>
                                <input type="text" class="form-control" id="contato" name="contato" value="">
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
            document.getElementById("addBtnSetor").addEventListener("click", function() {
                $('#modal01').modal('show');
            });
        });
    </script>
</body>

</html>