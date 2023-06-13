<?php
function listarArchivos($ruta)
{
    $archivos = scandir($ruta);
    $archivos = array_diff($archivos, array('.', '..')); // Eliminar las entradas "." y ".."

    sort($archivos); // Ordenar los archivos alfabéticamente

    echo "<table>";
    echo "<tr><th>Nombre de archivo</th></tr>";

    foreach ($archivos as $archivo) {
        $rutaCompleta = $ruta . '/' . $archivo;
        if (is_dir($rutaCompleta)) {
            echo "<tr><td><strong>$archivo</td></tr>";
            listarArchivos($rutaCompleta);
        } else {
            $extension = pathinfo($rutaCompleta, PATHINFO_EXTENSION);
            if (strtolower($extension) == 'pdf') {
                $rutaArchivo = str_replace($_SERVER['DOCUMENT_ROOT'], '', $rutaCompleta);
                echo "<tr><td><a href='$rutaArchivo' target='_blank'>$archivo</a></td></tr>";
            }
        }
    }

    echo "</table>";
}

$rut = $_GET['rutcito']; // Obtener el rut ingresado por el usuario

$folder = "das/controller/pdfs_personal"; // Ruta de la carpeta principal relativa al directorio raíz del servidor web
$targetFolder = $_SERVER['DOCUMENT_ROOT'] . "/" . $folder . "/" . $rut; // Ruta completa de la carpeta específica del rut

if (is_dir($targetFolder)) { // Verificar si la carpeta existe
    listarArchivos($targetFolder);
} else {
    echo "La carpeta para el rut $rut no existe.";
}
