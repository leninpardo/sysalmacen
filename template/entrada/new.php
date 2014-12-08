<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div>
    <h1>Registro de nuevas entradas</h1>
    <form action="save" method="post">
        <div class="">
            <label>Fecha:</label>
            <input type="text" name="fecha" id="fecha"/>
            <label>Proveedor:</label>
            <select name="proveedor" id="proveedor">
                <option>::Seleccione::</option>
                <?php 
                foreach ($proveedor as $p)
                {
                    echo "<option value='".$p['idproveedor']."'>".$p['nombre']."</option>";
                }
                ?>
            </select>
            <label>Tipo comprobante:</label>
            <input type="text" name="tipo" id="tipo"/>
            <label>Numero:</label>
            <input type="text" name="numero" id="numero"/>
            
            <div class="producer">
                <table class="table table-bordered">
                    <tr>
                        <th>Item</th>
                         <th>Producto</th>
                          <th>Stock</th>
                           <th>Unidad medida</th>
                            <th>Categoria</th>
                            <th>Cantidad</th>
                    </tr>
                    <tr>
                       <?php
                       foreach ($articulos as $a){
                           echo "<tr>";
                           echo "<td><input type='checkbox' name='articulos[]' class='articulo_click' id='articulos' value='".$a['id_articulo']."'/></td>";
                            echo "<td>".$a['articulo']."</td>";
                             echo "<td>".$a['stock']."</td>";
                              echo "<td>".$a['unidad_medida']."</td>";
                               echo "<td>".$a['categoria']."</td>";
                               echo "<td><input type='text' readonly='true' name='cantidad".$a['id_articulo']."' id='cantidad".$a['id_articulo']."' /></td>";
                             echo "</tr>";
                       }
                       ?> 
                    </tr>
                    <tr>
                        <th colspan="5">Nro de productos</th>
                        <th>Cantidad total</th>
                    </tr>
                </table>
            </div>
            
        </div>
    </form>
</div>
<script type="text/javascript">
$(function()
{ 
   $(".articulo_click").click(function(){
      //id=$(this).val();
      alert("g");
         if ($(this).attr('checked')) {
			var tr = $(this).parent().parent();
			
			var inp = tr.find("td").eq(6).children();
			inp.attr("readonly", false);
			tr.addClass("select_row");
			inp.focus();
                    }else{
                      	var tr = $(this).parent().parent();
			
			var inp = tr.find("td").eq(6).children();
			var vale = inp.attr("val");
			//inp.attr("value", vale);
			inp.attr("readonly", true);
			tr.removeClass("select_row");  
                    }
   }); 
    });
</script>