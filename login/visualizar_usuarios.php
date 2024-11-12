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

        $sql = "SELECT * FROM usuarios";
        $resultado = mysqli_query($con, $sql);

        $dados = [];

        if ($resultado) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $dados[] = [
                    'id' => $row['id'],
                    'nome' => $row['nome'],
                    'usuario' => $row['usuario'],
                    'email' => $row['email'],
                    'admin' => $row['admin']
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

    if ($carregarDados == 'delete') {
        $id = $_POST['id'] ?? '';

        if (empty($id)) {
            echo json_encode(["error" => "ID não fornecido."]);
            exit;
        }

        $id = mysqli_real_escape_string($con, $id);

        $sql = "DELETE FROM usuarios WHERE id = '$id' ";
        $resultado = mysqli_query($con, $sql);

        if ($resultado) {
            echo json_encode(["dados" => "Setor deletado com sucesso."]);
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
    <title>Usuários</title>
</head>

<body>

    <div class="container">
        <div class="container-fluid" style="margin-top: 60px;">
            <h1>Usuários</h1>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table width="100%" id="tabela_usuario" class="table table-striped tabela">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Usuário</th>
                                <th>Email</th>
                                <th>Administrador?</th>
                                <th>Deletar?</th>
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
        $('#nome').val('');
        $('#usuario').val('');
        $('#email').val('');
        $('#admin').val('');


        $(document).ready(function() {
            carregarDados();
        });

        async function carregarDatatable(data) {
            if (datatable) {
                datatable.clear().rows.add(data).draw();
            } else {
                datatable = $('#tabela_usuario').DataTable({
                    language: {
                        "url": "/includes/datatablesPortugues.json"
                    },
                    data: data,
                    columns: [{
                            "data": "id"
                        },
                        {
                            "data": "nome"
                        },
                        {
                            "data": "usuario"
                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "admin",
                            "render": function(data, type, row) {
                                if (data === "S") {
                                    return "Sim";
                                } else if (data === "N") {
                                    return "Não";
                                }
                                return data;
                            }
                        },
                        {
                            "data": null,
                            "defaultContent": `
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-sm btn-outline-danger delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            `,
                            "width": "50px"

                        }
                    ],
                    columnDefs: [{
                        targets: '_all',
                        className: 'text-center'
                    }],
                    ordering: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Todos"]
                    ],
                    drawCallback: function(settings) {

                        var api = this.api();

                        $('#tabela_usuario tbody').on('click', '.delete', function(event) {
                            var data = $('#tabela_usuario').DataTable().row($(this).closest('tr')).data();
                            var id = data.id;

                            if (confirm('Você tem certeza que deseja deletar este usuário?')) {
                                $.ajax({
                                    url: "visualizar_usuarios.php",
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
                url: 'visualizar_usuarios.php',
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
    </script>
</body>

</html>