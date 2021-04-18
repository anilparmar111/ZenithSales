<?php include 'required.php';?>
<?php



require_once 'Classes/PHPExcel.php';

// main for our excel sheet
//database connection (using mysqli)
$databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
$databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class Lazer_data
    {
        public $billno="-";
        public $comp_name;
        public $ddate="-";
        public $cdate="-";
        public $compdate;
        public $amount;
    }
	$arr=array();


if(isset($POST['cname']))
{
	
    error_reporting(0);
    try 
    {
        $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
        $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="select * from payment_status  WHERE pdate>=? and  pdate<=? and compname=? and party=?";			
        $result = $databasehandler->prepare($sql);
        $result->execute([$_GET['sdate'],$_GET['edate'],$_GET['cname'], $_SESSION['party']]);
        foreach ($result as $row) 
        {
            $dt=new Lazer_data();
            $dt->billno=$row['billid'];
            $dt->amount=$row['payment'];
            $dt->comp_name=$row['compname'];
            $dt->ddate=$row['pdate'];
            $dt->compdate=$row['pdate'];
            array_push($arr,$dt);
        }
        $sql="select * from payment_rec  WHERE rdate>=? and  rdate<=? and comp_name=? and party=?";			
        $result = $databasehandler->prepare($sql);
        $result->execute([$_GET['sdate'],$_GET['edate'],$_GET['cname'], $_SESSION['party']]);
        foreach ($result as $row) 
        {
            $dt=new Lazer_data();
            $dt->billno="-";
            $dt->amount=$row['amount'];
            $dt->comp_name=$row['comp_name'];
            $dt->cdate=$row['rdate'];
            $dt->compdate=$row['rdate'];
            array_push($arr,$dt);
        }
    }
    catch (PDOException $e) 
    {
        echo $e->getMessage();
        die();
    }
}
else
{
	try 
    {
        $databasehandler = new PDO('mysql:host=127.0.0.1;dbname=zenithsales','zenithsales');
        $databasehandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="select * from payment_status  WHERE pdate>=? and  pdate<=? and party=?";			
        $result = $databasehandler->prepare($sql);
        $result->execute([$_GET['sdate'],$_GET['edate'], $_SESSION['party']]);
        foreach ($result as $row) 
        {
            $dt=new Lazer_data();
            $dt->billno=$row['billid'];
            $dt->amount=$row['payment'];
            $dt->comp_name=$row['compname'];
            $dt->ddate=$row['pdate'];
            $dt->compdate=$row['pdate'];
            array_push($arr,$dt);
        }
        $sql="select * from payment_rec  WHERE rdate>=? and  rdate<=? and party=?";			
        $result = $databasehandler->prepare($sql);
        $result->execute([$_GET['sdate'],$_GET['edate'], $_SESSION['party']]);
        foreach ($result as $row) 
        {
            $dt=new Lazer_data();
            $dt->billno="-";
            $dt->amount=$row['amount'];
            $dt->comp_name=$row['comp_name'];
            $dt->cdate=$row['rdate'];
            $dt->compdate=$row['rdate'];
            array_push($arr,$dt);
        }
        print_r($a);
    }
    catch (PDOException $e) 
    {
        echo $e->getMessage();
        die();
    }
}

function cmp($x, $y) {
    if(strtotime($x->compdate) == strtotime($y->compdate))
    {
        return $x->billno > $y->billno;
    }
    return strtotime($x->compdate) - strtotime($y->compdate);
}
usort($arr, "cmp");
        
//create PHPExcel object
$excel = new PHPExcel();

//selecting active sheet
$excel->setActiveSheetIndex(0);

//populate the data
$row = 4;


$i=1;
foreach ($arr as $key=>$entry) 
{
        $amount=$entry->amount;
        if($entry->ddate=='-')
        {
            $amount=$amount*(-1);
        }
		if($entry->ddate!='-')
        {
            $ed = date("d/m/Y", strtotime($entry->ddate));
        }
        else
        {
            $ed="-";
        }
        if($entry->cdate!='-')
        {
            $ec = date("d/m/Y", strtotime($entry->cdate));
        }
        else
        {
            $ec="-";
        }
		$excel->getActiveSheet()
		->setCellValue('A'.$row , $entry->billno)
		->setCellValue('B'.$row , $entry->comp_name)
		->setCellValue('C'.$row , $ed)
		->setCellValue('D'.$row , $ec)
		->setCellValue('E'.$row , $amount);

	//increment the row
	$row++;

}

//set column width
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

//make table headers
$party="";
if($_SESSION["party"]=='zs')
{
	$party="Zenithsales";
}
else
{
	$party="Mansales";
}

$excel->getActiveSheet()
	 ->setCellValue('A1' , $party) //this is a title
	->setCellValue('A3' , 'Bill NO')
	->setCellValue('B3' , 'Compnay Name')
	->setCellValue('C3' , 'Debit Date')
	->setCellValue('D3' , 'Credit Date')
	->setCellValue('E3' , 'Amount');

//merging the title
$excel->getActiveSheet()->mergeCells('A1:E1');

//aligning
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');

//styling
$excel->getActiveSheet()->getStyle('A1')->applyFromArray(
	array(
		'font'=>array(
			'size' => 24,
		)
	)
);
$excel->getActiveSheet()->getStyle('A3:E3')->applyFromArray(
	array(
		'font' => array(
			'bold'=>true
		),
		'borders' => array(
			'allborders' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);
//give borders to data
$excel->getActiveSheet()->getStyle('A4:E'.($row-1))->applyFromArray(
	array(
		'borders' => array(
			'outline' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			),
			'vertical' => array(
				'style' => PHPExcel_Style_Border::BORDER_THIN
			)
		)
	)
);


//redirect to browser (download) instead of saving the result as a file
//this is for MS Office Excel xls format
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="test.xlsx"');
header('Cache-Control: max-age=0');

//write the result to a file
$file = PHPExcel_IOFactory::createWriter($excel,'Excel2007');
//output to php output instead of filename
$file->save('php://output');

?>

