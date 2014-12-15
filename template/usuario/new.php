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
            <li><a href="#">Usuario</a></li>
            <li class="active">nuevo</li>
        </ol>

    </section>
    <div>
        <fieldset>
            <h1><?php echo $message; ?></h1>
            <legend>Registro de Nuevos usuarios</legend>
            <form action="save" method="post">
                <input type="hidden" name="id_login" id="id_login" value="<?php echo $obj['id_login']; ?>"/>
                <div class="span8">
                    <table>
                       
                         <tr>
                            <td>Nombre</td>
                            <td><input type="text" class='form-control' name="nombre" id="nombre" value="<?php echo $obj['nombre'];?>"/></td>
                        </tr>
                         <tr>
                            <td>Apellidos</td>
                            <td><input type="text" class='form-control' name="apellido" id="apellido" value="<?php echo $obj['apellido'];?>"/></td>
                        </tr>
                          <tr>
                            <td>Correo</td>
                            <td><input type="text" class='form-control' name="correo" id="correo" value="<?php echo $obj['correo'];?>"/></td>
                        </tr>
                         <tr>
                            <td>Usuario</td>
                            <td><input type="text" class='form-control' name="user" id="user" value="<?php echo $obj['user'];?>" /></td>
                        </tr>
                         <tr>
                            <td>Clave</td>
                            <td><input type="password" class='form-control' name="password" id="password" value="<?php echo $obj['password'];?>" /></td>
                        </tr>
                        <tr>
                            <td><br></td>
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