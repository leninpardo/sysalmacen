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

    <h1>Registro de nuevas entradas</h1>
    <form action="save" method="post" id="frm">
        <div class="span5">
            <label>Fecha:</label>
            <input type="hidden" name="id_entradas" id="id_entradas" value="<?php echo $obj['id_entradas']; ?>"/>
            <input type="date" name="fecha_entrada" id="fecha" value="<?php echo $obj['fecha_entrada'] ?>"/>
              <label>Hora:</label>
            <input class="timepicker" type="time" name="tiempo" id="tiempo" value="<?php echo $obj['tiempo'] ?>" />
            <label>Proveedor:</label>
            <select name="proveedor" id="proveedor">
                <option>::Seleccione::</option>
                <?php 
                foreach ($proveedor as $p)
                {
                    if($p['idproveedor']==$obj['proveedor']){
                        echo "<option  selected value='".$p['idproveedor']."'>".$p['nombre']."</option>";
                    }else{
                       echo "<option value='".$p['idproveedor']."'>".$p['nombre']."</option>"; 
                    }
                    
                }
                ?>
            </select>
            <label>Tipo comprobante:</label>
            <select name="tipo_comprobante" id="tipo_comprobante">
                <option>::Seleccione::</option>
                <option <?php if($obj['tipo_comprobante']=='Boleta'){ echo "selected";}?> value="Boleta">Boleta</option>
                <option <?php if($obj['tipo_comprobante']=='Factura'){ echo "selected";}?> value="Factura">Factura</option>
            </select>
        </div>
        <br/>
        <div class="span5">
            
            <label>Numero:</label>
            <input type="number"  name="numero_comprobante"  placeholder="Numero comprobante"  id="numero_comprobante" value="<?php echo $obj['numero_comprobante'] ?>"/>
            <label>Guia remision:</label>
            <input type="text" name="guia_remision" placeholder="Guia remision" id="guia_remision" value="<?php echo $obj['guia_remision'] ?>"/>
            <label>Chofer:</label>
            <input type="text" name="chofer" placeholder="Chofer" id="chofer" value="<?php echo $obj['chofer'] ?>"/>
            <input type="hidden" name="id_login" id="id_login" value="<?php echo $_SESSION["usuario"];?>" />
        </div>
        <br/><br/>
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
        <legend>liata de productos ingresados</legend> 
            <div class="product">
                <table class="table table-bordered" id="table">
                    <thead>
                    <tr>
                        <th>Item</th>
                         <th>Producto</th>
                           <th>Unidad medida</th>
                            <th>Categoria</th>
                             <th>Stock</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                    </tr>

                    </thead>
                    
                    <tbody id="cuerpo_table">
                        <?php 
                        $cont=0;
                        if($obj_detalle!=null){
                            foreach ($obj_detalle as $dt){
                                echo "<tr id='".$dt['id_articulo']."'>";
                                echo "<td> <input type='hidden' name='articulo[]' id='articulo[]' value='".$dt['id_articulo']."'/>".$dt['id_articulo']."</td>";
                                echo "<td>".$dt['descripcion']."</td>";
                                echo "<td> <input type='hidden' name='stock".$dt['id_articulo']."' id='stock".$dt['id_articulo']."' value='".$dt['stock']."'/> ".$dt['stock']."</td>";
                                echo "<td>".$dt['unidad_medida']."</td>";
                                echo "<td>".$dt['categoria']."</td>";
                                echo "<td> <input type='hidden' name='articulo".$dt['id_articulo']."' id='articulo".$dt['id_articulo']."' value='".$dt['cantidad']."'/>".$dt['cantidad']."</td>";
                             
                                echo "<td><a   onclick='javascript:elimina(".$dt['id_articulo'].");' >Eliminar<a></td>";
                                   echo "</tr>";
                                   $cantidad=$cantidad+$dt['cantidad'];
                                   $cont=$cont+1;
                            }
                        }
                        ?>
                    </tbody>
                    
                         <tr role="row">              
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          
                        </tr>          
                </table>
                <div>
                    <table id="">
                         <tr>
                        <th colspan="5">Nro de productos</th>
                        <th><input type="" readonly="" id="n_productos" name="" value="<?php echo $cont;?>"/></th>
                        <th>Cantidad total</th>
                        <th><input type="text" readonly="" id="cantidad_total" name="cantidad_total"  value="<?php echo $cantidad; ?>"/></th>
                    </tr>
                    </table>
                </div>           
            </div>
        <br><br>
        <center><div class="span5"  >
            <input type="submit" class="btn btn-success" id="aceptar" name="aceptar"/>
            <a href="index" class="btn btn-success">Atras</a>
        </div></center>   
    </form>
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
           
       tr="<tr id='"+idarticulo+"'>";
       tr+="<td><input type= 'hidden' name='articulo[]' id='articulo[]' value='"+idarticulo+"'/>"+idarticulo+"</td>";
      
        tr+="<td>"+descripcion+"</td>";
         tr+="<td>"+categoria+"</td>";
         tr+="<td>"+unidad+"</td>";
         tr+="<td><input type='hidden' name='stock"+idarticulo+"' id='stock"+idarticulo+"' value='"+stock+"'/>"+stock+"</td>";
          tr+="<td><input type='hidden' name='articulo"+idarticulo+"' id='articulo"+idarticulo+"' value='"+cantidad+"'/>"+cantidad+"</td>";
           tr+="<td><a   onclick='javascript:elimina("+idarticulo+");' >Eliminar<a></td>";
           tr+="</tr>";
           //alert(tr);
           $("#cuerpo_table").append(tr);
           cantidad_t=$("#n_productos").val();
           if(cantidad_t==null){
               cantidad_t=0;
           }
           total_c=$("#cantidad_total").val();
           if(total_c==''){
               total_c=0;
           }
           cantidad_t=parseFloat(cantidad_t)+1;
           total_c=parseFloat(total_c)+parseFloat(cantidad);
           $("#cantidad_total").val(total_c);
           $("#n_productos").val(cantidad_t);
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
     cantidad=$("#cantidad"+id).val();
  cantidad_t=$("#n_productos").val();
           if(cantidad_t==null){
               cantidad_t=0;
           }
           total_c=$("#cantidad_total").val();
           if(total_c==''){
               total_c=0;
           }
           cantidad_t=cantidad_t-1;
           total_c=total_c-cantidad;
           $("#cantidad_total").val(total_c);
           $("#n_productos").val(cantidad_t);
  $("#"+id).remove();
  
 }
</script>