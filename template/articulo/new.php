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
            <li><a href="#">Articulo</a></li>
            <li class="active">nuevo</li>
        </ol>

    </section>
    <div>
        <fieldset>
            <h1><?php echo $message; ?></h1>
            <legend>Registro de Nueva Categoría</legend>
            <form action="save" method="post">
                <input type="hidden" name="id_articulo" id="id_articulo" value="<?php echo $obj['id_articulo']; ?>"/>
                <div class="span8">
                    <table>
                        <tr>
                            <td><label for="categoria">Categoria:</label>
                            </td>
                            <td>
                                
                                <select id="id_categoria" name="id_categoria" class="form-control">
                                    <option value="">::Seleccione::</option>
                                   <?php 
                                   foreach ($categoria as $c){
                                       if($c['id_categoria']==$obj['id_categoria'])
                                       {
                                          echo "<option selected value='".$c['id_categoria']."'>".$c['categoria']."</option>";  
                                       }else{
                                            echo "<option value='".$c['id_categoria']."'>".$c['categoria']."</option>";
                                       }
                                      
                                   }
                                   ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Unidad Medida</label> 
                            </td>
                            <td>
                                <select name="id_medida" id="id_medida" class="form-control">
                                      <option value="">::Seleccione::</option>
                                   <?php 
                                   foreach ($unidad as $c){
                                       if($c['id_medida']==$obj['id_medida']){
                                       echo "<option selected value='".$c['id_medida']."'>".$c['unidad_medida']."</option>";
                                       }else{
                                          echo "<option  value='".$c['id_medida']."'>".$c['unidad_medida']."</option>"; 
                                       }
                                   }
                                   ?>
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <td>Articulo</td>
                            <td><input type="text" class='form-control' name="articulo" id="articulo" value="<?php echo $obj['articulo'];?>" /></td>
                        </tr>
                         <tr>
                            <td>Descripcion</td>
                            <td><input type="text" class='form-control' name="descripcion" id="descripcion" value="<?php echo $obj['descripcion'];?>"/></td>
                        </tr>
                         <tr>
                            <td>Stock</td>
                            <td><input type="text" class='form-control' name="stock" id="stock" value="<?php echo $obj['stock'];?>"/></td>
                        </tr>
                        <tr>
                            <td>
                        <input type="submit" class="btn btn-success" value="guardar" id="save" name="save"/>
                            </td>
                            <td>
                                 <a href="index" class="btn btn-success">Atras</a>
                            </td>
                    </tr>
                </div>
                </table>
            </form>
        </fieldset>
    </div>
</div>