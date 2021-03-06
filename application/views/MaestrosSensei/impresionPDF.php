<?php

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{
    public $izquierdo;
    public $derecho;

    public function setData($izq, $derech)
    {
        $this->izquierdo = $izq;
        $this->derecho = $derech;
    }
    //Page header
    public function Header()
    {

        // Set font
        $this->SetFont('helvetica', 'B', 23);
        // Title
        $this->Ln(4);
        $this->Cell(0, 20, 'CALIFICACION FINAL DE MATERIA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(4);
        // Logo
        // $image_file = FCPATH . 'computel.png';

        $this->Image(FCPATH . '/publico/img/fondo.jpeg', 10, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Image(FCPATH . '/publico/img/fondo.jpeg', 255, 5, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Pagina ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf->setData($Asignado[0]->logo_emp, $Asignado[0]->Empresa_Ruta_Logo);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CCS');
$pdf->SetTitle('CALIFICACION MATERIA');
$pdf->SetSubject('impresion');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once dirname(__FILE__) . '/lang/eng.php';
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);

// add a page
$pdf->AddPage('L', 'A4');

// set cell padding
//$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
// $pdf->setCellMargins(1, 1, 1, 1);
//$pdf->setCellPaddings($left = '2', $top = '2', $right = '2', $bottom = '2');

// set color for background
//$pdf->SetFillColor(255, 255, 127);

// set some text for example

// Multicell test

//ejemplo de dibujar la linas

/*
$pdf->MultiCell(12, 15, '', 'L', 'C', 0, 0); // Left border only
$pdf->MultiCell(12, 15, '', 'LR', 'C', 0, 0); // Left and Right border only
$pdf->MultiCell(12, 15, '', 'LRB', 'C', 0, 0); // Left,Right and Bottom border only
$pdf->MultiCell(12, 15, '', 'LRBT', 'C', 0, 0); // Full border  */

$tbl = '
<table border="1" cellpadding="2" cellspacing="2" nobr="true">
 <tr>
  <th align="center">Materia</th>
  <th align="center">Alumno</th>
  <th align="center">Calificación</th>
 </tr>';
$cuerpo = '';
foreach ($lista_alumno->result() as $key) {
    $this->M_Sensei->set_calificacion_alumno($key->Materia_ID, $key->Usuario_ID, round($this->M_Sensei->suma_unidades_materia_alumno($key->Materia_ID, $key->Usuario_ID) / $total_unidades_materia, 2));
    $cuerpo = $cuerpo . '
    <tr>
        <td>' . $key->Materia_Nombre . '</td>
        <td>' . $key->Usuario_Nombre . '</td>
        <td>' . round($this->M_Sensei->suma_unidades_materia_alumno($key->Materia_ID, $key->Usuario_ID) / $total_unidades_materia, 2) . '</td>
    </tr>
    ';
}
$fin = '
</table>
';
$pdf->writeHTML($tbl . $cuerpo . $fin, true, false, false, false, '');

// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Calificacion_materia.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
