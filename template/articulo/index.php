<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

         
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Articulos
                        <small>Registrados</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inico</a></li>
                        <li><a href="#">Articulo</a></li>
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
                            <th rowspan="2">Nombre</th>
                            <th rowspan="2">Descrpcion</th>
                            <th rowspan="2">Stock</th>
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
                                echo "<td>".$g['id_articulo']."</td>";
                                echo "<td>".$g['articulo']."</td>";
                                echo "<td>".$g['descripcion']."</td>";
                                echo "<td>".$g['stock']."</td>";
                              
                                echo "<td><a href='editar&id=".$g['id_articulo']."'>Editar</a></td>";
                                 echo "<td><a href='eliminar&id=".$g['id_articulo']."'>Eliminar</a></td>";
                                ///echo "<td <a href='eliminar&id=".$g['id_articulo']."'>eliminar</a></td>";
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