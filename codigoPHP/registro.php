<?php
    if(isset($_REQUEST['Volver'])){
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
                "CodUsuario"       =>'',
                "DescUsuario"      =>'',
                "Password"         =>'',
                "ConfirmarPassword"=>''
            ];
            $aRespuestas=[
                "CodUsuario"       =>'',
                "DescUsuario"      =>'',
                "Password"         =>'',
                "ConfirmarPassword"=>''
            ];
            $entradaOK=true;
            if(isset($_REQUEST["Crear"])){
                //Código que se ejecuta cuando se envía el formulario.
                //Se valida los datos del formulario.
                $aErrores['CodUsuario']=validacionFormularios::comprobarAlfabetico($_REQUEST['CodUsuario'],10,4,1);
                if(empty($aErrores['CodUsuario'])){
                    try{
                        //Se conecta a la base de datos.
                        $miDB=new PDO(DSN,USERNAME,PASSWORD);
                        $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        //Consulta preparada:Busca si el código de usuario ya existe en la base de datos.
                        $sql="SELECT * FROM T01_Usuario WHERE T01_CodUsuario ='{$_REQUEST['CodUsuario']}'";
                        $resultadoConsulta=$miDB->prepare($sql);
                        $resultadoConsulta->execute();
                        if($resultadoConsulta->rowCount()>0){
                            $aErrores['CodUsuario']="Ya existe un usuario con este código.";
                        } 
                    }
                    catch(PDOException $miExceptionPDO) {
                        //Temporalmente ponemos estos errores para que se muestren en pantalla.
                        echo '<p class="rojo"><b>Error:</b>'.$miExceptionPDO->getMessage().'</p>';
                        echo '<p class="rojo"><b>Código de error:</b>'.$miExceptionPDO->getCode().'</p>';
                    }
                    finally {
                        unset($miDB);
                    }
                }
                $aErrores['DescUsuario'] =validacionFormularios::comprobarAlfabetico($_REQUEST['DescUsuario'],255,4,1);
                $aErrores['Password'] =validacionFormularios::validarPassword($_REQUEST['Password'],64,4,2,1);
                $aErrores['ConfirmarPassword']=validacionFormularios::validarPassword($_REQUEST['ConfirmarPassword'],64,4,2,1);
                if($_REQUEST['Password']!==$_REQUEST['ConfirmarPassword'] AND empty($aErrores['Password'])){
                    $aErrores['ConfirmarPassword']='Debes introducir la misma contraseña.';
                }
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
                $aRespuestas['CodUsuario']=$_REQUEST['CodUsuario'];
                $aRespuestas['DescUsuario']=$_REQUEST['DescUsuario'];
                $aRespuestas['Password']=$_REQUEST['Password'];
                try{
                    //Se conecta a la base de datos.
                    $miDB=new PDO(DSN,USERNAME,PASSWORD);
                    $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    //Consulta preparada:Busca un usuario y contraseña coincidentes.
                    $sql="INSERT INTO T01_Usuario(T01_CodUsuario,T01_Password,T01_DescUsuario,T01_NumConexiones) VALUES(".$aRespuestas['CodUsuario'].",".$aRespuestas['Password'].",".$aRespuestas['DescUsuario'].",1)";
                    $consulta=$miDB->prepare($sql);
                    $consulta->execute();
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
                    Login Logoff Tema 5
                </div>
            </div>
        </header>
        <main id="contenedor">  
            <h2 id="titulo">REGISTRO</h2>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <table class="formulario conErrores">
                    <tr>
                        <td colspan="3"><h3>Crear nuevo usuario:</h3></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="cod">Código:</label>
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
                            <label for="desc">Nombre y apellidos:</label>
                        </td>
                        <td>
                            <input type="text" name="DescUsuario" class="texto obligatorio" id="DescUsuario" value="<?php echo(isset($_REQUEST["DescUsuario"])&&empty($aErrores["DesUsuario"]))?$_REQUEST["DescUsuario"]:''?>">
                        </td>
                        <td class="span">
                            <span><?php echo $aErrores['Password']?></span>
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
                        <td>
                            <label for="desc">Confirmar contraseña:</label>
                        </td>
                        <td>
                            <input type="password" name="ConfirmarPassword" class="texto obligatorio" id="ConfirmarPassword" value="<?php echo(isset($_REQUEST["ConfirmarPassword"])&&empty($aErrores["ConfirmarPassword"]))?$_REQUEST["ConfirmarPassword"]:''?>">
                        </td>
                        <td class="span">
                            <span><?php echo $aErrores['ConfirmarPassword']?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" id="Env">
                            <button type="submit" id="Crear" class="BotonTabla" name="Crear">CREAR</button>
                            <button name="Volver" id="Volver" class="BotonTabla"><?php echo $textoBotonVolver; ?></button>
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