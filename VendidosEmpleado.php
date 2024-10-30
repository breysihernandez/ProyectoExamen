<?php
require('fpdf186/fpdf.php');


$host = 'localhost';
$db = 'libreria';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_empleado'])) {
    $id_empleado = $_POST['id_empleado'];

    
    $sql = "SELECT lb.titulo, dv.cantidad, dv.precio_unitario, (dv.cantidad * dv.precio_unitario) AS total 
            FROM detalle_venta dv 
            INNER JOIN ventas v ON dv.id_venta = v.id_venta 
            INNER JOIN libros lb ON dv.id_libro = lb.id_libro 
            WHERE v.id_empleado = ?
            ORDER BY lb.titulo";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_empleado);
    $stmt->execute();
    $result = $stmt->get_result();

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Reporte de Libros Vendidos', 0, 1, 'C');
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(0, 10, 'Empleado ID: ' . $id_empleado, 0, 1, 'C');
    $pdf->Ln(10);

    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(200, 220, 255); 
    $pdf->Cell(80, 10, 'Titulo', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Precio Unitario', 1, 0, 'C', true);
    $pdf->Cell(30, 10, 'Total', 1, 1, 'C', true); 

    
    $pdf->SetFont('Arial', '', 12);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(80, 10, $row['titulo'], 1);
        $pdf->Cell(30, 10, $row['cantidad'], 1);
        $pdf->Cell(30, 10, 'L' . number_format($row['precio_unitario'], 2), 1);
        $pdf->Cell(30, 10, 'L' . number_format($row['total'], 2), 1);
        $pdf->Ln();
    }

    
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="reporte_ventas_empleado.pdf"');
    $pdf->Output('I', 'reporte_ventas_empleado.pdf');

    $stmt->close();
} else {
    
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reporte de Ventas por Empleado</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                background-color: #f8f9fa;
            }
            h1 {
                color: #343a40;
                margin-bottom: 20px;
            }
            form {
                margin-bottom: 20px;
            }
            .btn-custom {
                background-color: #007bff;
                color: white;
            }
            .btn-custom:hover {
                background-color: #0056b3;
                color: white;
            }
            
        .nav {
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center; 
            padding: 15px;
            list-style: none;
        }

        .nav-item {
            margin: 0 20px; 
        }

        .nav a {
            color: #ffffff;
            text-decoration: none;
            padding: 8px 16px;
            display: block;
        }

        .nav a:hover {
            background-color: #ffc107;
            border-radius: 5px;
        }

        h1, h2 {
            color: #343a40;
        }

        .nav-link {
            font-size: 1.2rem;
        }
        .logo {
            display: flex;
            justify-content: center; 
            align-items: center; 
            margin: 20px 0; 
        }

        .logo img {
            max-width: 100%; 
            height: auto;
        }
        body {
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
        }

        .fondo-borroso {
            background-color: rgba(255, 255, 255, 0.9); 
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            color: #343a40;
        }
        .container {
            margin-top: 50px;
        }

        h1, h2 {
            color: #343a40;
        }

        .categoria {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: rgba(255, 255, 255, 0.8); 
            text-align: center;
            color: #000;
        }

        .categoria h4 {
            font-size: 1.5rem;
            color: #007bff;
        }

        .categoria p {
            font-size: 1rem;
            color: #000;
        }

        .formulario-cuadro {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.9); 
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.7);
            border: 1px solid #ccc;
        }

        .form-label {
            font-weight: bold;
            color: #343a40; 
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
        .nav {
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center; 
            padding: 15px;
            list-style: none;
        }

        .nav-item {
            margin: 0 20px;
        }

        .nav a {
            color: #ffffff;
            text-decoration: none;
            padding: 8px 16px;
            display: block;
        }

        .nav a:hover {
            background-color: #ffc107;
            border-radius: 5px;
        }

        h1, h2 {
            color: #343a40;
        }

        .nav-link {
            font-size: 1.2rem;
        }
        .logo {
            display: flex;
            justify-content: center; 
            align-items: center; 
            margin: 20px 0; 
        }

        .logo img {
            max-width: 100%; 
            height: auto;
        }
        </style>
    </head>
    <div class="logo text-center">
        <img src="IMG/metromedia.jpeg" alt="Descripción de la imagen" class="img-fluid rounded mb-4">
    </div>

    
    <body>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link text-white" href="inicio.php">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="producto.php">Producto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="VendidosEmpleado.php">Libros Vendidos por Empleado</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="MasVenidos.php">Libros por genero</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="Cerrar.php">Salir</a>
        </li>
    </ul>
    
    <div class="container mt-5">
    <h1 class="text-center">Reporte de Ventas por Empleado</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="id_empleado">Ingrese el ID del Empleado:</label>
            <input type="number" id="id_empleado" name="id_empleado" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-custom">Generar Reporte</button>
    </form>
</div>

    </body>
    </html>
    <?php
}

$conn->close();
?>

