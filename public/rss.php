<?php header ("Content-type: text/xml"); ?>
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
<channel>
    <title>Parchís Mg98</title>
    <link>http://localhost:8000/foro</link>
    <description>Artículos sobre desarrollo web en Español.</description>
    <language>es</language>
    <?php
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $db = "parchismg98";

        // Creo la conexión
        $conexion = new mysqli($servidor, $usuario, $password, $db);

        // Soporte para caracteres y símbolos extraños
        $conexion->set_charset("utf8");

        // Validamos la conexión a la Base de Datos
        if ($conexion->connect_error) {
            die("Erro en la Conexión a la Base de Datos: " . $conexion->connect_error);
        }
        $result = $conexion->query("SELECT id, titulo, contenido, fecha, likes FROM posts ORDER BY fecha desc");
        while ($row = $result->fetch_assoc()) {
    ?>
    <item>
        <title><?php echo $row['titulo'] ?></title>
        <link>http:\\localhost:8000/posts/<?php echo $row['id'] ?></link>
        <description><?php echo $row['contenido'] ?></description>
        <fecha><?php echo $row['fecha'] ?></fecha>
        <likes><?php echo count(explode(',',$row['likes'])) ?></likes>
    </item>
    <?php }  ?>
</channel>
</rss>