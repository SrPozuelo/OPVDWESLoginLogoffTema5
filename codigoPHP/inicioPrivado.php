<?php
    session_start();
    $textoBotonCerrarSesion = 'CERRAR SESIÓN';
    if (isset($_REQUEST['cerrarSesion'])) {
        header('Location: ../indexLoginLogoffTema5.php');
        exit;
    }
    if(isset($_REQUEST['Detalles'])){
        header('Location: detalle.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tema 5 | Óscar Pozuelo Villamandos</title>
        <link rel="stylesheet" href="/OPVDWESLoginLogoffTema5/webroot/css/fonts.css">
        <link rel="stylesheet" href="/OPVDWESLoginLogoffTema5/webroot/css/all.min.css">
        <link rel="stylesheet" href="/OPVDWESLoginLogoffTema5/webroot/css/estilos.css"> 
        <link rel="stylesheet" href="/OPVDWESLoginLogoffTema5/webroot/css/estilosTabla.css"> 
    </head>
    <body>
        <header class="cabecera-principal">
            <div class="contenido-cabecera">
                <div class="identidad">
                    <a href="../index.html" style="text-decoration:none;">
                        <div class="logo-iniciales">ÓS</div>
                    </a>
                    <h1>Óscar Pozuelo Villamandos</h1>
                </div>
                <div class="curso-badge" style="background-color: #777BB4; color: white;">
                    Login Logoff Tema 5
                </div>
                <form action="" method="post" id="FormularioSesion">
                    <button name="cerrarSesion" id="Sesion"><span><?php echo $textoBotonCerrarSesion; ?></span></button>
                </form>
            </div>
        </header>
        <main id="contenedor">  
            <h2 id="titulo">INICIO PRIVADO</h2>
            <form action="" method="post">
                <button name="Detalles" id="Boton"><span>DETALLES</span></button>
            </form>
            <?php
                echo('<h3>Bienvenido'.$_SESSION[usuarioDAW210AppLoginLogoffTema5][DescUsuario].'</h3>');
                if($_SESSION[usuarioDAW205AppLoginLogoffTema5][NumConexiones]==1){
                    echo('<h3>Esta es la primera vez que se conecta.</h3>');
                }
            ?>
        </main>
        <footer class="pie-pagina">
            <div class="contenido-footer">
                <div class="texto-legal">
                    <p>2025-26 IES LOS SAUCES. ©Todos los derechos reservados.</p>
                    <p class="autor"><a href="https://oscarpozvil.ieslossauces.es" target="_blank">Óscar Pozuelo Villamandos.</a> Fecha de Actualización: 23-02-2026</p>
                </div>
                <div class="iconos-footer">
                    <a href="https://github.com/SrPozuelo/OPVDWESLoginLogoffTema5" target="_blank" title="GitHub"><i class="fa-brands fa-github"></i></a>
                    <a href="../OPVDWESProyectoDWES/indexProyectoDWES.html" title="Inicio"><i class="fa-solid fa-house"></i></a>
                    <a href="../OPVDWESProyectoDWES/indexProyectoDWES.html" title="Volver a DWES"><i class="fa-solid fa-arrow-turn-up"></i></a>
                </div>
            </div>
        </footer>
    </body>
</html>