<?php
    $textoBotonVolver='VOLVER';
    if (isset($_REQUEST['Volver'])) {
        header('Location: inicioPrivado.php');
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
                    <button name="Volver" id="Sesion"><span><?php echo $textoBotonVolver;?></span></button>
                </form>
            </div>
        </header>
        <main id="contenedor">  
            <h2 id="titulo">DETALLES:</h2>
            <?php
                
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