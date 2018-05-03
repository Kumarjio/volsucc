<?php 

	$DIR_CONST = '';
	if (defined('__DIR__'))
		$DIR_CONST = __DIR__;
	else
		$DIR_CONST = dirname(__FILE__);

	require_once($DIR_CONST . '/external/tcpdf/tcpdf.php');

 	/**
	 * Simplejobscript Copyright (©) 2016 Niteosoft
	 * <support@niteosoft.co.uk>
	 *
	 * @author     Niteosoft (niteosoft.co.uk)
	 * @license    Proprietary software license
	 * @website    simplejobscript.com
	 * 
	 * OFFICIAL PAYPAL PLUGIN
	 */

	class MYPDF extends TCPDF {

		const FONT_SIZE_BASIC = 10;
		const FONT_SIZE_BIGGER = 11;
		const PADDING_X = 0;
		const PADDING_Y = 10;
		private static $FOOTER_DESC = '';
		private static $_tr = array();

	public static function generateInvoice($invoice_id, $invoice_data, $orders, $translations, $invoice_fname, $total, $priceBeforeVAT) {
		$pdf = new self(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		self::$_tr = $translations;
		self::$FOOTER_DESC = $translations['invoice']['footer_txt'];
	 	
		// set document (meta) information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor(SITE_NAME);
		$pdf->SetTitle(SITE_NAME . ' invoice');
		$pdf->SetSubject(SITE_NAME . ' invoice');
		$pdf->SetKeywords(SITE_NAME . ', invoice');
		 
		//add a page
		$pdf->AddPage();

		// create address box
		$yBase = 30;
		$pdf->CreateTextBox($translations['invoice']['invoice_to_txt'], 0, $yBase, self::PADDING_X, 0, self::FONT_SIZE_BIGGER, 'B');
		$pdf->CreateTextBox($invoice_data['name'], 0, $yBase+5, self::PADDING_X, self::PADDING_Y, self::FONT_SIZE_BASIC);
		$pdf->CreateTextBox($invoice_data['Addr1'], 0, $yBase+10, self::PADDING_X, self::PADDING_Y, self::FONT_SIZE_BASIC);
		$pdf->CreateTextBox($invoice_data['Addr2'], 0, $yBase+15, self::PADDING_X, self::PADDING_Y, self::FONT_SIZE_BASIC);
		 
		// invoice title / number
		$pdf->CreateTextBox($invoice_id, 0, 90, 120, 20, 16);
		$pdf->CreateTextBox($translations['invoice']['service_desc'], 0, 120, 90, 10, 10, 'B');
		$pdf->CreateTextBox($translations['invoice']['amount'], 110, 120, 30, 10, 10, 'B', 'R');
		$pdf->CreateTextBox($translations['invoice']['price'], 140, 120, 30, 10, 10, 'B', 'R');
		 
		$pdf->Line(20, 129, 195, 129);
		 
		$currY = 128;
		foreach ($orders as $row) {
			$amount = 1;
			$pdf->CreateTextBox($row['desc'], 0, $currY, 90, 10, 10, '');
			$pdf->CreateTextBox($amount, 110, $currY, 30, 10, 10, '', 'R');
			$pdf->CreateTextBox(format_currency(WEBSITE_CURRENCY, $row['price']), 140, $currY, 30, 10, 10, '', 'R');

			$currY = $currY+5;
			$total = $total;
		}

		$pdf->Line(20, $currY+4, 195, $currY+4);

		if (VAT_KOEFICIENT != 0) { 
			$pdf->CreateTextBox($translations['post_step2']['vat'], 20, $currY+5, 135, 10, 10, '', 'R');
			$pdf->CreateTextBox(format_currency(WEBSITE_CURRENCY, number_format($priceBeforeVAT, 2, '.', '')), 140, $currY+5, 30, 10, 10, '', 'R');
			$currY = $currY+5;
		}

		// output the total row
		$pdf->CreateTextBox($translations['invoice']['total'] . ":", 20, $currY+5, 135, 10, 10, 'B', 'R');
		$pdf->CreateTextBox(format_currency(WEBSITE_CURRENCY, number_format($total, 2, '.', '')), 140, $currY+5, 30, 10, 10, 'B', 'R');
		 
		// some payment instructions or information
		$pdf->setXY(20, $currY+30);
		$pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
		$pdf->MultiCell(175, 10, '<em>' . $translations['invoice']['invoice_additional_txt'], 0, 'L', 0, 1, '', '', true, null, true);

		$file = PATH_PREFIX . INVOICES_UPLOAD_FOLDER . $invoice_fname . '.pdf';
		$pdf->Output($file, 'F');
		chmod($file, 0777);
	}

	public function Header() {

		// BUSINESS LOGO

		$this->setJPEGQuality(99);
		$this->Image(PROTOCOL . MAIN_URL . INVOICE_LOGO_PATH, 130, 12, 70, 0, INVOICE_LOGO_EXT, INVOICE_LOGO_LINK);
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// calculate the Y offset from top

		$ILH = intval(INVOICE_LOGO_H);

		if ($ILH < 51)
			$yBase = $ILH;
		else if ($ILH > 50 && $ILH < 76)
			$yBase = $ILH;
		else if ($ILH > 75 && $ILH < 101)
			$yBase = $ILH - 50;
		else if ($ILH > 100 && $ILH < 151)
			$yBase = ($ILH - 50) * 0.75;
		else
			$yBase = ($ILH - 50) * 0.9;

		// BUSINESS ADDRESS

		$this->CreateTextBox(INVOICE_ADDRESS_FIRST_PART, 0, $yBase, 0, 0, self::FONT_SIZE_BASIC, '', 'R');
		$this->CreateTextBox(INVOICE_ADDRESS_SECOND_PART, 0, $yBase+5, 0, 0, self::FONT_SIZE_BASIC, '', 'R');
		$this->CreateTextBox(INVOICE_ADDRESS_POSTCODE, 0, $yBase+10, 0, 0, self::FONT_SIZE_BASIC, '', 'R');

		// BUSINESS CONTACT

		$yBase += 18;
		$this->SetTextColor(57, 182, 179);
		$this->CreateTextBox(self::$_tr['invoice']['contact'], 0, $yBase, 0, 0, self::FONT_SIZE_BASIC, 'B', 'R');
		$this->SetTextColor(0,0,0);
		$this->CreateTextBox(INVOICE_CONTACT_PHONE, 0, $yBase+6, 0, 0, self::FONT_SIZE_BASIC, '', 'R');
		$this->CreateTextBox(INVOICE_CONTACT_EMAIL, 0, $yBase+11, 0, 0, self::FONT_SIZE_BASIC, '', 'R');

		// DATE
		$yBase += 16;

		$this->SetTextColor(57, 182, 179);
		$this->CreateTextBox(self::$_tr['invoice']['date'], 0, $yBase + 2, 0, 0, self::FONT_SIZE_BASIC, 'B', 'R');
		$this->SetTextColor(0,0,0);
		$this->CreateTextBox(date('d/m/Y'), 0, $yBase + 7, 0, 0, self::FONT_SIZE_BASIC, '', 'R');
	}
	public function Footer() {
		$this->SetY(-15);
		$this->SetFont(PDF_FONT_NAME_MAIN, 'I', 8);
		$this->Cell(0, 10, self::$FOOTER_DESC, 0, false, 'C');
	}
	public function CreateTextBox($textval, $x = 0, $y, $width = 0, $height = 10, $fontsize = 10, $fontstyle = '', $align = 'L') {
		$this->SetXY($x+20, $y); // 20 = margin left
		$this->SetFont(PDF_FONT_NAME_MAIN, $fontstyle, $fontsize);
		$this->Cell($width, $height, $textval, 0, false, $align);
	}
}

?>
