$(document).ready(() => {

    $(document).on('click', '.btn-editar-local', function() {
        let id = $(this).data('id');
        let local = $(this).data('local');

        $('#editar-id-local').val(id);
        $('#editar-local').val(local);
    });

    $('#salvar-edicao-local').on('click', function () {
        let formData = {
            id: $('#editar-id-local').val(),
            local: $('#editar-local').val(),
        };

        // ajaxAtualizar(`{{ url_for('editarLocal') }}`, formData, function(response) {// tire a rederização especifica pelo framework slim visto que agora o js está em um arquivo separado
        ajaxAtualizar(`http://10.4.132.70/admin/localOcorrencia/editarLocal`, formData, function(response) {
            $('#modal-editar').modal('hide');
            window.location.reload();
        });
    });

    $(document).on('click', '.btn-excluir-local', function() {
        let id = $(this).data('id');
        let local = $(this).data('local');

        $('#excluir-id').val(id);
        $('#nome-local-excluir').text(local);
    });

    $('#confirmar-exclusao-local').on('click', function() {
        let id = $('#excluir-id').val();

        // ajaxDeletar(`{{ url_for('excluirLocal') }}`, id, function(response) {
        ajaxDeletar(`http://10.4.132.70/admin/localOcorrencia/excluirLocal`, id, function(response) {
            $('#modal-excluir').modal('hide');
            window.location.reload();
        });
    });

    $('#criar-local').on('click', function () {
        let formData = {
            local: $('#local').val(),
        };

        // ajaxCriar(`{{ url_for('criarLocal') }}`, formData, function(response) {
        ajaxCriar(`http://10.4.132.70/admin/localOcorrencia/criarLocal`, formData, function(response) {
            $('#modal-editar').modal('hide');
            window.location.reload();
        });
    });

})