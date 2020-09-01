<?php
 
 // Datos de conexión a la Base de Datos
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
 
 // Pido el campo 'url' de todos los postres o registros de la tabla 'postres' en la Base de Datos 
 $sql = "SELECT id FROM posts";
 
 // Llamo los resultados con los postres o registros
 $resultados = $conexion->query($sql);
 
 // Defino mi archivo como XML  
 header("Content-Type: text/xml");
 
 // Inicio la estructura de mi archivo XML 
 echo "<?xml version='1.0' encoding='iso-8859-1' ?>" .
 "<urlset xmlns='https://www.sitemaps.org/schemas/sitemap/0.9'>"; 
 
 echo "<url>
 <loc>https://localhost:8000/dashboard</loc>
 <changefreq>weekly</changefreq>
 <priority>"."0.8"."</priority>
 </url>";
 
 echo "<url>
 <loc>https://localhost:8000/perfil</loc>
 <changefreq>weekly</changefreq>
 <priority>"."0.8"."</priority>
   </url>";
   
 echo "<url>
 <loc>https://localhost:8000/tienda</loc>
 <changefreq>weekly</changefreq>
 <priority>"."0.8"."</priority>
   </url>";
   
 echo "<url>
 <loc>https://localhost:8000/amigos</loc>
 <changefreq>weekly</changefreq>
 <priority>"."0.8"."</priority>
   </url>"; 
  echo "<url>
 <loc>https://localhost:8000/registrar-post</loc>
 <changefreq>weekly</changefreq>
 <priority>"."0.8"."</priority>
   </url>"; 
 echo "<url>
 <loc>https://localhost:8000/mis-post</loc>
 <changefreq>weekly</changefreq>
 <priority>"."0.8"."</priority>
   </url>"; 
 echo "<url>
 <loc>https://localhost:8000/admin</loc>
 <changefreq>weekly</changefreq>
 <priority>"."0.8"."</priority>
   </url>"; 
 echo "<url>
 <loc>https://localhost:8000/ban</loc>
 <changefreq>weekly</changefreq>
 <priority>"."0.8"."</priority>
   </url>"; 
 echo "<url>
 <loc>https://localhost:8000/foro</loc>
 <changefreq>weekly</changefreq>
 <priority>"."0.8"."</priority>
   </url>"; 

 
 
 if ($resultados->num_rows > 0) {
 
     while($row = $resultados->fetch_assoc()) {
 
     	echo "<url>
 <loc>https://www.midominio.com/posts/". $row["id"]. "</loc>
 <changefreq>weekly</changefreq>
 <priority>"."0.8"."</priority>
   </url>";
     }
 
 } 
 
 // Si no hay registros en la Base de Datos enviamos el siguiente mensaje
 else {
     echo "0 resultados";
 }
 
 
 // Cierre de la etiqueta del archivo XML del Sitemap
 echo "</urlset>";
 
 // Cierro la conexión a la Base de Datos por seguridad 
 $conexion->close(); 

