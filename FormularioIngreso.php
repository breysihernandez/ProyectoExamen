<?php

session_start();


$host = 'localhost';
$dbname = 'libreria'; 
$user = 'root'; 
$password = ''; 


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage(); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    
    $stmt = $conn->prepare("SELECT * FROM empleados WHERE Usuario = :usuario AND Contraseña = :contrasena");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->execute();

    $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($empleado) {
        
        $_SESSION['usuario'] = $empleado['Usuario'];
        header('Location: inicio.php'); 
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Metromedia</title>
    <style>
        body {
            background-color: rgba(255, 255, 255, 0.8); 
            background-image: url('IMG/fondo1.jpg'); 
            background-size: cover; 
            backdrop-filter: blur(2px);
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            
        }
        .login-container {
            width: 300px;
            margin: 100px auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
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
<body>

<div class="login-container">
        <div class="logo text-center">
            <img src="IMG/metromedia.jpeg" alt="Descripción de la imagen" class="img-fluid rounded mb-4">
        </div>

    <h2>Formulario de Ingreso</h2>
    
    <form method="POST" action="">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <input type="submit" value="Ingresar">
    </form>
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
</div>

</body>
</html>

