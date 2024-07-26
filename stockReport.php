<?php

include('fpdf17/fpdf.php');


include('include/databaseConnection.php');

if(isset($_POST['submit'])){


$to_date = $_POST['to_date'];

$from_date = $_POST['from_date'];

}





class PDF extends FPDF{

	function Header() {

	if(isset($_POST['submit'])){

  	$to_date = strtotime($_POST['to_date']);

    $from_date = strtotime($_POST['from_date']);


}



		$this -> SetFont('Arial','B',15);

		$this -> Cell(12);

		$this -> Image('pos-logo.png',10,10,10);

		$this -> Cell(100,10,'Sales Management System',0,1);

		$this -> SetFont('Arial','i',12);

		$this -> Cell(50,10,'Dar Es Salaam Tanzania ',0,0);

		$this -> Cell(50,5,' ',0,1);

		$this -> Cell(50,10,'Telephone Number:',0,0);

		$this -> Cell(50,5,' ',0,1);

		$this -> Cell(50,10,'Email: ',0,0);

		$this -> Cell(50,5,' ',0,1);



		$this -> Ln(5);

		$this -> SetFont('Arial','B',11);
		$this -> Cell(100,10,'Products STOCKED ON: '.date('l, jS F Y',$from_date).' to '.date('l, jS F Y',$to_date),0,1);

		$this -> SetFont('Arial','B',11);

		$this -> cell(60,5,'#',1,0);
		
		$this -> cell(60,5,'Product Name',1,0);

		$this -> cell(60,5,'Quantity Stocked',1,1);

	}

	function Footer(){

		$this -> SetY(-15);

		$this -> SetFont('Arial','',8);

		$this -> Cell(0,10,'Page'.$this ->PageNo()."/{pages}",0,0,'C');
	}

}

	$pdf = new PDF('P','mm','A4');

	$pdf -> AliasNbPages ('{pages}');

	$pdf -> AddPage();



 	$pdf -> setFont('Arial','',9);





   $query=mysqli_query($conn, "select productName, sum(quantityStocked) from products

   inner join stock on stock.productID=products.productID where restockDate between  '$from_date' and '$to_date' group by products.productID;");


$count = 1;

	while($data=mysqli_fetch_array($query)){

		$pdf -> cell(60,5,$count,1,0);
		$pdf -> cell(60,5,strtoupper($data['productName']),1,0);

		$pdf -> cell(60,5,number_format($data['sum(quantityStocked)']),1,1);

		$count++;

	}



	$pdf -> Output();

?>

