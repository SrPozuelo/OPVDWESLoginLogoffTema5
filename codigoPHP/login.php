<?php
    if (isset($_REQUEST['Volver'])) {
        header('Location: ../indexLoginLogoffTema5.php');
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
        <?php
            require_once '../conf/ConfDBPDO.php';
            require_once "../core/libreriaValidacion.php";
            $textoBotonVolver='VOLVER';
            $aErrores=[
                "CodUsuario"=>'',
                "Password"  =>''
            ];
            $aRespuestas=[
                "CodUsuario"=>'',
                "Password"  =>''
            ];
            $entradaOK=true;
            if(isset($_REQUEST["Enviar"])){
                //Código que se ejecuta cuando se envía el formulario.
                //Se valida los datos del formulario.
                $aErrores['CodUsuario']=validacionFormularios::comprobarAlfabetico($_REQUEST['CodUsuario'],10,0,1);
                $aErrores['Password'] =validacionFormularios::validarPassword($_REQUEST['Password'],64,4,2,1);
                foreach($aErrores as $campo => $valor){
                    if(!empty($valor)){
                        //Se comprueba si el valor es válido.
                        $entradaOK=false;
                    } 
                }
            }
            else{
                //Código que se ejecuta antes de rellenar el formulario.
                $entradaOK=false;
            }
            //Se comprueba el que el nombre del usuario y la contraseña sean introducidos correctamente.
            if($entradaOK){
                //Se Carga la variable $aRespuestas y tratamiento de datos OK.
                try {
                    //Se conecta a la base de datos.
                    $miDB=new PDO(DSN,USERNAME,PASSWORD);
                    //Consulta preparada:Busca un usuario y contraseña coincidentes.
                    $sql="SELECT * FROM T01_Usuario WHERE T01_CodUsuario = :CodUsuario AND T01_Password = sha2(:Password,256)";
                    $consulta = $miDB->prepare($sql);
                    $consulta->execute([
                        ':CodUsuario' => $_REQUEST['CodUsuario'],
                        ':Password'   => $_REQUEST['CodUsuario'].$_REQUEST['Password']
                    ]);
                    //Si encuentra una fila, las credenciales son correctas.
                    $usuarioBD=$consulta->fetchObject();
                    if($usuarioBD){
                        $oFechaActual=new DateTime();
                        //Sino se inicia la session y guardamos datos de sesión.
                        session_start();
                        $_SESSION['usuarioDAW205AppLoginLogoffTema5']=[
                            'CodUsuario'                      => $usuarioBD->T01_CodUsuario,
                            'Password'                        => $usuarioBD->T01_Password,
                            'DescUsuario'                     => $usuarioBD->T01_DescUsuario,
                            'FechaHoraUltimaConexionAnterior' => $usuarioBD->T01_FechaHoraUltimaConexion,
                            'FechaHoraUltimaConexion'         => $oFechaActual->format('Y-m-d H:i:s'),
                            'NumConexiones'                   => $usuarioBD->T01_NumConexiones+1,
                            'Perfil'                          => $usuarioBD->T01_Perfil
                        ];
                        //Se actualiza la fecha de la última session y el contador de conexiones.
                        $actualizacion=<<<SQL
                            UPDATE T01_Usuario SET
                            T01_FechaHoraUltimaConexion = now(),
                            T01_NumConexiones = T01_NumConexiones + 1
                            WHERE T01_CodUsuario = :CodUsuario
                        SQL;
                        $consulta2 = $miDB->prepare($actualizacion);
                        $consulta2->execute([':CodUsuario' => $_REQUEST['CodUsuario']]);
                        //Se Avanza a la página de inicio privado.
                        header('Location: inicioPrivado.php');
                        exit; 
                    }
                    else{
                        //Si el usuario NO es válido se vuelve a cargar el login con los errores.
                        if(empty($aErrores['CodUsuario']) and empty($aErrores['Password'])){
                            $aErrores['CodUsuario']="El nombre de usuario o la contrasena estan mal introducidos.";
                            $aErrores['Password']="El nombre de usuario o la contrasena estan mal introducidos.";
                        }
                    }
                }
                catch (PDOException $miExceptionPDO) {
                    //Temporalmente ponemos estos errores para que se muestren en pantalla.
                    echo '<p class="rojo"><b>Error:</b>'.$miExceptionPDO->getMessage().'</p>';
                    echo '<p class="rojo"><b>Código de error:</b>'.$miExceptionPDO->getCode().'</p>';
                }
                finally {
                    unset($miDB);
                }
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
                    
                </form>
            </div>
        </header>
        <main id="contenedor">  
            <h2 class="titulo-pagina">Login</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table class="formulario conErrores">
                    <tr>
                        <td colspan="3"><h3>Iniciar sesion:</h3></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="cod">Nombre:</label>
                        </td>
                        <td>
                            <input type="text" name="CodUsuario" class="texto obligatorio" id="CodUsuario" value="<?php echo(isset($_REQUEST["CodUsuario"])&&empty($aErrores["CodUsuario"]))?$_REQUEST["CodUsuario"]:''?>">
                        </td>
                        <td class="span">
                            <span><?php echo $aErrores['CodUsuario']?></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="desc">Contraseña:</label>
                        </td>
                        <td>
                            <input type="password" name="Password" class="texto obligatorio" id="Password" value="<?php echo(isset($_REQUEST["Password"])&&empty($aErrores["Password"]))?$_REQUEST["Password"]:''?>">
                        </td>
                        <td class="span">
                            <span><?php echo $aErrores['Password']?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" id="Env">
                            <button type="submit" id="Enviar" name="Enviar">ENVIAR</button>
                            <button name="Volver" id="Volver"><?php echo $textoBotonVolver; ?></button>
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