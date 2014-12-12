<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<section class="content-header">
                    <h1>
                        lista de 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-android"></i> <?php echo $ruta?></a></li>
                        <li class="active">dd</li>
                    </ol>
    </section>
       
<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Lista de usuarios</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row"><div class="col-xs-6"><div class="dataTables_length" id="example1_length"><label><select aria-controls="example1" size="1" name="example1_length"><option selected="selected" value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> records per page</label></div></div><div class="col-xs-6"><div id="example1_filter" class="dataTables_filter"><label>Search: <input aria-controls="example1" type="text"></label></div></div></div>
                                        <table aria-describedby="example1_info" id="example1" class="table table-bordered table-striped dataTable">
                                        <thead>
                                            <tr role="row">
                                                <th>idusuario</th><th>Nombre</th>
                                                <td colspan="3">Acciones</td>
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
                                          echo "<td><a class='btn btn-info btn-eye'>Ver</a></td>";
                                          echo "<td><a>Editar</a></td>";
                                          echo "<td><a>Eliminar</a></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div id="example1_info" class="dataTables_info">Showing 1 to 50 of 57 entries</div>
                                                    
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="dataTables_paginate paging_bootstrap">
                                                     <?php ?>                                                   <!-- <ul class="pagination">
                                                        <li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a>
                                                        </li><li><a href="#">2</a></li><li class="next"><a href="#">Next → </a></li>
                                                    </ul>-->
                                                </div>
                                            </div>
                                        </div></div>
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