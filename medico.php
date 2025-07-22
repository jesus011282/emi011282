<!-- medico.php -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Médico</title>


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- JavaScript jQuery realiza lo que es la carga de 
 los contenidos menu.php en la
 la pagina cargada al terminar -->
<script>
  $(document).ready(function () {
          $("menu").load("menu.php");
      });
      <!--
</script>
<!-- El còdigo CSS sirve para la visualizaciòn del formulari
 en la cual se ve los margenes, bordes redondeados, fondos claros
 con tener un maximo de la presentaciòn-->
  <style>
    header {
  background-color: rgba(255, 255, 255, 0.85); /* fondo blanco con transparencia */
  padding: 10px 20px;
  border-radius: 12px;
  max-width: 400px;
  margin: 30px auto 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

header h3 {
  font-size: 1.8rem;
  font-weight: bold;
  color: #333;
  margin-left: 10px;
}

header img {
  border-radius: 50%;
  border: 2px solid #2c3e50;
}

     body {
    background-image: url('2.jpg'); /* Cambia 'fondo.jpg' por tu imagen */
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
     min-height: 100vh;
     display: flex;
    flex-direction: column;
  }

    .form-container {
      margin-top: 40px;
      max-width: 500px;
      padding: 50px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: rgba(255, 255, 255, 0.95); /* Blanco con transparencia */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }
    .error {
      color: red;
      font-size: 0.9em;
    }
  </style>
</head>
<!-- Los còdigos HTML del registro del mèdico 
 en la cual incluye algunos fragmento de la pàgina del registro del mèdico
 Son el elementos de <menu> que se realiza la carga del menu
 dinamico.
 Los encabezados de <heeder> en los logos de los nombres Torres Mèdica.
  El contenedor <div class = container> que es el formulario del registro.
  como son los campos al poder ingresar los nombres medico y despligue de la lista-->
<body>
<menu></menu>
  <header class="text-center my-4 d-flex justify-content-center align-items-center gap-3">
  <img src="bueno.jpg" alt="Logo Torres Médicas" width="50" height="50">
  <h3 class="m-0">Torres Médicas</h3>
</header>
  <div class="container">
    <div class="form-container mx-auto">
      <h2 class="text-center mb-4">Registro de Médico</h2>
      <form id="formMedico">
        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
          <label for="hora">Especialidades:</label>
          <select class="form-control" id="especialidad" name="especialidad" required>
            <option value="Cardiólogo">Cardiólogo</option>
            <option value="Ginecología">Ginecología</option>
            <option value="Mèdico general">Mèdico general</option>
            <option value="Colposcopía">Colposcopía</option>
            <option value="ultrasonido pélvico y revisión de mamas">ultrasonido pélvico y revisión de mamas</option>
            <option value="Papiloma Humano (VPH)">Papiloma Humano (VPH)</option>
            
            
          </select>
        </div>
        <!-- En el formulario de registro se realiza lo que es un bloque
         de los registros medicos como son la captura de telefono
         correo electronico, el nombre del usuario, en la cual incluye lo que son los botones
         uno para registrar, modificar, eliminar -->
        <div class="form-group">
          <label for="telefono">Teléfono:</label>
          <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="10 dígitos" required>
        </div>
        <div class="form-group">
          <label for="correo">Correo:</label>
          <input type="email" class="form-control" id="correo" name="correo" required>
          <small class="error" id="errorCorreo"></small>
        </div>
        <div class="form-group">
          <label for="usuario">Usuario:</label>
          <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Registrar Mèdico</button>
        
        
    </div>
  </div>
<!-- Lo que es la validacion del formulario con jQuery y SweetAlert que son los formularios de registros
 en la cual muestra los mensajes de error en SweetAlert en la cual son algunos campos 
 obligatorios, nombre, especialidad, telefono, correo o usuario-->
  <script>
    $(document).ready(function () {
      $("#formMedico").submit(function (e) {
        e.preventDefault();

        var nombre = $("#nombre").val().trim();
        var especialidad = $("#especialidad").val().trim();
        var telefono = $("#telefono").val().trim();
        var correo = $("#correo").val().trim();
        var usuario = $("#usuario").val().trim();

        // Validaciones
        if (!nombre || !especialidad || !telefono || !correo || !usuario) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Todos los campos son obligatorios.'
          });
          return;
        }
        // Lo que es la validaciòn del telèfono que solo tenga 10 digitos numèrico en el formato
        // Del mensaje de error con SweetAlert

        var telefonoRegex = /^\d{10}$/;
        if (!telefonoRegex.test(telefono)) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El teléfono debe ser numérico de 10 dígitos.'
          });
          return;
        }
// Lo que es la recolecciòn de los datos del formulario
// En la cual se realiza la creaciòn del formData que es el almacenamiento
// De los valores de los campos
//El formulario, eliminaciòn del espacio blanco 
//Y los datos finales de cada otro datos
var formData = {
  nombre: $("#nombre").val().trim(),
  especialidad: $("#especialidad").val().trim(),
  telefono: $("#telefono").val().trim(),
  correo: $("#correo").val().trim(),
  usuario: $("#usuario").val().trim()
};
// En realizar los datos ajax en enviar el formulario del archivo registro_medico.php
//Que es POST en los registros exitoso en los mensajes de èxito en SweetAlert 
        $.ajax({
          url: "registro_medico.php",
          type: "POST",
          data: formData,
          success: function (respuesta) {
            Swal.fire({
              icon: 'success',
              title: 'Médico registrado correctamente',
              text: 'Redirigiendo a inicio...',
              timer: 3000,
              showConfirmButton: false
            });
          },
          error: function () {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Hubo un problema al registrar al paciente.'
            });
          }
        });
      });
    });
  </script>
</body>
</html>
