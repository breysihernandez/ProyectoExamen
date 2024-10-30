<?php
require('cnx.php'); 

$U = $_POST["txtU"];
$C = $_POST["txtC"];

try {
    $stmt = $camino->prepare("SELECT * FROM empleados WHERE Usuario = ? AND Contraseña = ?");
    $stmt->bind_param("ss", $U, $C); 

    
    $stmt->execute();
    $resultado = $stmt->get_result();  

    
    if ($resultado->num_rows > 0) {
        session_start();
        $empleado = $resultado->fetch_assoc(); 

       
        $_SESSION['empleados'] = $empleado['Usuario']; 

       
        header("location: menu.php");
        exit(); 
    } else {
        echo "Usuario y/o contraseña incorrecta";
    }

   
    $stmt->close();
    mysqli_close($camino);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    mysqli_close($camino);
}
?>
