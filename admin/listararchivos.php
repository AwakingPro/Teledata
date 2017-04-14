<?php 
//showFiles("/home/foco/ftp/45");

echo "<br>";
echo "Se busca el rut: 76443280";
echo "<br>";


$resp = BuscarEnDirectorio("/home/foco/ftp/facturas","76443280");
echo "Se encontro :" . $resp;
echo "<br><br>";





function showFiles($path){
    $dir = opendir($path);
    $files = array();
    while ($current = readdir($dir)){
        if( $current != "." && $current != "..") {
            if(is_dir($path.$current)) {
                showFiles($path.$current.'/');
            }
            else {
                $files[] = $current;
            }
        }
    }
    echo '<h2>'.$path.'</h2>';
    echo '<ul>';
    for($i=0; $i<count( $files ); $i++){
        echo '<li>'.$files[$i]."</li>";
    }
    echo '</ul>';
}

function BuscarEnDirectorio($path,$rut){
    $dir = opendir($path);
    $files = array();
    $nombreArchivo = "";
    while ($current = readdir($dir)){
        if( $current != "." && $current != "..") {
            if(is_dir($path.$current)) {
                //showFiles($path.$current.'/');
            }
            else {
                $files[] = $current;
                $pos = strpos($current, $rut);
                if ($pos !== false) {
				     return $current;
				} 
            }
        }
    }
    return "0";
    
}






 ?>
