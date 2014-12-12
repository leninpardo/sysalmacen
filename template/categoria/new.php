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
                        <li><a href="#">Categoria</a></li>
                        <li class="active">nuevo</li>
                    </ol>
                  
                </section>
    <div>
        <fieldset>
            <h6><?php echo $message;?></h6>
            <legend>Registro de Nueva Categoría</legend>
            <form action="save" method="post">
                <div class="span">
                    <label for="categoria">Categoria:</label>
                    <input type="text"  style="width: 30%;" id="categoria" class='form-control' name="categoria" value="<?php echo $obj['categoria']; ?>"/>
                    <input type="hidden"  class='form-control' id="id_categoria" name="id_categoria" value="<?php echo $obj['id_categoria']; ?>"/>
                   
                    <br/>
                    <input type="submit" class="btn btn-success" value="guardar" id="save" name="save"/>
                     <a href="index" class="btn btn-success">Atras</a>
                </div>
            </form>
        </fieldset>
    </div>
</div>