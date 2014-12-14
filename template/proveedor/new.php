<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div>
       <section class="content-header">
                    
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li><a href="#">Proveedor</a></li>
                        <li class="active">nuevo</li>
                    </ol>
                  
                </section>
    <div>
        <fieldset>
            <h6><?php echo $message;?></h6>
            <legend>Registro de Nuevo proveedor</legend>
            <form action="save" method="post">
                <div class="span">
                    <label for="categoria">Nombre:</label>
                    <input type="text"  style="width: 30%;" id="nombre" class='form-control' name="nombre" value="<?php echo $obj['nombre']; ?>"/>
                    <input type="hidden"  class='form-control' id="idproveedor" name="idproveedor" value="<?php echo $obj['idproveedor']; ?>"/>
                    <label for="categoria">Direccion:</label>
                    <input type="text"  style="width: 30%;" id="direccion" class='form-control' name="direccion" value="<?php echo $obj['direccion']; ?>"/>
                   
                    <br/>
                    <input type="submit" class="btn btn-success" value="guardar" id="save" name="save"/>
                     <a href="index" class="btn btn-success">Atras</a>
                </div>
            </form>
        </fieldset>
    </div>
</div>