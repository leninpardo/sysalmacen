<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Almacen</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
                <script src="/<?php echo file;?>/js/jquery.min.js" type="text/javascript"></script>
                <script src="/<?php echo file;?>/js/jquery.blockUI.js" type="text/javascript"></script>
                 <script src="/<?php echo file;?>/js/funciones_globales.js" type="text/javascript"></script>
                 <script src="/<?php echo file;?>/js/required.js" type="text/javascript"></script>
        <!-- bootstrap 3.0.2 -->
        <link href="/<?php echo file;?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="/<?php echo file;?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="/<?php echo file;?>/css/ionicons.min.css" rel="stylesheet" type="text/css" />
                <link href="/<?php echo file;?>/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="/<?php echo file;?>/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="/<?php echo file;?>/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="/<?php echo file;?>/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="/<?php echo file;?>/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="/<?php echo file;?>/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="/<?php echo file;?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
<<<<<<< HEAD
    <body class="skin-blue" style="background: #c9f1fd repeat;">
        <!-- header logo: style can be found in header.less -->
=======
    <body class="skin-blue">
        
        <!-- Parte derecha -->
>>>>>>> eb0edc6651c1c51eda382ae4643a9d21651e223d
        <header class="header">
            <a href="/<?php echo file;?>/template/index" class="logo">
                Sistema de Almacenes
            </a>
            
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $_SESSION['nombre'];?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="/<?php echo file; ?>/img/almacen.jpg" class="img-circle" alt="User Image" />
                                    <p>
                                       <?php echo $_SESSION['nombre'];?> - Encargado de almacen
                                       <small>Conectado <?php echo date("Y-m-d"); ?></small>
                                    </p>
                                </li>
<<<<<<< HEAD
                                <!-- Menu Body -->
                              
                                <!-- Menu Footer-->
=======
                              
>>>>>>> eb0edc6651c1c51eda382ae4643a9d21651e223d
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="/<?php echo file; ?>/login/logout" class="btn btn-default btn-flat">Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <!-- Parte izquierda-->
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="/<?php echo file; ?>/img/almacen.jpg" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Bienvenido: <?php echo $_SESSION['nombre'];?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="/<?php echo file;?>/template/index">
                                <i class="fa fa-dashboard"></i> <span>Inicio</span>
                            </a>
                        </li>
                        
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Almacen</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/<?php echo file;?>/entrada/index"><i class="fa fa-angle-double-right"></i> Entradas Almacen </a></li>
                                <li><a href="/<?php echo file;?>/salida/index"><i class="fa fa-angle-double-right"></i> Salidas de Almacen </a></li>
                                <li><a href="/<?php echo file;?>/articulo/index"><i class="fa fa-angle-double-right"></i> Articulos</a></li>
                                <li><a href="/<?php echo file;?>/unidad/index"><i class="fa fa-angle-double-right"></i> Unidades medidas</a></li>
                                <li><a href="/<?php echo file;?>/categoria/index"><i class="fa fa-angle-double-right"></i> Categoria </a></li>
<<<<<<< HEAD
                                <li><a href="/<?php echo file;?>/reportes/index_entradas"><i class="fa fa-angle-double-right"></i> reportes entrada </a></li>
                                 <li><a href="/<?php echo file;?>/reportes/index_salidas"><i class="fa fa-angle-double-right"></i> reportes Salida </a></li>
=======
                                <li><a href="/<?php echo file;?>/"><i class="fa fa-angle-double-right"></i> Proveedor </a></li>

>>>>>>> eb0edc6651c1c51eda382ae4643a9d21651e223d
                            </ul>
                        </li>
                      
                        <li class="active">
                            <a href="/<?php echo file;?>/usuario/index">
                                <i class="fa fa-users"></i> <span>Usuarios</span>
                            </a>
                        </li>   
                    </ul>
                </section>
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Main content -->
<<<<<<< HEAD
                <section class="content" style="background: #c9f1fd repeat;">
                    
<?php echo $content;?>
                    
               </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-5 connectedSortable" > 
                          

                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->

=======
                <section class="content">
                    <?php echo $content;?>
               </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        
            </aside>            
        </div>
>>>>>>> eb0edc6651c1c51eda382ae4643a9d21651e223d

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.jss"></script>
        <!-- jQuery UI 1.10.3 -->

        <!-- Bootstrap -->
         
<script src="/<?php echo file;?>/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
         
        <script src="/<?php echo file;?>/js/bootstrap.min.js" type="text/javascript"></script>
           <script src="/<?php echo file;?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="/<?php echo file;?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
     

             
        <!-- AdminLTE App -->
        <script src="/<?php echo file;?>/js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="/<?php echo file;?>/js/AdminLTE/dashboard.jss" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="/<?php echo file;?>/js/AdminLTE/demo.js" type="text/javascript"></script>
    </body>
</html>
