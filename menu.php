<?php
session_start();

// Si no hay usuario, redirigir al login
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Obtener la página actual
$currentPage = basename($_SERVER['PHP_SELF']);

// Colores y iconos del menú según la página activa
$menuItems = [
    'inicio.php'        => ['Inicio', 'fas fa-home', 'primary'],
    'paciente.php'      => ['Pacientes', 'fas fa-user-injured', 'success'],
    'medico.php'        => ['Médicos', 'fas fa-user-md', 'info'],
    'cita.php'          => ['Citas', 'fas fa-calendar-plus', 'warning'],
    'vercita.php'       => ['Ver Citas', 'fas fa-calendar-alt', 'secondary'],      // Icono para ver calendario
    'verpaciente.php'   => ['Ver Pacientes', 'fas fa-address-book', 'secondary'],  // Icono para ver lista de pacientes
    'vermedico.php'     => ['Ver Médicos', 'fas fa-address-card', 'secondary']     // Icono para ver lista de médicos
];



?>

<div class="menu">
    <div class="menu-left">
        <?php foreach ($menuItems as $page => $details): ?>
            <a href="<?php echo $page; ?>" 
               class="<?php echo ($currentPage == $page) ? 'active' : ''; ?> 
               <?php echo isset($details[3]) ? $details[3] : ''; ?>">
                <i class="<?php echo $details[1]; ?>"></i> <?php echo $details[0]; ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="menu-right">
        <span class="session-info">
            <i class="fas fa-user"></i> <?php echo $_SESSION['usuario'] ?? 'Invitado'; ?>
        </span>

        <form action="logout.php" method="post" style="display:inline;">
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
:root {
    --verde: #708A65;
    --dorado: #B9A86F;
    --negro: #e83636;
    --fondo: #F9F9F9;
}
.menu {
    display: flex;
    justify-content: space-between; /* Separación entre el menú y la sesión/logout */
    align-items: center;
    background-color: var(--verde);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin:0px !important;
}
.menu-left {
    display: flex;
    gap: 15px;
}
.menu-right {
    display: flex;
    align-items: center;
    gap: 15px;
}
.menu a {
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    font-weight: bold;
    color: white;
    transition: 0.3s;
}
.menu a.active {
    background-color: var(--dorado);
    color: white;
}
.menu a:hover {
    background-color: var(--dorado);
}
.session-info {
    font-size: 16px;
    font-weight: bold;
    color: white;
}
.logout-btn {
    background: var(--negro);
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}
.logout-btn:hover {
    background: #B10000;
}
menu{
    margin:0px !important;
    padding:0px !important;
}
.branding {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.logo {
  width: 100px;
  height: 100px;
  object-fit: contain;
  margin-bottom: 10px;
}

.brand-title {
  font-size: 2.8em;
  font-weight: bold;
  color: #2C3E50; /* o var(--verde) si usas colores definidos */
  margin: 0;
}

</style>
