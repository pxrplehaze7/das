$(document).ready(function() {
    var contadorDocumentos = 1;

    // Función para agregar un nuevo div "row document"
    function agregarDocumento() {
        contadorDocumentos++;
        var nuevoDocumento = $('<div class="row document">' +
            '<div class="col-md-2">' +
            '<label for="idDecreto' + contadorDocumentos + '"><span style="color: #c40055;">*</span> N° Decreto</label>' +
            '<input type="text" name="nameDecreto[]" id="idDecreto' + contadorDocumentos + '" class="form-control" maxlength="30" required>' +
            '</div>' +
            '<div class="col-md-5 document">' +
            '<label for="idDocContratoInput' + contadorDocumentos + '">Contrato</label>' +
            '<div class="input-group">' +
            '<input type="file" id="idDocContratoInput' + contadorDocumentos + '" name="nameDocContratoInput[]" class="form-control" accept=".pdf">' +
            '<button class="button" type="button" onclick="clearFileInput(\'idDocContratoInput' + contadorDocumentos + '\')">' +
            '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="bell">' +
            '<path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />' +
            '</svg>' +
            '</button>' +
            '</div>' +
            '</div>' +
            '<div class="col-md-3">' +
            '<label for="idFechaTer' + contadorDocumentos + '"><span style="color: #c40055;">*</span> Termino</label>' +
            '<input type="date" name="nameFechaTer[]" id="idFechaTer' + contadorDocumentos + '" class="form-control">' +
            '</div>' +
            '<div class="col-md-2" style="display: flex !important;align-self: end;padding-bottom: 11px;">' +
            '<button class="btn btn-danger eliminar-documento" type="button">Eliminar</button>' +
            '</div>' +
            '</div>');

        nuevoDocumento.find('.eliminar-documento').click(function() {
            $(this).closest('.row.document').remove();
        });

        $('#document-container').append(nuevoDocumento);
    }

    // Manejador de evento para el botón "Agregar documento"
    $('#agregar-documento').click(function() {
        agregarDocumento();
    });

    // Manejador de evento delegado para el botón "Eliminar documento"
    $('#document-container').on('click', '.eliminar-documento', function() {
        $(this).closest('.row.document').remove();
    });
});
