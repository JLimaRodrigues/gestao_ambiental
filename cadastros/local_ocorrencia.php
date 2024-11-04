<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['qual'] == 'local') {

        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/conexao.php';
        header('Content-Type: application/json');
        $con = connect_local_mysqli('gestao_ambiental');

        $carregarDados = $_POST['carregarDados'] ?? '';

        if ($carregarDados == 'sim') {

            $sql = "SELECT * FROM local";
            $resultado = mysqli_query($con, $sql);

            $dados = [];

            if ($resultado) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $dados[] = [
                        'id' => $row['id'],
                        'local' => $row['local'],
                        'descricao' => $row['descricao'],
                        'observacao' => $row['observacao']
                    ];
                }

                if (empty($dados)) {
                    echo json_encode(["error" => "Consulta não retornou dados."]);
                } else {
                    echo json_encode(["dados" => $dados]);
                }
            } else {
                echo json_encode(["error" => "Erro na execução da consulta."]);
            }
            exit;
        }

        if ($carregarDados == 'nao') {
            $id = $_REQUEST['id'] ?? '';
            $local = $_REQUEST['local'] ?? '';
            $descricao = $_REQUEST['descricao'] ?? '';
            $observacao = $_REQUEST['observacao'] ?? '';

            if (!empty($id)) {

                $sql = "UPDATE local SET LOCAL='$local', descricao='$descricao', observacao='$observacao' WHERE id = '$id'";
                $resultado = mysqli_query($con, $sql);

                if ($resultado) {
                    echo json_encode(["status" => "true", "message" => "Setor atualizado com sucesso."]);
                } else {
                    echo json_encode(["status" => "false", "message" => "Erro ao atualizar setor."]);
                }
                exit;
            } else {

                $sql = "INSERT INTO LOCAL (local, descricao, observacao) VALUES ('$local','$descricao','$observacao')";
                $resultado = mysqli_query($con, $sql);

                if ($resultado) {
                    echo json_encode(["status" => "true", "message" => "Setor adicionado com sucesso."]);
                } else {
                    echo json_encode(["status" => "false", "message" => "Erro ao adicionar setor."]);
                }
                exit;
            }
        }

        if ($carregarDados == 'linha') {

            $id = $_POST['id'];

            $sql = "SELECT * FROM LOCAL WHERE id = '$id' ";
            $resultado = mysqli_query($con, $sql);

            $dados = [];

            if ($resultado) {

                $row = mysqli_fetch_assoc($resultado);

                $dados[] = [
                    'id' => $row['id'],
                    'local' => $row['local'],
                    'descricao' => $row['descricao'],
                    'observacao' => $row['observacao']
                ];


                if (empty($dados)) {
                    echo json_encode(["error" => "Consulta não retornou dados."]);
                } else {
                    echo json_encode(["dados" => $dados]);
                }
            } else {
                echo json_encode(["error" => "Erro na execução da consulta."]);
            }
            exit;
        }

        if ($carregarDados == 'delete') {
            $id = $_POST['id'];

            $sql = "DELETE FROM LOCAL WHERE id = '$id' ";
            $resultado = mysqli_query($con, $sql);

            if ($resultado) {
                echo json_encode(["dados" => "Setor deletado com sucesso."]);
            } else {
                echo json_encode(["error" => "Erro na execução da consulta."]);
            }
            exit;
        }
    }

    if ($_POST['qual'] == 'ocorrencia') {

        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/conexao.php';
        header('Content-Type: application/json');
        $con = connect_local_mysqli('gestao_ambiental');

        $carregarDados = $_POST['carregarDados'] ?? '';

        if ($carregarDados == 'sim') {

            $sql = "SELECT * FROM ocorrencia";
            $resultado = mysqli_query($con, $sql);

            $dados = [];

            if ($resultado) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $dados[] = [
                        'id' => $row['id'],
                        'ocorrencia' => $row['ocorrencia'],
                        'observacao' => $row['observacao']
                    ];
                }

                if (empty($dados)) {
                    echo json_encode(["error" => "Consulta não retornou dados."]);
                } else {
                    echo json_encode(["dados" => $dados]);
                }
            } else {
                echo json_encode(["error" => "Erro na execução da consulta."]);
            }
            exit;
        }

        if ($carregarDados == 'nao') {
            $id = $_REQUEST['id'] ?? '';
            $ocorrencia = $_REQUEST['ocorrencia'] ?? '';
            $observacao = $_REQUEST['observacao'] ?? '';

            if (!empty($id)) {

                $sql = "UPDATE OCORRENCIA SET ocorrencia='$ocorrencia', observacao='$observacao' WHERE id = '$id'";
                $resultado = mysqli_query($con, $sql);

                if ($resultado) {
                    echo json_encode(["status" => "true", "message" => "Setor atualizado com sucesso."]);
                } else {
                    echo json_encode(["status" => "false", "message" => "Erro ao atualizar setor."]);
                }
                exit;
            } else {

                $sql = "INSERT INTO OCORRENCIA (ocorrencia, observacao) VALUES ('$ocorrencia', '$observacao')";
                $resultado = mysqli_query($con, $sql);

                if ($resultado) {
                    echo json_encode(["status" => "true", "message" => "Setor adicionado com sucesso."]);
                } else {
                    echo json_encode(["status" => "false", "message" => "Erro ao adicionar setor."]);
                }
                exit;
            }
        }

        if ($carregarDados == 'linha') {

            $id = $_POST['id'];

            $sql = "SELECT * FROM OCORRENCIA WHERE id = '$id' ";
            $resultado = mysqli_query($con, $sql);

            $dados = [];

            if ($resultado) {

                $row = mysqli_fetch_assoc($resultado);

                $dados[] = [
                    'id' => $row['id'],
                    'ocorrencia' => $row['ocorrencia'],
                    'observacao' => $row['observacao']
                ];


                if (empty($dados)) {
                    echo json_encode(["error" => "Consulta não retornou dados."]);
                } else {
                    echo json_encode(["dados" => $dados]);
                }
            } else {
                echo json_encode(["error" => "Erro na execução da consulta."]);
            }
            exit;
        }

        if ($carregarDados == 'delete') {
            $id = $_POST['id'];

            $sql = "DELETE FROM OCORRENCIA WHERE id = '$id' ";
            $resultado = mysqli_query($con, $sql);

            if ($resultado) {
                echo json_encode(["dados" => "Setor deletado com sucesso."]);
            } else {
                echo json_encode(["error" => "Erro na execução da consulta."]);
            }
            exit;
        }
    }
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/autoload.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="/includes/estilo.css" rel="stylesheet">

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
                            <th>Descrição</th>
                            <th>Observações</th>
                            <th>Opções</th>
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
                <table width="100%" id="tabela_ocorrencia" class="table table-striped tabela">
                    <thead>
                        <tr>
                            <th>Ocorrência</th>
                            <th>Observações</th>
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

    <!-- Modal 01 -->
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
                        <input type="hidden" class="form-control" id="id_local" name="id_local">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="local" class="form-label">Local:</label>
                                <input type="text" class="form-control" id="local" name="local" value="">
                                <span style="font-size: 12px;">30 caracteres restantes</span>
                            </div>

                            <div class="col-md-6">
                                <label for="descricao" class="form-label">Descrição:</label>
                                <input type="text" class="form-control" id="descricao" name="descricao">
                                <span style="font-size: 12px;">30 caracteres restantes</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="observacao_local" class="form-label">Observação:</label>
                                <textarea class="form-control" id="observacao_local" name="observacao_local" rows="3" max="200"></textarea>
                                <div id="charCountObsLocal" class="text-end" style="font-size: 12px;">200 caracteres restantes</div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-dark" id="saveBtnLocal">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 02 -->
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
                        <input type="text" class="form-control" id="id_ocorrencia" name="id_ocorrencia">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="ocorrencia" class="form-label">Ocorrência:</label>
                                <input type="text" class="form-control" id="ocorrencia" name="ocorrencia" value="">
                                <span style="font-size: 12px;">30 caracteres restantes</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="observacao_ocorrencia" class="form-label">Observações:</label>
                                <textarea class="form-control" id="observacao_ocorrencia" name="observacao_ocorrencia" rows="3" max="200"></textarea>
                                <div id="charCountObsOcorr" class="text-end" style="font-size: 12px;">200 caracteres restantes</div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-dark" id="saveBtnOcorrencia">Salvar</button>
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
        let datatable_local;
        let datatable_ocorrencia;

        $('#id_local').val('');
        $('#local').val('');
        $('#descricao').val('');
        $('#observacao_local').val('');

        $('#id_ocorrencia').val('');
        $('#ocorrencia').val('');
        $('#observacao_ocorrencia').val('');

        $(document).ready(function() {

            document.getElementById("addBtnLocal").addEventListener("click", function() {
                $('#modal01').modal('show');
            });
            document.getElementById("addBtnOcorrencia").addEventListener("click", function() {
                $('#modal02').modal('show');
            });

            carregarDadosLocal();
            carregarDadosOcorrencia();
        });

        function setupCharCounter(textarea, charCount, maxChars = 200) {
            textarea.addEventListener('input', function() {
                if (textarea.value.length > maxChars) {
                    alert("Você ultrapassou o limite de 200 caracteres.");
                    textarea.value = textarea.value.substring(0, maxChars);
                }

                const remainingChars = maxChars - textarea.value.length;
                charCount.textContent = `${remainingChars} caracteres restantes`;
            });
        }

        const textareaObsLocal = document.getElementById('observacao_local');
        const charCountObsLocal = document.getElementById('charCountObsLocal');
        const textareaObsOcorr = document.getElementById('observacao_ocorrencia');
        const charCountObsOcorr = document.getElementById('charCountObsOcorr');

        setupCharCounter(textareaObsLocal, charCountObsLocal);
        setupCharCounter(textareaObsOcorr, charCountObsOcorr);


        const local = document.getElementById('local');
        const descricao = document.getElementById('descricao');
        const ocorrencia = document.getElementById('ocorrencia');
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

        enforceMaxLength(local);
        enforceMaxLength(descricao);
        enforceMaxLength(ocorrencia);


        /*----------------FUNÇÕES PARA O CRUD LOCAL ----------------------------------*/

        async function carregarDatatableLocal(data) {
            if (datatable_local) {
                datatable.clear().rows.add(data).draw();
            } else {
                datatable_local = $('#tabela_local').DataTable({
                    language: {
                        "url": "/componentes/datatablesPortugues.json"
                    },
                    data: data,
                    columns: [{
                            "data": "local"
                        },
                        {
                            "data": "descricao"
                        },
                        {
                            "data": "observacao"
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
                    lengthChange: false,
                    paging: false,
                    info: false,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Todos"]
                    ],
                    drawCallback: function(settings) {

                        var api = this.api();

                        $('#tabela_local tbody').on('click', '.edit', function(event) {

                            var data = $('#tabela_local').DataTable().row($(this).closest('tr')).data();
                            var id = data.id;

                            $('#modal01').modal('show');

                            $.ajax({
                                url: "local_ocorrencia.php",
                                method: 'POST',
                                data: {
                                    id: id,
                                    carregarDados: "linha",
                                    qual: "local"
                                },
                                success: function(response) {

                                    if (response.dados && response.dados.length > 0) {
                                        var data = response.dados[0];

                                        $('#id_local').val(data.id);
                                        $('#local').val(data.local);
                                        $('#descricao').val(data.descricao);
                                        $('#observacao_local').val(data.observacao);

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

                        $('#tabela_local tbody').on('click', '.delete', function(event) {
                            var data = $('#tabela_local').DataTable().row($(this).closest('tr')).data();
                            var id = data.id;

                            if (confirm('Você tem certeza que deseja deletar este local?')) {
                                $.ajax({
                                    url: "local_ocorrencia.php",
                                    method: 'POST',
                                    data: {
                                        id: id,
                                        carregarDados: "delete",
                                        qual: "local"
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

        function carregarDadosLocal() {
            $.ajax({
                url: 'local_ocorrencia.php',
                type: "POST",
                data: {
                    carregarDados: "sim",
                    qual: "local"
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Resposta do servidor:', response);
                    if (response.dados && Array.isArray(response.dados)) {
                        carregarDatatableLocal(response.dados);
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

        $('#modal01').on('click', '#saveBtnLocal', function() {
            var id = $('#id_local').val();
            var local = $('#local').val();
            var descricao = $('#descricao').val();
            var observacao = $('#observacao_local').val();

            $.ajax({
                url: 'local_ocorrencia.php',
                type: 'POST',
                data: {
                    id: id,
                    local: local,
                    descricao: descricao,
                    observacao: observacao,
                    carregarDados: 'nao',
                    qual: "local"
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
                    $('#local').val('');
                    $('#descricao').val('');
                    $('#observacao_local').val('');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Erro na requisição: ' + error);
                }
            });
        });

        /*----------------FUNÇÕES PARA O CRUD OCORRENCIA-----------------------------*/

        async function carregarDatatableOcorrencia(data) {
            if (datatable_ocorrencia) {
                datatable.clear().rows.add(data).draw();
            } else {
                datatable_ocorrencia = $('#tabela_ocorrencia').DataTable({
                    language: {
                        "url": "/componentes/datatablesPortugues.json"
                    },
                    data: data,
                    columns: [{
                            "data": "ocorrencia"
                        },
                        {
                            "data": "observacao"
                        },
                        {
                            "data": null,
                            "defaultContent": `
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-sm btn-outline-dark edit1 me-1">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger delete1">
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
                    lengthChange: false,
                    paging: false,
                    ordering: true,
                    info: false,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Todos"]
                    ],
                    drawCallback: function(settings) {

                        var api = this.api();

                        $('#tabela_ocorrencia tbody').on('click', '.edit1', function(event) {

                            var data = $('#tabela_ocorrencia').DataTable().row($(this).closest('tr')).data();
                            var id = data.id;

                            $('#modal02').modal('show');

                            $.ajax({
                                url: "local_ocorrencia.php",
                                method: 'POST',
                                data: {
                                    id: id,
                                    carregarDados: "linha",
                                    qual: "ocorrencia"
                                },
                                success: function(response) {
                                    if (response.dados && response.dados.length > 0) {
                                        var data = response.dados[0];

                                        $('#id_ocorrencia').val(data.id);
                                        $('#ocorrencia').val(data.ocorrencia);
                                        $('#observacao_ocorrencia').val(data.observacao);

                                        $('#modal02').modal('show');
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

                        $('#tabela_ocorrencia tbody').on('click', '.delete1', function(event) {
                            var data = $('#tabela_ocorrencia').DataTable().row($(this).closest('tr')).data();
                            var id = data.id;

                            if (confirm('Você tem certeza que deseja deletar esta ocorrencia?')) {
                                $.ajax({
                                    url: "local_ocorrencia.php",
                                    method: 'POST',
                                    data: {
                                        id: id,
                                        carregarDados: "delete",
                                        qual: "ocorrencia"
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

        function carregarDadosOcorrencia() {
            $.ajax({
                url: 'local_ocorrencia.php',
                type: "POST",
                data: {
                    carregarDados: "sim",
                    qual: "ocorrencia"
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Resposta do servidor:', response);
                    if (response.dados && Array.isArray(response.dados)) {
                        carregarDatatableOcorrencia(response.dados);
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

        $('#modal02').on('click', '#saveBtnOcorrencia', function() {
            var id = $('#id_ocorrencia').val();
            var ocorrencia = $('#ocorrencia').val();
            var observacao = $('#observacao_ocorrencia').val();

            $.ajax({
                url: 'local_ocorrencia.php',
                type: 'POST',
                data: {
                    id: id,
                    ocorrencia: ocorrencia,
                    observacao: observacao,
                    carregarDados: 'nao',
                    qual: "ocorrencia"
                },
                success: function(response) {
                    console.log(response);
                    $('#modal02').modal('hide');

                    if (response.status === 'true') {
                        window.location.reload();
                    } else {
                        alert(response.message);
                    }

                    $('#id').val('');
                    $('#ocorrencia').val('');
                    $('#observacao_ocorrencia').val('');
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