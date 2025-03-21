<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Conexão com o banco de dados
    require_once $_SERVER['DOCUMENT_ROOT'] . '/config/conexao.php';
    header('Content-Type: application/json');
    $con = connect_local_mysqli('gestao_ambiental');

    if (mysqli_connect_errno()) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $carregarDados = $_POST['carregarDados'] ?? '';

    // Carregar dados
    if ($carregarDados == 'sim') {

        $sql = "SELECT * FROM campo_atuacao";
        $resultado = mysqli_query($con, $sql);

        $dados = [];

        if ($resultado) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $dados[] = [
                    'id' => $row['id'],
                    'descricao' => $row['descricao']
                ];
            }

            if (empty($dados)) {
                echo json_encode(["error" => "Consulta não retornou dados."]);
            } else {
                echo json_encode(["dados" => $dados]);
            }
        } else {
            echo json_encode(["error" => "Erro na execução da consulta: " . mysqli_error($con)]);
        }
        exit;
    }

    // Adicionar ou atualizar dados
    if ($carregarDados == 'nao') {
        $id = $_POST['id'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $descricao = mysqli_real_escape_string($con, $descricao);

        if (!empty($id)) {
            $sql = "UPDATE campo_atuacao SET descricao='$descricao' WHERE id = '$id'";
            $resultado = mysqli_query($con, $sql);

            if ($resultado) {
                echo json_encode(["status" => "true", "message" => "Campo de atuação atualizado com sucesso."]);
            } else {
                echo json_encode(["status" => "false", "message" => "Erro ao atualizar campo de atuação: " . mysqli_error($con)]);
            }
            exit;
        } else {
            $sql = "INSERT INTO campo_atuacao (descricao) VALUES ('$descricao')";
            $resultado = mysqli_query($con, $sql);

            if ($resultado) {
                echo json_encode(["status" => "true", "message" => "Campo de atuação adicionado com sucesso."]);
            } else {
                echo json_encode(["status" => "false", "message" => "Erro ao adicionar campo de atuação: " . mysqli_error($con)]);
            }
            exit;
        }
    }



    // Carregar dados de uma linha específica
    if ($carregarDados == 'linha') {
        $id = $_POST['id'] ?? '';

        if (empty($id)) {
            echo json_encode(["error" => "ID não fornecido."]);
            exit;
        }

        // Proteção contra SQL Injection
        $id = mysqli_real_escape_string($con, $id);

        $sql = "SELECT * FROM campo_atuacao WHERE id = '$id' ";
        $resultado = mysqli_query($con, $sql);

        $dados = [];

        if ($resultado) {
            $row = mysqli_fetch_assoc($resultado);

            if ($row) {
                $dados[] = [
                    'id' => $row['id'],
                    'descricao' => $row['descricao']
                ];
                echo json_encode(["dados" => $dados]);
            } else {
                echo json_encode(["error" => "Consulta não retornou dados."]);
            }
        } else {
            echo json_encode(["error" => "Erro na execução da consulta: " . mysqli_error($con)]);
        }
        exit;
    }

    // Deletar um campo de atuacao
    if ($carregarDados == 'delete') {
        $id = $_POST['id'] ?? '';

        if (empty($id)) {
            echo json_encode(["error" => "ID não fornecido."]);
            exit;
        }

        // Proteção contra SQL Injection
        $id = mysqli_real_escape_string($con, $id);

        $sql = "DELETE FROM campo_atuacao WHERE id = '$id' ";
        $resultado = mysqli_query($con, $sql);

        if ($resultado) {
            echo json_encode(["dados" => "Campo de atuação deletado com sucesso."]);
        } else {
            echo json_encode(["error" => "Erro na execução da consulta: " . mysqli_error($con)]);
        }
        exit;
    }
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/autoload.php';
require_once HOME_DIR . 'componentes/navbar.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="/includes/estilo.css" rel="stylesheet">
    <link rel="icon" href="/includes/logo.ico">
    <title>Campo de Atuação</title>
</head>

<body>

    <div class="container">
        <div class="container-fluid" style="margin-top: 60px;">
            <h1>Campo de Atuação</h1>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-md-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-dark" id="addBtnCA">Cadastrar campo de atuação</button>
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table width="100%" id="tabela_ca" class="table table-striped tabela">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dados serão preenchidos pelo DataTables -->
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
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar campo de atuação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" class="form-control" id="id" name="id">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="campo_atuacao" class="form-label">Descrição:</label>
                                <input type="text" class="form-control" id="campo_atuacao" name="campo_atuacao">
                                <span style="font-size: 12px;">100 caracteres restantes</span>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript">
        let datatable;

        $('#id').val('');
        $('#campo_atuacao').val('');

        $(document).ready(function() {
            document.getElementById("addBtnCA").addEventListener("click", function() {
                $('#modal01').modal('show');
            });

            carregarDados();
        });

        const campoAtuacaoInput = document.getElementById('campo_atuacao');
        const maxChars = 30;

        function enforceMaxLength(input) {
            input.addEventListener('input', function() {
                if (input.value.length > maxChars) {
                    alert("Você ultrapassou o limite de 30 caracteres.");
                    input.value = input.value.substring(0, maxChars);
                }

                const remainingChars = maxChars - input.value.length;
                const charCountElement = input.nextElementSibling;
                charCountElement.textContent = `${remainingChars} caracteres restantes`;
            });
        }

        enforceMaxLength(campoAtuacaoInput);

        async function carregarDatatable(data) {
            if (datatable) {
                datatable.clear().rows.add(data).draw();
            } else {
                datatable = $('#tabela_ca').DataTable({
                    language: {
                        "url": "/includes/datatablesPortugues.json"
                    },
                    data: data,
                    columns: [{
                            "data": "descricao"
                        },
                        {
                            "data": null,
                            "defaultContent": `
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-sm btn-outline-dark edit me-1">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            `,
                            "width": "90px"

                        }
                    ],
                    columnDefs: [{
                        targets: '_all',
                        className: 'text-center'
                    }],
                    ordering: true,
                    lengthMenu: [
                        [25, 50, -1],
                        [25, 50, "Todos"]
                    ],
                    drawCallback: function(settings) {

                        var api = this.api();

                        $('#tabela_ca tbody').on('click', '.edit', function(event) {

                            var data = $('#tabela_ca').DataTable().row($(this).closest('tr')).data();
                            var id = data.id;

                            $('#modal01').modal('show');

                            $.ajax({
                                url: "campo_atuacao.php",
                                method: 'POST',
                                data: {
                                    id: id,
                                    carregarDados: "linha"
                                },
                                success: function(response) {

                                    if (response.dados && response.dados.length > 0) {
                                        var data = response.dados[0];

                                        $('#id').val(data.id);
                                        $('#campo_atuacao').val(data.descricao);

                                        $('#modal01').modal('show');
                                    } else {
                                        console.error('Nenhum dado encontrado.');
                                        alert('Erro: Nenhum dado encontrado.');
                                    }
                                },

                                error: function(xhr, status, error) {
                                    console.error('Erro no AJAX:', error);
                                }
                            });
                        });

                        $('#tabela_ca tbody').on('click', '.delete', function(event) {
                            var data = $('#tabela_ca').DataTable().row($(this).closest('tr')).data();
                            var id = data.id;

                            if (confirm('Você tem certeza que deseja deletar este setor?')) {
                                $.ajax({
                                    url: "campo_atuacao.php",
                                    method: 'POST',
                                    data: {
                                        id: id,
                                        carregarDados: "delete"
                                    },
                                    success: function(response) {

                                        console.log(response);

                                        if (response.dados) {
                                            window.location.reload();
                                        } else {
                                            console.error('Erro na resposta:', response.error);
                                            alert('Erro: ' + response.error);
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Erro no AJAX:', error);
                                        alert('Erro na requisição: ' + error);
                                    }
                                });
                            }
                        });
                    }
                });
            }
        }

        function carregarDados() {
            $.ajax({
                url: 'campo_atuacao.php',
                type: "POST",
                data: {
                    carregarDados: "sim"
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Resposta do servidor:', response);
                    if (response.dados && Array.isArray(response.dados)) {
                        carregarDatatable(response.dados);
                    } else if (response.error) {
                        console.error('Erro no servidor:', response.error);
                    } else {
                        console.error('Dados inválidos recebidos do servidor:', response);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição:', error);
                }
            });
        }

        $('#modal01').on('click', '#saveBtn', function() {
            var id = $('#id').val();
            var campo_atuacao = $('#campo_atuacao').val();

            $.ajax({
                url: 'campo_atuacao.php',
                type: 'POST',
                data: {
                    id: id,
                    descricao: campo_atuacao,
                    carregarDados: 'nao'
                },
                success: function(response) {
                    console.log(response);
                    $('#modal01').modal('hide');

                    if (response.status === 'true') {
                        window.location.reload();
                    } else {
                        alert(response.message);
                    }

                    $('#id').val('');
                    $('#campo_atuacao').val('');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Erro na requisição: ' + error);
                }
            });
        });
    </script>
</body>

</html>