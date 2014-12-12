<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

         
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Entradas
                        <small>Almacen</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inico</a></li>
                        <li><a href="#">Entrada</a></li>
                        <li class="active">index</li>
                    </ol>
                    <div>
                        <li><a  href="nuevo" class="btn btn-primary">Nuevo</a></li>
                     </div>
                </section>

                <!-- Main content -->
                <section class="content">
                    <table class="table table-bordered" >
                         <tr>
                            <th rowspan="2" >ITEM</th>
                            <th rowspan="2" >PRODUCTO</th>
                            <th  rowspan="2">FECHA ENTRADA</th>
                            <th rowspan="2">N° COMPROBANTE</th>
                            <th  rowspan="1"colspan="3">ACCIONES</th>
                        </tr>
                        <tr>
                            <th>Ver</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                        
                            <?php 
                            foreach ($grid as $g)
                            {
                                echo "<tr>";
                                echo "<td>".$g['id_entadas']."</td>";
                                echo "<td>".$g['producto']."</td>";
                                echo "<td>".$g['fecha_entrada']."</td>";
                                echo "<td>".$g['numero_comprobante']."</td>";
                                echo "<td>ver</td>";
                                echo "<td>editar</td>";
                                echo "<td>eliminar</td>";
                                echo "</tr>";
                            }
                            ?>
                        
                    </table>
                </section><!-- /.content -->
           
       
        
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>