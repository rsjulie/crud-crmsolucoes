const BASE_URL = window.location.origin + window.location.pathname;

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    $('#addForm').submit(function() {
        $('#addModal').modal('toggle')
        const request_data = {
            titulo: $("#add-titulo").val(),
            descricao: $("#add-descricao").val(),
        }

        $.post(`${BASE_URL}index.php?pagina=home&metodo=insert`, request_data);
    })
});

function edit(element) {
    $("#editForm input")[0].value = element.parentElement.parentElement.children[1].textContent
    $("#editForm input")[1].value = element.parentElement.parentElement.children[2].textContent
    $('#editForm').submit(function() {
        $('#editModal').modal('toggle')
        const request_data = {
            id: element.parentElement.parentElement.children[0].textContent,
            titulo: $("#update-titulo").val(),
            descricao: $("#update-descricao").val(),
        }

        $.post(`${BASE_URL}index.php?pagina=home&metodo=update`, request_data);
    })
}

function deleteItem(id) {
    $('#deleteForm').submit(function() {
        $('#deleteModal').modal('toggle')
        const request_data = {
            id: id,
        }

        $.post(`${BASE_URL}index.php?pagina=home&metodo=delete`, request_data);
    })
}