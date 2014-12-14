<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <thead></thead>
<?php

?>
    <tbody>
<table class="table table-bordered table-hover" border="1">
    <tr>
        <td>Item</td>
        <td>Nro entrada</td>
        <td>Fecha</td>
        <td>Tiempo</td>
        <td>Tipo comprabante</td>
        <td>Numero de Comprobante</td>
        <td>Guia Remision</td>
        <td>chofer</td>
        <td>Cantidad</td>
        <td>Articulo</td>
        <td>Descripcion articulo</td>
        <td>Unidad Medida</td>
        <td>Categoria</td>
    </tr>
    <?php 
    $i=0;
    foreach ($kardex as $kd){
        $i++;
        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>" . $kd['id_entradas'] . "</td>";
        echo "<td>" . $kd['fecha_entrada'] . "</td>";
        echo "<td>" . $kd['tiempo'] . "</td>";
        echo "<td>" . $kd['tipo_comprobante'] . "</td>";
        echo "<td>" . $kd['numero_comprobante'] . "</td>";
        echo "<td>" . $kd['gui_remision'] . "</td>";
        echo "<td>" . $kd['chofer'] . "</td>";
        echo "<td>" . $kd['cantidad'] . "</td>";
        echo "<td>" . $kd['articulo'] . "</td>";
         echo "<td>" . $kd['descripcion'] . "</td>";
          echo "<td>" . $kd['unidad_medida'] . "</td>";
           echo "<td>" . $kd['categoria'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>
</tbody>
</html>