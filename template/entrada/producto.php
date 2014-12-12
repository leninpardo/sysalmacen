<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div>
    <dv class="ui-accordion-content">Listado de Articulos</dv>
    <table class="table table-bordered table-hover">
        <tr>
            <td>item</td>
            <td>Descripcion</td>
            <td>Unidad medida</td>
            <td>Categoria</td>
            <td>Stock</td>
            <td>Acciones</td>
        </tr>
        <?php 
        foreach ($grid as $g){
            echo "<tr>";
            echo "<td>".$g['id_articulo']."</td>";
             echo "<td>".$g['descripcion']."</td>";
              echo "<td>".$g['unidad_medida']."</td>";
               echo "<td>".$g['categoria']."</td>";
                echo "<td>".$g['stock']."</td>";
                ?>
              <td><a href="javascript:productos('<?php echo $g['id_articulo'];?>','<?php echo $g['descripcion'];?>','<?php echo $g['unidad_medida'];?>','<?php echo $g['categoria'];?>','<?php echo $g['stock'];?>')" >elegir</a></td>
                <?php
             echo "</tr>";
        }
        ?>
    </table>
</div>
<div class="container">
    <a   onclick="" id="close" class="btn btn-info">Cerrar</a> 
</div>
<script type="text/javascript">
function productos(idarticulo,articulo,unidad_medida,categoria,stock){
   
  $("#producto").val(articulo);  
  $("#categoria").val(categoria);
  $("#unidad").val(unidad_medida);
  $("#stock").val(stock);
  $("#id_articulo").val(idarticulo);
     $.unblockUI({
        onUnblock: function() {
            $("#emergente").html("");
        }
    });
}
$(function()
{  
 $("#close").click(function(){
     $.unblockUI({
        onUnblock: function() {
            $("#emergente").html("");
        }
    }); 
 }); 
    
 });
</script>
