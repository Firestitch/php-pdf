<?	
	namespace Firestitch;

	use setasign\Fpdi\Tcpdf\Fpdi;

	class PdfRenderer extends Fpdi {
		
		public function download($filename="") {
			$filename = $filename ? $filename : "download.pdf";
			$this->Output($filename,"D");
		}	
		
		public function save($pdfFile) {
			$this->Output($pdfFile,"F");
			return is_file($pdfFile);
		}

		public function Pdf($pdfFile, $pageNumber, $x=null, $y=null, $width=null, $height=null) {

			$this->setSourceFile($pdfFile);

			$handler = $this->importPage($pageNumber);

			if($handler) {

				$width 	= $width ? round($width) : null;
				$height = $height ? round($height) : null;
				$x 	= $x ? round($x) : null;
				$y 	= $y ? round($y) : null;

				$this->useTemplate($handler, $x, $y, $width, $height);
			}
		}

		public function addPdfPage($pdfFile,$options=[]) {

			$pageNumber 	= value($options,"pageNumber",1);
			$rotate 		= value($options,"rotate",0);

			$this->setSourceFile($pdfFile);
			$handler = $this->importPage($pageNumber,"/CropBox");

			$size = $this->getTemplateSize($handler);

			if($size && $handler) {

				$width 	= value($size,"width");
				$height	= value($size,"height");

				$orientation = $width>$height ? "L" : "P";

				$pageFormat = [
									"MediaBox" => ["llx" => 0, "lly" => 0, "urx" => $width, "ury" => $height],
									"CropBox" => ["llx" => 0, "lly" => 0, "urx" => $width, "ury" => $height],
									"Rotate"=>$rotate 
								];
				$this->AddPage($orientation, $pageFormat);
				$this->Pdf($pdfFile, $pageNumber, 0, 0, $width, $height);
			}
		}
	}
