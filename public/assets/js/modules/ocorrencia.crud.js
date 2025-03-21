$(document).ready(() => {

    $(document).on('click', '.btn-editar-ocorrencia', function() {
        let id = $(this).data('id');
        let ocorrencia = $(this).data('ocorrencia');

        $('#editar-id-ocorrencia').val(id);
        $('#editar-ocorrencia').val(ocorrencia);
    });

    $('#salvar-edicao-ocorrencia').on('click', function () {
        let formData = {
            id: $('#editar-id-ocorrencia').val(),
            ocorrencia: $('#editar-ocorrencia').val(),
        };

        ajaxAtualizar(`http://10.4.132.70/admin/localOcorrencia/editarOcorrencia`, formData, function(response) {
            $('#modal-editar-ocorrencia').modal('hide');
            window.location.reload();
        });
    });

    $(document).on('click', '.btn-excluir-ocorrencia', function() {
        let id = $(this).data('id');
        let ocorrencia = $(this).data('ocorrencia');

        $('#excluir-id').val(id);
        $('#nome-ocorrencia-excluir').text(ocorrencia);
    });

    $('#confirmar-exclusao-ocorrencia').on('click', function() {
        let id = $('#excluir-id').val();

        ajaxDeletar(`http://10.4.132.70/admin/localOcorrencia/excluirOcorrencia`, id, function(response) {
            $('#modal-excluir-ocorrencia').modal('hide');
            window.location.reload();
        });
    });

    $('#criar-ocorrencia').on('click', function () {
        let formData = {
            ocorrencia: $('#ocorrencia').val(),
        };

        // ajaxCriar(`{{ url_for('criarLocal') }}`, formData, function(response) {
        ajaxCriar(`http://10.4.132.70/admin/localOcorrencia/criarOcorrencia`, formData, function(response) {
            $('#modal-editar-ocorrencia').modal('hide');
            window.location.reload();
        });
    });

})