<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div>
    <h1>Registro de Salidas entradas</h1>
    <form action="save" method="post">
        <div class="">
            <label>Fecha:</label>
            <input type="text" name="fecha" id="fecha"/>
            <label>Proveedor:</label>
           <?php echo $proveedor;?>
            <label>Tipo comprobante:</label>
            <input type="text" name="tipo" id="tipo"/>
            <label>Numero:</label>
            <input type="text" name="numero" id="numero"/>
            
            <div class="producer">
                <table class="table table-bordered">
                    <tr>
                        <th>item</th>
                         <th>producto</th>
                          <th>stock</th>
                           <th>unidad medida</th>
                            <th>cantidad</th>
                    </tr>
                    <tr>
                       <?php
                       foreach ($articulos as $a){
                           echo "<tr>";
                           echo "<td>".$a['id_articulo']."</td>";
                            echo "<td>".$a['id_medida']."</td>";
                             echo "<td>".$a[2]."</td>";
                              echo "<td>".$a[3]."</td>";
                               echo "<td>".$a[4]."</td>";
                             echo "</tr>";
                       }
                       ?> 
                    </tr>
                    <tr>
                        <th colspan="4">Nro de productos</th>
                        <th>Cantidad total</th>
                    </tr>
                </table>
            </div>
            
        </div>
    </form>
</div>