<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dompdf_gen {
		
	public function __construct() {
		
		require_once APPPATH. 'libraries/dompdf/dompdf_config.inc.php';
		
		$pdf = new DOMPDF();
		
		$CI =& get_instance();
		$CI->dompdf = $pdf;
		
	}
	public function generate($html, $filename, $stream=TRUE)
  {
    define('DOMPDF_ENABLE_AUTOLOAD', false);
    require_once("./vendor/dompdf/dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF('L', 'A4');
    $dompdf->load_html($html);
    $dompdf->set_paper('a4', 'landscape');
    $dompdf->render();
    ob_end_clean();
    $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
    exit;
  }
	
}