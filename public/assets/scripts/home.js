$(document).ready(function() {
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    $('#addForm').submit(function() {
        console.log("TESTE");
        $('#addModal').modal('toggle')
        var request_data = {}
        request_data.titulo = $("#add-titulo").val()
        request_data.descricao = $("#add-descricao").val()

        $.post("http://localhost/crud/index.php?pagina=home&metodo=insert", request_data, function(data) {
            console.log(data)
        });
        // console.log(titulo);
        location.reload();
    })

});

function edit(e) {
    $("#editForm input")[0].value = e.parentElement.parentElement.children[1].textContent
    $("#editForm input")[1].value = e.parentElement.parentElement.children[2].textContent
    $('#editForm').submit(function() {
        $('#editModal').modal('toggle')
        var request_data = {}
        request_data.id = e.parentElement.parentElement.children[0].textContent
        request_data.titulo = $("#update-titulo").val()
        request_data.descricao = $("#update-descricao").val()

        $.post("http://localhost/crud/index.php?pagina=home&metodo=update", request_data, function(data) {
            console.log(data)
        });
    })
}

function deleteItem(e) {
    $('#deleteForm').submit(function() {
        $('#deleteModal').modal('toggle')
        var request_data = {}
        request_data.id = e

        $.post("http://localhost/crud/index.php?pagina=home&metodo=delete", request_data, function(data) {
            console.log(data)
        });
    })
}