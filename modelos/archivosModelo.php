<?php
class archivosModelo extends padreModelo{

    public function saveArchivos($url, $endpointURI, $proc){
        global $bd;
        
        $this->delArchivos();

        $options = array('location' => $endpointURI);
        $client = new SoapClient($url, $options);
        
        $archivos = $client->BuscarArchivo(array('Condiciones' => array('Condicion' => array('Tipo' => "FechaInicial",
        'Expresion' => "2019-07-01 00:00:00"))));
        $outXml = $this->toXml(json_encode($archivos));
        $sql = $proc->transformToXML($outXml);

        $result = $bd->prepare($sql);
        $result->execute();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function getArchivos($proc){
        global $bd;
        $result = $bd->query("SELECT id, nombre FROM archivos");
        $archivos = array('Archivo' => $result->fetchAll(PDO::FETCH_CLASS,"Archivo"));
        $outXml = $this->toXml(json_encode($archivos));
        
        return $proc->transformToXML($outXml);
    }

    public function getCantidadArchivos($proc){
        global $bd;
        $result = $bd->query("SELECT COUNT(id) as cantidad, extension FROM tipo_archivo GROUP BY extension");
        $archivos = array('Archivo' => $result->fetchAll(PDO::FETCH_CLASS,"CantidadArchivo"));
        $outXml = $this->toXml(json_encode($archivos));
        
        return $proc->transformToXML($outXml);
    }

    private function toXml($json){
        require_once 'XML/Serializer.php';

        $data = json_decode($json, true);

        $serializer_options = array (
        'addDecl' => TRUE,
        'encoding' => 'ISO-8859-1',
        'indent' => '  ',
        'rootName' => 'RtaBuscarArchivo',
        'mode' => 'simplexml'
        ); 

        $Serializer = new XML_Serializer($serializer_options);
        $status = $Serializer->serialize($data);

        if (PEAR::isError($status)) die($status->getMessage());

        return simplexml_load_string($Serializer->getSerializedData());
    }

    private function delArchivos(){
        global $bd;
        $result = $bd->query("TRUNCATE archivos;TRUNCATE tipo_archivo;");
    }
}

class Archivo {
    public $id;
    public $nombre;
}

class CantidadArchivo {
    public $cantidad;
    public $extension;
}
?>
