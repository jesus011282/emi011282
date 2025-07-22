<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Responsive</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
        }
        .container-fluid {
            display: flex;
            width: 80%;
            max-width: 900px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .left-side {
            flex: 1;
            text-align: center;
            padding: 40px;
            border-radius: 10px 0 0 10px;
        }
        .left-side img {
            max-width: 100%;
            height: auto;
        }
        .right-side {
            flex: 1;
            padding: 40px;
            text-align: center;
        }
        .profile-icon {
            width: 80px;
            height: 80px;
            background: #708A65;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 40px;
            margin: 0 auto 20px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .toggle-password {
            cursor: pointer;
        }
        .spinner {
            display: none;
            margin: 10px auto;
            width: 24px;
            height: 24px;
            border: 3px solid #ccc;
            border-top: 3px solid #5C6BC0;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="left-side">
            <h2 class="torre-medica">TORRE MEDICA</h2>
            <img src="2.jpg" width="800" height="500">
        </div>
        <div class="right-side">
            <div class="profile-icon">
                <i class="fas fa-user"></i>
            </div>
            <h3>Iniciar Sesión</h3>
            <div class="spinner" id="spinner"></div>
            <form id="formLogin">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" minlength="8" maxlength="10" required>
                    <div class="input-group-append">
                        <span class="input-group-text toggle-password"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
            </form>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        $(".toggle-password").click(function(){
            let input = $("#password");
            let icon = $(this).find("i");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                input.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        /*    
        $("#formLogin").submit(function(e){
            e.preventDefault();
            $("#spinner").show();

            $.post("login.php", $(this).serialize(), function(data){
                $("#spinner").hide();
                if (data.includes("Acceso correcto")) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido',
                        text: 'Inicio de sesión exitoso.'
                    }).then(() => {
                        window.location.href = "inicio.php";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de acceso',
                        text: data
                    });
                }
            });
        });
        */
        $("#formLogin").submit(function(e){
                e.preventDefault();
                $("#spinner").show();

                $.post("login.php", $(this).serialize(), function(data){
                    $("#spinner").hide();
                    if (data.includes("Acceso correcto")) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Bienvenido',
                            text: 'Inicio de sesión exitoso.'
                        }).then(() => {
                            window.location.href = "inicio.php";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de acceso',
                            text: data
                        });
                        if (data.includes("Error en CAPTCHA")) {
                            $("#formLogin")[0].reset(); // Limpia los valores del formulario
                            grecaptcha.reset(); // Reinicia el CAPTCHA
                        }
                    }
                });
            });



    });
    </script>
</body>
</html>
