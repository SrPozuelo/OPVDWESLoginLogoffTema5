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
        <?php
            $textoBotonIniciarSesion = 'VOLVER';
            if (isset($_REQUEST['iniciarSesion'])) {
                header('Location: ../indexLoginLogoffTema5.php');
                exit;
            }
        ?>
        <header class="cabecera-principal">
            <div class="contenido-cabecera">
                <div class="identidad">
                    <a href="../index.html" style="text-decoration:none;">
                        <div class="logo-iniciales">ÓS</div>
                    </a>
                    <h1>Óscar Pozuelo Villamandos</h1>
                </div>
                <div class="curso-badge" style="background-color: #777BB4; color: white;">
                    Tema 5
                </div>
                <form action="" method="post">
                    <button name="Volver"><span><?php echo $textoBotonIniciarSesion; ?></span></button>
                </form>
            </div>
        </header>
        <main class="contenedor-principal">  
            <h2 class="titulo-pagina">Login</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table class="formulario conErrores">
                    <tr>
                        <td colspan="3"><h3>Crear nuevo departamento:</h3></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="cod">Código:</label>
                        </td>
                        <td>
                            <input type="text" name="CodDepartamento" class="texto obligatorio" id="CodDepartamento" value="<?php echo(isset($_REQUEST["CodDepartamento"])&&empty($aErrores["CodDepartamento"]))?$_REQUEST["CodDepartamento"]:''?>">
                        </td>
                        <td class="span">
                            <span><?php echo $aErrores['CodDepartamento']?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="desc">Descripción:</label>
                        </td>
                        <td>
                            <input type="text" name="DescDepartamento" class="texto obligatorio" id="DescDepartamento" value="<?php echo(isset($_REQUEST["DescDepartamento"])&&empty($aErrores["DescDepartamento"]))?$_REQUEST["DescDepartamento"]:''?>">
                        </td>
                        <td class="span">
                            <span><?php echo $aErrores['DescDepartamento']?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="crea">Fecha de creación:</label>
                        </td>
                        <td>
                            <input type="text" name="FechaCreacionDepartamento" class="fecha bloqueado" id="FechaCreacionDepartamento" value="<?php echo(new DateTime())->format('d-m-Y');?>" readonly>
                        </td>
                        <td class="span">
                            <span><?php echo $aErrores['FechaCreacionDepartamento']?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Vol">Volumen de negocio:</label>
                        </td>
                        <td>
                            <input type="text" name="VolumenDeNegocio" class="texto obligatorio" id="VolumenDeNegocio" value="<?php echo(isset($_REQUEST["VolumenDeNegocio"])&&empty($aErrores["VolumenDeNegocio"]))?$_REQUEST["VolumenDeNegocio"]:''?>">
                        </td>
                        <td class="span">
                            <span><?php echo $aErrores['VolumenDeNegocio']?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" id="Env">
                            <button type="submit" id="Enviar" name="Enviar">ENVIAR</button>
                        </td>
                    </tr>
                </table>
            </form>
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