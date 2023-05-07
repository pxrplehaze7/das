<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    
</head>

<body>
    <form id="documentos" enctype="multipart/form-data" method="POST">

        <label for="nombre">NOMBRE</label>
        <input type="text" name="nombre" id="nombre">
        <br>


        <label for="pdf-files">Antecedentes</label>
        <input type="file" id="pdf-files" name="pdf-files" accept=".pdf">
        <br>


        <label for="pdf2-files">Cedula</label>
        <input type="file" id="pdf2-files" name="pdf2-files" accept=".pdf">
        <br>


        <input type="submit" value="Enviar">
    </form>
    <script src="./assets/js/main.js"></script>
</body>

</html>