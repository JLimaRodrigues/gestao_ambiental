//funções de CRUD usando o ajax

/**
 * Função genérica para criar um registro.
 * @param {string} url - Endpoint para a criação.
 * @param {Object} data - Dados a serem enviados (um objeto com os campos).
 * @param {function} [callback] - Função a ser executada em caso de sucesso.
 */
function criarAjax(url, data, callback = () => window.location.reload())
{
    $.ajax({
        url: url,
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            callback(response);
        },
        error: function(xhr, status, error) {
            alert('Erro ao criar o registro: ' + error);
        }
    });
}

    /**
 * Função genérica para atualizar um registro.
 * @param {string} url - Endpoint para a atualização.
 * @param {Object} data - Dados a serem enviados (incluindo o identificador).
 * @param {function} [callback] - Função a ser executada em caso de sucesso.
 */
function ajaxAtualizar(url, data, callback = () => window.location.reload()) {
    $.ajax({
        url: url,
        type: 'POST', // ou 'PUT', se o backend aceitar, conforme sua implementação
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            callback(response);
        },
        error: function(xhr, status, error) {
            alert('Erro ao atualizar o registro: ' + error);
        }
    });
}

/**
 * Função genérica para excluir um registro.
 * @param {string} url - Endpoint para a exclusão.
 * @param {number|string} id - Identificador do registro a ser excluído.
 * @param {function} [callback] - Função a ser executada em caso de sucesso.
 */
function ajaxDeletar(url, id, callback = () => window.location.reload()) {
    $.ajax({
        url: url,
        type: 'POST', // ou 'DELETE', se o backend aceitar esse método
        contentType: 'application/json',
        data: JSON.stringify({ id: id }),
        success: function(response) {
            callback(response);
        },
        error: function(xhr, status, error) {
            alert('Erro ao excluir o registro: ' + error);
        }
    });
}