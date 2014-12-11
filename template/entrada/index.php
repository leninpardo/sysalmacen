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
                        <small>Planta</small>
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
                    <table class="table table-bordered">
                        <tr>
                            <th rowspan="2" >item</th>
                            <th rowspan="2">fecha entrada</th>
                            <th rowspan="2">nro comprobante</th>
                            <th  rowspan="1"colspan="3">Acciones</th>
                        </tr>
                        <tr>
                            
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                        
                            <?php 
                            foreach ($grid as $g)
                            {
                                echo "<tr>";
                                echo "<td>".$g['id_entradas']."</td>";
                                echo "<td>".$g['fecha_entrada']."</td>";
                                echo "<td>".$g['numero_comprobante']."</td>";
                              
                                echo "<td><a href='editar&id=".$g['id_entradas']."' >editar</a></td>";
                                echo "<td><a href='eliminar&id=".$g['id_entradas']."'>eliminar</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        
                    </table>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div>
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