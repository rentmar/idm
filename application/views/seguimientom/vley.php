<main role="main">
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 color-contenedores">
                <div id="esquinas_redondeadas">
                    <div id="Caja_de_orden" class="Caja_de_datos">
                        <br>
                        <h3 id="Título_central"> Editar Ley </h3>
                    </div>
                    <div id="Caja_de_datos" class="Caja_de_datos">
                        <form action="<?php echo base_url().'index.php/Seguimientomonitores/actualizarLey/'/*.$leyes->idleyes*/;?>" method='POST'>
                            <?php foreach ($leyes as $ly) {?>
                            <label for="echaReg" class="form-group"> Fecha de registro de Ley </label>
                            <br>
                            <input type="text" id="fechaReg" name="fechaReg" value="<?php echo date('d/m/Y',$ly->fecha_registro);?>" disable>
                            <a href="<?php echo site_url('Seguimientomonitores/actualizarLey/'.$ly->idleyes);?>"><i class="fas fa-edit"></i></a>
                            <br><br>
                            <label for="echaEst" class="form-group"> Fecha de Estado de ley </label>
                            <br>
                            <input type="text" id="fechaEst" name="fechaEst"  value="<?php echo date('d/m/Y',$ly->fecha_estadoley);?>" readonly>
                            <a href="<?php echo site_url('Seguimientomonitores/actualizarLey/'.$ly->fecha_estadoley);?>"><i class="fas fa-edit"></i></a>
                            <br><br>
                            <label for="ombreLey" class="form-group"> Nombre de ley </label>
                            <br>
                            <textarea name="ombreLey" rows="5" cols="50" disabled><?php echo $ly->nombre_ley;?> </textarea>
                            <a href="<?php echo site_url('Seguimientomonitores/actualizarLey/'.$ly->idleyes);?>"><i class="fas fa-edit"></i></a>
                            <br><br>
                            <label for="stadoLey" class="form-group"> Estado de ley </label>
                            <br>
                            <input type="text" id="estadoLey" name="estadoLey"  value="<?php echo $ly->nombre_estadoley;?>" readonly>
                            <a href="<?php echo site_url('Seguimientomonitores/actualizarLey/'.$ly->idleyes);?>"><i class="fas fa-edit"></i></a>
                            <br><br>
                            <label for="odigoLey" class="form-group"> Codigo de ley </label>
                            <br>
                            <input type="text" id="codigoLey" name="codigoLey"  value="<?php echo $ly->codigo_ley;?>" disabled>
                            <a href="<?php echo site_url('Seguimientomonitores/actualizarLey/'.$ly->codigo_ley);?>"><i class="fas fa-edit"></i></a>
                            <br><br>
                            <label for="esumenLey" class="form-group"> Resumen de ley </label>
                            <br>
                            <textarea name="esumenLey" rows="5" cols="50" readonly><?php echo $ly->resumen;?> </textarea>
                            <a href="<?php echo site_url('Seguimientomonitores/actualizarLey/'.$ly->idleyes);?>"><i class="fas fa-edit"></i></a>
                            <br><br>
                            <?php }?>
                            <br>
<!--                            <input type="submit" id="BOTON" value="EDITAR">-->
                            <a href="<?php echo site_url('SeguimientoMonitores/leyesTabla');?>"><input type="button" class="BOTONROJO" value="CANCELAR"></a>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</main>