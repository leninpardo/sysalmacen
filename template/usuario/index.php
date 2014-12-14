<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<section class="content-header">
                    <h1>
                        lista de 
                        <small> usuarios</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-android"></i> Usuarios</a></li>
                        <li class="active">index</li>
                    </ol>
    </section>
       
<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Lista de usuarios</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                
                                        <table aria-describedby="example1_info" id="example1" class="table table-bordered table-striped dataTable">
                                        <thead>
                                            <tr role="row">
                                                <th>idusuario</th><th>Nombre</th>
                                                <td colspan="2">Acciones</td>
                                            </tr>
                                        </thead>
                                        
                                        <tfoot>
                                            <tr>
                                               
                                            </tr>
                                        </tfoot>
                                    <tbody aria-relevant="all" aria-live="polite" role="alert">
                                    <?php 
                                    foreach ($grid as $g)
                                    {
                                        echo "<tr>";
                                        echo "<td>".$g['id_login']."</td>";
                                         echo "<td>".$g['nombre']."</td>";
                                        
                                          echo "<td><a>Editar</a></td>";
                                          echo "<td><a>Eliminar</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                        </table>
                                     
                                </div><!-- /.box-body -->
                            </div>
   <script type="text/javascript">
            $(function() {
               
                $('#example1').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>