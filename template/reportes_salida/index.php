<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div>
    <h1>Reporte de kardex de Salidas a almacen</h1>
    <div>
        <fieldset>
            <legend>Datos a procesar</legend>
            <form name="" id="frm" action="procesamiento_salida" method="post" target="_blank">
            <label>Fecha:</label>
            <input type="date" value="" id="fi" name="fi"/>
            <label>Fecha:</label>
            <input type="date" value="" id="ff" name="ff"/>
            <input type="submit" name="procesar" id="procesar"/>
            </form>
        </fieldset>
    </div>
</div>
<script type="text/javascript">
    $(function(){
       $("#frm").submit(function(){
           bval=true;
           bval=$("#fi").required();
            bval=$("#ff").required();
            if(bval){
               $(this).submit();
            }
           return false;
       }) ;
    });
</script>