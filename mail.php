<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Validar los datos
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Si hay un error con los datos, redirigir de vuelta al formulario con un error
        header("Location: index.html?error=invalidinput");
        exit;
    }

    // Establecer el destinatario del correo
    $recipient = "allisonseoane96@gmail.com";

    // Asunto del correo
    $subject = "Nuevo mensaje de $name";

    // Contenido del correo
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Cabeceras del correo
    $email_headers = "From: $name <$email>";

    // Enviar el correo
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Redirigir a una página de agradecimiento o mostrar un mensaje de éxito
        header("Location: index.html?success=1");
    } else {
        // Si hay un error al enviar el correo, redirigir con un error
        header("Location: index.html?error=sendfail");
    }
} else {
    // Si el formulario no se envió correctamente, redirigir de vuelta al formulario
    header("Location: index.html");
}
?>
