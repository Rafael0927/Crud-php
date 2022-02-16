<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Crud  de productos  </title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/sweetalert2.min.css">
        <link rel="stylesheet" href="css/bootstrap-select.min.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <?php 
    session_start(); 

    $db = new mysqli( 'localhost', 'root', '', 'productos' );

    ?>
    
    <body>
    <script type="text/javascript">        
        $(document).ready(function(){  
            $("#botoncrear").click(function () {
                $('.Panelmodificar').hide("slow");
                $('.Paneleliminar').hide("slow");
                $('.PanelCrear').toggle("slow");
            });
            $("#botoncerrar").click(function () {
                $('.PanelCrear').toggle("slow");
            });
            $("#botoncancelar").click(function () {
                $('.PanelCrear').toggle("slow");
            });

        });

        $(document).ready(function() {
            $(document).on('click', '.edit', function() {
                var id = $(this).val();
                var idd = $('#id' + id).text();
                var codigo = $('#codigo' + id).text();
                var nombre = $('#nombre' + id).text();
                var descripcion = $('#descripcion' + id).text();
                var marca = $('#marca' + id).text();
                var categoria = $('#categoria' + id).text();
                var precio = $('#precio' + id).text();
                $('#idmodificar').val(idd);
                $('#codigomodificar').val(codigo);
                $('#nombremodificar').val(nombre);
                $('#descripcionmodificar').val(descripcion);
                $('#marcamodificar').val(marca);
                //$('#categoriamodificar').val(categoria);
                $('#preciomodificar').val(precio);
               
                $('.PanelCrear').hide("slow");
                $('.Panelmodificar').hide("slow");
                $('.Paneleliminar').hide("slow");
                $('.Panelmodificar').show("slow");
            });
        });

        $(document).ready(function() {
            $(document).on('click', '.delete', function() {
                var id = $(this).val();
                var idd = $('#id' + id).text();
                $('#ideliminar').val(idd);      
               
                $('.PanelCrear').hide("slow");
                $('.Panelmodificar').hide("slow");
                $('.Paneleliminar').hide("slow");
                $('.Paneleliminar').show("slow");
            });
        });
    </script>
        <div id="productModal" class=" PanelCrear" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Producto</h4>
                        <button type="button" id="botoncerrar" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form name="productForm" id="productForm" action="api/AddProducto.php" method="POST">
                        <div class="modal-body">                          
                            <div class="form-group">
                                <label>Id</label>
                                <input type="text" name="id" id="id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text" name="codigo" id="code" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" name="descripcion" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Marca</label>
                                <input type="text" name="marca" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Categoría</label>
                                <select name="categoria" class="form-control" id="exampleFormControlSelect1">
                                      <?php foreach ($db->query("SELECT id, nombre FROM `categoria`" ) as $row){ ?> 
                                      <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="text" pattern="\d*" name="precio" id="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" id="botoncancelar" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-info" value="Agregar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="productModal" class=" Panelmodificar" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modificar Producto</h4>
                        <button type="button" id="botoncerrar" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form name="productForm" id="productForm" action="api/ModificarProducto.php" method="POST">
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label>Id</label>
                                <input type="text" name="id" id="idmodificar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Código</label>
                                <input type="text" name="codigo" id="codigomodificar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" id="nombremodificar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" name="descripcion" id="descripcionmodificar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Marca</label>
                                <input type="text" name="marca" id="marcamodificar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Categoría</label>
                                <select name="categoria" class="form-control" id="exampleFormControlSelect1">
                                      <?php foreach ($db->query("SELECT id, nombre FROM `categoria`" ) as $row){ ?> 
                                      <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="text" pattern="\d*" name="precio" id="preciomodificar" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" id="botoncancelar" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-info" value="Modificar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
         <div id="productModal" class=" Paneleliminar" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Eliminar producto</h4>
                        <button type="button" id="botoncerrar" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <form name="productForm" id="productForm" action="api/deleteProduct.php" method="POST">
                        <div class="modal-body">
                            <h4>¿Seguro que desea eliminar el producto seleccionado? </h4>
                            <div class="form-group" style="display: none;" >
 
                                <input type="hidde"  name="id" id="ideliminar" class="form-control" required>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="button" id="botoncancelar" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                            <input type="submit" class="btn btn-info" value="Eliminar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Administrar <b>Productos</b></h2>
                        </div>
                        <div class="col-sm-12">
                            <a id="botoncrear" class="btn btn-success"><i class="fa fa-plus"></i> <span>Agregar  producto</span></a><br><br><br>
                        </div> 
                        <div class="col-sm-12">
                            <a href="categoria.php"  id="botonproducto" class="btn btn-success"><i class="fa fa-plus"></i> <span>Agregar categoria</span></a>
                        </div>

                    </div>
                </div>
                <div class="table-responsive">
                    <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">                
                    <thead>
                        <tr center>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Marca</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                          </tr>
                    </thead>
                    <?php foreach ($db->query("SELECT *, categoria.nombre as nombrec, product.id as idp FROM `product`, `categoria` where categoria.id = product.categoria " ) as $row){ // aca puedes hacer la consulta e iterarla  ?> 
                    <tr>
                        <td><span id="id<?php echo $row['idp'] ?>"><?php echo $row['idp'] ?></span></td>
                        <td><span id="codigo<?php echo $row['idp'] ?>"><?php echo $row['codigo'] ?></span></td>
                        <td><span id="nombre<?php echo $row['idp'] ?>"><?php echo $row['nombre'] ?></span></td>

                        <td><span id="descripcion<?php echo $row['idp'] ?>"><?php echo $row['descripcion'] ?></span></td>
                        <td><span id="marca<?php echo $row['idp'] ?>"><?php echo $row['marca'] ?></span></td>
                        <td><span id="nombrec<?php echo $row['idp'] ?>"><?php echo $row['nombrec'] ?></span></td>
                        <td><span id="precio<?php echo $row['idp'] ?>"><?php echo $row['precio'] ?></span></td>

                        
                        <td><center><button value="<?php echo $row['idp'] ?>" id="<?php echo $row['idp'] ?>" onclick="document.getElementById('id01').style.display='block'" class="btn-primary edit"><i class="fas fa-user-edit"></i></button></center></td>
                        <td><center><button value="<?php echo $row['idp'] ?>" id="<?php echo $row['idp'] ?>" onclick="document.getElementById('id02').style.display='block'" class="btn-primary delete"><i class="fas fa-user-times"></i></i></button></center></td>                         
                     </tr>
                    <?php
                        }
                    ?>
                    <tfoot>
                        <tr center>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Marca</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                          </tr>
                    </tfoot>
                </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SCRIPTS -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/sweetalert2.min.js"></script>
        <script src="js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
              $('#example').DataTable({
                "language": {
                  "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
              });
            });
        </script>

        <?php if (isset($_SESSION['ErrorAcademia'])) { ?>
            <script type="text/javascript">
                swal("<?php echo $_SESSION['ErrorAcademia'] ?>", "", "error");
            </script>
        <?php $_SESSION['ErrorAcademia'] = null; } ?>
        <?php if (isset($_SESSION['exito'])) { ?>
            <script type="text/javascript">
                swal("<?php echo $_SESSION['exito'] ?>","", "success");
            </script>
        <?php $_SESSION['exito'] = null;} ?>

    </body>
</html>