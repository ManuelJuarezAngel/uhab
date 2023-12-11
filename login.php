<?php
include('conexion.php');
session_start();
error_reporting(0);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        ?>
        <script>
            alert('Inicio de sesión exitoso. ¡Bienvenido, <?= $username ?>!')
            window.location = "index.php";
        </script>
    <?php } else { ?>
        <script>
            alert('Credenciales inválidas. Por favor, inténtalo nuevamente.')
        </script>
<?php }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script>
        function validateForm() {
            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;

            if (username == "" || password == "") {
                alert("Por favor, completa todos los campos");
                return false;
            }
        }
    </script>
</head>

<body>
    <form name="loginForm" action="login.php" method="post" onsubmit="return validateForm()">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username"><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="Iniciar sesión">
    </form>
</body>

</html>