    <?php
        require_once('../../class/methods_global/methods.php');
        $run = new Method;

        $Rut = isset($_POST['rut']) ? trim($_POST['rut']) : "";
        $Dv = $run->obtenerDv($Rut);
        echo trim($Dv);
    ?>