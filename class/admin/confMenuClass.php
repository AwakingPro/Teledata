<?php 

    include('../../class/methods_global/methods.php'); 
    header('Content-type: application/json');
    /**
    * Clase para configuracion de los privilegios del menu
    */
    class confMenu{

        public function GetDatatableMenu(){

            $run = new Method();
            $array = array();
            
            $headers = array();
            $headers[] = "Menu";
            $headers[] = "Submenu";

            $query = "SELECT * FROM roles"; 
            $roles = $run->select($query);
            foreach($roles as $rol){
                $headers[] = utf8_encode($rol['nombre']);
            }

            $array['headers'] = $headers;
            
            $menus = array();
            $query = "SELECT * FROM menu"; 
            $consulta_menu = $run->select($query);

            foreach($consulta_menu as $menu){
                $i = 0;
                $id = $menu['id_menu'];
                $result = '';
                $menus[$id][$i] = utf8_encode($menu['descripcion']);
                $i++;
                $result =  $result . utf8_encode($menu['descripcion']) . '<div class="clearfix" style="margin-bottom:2%"></div>';
                $query = "SELECT * FROM submenu WHERE Id_menu = ".$menu['id_menu'];
                $submenus = $run->select($query);
                foreach($submenus as $submenu){
                    $result =  $result . '--' . utf8_encode($submenu['Nombre']) . '<div class="clearfix" style="margin-bottom:2%"></div>';
                }

                $menus[$id][$i] = $result;
                $i++;
                foreach($roles as $rol){
                    $result = '';
                    $query = "SELECT * FROM menu_roles where id_menu = ".$menu['id_menu']." AND id_rol = ".$rol['id']." AND menu_submenu = 1";
                    $privilegio = $run->select($query);
                    if(count($privilegio) == 0){
                        $result = $result . '<input type="checkbox" id = "'.$rol['id'].'-'.$menu['id_menu'].'-1"><br>';
                    }else{
                        $result = $result . '<input type="checkbox" id = "'.$rol['id'].'-'.$menu['id_menu'].'-1" checked><br>';
                    }
                    
                    foreach($submenus as $submenu){

                        $query = "SELECT * FROM menu_roles where id_menu = ".$submenu['IdSubMenu']." AND id_rol = ".$rol['id']." AND menu_submenu = 2";
                        $privilegio = $run->select($query);
                        if(count($privilegio) == 0){
                            $result = $result . '<input type="checkbox" id = "'.$rol['id'].'-'.$submenu['IdSubMenu'].'-2"><br>';
                        }else{
                            $result = $result . '<input type="checkbox" id = "'.$rol['id'].'-'.$submenu['IdSubMenu'].'-2" checked><br>';
                        }
                    }

                    $menus[$id][$i] = $result;
                    $i++;
                }
            } 
            
            $array['menus'] = $menus;

            echo json_encode($array);
            
        }

        function crearPrivilegio($ID){
            $run = new Method();

            $Explode = explode('-',$ID);
            $id_rol = $Explode[0];
            $id_menu = $Explode[1];
            $menu_submenu = $Explode[2];
            $query = "INSERT INTO menu_roles (id_menu,id_rol,menu_submenu) VALUES ('".$id_menu."','".$id_rol."','".$menu_submenu."')";
            $insert = $run->insert($query);
        }

        function eliminarPrivilegio($ID){
            $run = new Method();

            $Explode = explode('-',$ID);
            $id_rol = $Explode[0];
            $id_menu = $Explode[1];
            $menu_submenu = $Explode[2];
            $query = "DELETE FROM menu_roles WHERE id_menu = ".$id_menu." AND id_rol = ".$id_rol." AND menu_submenu = ".$menu_submenu;
            $delete = $run->delete($query);
        }
    }
 ?>