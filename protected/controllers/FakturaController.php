<?php
    class FakturaController extends Controller
    {
        public function run($id)
        {	
       
            if (substr($id,0,2)=="ID") {
             
                $faktura=substr($id,2,strlen($id));
                $pathToInvoice=YiiBase::getPathOfAlias('webroot')."/protected/documents/pdf/agreements/invoice_".$faktura.".pdf";
                GDownload::send($pathToInvoice);

            } elseif (substr($id,0,2)=="IS") {
                $faktura=substr($id,2,strlen($id));
                $pathToInvoice=YiiBase::getPathOfAlias('webroot')."/protected/documents/pdf/agreements/invoice_s_".$faktura.".pdf";
                GDownload::send($pathToInvoice);
                
            } elseif (substr($id,0,2)=="CF") {
                $faktura=substr($id,2,strlen($id));
                $pathToInvoice=YiiBase::getPathOfAlias('webroot')."/protected/documents/pdf/agreements/chargeback_".$faktura.".pdf";
                GDownload::send($pathToInvoice);
                
            } elseif (substr($id,0,2)=="CR") {
                $faktura=substr($id,2,strlen($id));
                $pathToInvoice=YiiBase::getPathOfAlias('webroot')."/protected/documents/pdf/agreements/chargeback_r".$faktura.".pdf";
                GDownload::send($pathToInvoice);
   
            } elseif (substr($id,0,2)=="FR") {
                $faktura=substr($id,2,strlen($id));
                $pathToInvoice=YiiBase::getPathOfAlias('webroot')."/protected/documents/pdf/agreements/invoice_r".$faktura.".pdf";
                GDownload::send($pathToInvoice);
                
             } elseif (substr($id,0,2)=="DE") {
                $faktura=substr($id,2,strlen($id));
                $pathToInvoice=YiiBase::getPathOfAlias('webroot')."/protected/documents/pdf/agreements/demo_".$faktura.".pdf";
                GDownload::send($pathToInvoice);
                
            }
        }
        
}