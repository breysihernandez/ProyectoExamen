<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libreria"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error); 
}


$sql = "SELECT * FROM generos"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title></title>
    <style>
        .categoria {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1); 
            transform: translateY(-5px); 
        }
        body {
            background-color: #f8f9fa; 
            font-family: 'Poppins', sans-serif; 
        }

        .navbar {
            background-color: #343a40; 
        }

        .navbar a {
            color: #ffffff; 
        }

        .navbar a:hover {
            color: #ffc107; 
        }

        .container {
            margin-top: 50px;
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            font-size: 2.5rem; 
            color: #343a40; 
        }

        .nav-link {
            font-size: 1.2rem; 
        }

      
        ul.nav {
            background: linear-gradient(90deg, #007bff, #0056b3); 
            padding: 10px 0;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
            list-style: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        ul.nav li {
            display: inline-block;
            margin-right: 20px;
        }

        ul.nav li a {
            color: #fff; 
            text-decoration: none;
            font-size: 1.2rem;
            padding: 8px 16px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        ul.nav li a:hover {
            background-color: #ffc107; 
            color: #fff;
            border-radius: 4px;
        }

   
        .logo {
            text-align: center;
            margin: 20px 0;
        }

        .logo img {
            max-width: 400px; 
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.1); 
        }

     
        .boton-fijo {
            position: fixed;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .boton-fijo:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
     
     <div class="logo">
        <img src="IMG/metromedia.jpeg" alt="Descripción de la imagen" class="img-fluid rounded mb-4">
    </div>

    
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link text-white" href="inicio.php">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="producto.php">Producto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">Acerca de</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="Factura.php">Factura</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="cerrar.php">Salir</a>
        </li>
    </ul>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Bienvenido a Nuestra Librería</h1>
        <p class="text-center">Explora un mundo de conocimiento y aventuras. Aquí encontrarás una amplia variedad de libros, desde clásicos atemporales hasta las últimas novedades en literatura. ¡Sumérgete en nuestras recomendaciones y descubre tu próxima lectura!</p>

        <h2 class="mt-5">Categorías de Libros</h2>
        <div class="row">
            <?php
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '
                    <div class="col-md-3">
                        <div class="categoria">
                            <h4>' . htmlspecialchars($row['nombre_genero']) . '</h4>
                            <p>Descubre nuestros libros de ' . htmlspecialchars($row['nombre_genero']) . '.</p>
                        </div>
                    </div>';
                }
            } else {
                echo '<p>No se encontraron categorías disponibles.</p>';
            }
            ?>
        </div>

        <h2 class="mt-5">Agregar Nuevo Libro</h2>
        <form action="agregar_libro.php" method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="id_autor" class="form-label">ID Autor</label>
                <input type="number" class="form-control" id="id_autor" name="id_autor" required>
            </div>
            <div class="mb-3">
                <label for="id_genero" class="form-label">ID Género</label>
                <input type="number" class="form-control" id="id_genero" name="id_genero" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" id="precio" name="precio" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Libro</button>
        </form>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php

$conn->close();
?>
