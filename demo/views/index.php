<?
	use Firestitch\PdfRenderer;

	if(isset($_POST["example1"])) {	
	
		$pdf = new PdfRenderer();
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->AddPage();
		$pdf->setSourceFile(basename(__DIR__)."/crop-marks.pdf");

		$tplId = $pdf->importPage(1);

		$pdf->useTemplate($tplId, 0, 0, 100);
		$pdf->Output();	
	}

?>

<button type="submit" name="example1" class="btn btn-primary">Import Page</button>

