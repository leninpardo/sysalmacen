<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div>
         <section class="content-header">
                    <h1>
                        Categorias
                        <small>Registradas</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inico</a></li>
                        <li><a href="#">Categoria</a></li>
                        <li class="active">index</li>
                    </ol>
                    <div>
                        <li><a  href="nuevo" class="btn btn-primary ">Nuevo</a></li>
                        <h6><?php echo $message;?></h6>
                     </div>
                </section>
    <br/>
     <div class="row-fluid">
           
            <div class='' style=''>
                <table  class="table table-striped table-bordered table-hover" style="" id="index">
                    <thead>
                        <tr>
                            <th rowspan="2">Item</th>
                            <th rowspan="2"> Categoria</th>
                            <th rowspan="2"> Campo ejemplo</th>
                            <th   colspan="3">Acciones</th>
                        </tr>
                        <tr>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($grid as $ds){
                            echo "<tr>";
                            echo "<td>".$ds['id_categoria']."</td>";
                            echo "<td>".$ds['categoria']."</td>";
                             echo "<td>".$ds['campoejemplo']."</td>";
                            echo "<td><a class='btn btn-info' href='edit&id=".$ds['id_categoria']."'><i class='btn'></i></a></td>";
                          echo "<td><a class='btn btn-info' href='delete&id=".$ds['id_categoria']."'><i class='btn'></i></a></td>";
                            
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
     </div>
</div>


                
<script type="text/javascript">
          $(function () {
             
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                })
</script>