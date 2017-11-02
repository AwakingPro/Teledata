<?php

    include('../../../class/methods_global/methods.php'); 
    header('Content-type: application/json');

    class Uf{

    	public function storeUf($Mes, $Valor){

            $response_array = array();

            $Mes = isset($Mes) ? trim($Mes) : "";
            $Valor = isset($Valor) ? trim($Valor) : "";

            if(!empty($Mes) && !empty($Valor)){

                $this->Mes=$Mes;
                $this->Valor=$Valor;

                $query = "INSERT INTO mantenedor_uf(mes, valor) VALUES ('$this->Mes','$this->Valor')";
                $run = new Method;
                $id = $run->insert($query);

                if($id){

                    $array = array('id'=> $id, 'mes' => $this->Mes, 'valor' => $this->Valor);

                    $response_array['array'] = $array;
                    $response_array['status'] = 1; 
                }else{
                    $response_array['status'] = 0; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);

    	} 


        function updateUf($Mes, $Valor, $Id){

            $response_array = array();

            $Mes = isset($Mes) ? trim($Mes) : "";
            $Valor = isset($Valor) ? trim($Valor) : "";
            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Mes) && !empty($Valor) && !empty($Id)){

                $this->Mes=$Mes;
                $this->Valor=$Valor;
                $this->Id=$Id;

                $query = "UPDATE `mantenedor_uf` set `mes` = '$this->Mes', `valor` = '$this->Valor' where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->update($query);

                if($data){

                    $array = array('mes' => $this->Mes, 'valor' => $this->Valor, 'id' => $this->Id);

                    $response_array['array'] = $array;
                    $response_array['status'] = 1; 

                }else{
                    $response_array['status'] = 0; 
                }
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function deleteUf($Id){

            $response_array = array();

            $Id = isset($Id) ? trim($Id) : "";

            if(!empty($Id)){

                $this->Id=$Id;

                $query = "DELETE from `mantenedor_uf` where `id` = '$this->Id'";
                $run = new Method;
                $data = $run->delete($query);
                $response_array['status'] = 1; 
              
            }else{
                $response_array['status'] = 2; 
            }

            echo json_encode($response_array);
        }

        function showUf(){

            $query = "SELECT * from mantenedor_uf";
            $run = new Method;
            $data = $run->select($query);

            $response_array['array'] = $data;

            echo json_encode($response_array);

        }
    }

?>
