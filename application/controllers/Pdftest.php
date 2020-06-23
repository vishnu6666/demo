<?php 
class Pdftest extends CI_Controller{
      function __construct() { 
 parent::__construct();
 } 

 	public function generatePDF(){
 		$this->load->library('Pdf');
 		$pdf = new pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nilesh Zemse');
		$pdf->SetTitle('Invoice');
		$pdf->SetSubject('Invoice');
		$pdf->SetKeywords('PDF, Invoice');


		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		//set some language-dependent strings
		// $pdf->setLanguageArray($l);

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('times', '', 15); 
		// *** Very IMP: Please use times font, so that if you send this pdf file in gmail as attachment and if user
		//opens it in google document, then all the text within the pdf would be visible properly.

		// add a page
		$pdf->AddPage();

		// create some HTML content
		$now = date("j F, Y");
		$company_name = 'ABC test company';

		$user_name = 'Mr. Lorel Ispum';
		$invoice_ref_id = '2013/12/03/0001';

		// *** IMP: The value of $html and $html_terms can come from db
		// But, If these values contain, other language special characters, then
		// PDF is not getting generated. in that case should find such invalid charactes and 
		// make use of its htmlentity substitute 
		// for ex. If copyright is invalid character then use &copy; in html content


		// $html on page 1 of PDF and $html_terms are on page 2 of PDF


		$html = '';
		$html .= '<table cellpadding="5">
		            <tr>
		                <td colspan="2" align="center"><u><h1>Invoice</b></h1></td>
		            </tr>
		            <tr>
		                <td colspan="2" align="right"><u>{now}</u></td>
		            </tr>
		            <tr>
		                <td>Dear {user_name},<br>here is your invoice.</td>
		            </tr>
		         </table>';

		$html .= '<br><br>
		          <table border="1" cellpadding="5">
		            <tr>
		                <td colspan="3">Invoice # {invoice_ref_id}</td>            
		            </tr>
		            <tr>
		                <td><b>Product</b></td>
		                <td><b>Quantity</b></td>
		                <td align="right"><b>Amount (Rs.)</b></td>
		            </tr>
		            <tr>
		                <td>Product 1</td>
		                <td>30</td>
		                <td align="right">300</td>
		            </tr>
		            <tr>
		                <td>Product 2</td>
		                <td>15</td>
		                <td align="right">75</td>
		            </tr>
		            <tr>
		                <td colspan="3" align="right"><b>Total: 375</b></td>
		            </tr>
		         </table>';

		$html .= '<br><br>Some more text can come here...';

		$html = str_replace('{now}',$now, $html);
		$html = str_replace('{company_name}',$company_name, $html);
		$html = str_replace('{user_name}',$user_name, $html);
		$html = str_replace('{invoice_ref_id}',$invoice_ref_id, $html);


		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		// add a page
		$pdf->AddPage();

		$html_terms = '
		        <table>
		            <tr>
		                <td colspan="2"><u><b>Terms & Conditions</b></u></td>
		            </tr>
		            
		            <tr>
		                <td colspan="2" align="right">
		                <ul>
		                    <li>Point one</li>
		                    <li>Point two</li>
		                    <li>Point three</li>
		                    <li>Point four</li>
		                    <li>Point five</li>
		                    <li>Point six</li>
		                    <li>Point seven</li>
		                    <li>Point eight</li>
		                    <li>Point nine</li>
		                    <li>Point ten</li>
		                </ul>
		                </td>
		            </tr>

		        </table>
		        ';
		// output the HTML content
		$pdf->writeHTML($html_terms, true, false, true, false, '');

		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

		// reset pointer to the last page
		$pdf->lastPage();

		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf_file_name = 'custom_header_footer.pdf';
		$pdf->Output($pdf_file_name, 'I');
    }

