<?php
switch ($accion) {
    case '0':

        $url = "http://test.analitica.com.co/AZDigital_Pruebas/WebServices/ServiciosAZDigital.wsdl";
        $endpointURI = "http://35.211.83.38/AZDigitalV6/WebServices/SOAP/index.php";

        $xslSql = new DOMDocument;
        $xslSql->load('xsl/toSql.xsl');

        $procSql = new XSLTProcessor;
        $procSql->importStyleSheet($xslSql);

        if($model->saveArchivos($url,$endpointURI,$procSql)){
            $xslVista = new DOMDocument;
            $xslVista->load('xsl/toVista.xsl');

            $procVista = new XSLTProcessor;
            $procVista->importStyleSheet($xslVista);
            $resp = $model->getArchivos($procVista);
        }
        $view="archivos";
        break; 
    case 'cantidad':
        $xslVista = new DOMDocument;
        $xslVista->load('xsl/toVistaCantidad.xsl');

        $procVista = new XSLTProcessor;
        $procVista->importStyleSheet($xslVista);
        $resp = $model->getCantidadArchivos($procVista);
        
        $view="archivos";
        break;
    }
?>
