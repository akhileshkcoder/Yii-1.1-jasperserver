<?php 
require_once(dirname(__FILE__) . '/client/JasperClient.php');
class YiiJasperserver extends CWidget
{
	public $parameter=array();
	public $path;
	public $format;
	public $page=null;
	public $out="I";
	public $file;
	
	private $mimetype=array(
            'html'=>'text/html',
            'pdf'=>'application/pdf',
            'xls'=>'application/vnd.ms-excel',
            'csv' => 'text/csv',
            'docx'=>'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'rtf' => 'text/rtf',
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            'xlsx' => 'application/vnd.ms-excel'
            );
	
	public function run()
	{
		$client = new Jasper\JasperClient('localhost', // Hostname
                   8080, // Port
                  'jasperadmin', // Username
                  'jasperadmin', // Password
                  '/jasperserver'); // Organization (pro only)
    
               
		$report = $client->runReport($this->path, $this->format,$this->page,$this->parameter);
		// The URI string could also be found from a resourceDescriptor object using the getUriString() method
 		header('Content-type: '.$this->mimetype[$this->format]);
                if($this->out=="I")
 		header('Content-Disposition: inline; filename="'.$this->file.'.'.$this->format.'"');
 		if($this->out=="D")
                header('Content-Disposition: attachment; filename="'.$this->file.'.'.$this->format.'"');
		echo $report;
	}
	
}

?>