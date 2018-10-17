<?
	use Firestitch\PdfRenderer;

	if(isset($_POST["example1"])) {	
	
		$pdf = new PdfRenderer();
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->addPdfPage(basename(__DIR__)."/crop-marks.pdf");
		$pdf->download();	
	}

?>

<button type="submit" name="example1" class="btn btn-primary">Import Page</button>

