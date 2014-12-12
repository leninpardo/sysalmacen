<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
<div>

    <h1>Registro de entradas al almacen</h1><br><br>
    <form action="save" method="post" id="frm">
        <div class="span5">
            <label>Fecha:</label>
            <input type="date" name="fecha_entrada" id="fecha"/>
              <label>Hora:</label>
            <input class="timepicker" type="time" name="tiempo" id="tiempo" />
            <label>Proveedor:</label>
            <select name="proveedor" id="proveedor">
                <option>Seleccione</option>
                <?php 
                foreach ($proveedor as $p)
                {
                    echo "<option value='".$p['idproveedor']."'>".$p['nombre']."</option>";
                }
                ?>
            </select>
            <label>Tipo comprobante:</label>
            <select name="tipo_comprobante" id="tipo_comprobante">
                <option>Seleccione</option>
                <option value="Boleta">Boleta</option>
                <option value="Factura">Factura</option>
            </select>
        </div>
        <br/>
        <div class="span5">
            <label>Numero:</label>
            <input type="text" name="numero_comprobante" class="" placeholder="Numero Comprobante" id="numero_comprobante"/>
            <label>Guia remision:</label>
            <input type="text" name="guia_remision" placeholder="Guia Remision" id="guia_remision"/>
            <label>Chofer:</label>
            <input type="text" name="chofer" placeholder="Chofer" id="chofer"/>
            <input type="hidden" name="id_login" id="id_login" value="<?php echo $_SESSION["usuario"];?>" />
        </div>
        
        <br><br> 
                        <fieldset>

        <div class="span5">
                    <input type="hidden" name="id_articulo" id="id_articulo" />
                    <legend>Producto que ingresa</legend>                    
                    <label>Producto</label>
                    <span><a id="buscar" class="btn btn-success" >buscar</a></span>
                    <input readonly="" type="text" name="producto" placeholder="Buscar Producto" id="producto"/>    
                    
                     <label>Categoria</label>
                     <input readonly="" type="text" name="categoria" id="categoria"/>
                     <label>unidad medida</label>
                     <input readonly="" type="text" name="unidad" id="unidad"/>
        </div>
        <br>
        <div class="span5">     
            <label>Cantidad(stock)</label>
            <input readonly=""type="text" name="stock" id="stock"/>
            <label>Cantidad</label>
            <input  type="text" name="cantidad" placeholder="Cantidad de ingreso" id="cantidad"/>
            <span><a id="add" class="btn btn-success">Agregar</a></span>
        </div>
                </fieldset>
                
        <br><br>
        
        
        <!-- Lista de los ingresos -->
        <div class="product">
            <table class="table table-bordered" id="table">
                 <legend>Lista de productos ingresados</legend> 
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Producto</th>
                        <th>Stock</th>
                        <th>Unidad medida</th>
                        <th>Categoria</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                   <tbody id="cuerpo_table">
                        
                    </tbody>
            </table>
            
            <br><br><br>
                <div>
                    <table id="">
                         <tr>
                        <th colspan="5">Nro de productos</th>
                        <th><input type=""  id="n_productos" name=""/></th>
                        <th>Cantidad total</th>
                        <th><input type="text" id="cantidad_total" name="cantidad_total" /></th>
                    </tr>
                    </table>
                </div>           </div>     
        <div class="form-control">
            <input type="submit" class="btn btn-success" id="aceptar" name="aceptar"/>
            <a href="index" class="btn btn-success">Atras</a>
        </div>   </form>
</div>
<div name="emergente" id="emergente">
    
</div>
<script type="text/javascript">
$(function()
{ 
   $("#buscar").click(function(){
     $("#emergente").load("getproductos", function () {
            //$.getScript('web/js/evnt/val_frmParcela.js');
            //boquea la pantalla
            $.blockUI({
                message: $("#emergente"),
                css: {
                    top: '10%',
                    width: '75%',
                    height: '80%',
                    left: '15%'
                }
            });
        });
    
   }); 
   $("#add").click(function(){
       
       idarticulo=$("#id_articulo").val();
       descripcion=$("#producto").val();
       categoria=$("#categoria").val();
       unidad=$("#unidad").val();
       stock=$("#stock").val();
       cantidad=$("#cantidad").val();
       bval=true;
           bval = bval && $("#producto").required();
    if (bval) {
       if(cantidad==''){
           alert("llene la cantidad");
       }else{
           if(stock<cantidad)
           {
               alert("No hay suficiente stock");
           }else{
       tr="<tr id='"+idarticulo+"'>";
       tr+="<td><input type= 'hidden' name='articulo[]' id='articulo' value='"+idarticulo+"'/>"+idarticulo+"</td>";
      
        tr+="<td>"+descripcion+"</td>";
         tr+="<td>"+categoria+"</td>";
         tr+="<td>"+unidad+"</td>";
         tr+="<td><input type='hidden' name='stock"+idarticulo+"' id='stock"+idarticulo+"' value='"+stock+"'/>"+stock+"</td>";
          tr+="<td><input type='hidden' name='articulo"+idarticulo+"' id='articulo"+idarticulo+"' value='"+cantidad+"'/>"+cantidad+"</td>";
           tr+="<td><a   onclick='javascript:elimina("+idarticulo+");' >Eliminar<a></td>";
           tr+="</tr>";
           //alert(tr);
           $("#cuerpo_table").append(tr);
       }
       }
       }
       return false;
   });
 
$("#frm").submit(function(){
val=true;
val=$("#fecha").required();
val=$("#tiempo").required();
val=$("#proveedor").required();
if(val){
  $(this).submit();
            
}
return false;
});

    });
     function elimina(id){
 
  $("#"+id).remove();
 }
</script>