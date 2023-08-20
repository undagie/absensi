<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf extends DOMPDF
{
	protected function ci()
	{
		return get_instance();
	}

	public function create()
	{
		return new Dompdf();
	}
}
