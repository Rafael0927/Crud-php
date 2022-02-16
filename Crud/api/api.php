<?php
    class Api{
 
        public function __construct(){
            $this->db = new Db;
        }
        public function storeCategoria($idp, $codigop, $nombrep, $descripcionp, $activop){
            $query = "INSERT INTO `categoria` (`id`, `codigo`, `nombre`, `descripcion`, `activo`) VALUES ('$idp', '$codigop', '$nombrep', '$descripcionp','$activop')";
   
            if($this->db->insert($query)){
                
                $_SESSION['exito'] = 'Categoria agregada con exito';
                    
            }else{

                $_SESSION['ErrorAcademia'] = 'La categoria ya existe!';

            }  
        }
        public function updateCategoria($idp, $codigop, $nombrep, $descripcionp, $activop){
            $query = "UPDATE categoria SET id = '".$idp."', codigo = '".$codigop."', nombre = '".$nombrep."', descripcion = '".$descripcionp."', activo = '".$activop."' WHERE id = '".$idp."'";

            if($this->db->insert($query)){
                
                $_SESSION['ErrorAcademia'] = 'La categoria no se modifico!'. $idp;
                    
            }else{

                $_SESSION['exito'] = 'Categoria modificada con exito';

            }  
        }
        public function storeProduct($idp, $codigop, $nombrep, $categoriap, $descripcionp, $marcap,$preciop){
            $query = "INSERT INTO `product` (`id`, `codigo`, `nombre`, `descripcion`, `marca`, `categoria`, `precio`) VALUES ('$idp', '$codigop', '$nombrep', '$descripcionp', '$marcap', '$categoriap', '$preciop')";
   
            if($this->db->insert($query)){
                
                $_SESSION['ErrorAcademia'] = 'El producto exite!';
                    
            }else{

                $_SESSION['exito'] = 'Producto agregado con exito';

            }  
        }
        public function updateProducto($idp, $codigop, $nombrep, $categoriap, $descripcionp, $marcap,$preciop){
            $query = "UPDATE product SET id = '".$idp."', codigo = '".$codigop."', nombre = '".$nombrep."', descripcion = '".$descripcionp."', marca = '".$marcap."', categoria = '".$categoriap."', precio = '".$preciop."'  WHERE id = '".$idp."'";

            if($this->db->insert($query)){
                
                $_SESSION['ErrorAcademia'] = 'El producto no se modifico!'. $idp;
                    
            }else{

                $_SESSION['exito'] = 'Producto se modifico';

            }  
        }
        public function deleteProduct($idp){
            $query = "DELETE FROM product WHERE id = '".$idp."'";
            if($this->db->insert($query)){
                
                $_SESSION['ErrorAcademia'] = 'El producto no se elimino!'. $idp;
                    
            }else{

                $_SESSION['exito'] = 'Producto eliminado';

            }  
        }
    }
?>