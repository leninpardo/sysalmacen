<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>::Sumák:: Sistema Integrado Comercialización::</title>
        <link href="/<?php echo file; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/<?php echo file; ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/<?php echo file; ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="bg-light-blue-gradientg">
       
        <div class="form-box" id="login-box">
             <div class="container">
                 <h4>Sistema para almacen
                     <br/>****------****</h4></div>
            <div class="header">INICIE SESION</div>
            <form action="/<?php echo file;?>/login" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="usuario" class="form-control" placeholder="USUARIO"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="clave" class="form-control" placeholder="CONTRASEÑA"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> No cerrar sesión
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Iniciar sesión</button>  
                    
                    <p><a href="#">I forgot my password</a></p>
                    
                    <a href="register.html" class="text-center">Register a new membership</a>
                </div>
            </form>

            <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>
        </div>
        <script src="/<?php echo file; ?>/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/<?php echo file; ?>/js/bootstrap.min.js" type="text/javascript"></script> 
    </body>
</html>
