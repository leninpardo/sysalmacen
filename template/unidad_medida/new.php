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
            <li><a href="#">Unidad Medida</a></li>
            <li class="active">nuevo</li>
        </ol>

    </section>
    <div>
        <fieldset>
            <h1><?php echo $message; ?></h1>
            <legend>Registro de Unidad de medida</legend>
            <form action="save" method="post">
                <input type="hidden" name="id_medida" id="id_medida" value="<?php echo $obj['id_medida']; ?>"/>
                <div class="span5">
                    <table>
        
                        <tr>
                            <td>Unidad Medida</td>
                            <td><input type="text" name="unidad_medida" id="unidad_medida" value="<?php echo $obj['unidad_medida'];?>" /></td>
                        </tr>
                      
                        <tr>
                            <td>
                        <input type="submit" class="btn btn-success" value="guardar" id="save" name="save"/>
                            </td>
                    </tr>
                </div>
                </table>
            </form>
        </fieldset>
    </div>
</div>