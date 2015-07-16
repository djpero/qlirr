<?php
    class PdfGenerator
    {
        function generatePdfTcpdf($html, $background = false, $pdfPath)
        {
            // create new PDF document        
            Yii::import('application.vendors.tcpdf.config.lang.eng');
            Yii::import('application.vendors.tcpdf.config.lang.tcpdfConfig');
            Yii::import('application.vendors.tcpdf.tcpdf');
           // Yii::import('application.extensions.phpmailer.JPhpMailer');
            //require_once(APPLICATION_PATH . '/../library/tcpdf/config/lang/eng.php');
            //require_once(APPLICATION_PATH . '/../library/tcpdf/tcpdf.php');
            // create new PDF document
            $pdf = new tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
     
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            //podesavanje fonta, ovaj ima nasa slova  i prakticno to je arial 
            //u photoshop-u kad se preklopi preko Bozinog isto :)

            $pdf->SetFont('freesans', '', 10);
            $pdf->setFontSubsetting(false);

            //margine podesene za velicinu A4 formata u skladu sa Bozinim marginama
            $pdf->SetMargins(2, 0, 4);  // ---------------> za sve ostale
           //$pdf->SetMargins(2, 4, 8);
            //set auto page breaks
            $pdf->SetAutoPageBreak(false, 10);
            //dodata stranica velicina A4 formata
            $pdf->SetDisplayMode('real', 'SinglePage', 'UseNone');
            $pdf->AddPage('P', 'A4');

            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            if ($background == true)
            {
                $img_file = K_PATH_IMAGES.'HUB3A.gif';
//                echo($img_file);die();
                $pdf->Image($img_file, 1, 204, 208, 101, 'gif', '', '', false, 300, '', false, false, 0);
            }

            $pdf->setPageMark();
            // ---------------------------------------------------------

            //$htmlcontent = $this->view->render('invoice/view.phtml');
            // output the HTML content
            $pdf->writeHTML($html, true, 0, true, 0);
            $pdf->lastPage();
//            $pdfPath = Yii::app()->request->baseUrl.'report'. '.pdf';

            //die($pdfPath);
        
            $pdf->Output($pdfPath, 'F');

            //file_put_contents ($pdfPath, $pdf->Output($pdfPath, 'F'));


            //return $pdfPath;
        }
}