    public function index()
 	{
 		$test ='uuuuuuu';
 		ob_start();
		$this->load->library('Pdf');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('Your tickets');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		//$pdf->SetFont('dejavusans', '', 10);


	// add a page
		$pdf->AddPage();


		// set style for barcode
		$style = array(
		    'border' => 0,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);

		// QRCODE,L : QR-CODE Low error correction
		$pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,R', 20, 30, 50, 50, $style, 'N');

		// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
		// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
		$html = '<table  cellspacing="3" cellpadding="4" style="border: 1px red solid;">
		    <tr><td width="15%">' . $test . '</td>
		    <td width="70%">
			    <table border="0" >
			    	<tr><td>Almanac Brewery Tour</td></tr>
			    	<tr><td ><font size="8px">Sat, Feb 22 2020 12:30pm - Sat, Feb 22 2020 1:30pm<br>651 W Tower Ave, Alameda, CA 94501, USA</font></td></tr>
			    	<tr><td><font align="left">Nimit Parekh </font><font align="right">Nimit Parekh </font></td>
			    	</tr>
				</table>
			</td><td width="15%"> Barcod</td></tr>
			</table>';

		$pdf->writeHTML($html, true, false, true, false, '');

		

		$html = '<font size="10px"><b>Event Note</b></font>';
		$pdf->writeHTML($html, true, false, true, false, '');

		$html = '<font size="8px">We can t wait to show you around! Just remember those close-toed shoes :)</font>';
		$pdf->writeHTML($html, true, false, true, false, '');


		// add a page
		$pdf->AddPage();
		// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
		// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
		$html = '<table border="1" cellspacing="3" cellpadding="4">
		    <tr><td width="15%">Image</td>
		    <td width="70%">
			    <table border="0" >
			    	<tr><td>Almanac Brewery Tour</td></tr>
			    	<tr><td ><font size="8px">Sat, Feb 22 2020 12:30pm - Sat, Feb 22 2020 1:30pm<br>651 W Tower Ave, Alameda, CA 94501, USA</font></td></tr>
			    	<tr><td><font align="left">Nimit Parekh </font><font align="right">Nimit Parekh </font></td>
			    	</tr>
				</table>
			</td><td width="15%"> Barcod</td></tr>
			</table>';

		$pdf->writeHTML($html, true, false, true, false, '');

		

		$html = '<font size="10px"><b>Event Note</b></font>';
		$pdf->writeHTML($html, true, false, true, false, '');

		$html = '<font size="8px">We can t wait to show you around! Just remember those close-toed shoes :)</font>';
		$pdf->writeHTML($html, true, false, true, false, '');

		// add a page
		$pdf->AddPage();

		$html = '<h2>Your order receipt</h2><table border="1" cellspacing="3" cellpadding="4"><tr><th colspan="2">Order details</th></tr>

		    <tr><td width="20%">Buyer</td><td width="80%">Nimit Parekh</td></tr>
		    
		    <tr><td>Event</td><td>Almanac Brewery Tour</td></tr>
		    
		    <tr><td>Location</td><td >651 W Tower Ave, Alameda, CA 94501, USA</td></tr>
		    
		    <tr><td>Date</td><td>Sat, Feb 22 2020 12:30pm - Sat, Feb 22 2020 1:30pm</td></tr>

		</table>';

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');


		$html = '<table border="1" cellspacing="3" cellpadding="4"><tr><th colspan="4">Payment Information</th></tr>

		    <tr><td width="55%">Items</td><td width="15%">Unit price</td><td width="10%">Quantity</td><td width="20%">Total</td></tr>
		    
		    <tr><td width="55%">Brewery Tour Reservation</td><td width="15%">Free</td><td width="10%">2</td><td width="20%">$0.00 USD</td></tr>

		    <tr><td width="55%">Service charge</td><td width="15%"> </td><td width="10%"></td><td width="20%">Free</td></tr>

		    <tr><td width="55%">Free</td><td width="15%"></td><td width="10%"></td><td width="20%">Free</td></tr>
		    
		</table>';

		$pdf->writeHTML($html, true, false, true, false, '');


		$html = '<font size="10px">Reference ID: 5e396bffccd2be00353de2ab<br>
		We have sent you a confirmation email to nimit51parekh@gmail.com </font>';
		$pdf->writeHTML($html, true, false, true, false, '');

		ob_clean();
        // $filename= rand(00000000000,99999999999).'vishnum.pdf'; 
        // $filelocation = "D:/wamp/www/ci/assets/uploads";//windows
        // //$filelocation = "/var/www/project/custom"; //Linux
        // $fileNL = $filelocation."/".$filename;//Windows
        // //$fileNL = $filelocation."/".$filename; //Linux
        // $pdf->Output($fileNL,'F');

        $pdf->Output($html,'I');
    }

    public function pdf()
    {
    	$image_file = 'D:/wamp/www/ci/assets/uploads/event.jpg'; // *** Very IMP: make sure this image is available on given path on your server
        $pdf->Image($image_file,15,30,30);
    }

    function csv(){
        $data[] = array('f_name'=> "Vishnu", 'l_name'=> "Prajapati", 'mobile'=> "7777777777", 'gender'=> "male");
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"test".".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');
        fputcsv($handle, array("No","First Name","Last Name","mobile","gender"));
        $cnt=1;
        foreach ($data as $key) {
            $narray=array($cnt,$key["f_name"],$key["l_name"],$key["mobile"],$key["gender"]);
            fputcsv($handle, $narray);
        }
            fclose($handle);
        exit;
    }
}
?>