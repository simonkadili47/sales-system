<?php
include('fpdf17/fpdf.php');
include('include/databaseConnection.php');

if(isset($_POST['submitDate'])){

	$to_date = $_POST['to_date'];

	$from_date = $_POST['from_date'];}



	class PDF extends FPDF

	{

		function Header() {

			if(isset($_POST['submitDate'])){

				$to_date = strtotime($_POST['to_date']);

				$from_date = strtotime($_POST['from_date']);





			}



			$this -> SetFont('Arial','B',15);

			$this -> Cell(12);

			$this -> Image('pos-logo.png',10,10,10);

			$this -> Cell(100,10,'Sales Management System',0,1);



			$this -> SetFont('Arial','i',12);

			$this -> Cell(50,10,'Dar Es Salaam',0,0);

			$this -> Cell(50,5,' ',0,1);

			$this -> Cell(50,10,'Telephone Number: ',0,0);

			$this -> Cell(50,5,' ',0,1);

			$this -> Cell(50,10,'Email: salesshop@gmail.com',0,0);

			$this -> Cell(50,5,' ',0,1);





			$this -> Ln(5);



			$this -> SetFont('Arial','B',9);

			$this -> Cell(100,10,'SALE`S RECORDS '.date('l, jS F Y',$from_date).' to '.date('l, jS F Y',$to_date),0,1);



			$this -> SetFont('Arial','B',11);

			$this -> cell(5,5,'#',1,0);

			$this -> cell(15,5,'Date',1,0);

			$this -> cell(25,5,'Customer',1,0);

			$this -> cell(40,5,'Product',1,0);

			$this -> cell(15,5,'Cost',1,0);

			$this -> cell(15,5,'Price',1,0);

			$this -> cell(15,5,'Qty',1,0);

			$this -> cell(15,5,'Total',1,0);

			$this -> cell(15,5,'Profit',1,1);





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



	$pdf -> setFont('Arial','',7);


	$query=mysqli_query($conn, "
		select salesID, customerName, sellingPrice*quantitySold as totalAmount, sellingPrice, quantitySold, date,
		(select productName from products where products.productID = sales.productID) as productName,
		(select productionCost from products where products.productID = sales.productID) as productionCost
		from sales where date between '$from_date' and '$to_date'");

	$query_total=mysqli_query($conn, "
		select 
		sum(sellingPrice*quantitySold) as totalAmount,
		sum(amountPaid) as totalAmountPaid from sales where date between '$from_date' and '$to_date'");

	$total=mysqli_fetch_array($query_total);

	$count = 1;

	while($data=mysqli_fetch_array($query)){

		$pdf -> cell(5,5,$count,1,0);

		$pdf -> cell(15,5,$data['date'],1,0);

		$pdf -> cell(25,5,strtoupper($data['customerName']),1,0);

		$pdf -> cell(40,5,strtoupper($data['productName']),1,0);

		$pdf -> cell(15,5,number_format($data['productionCost'],0),1,0);

		$pdf -> cell(15,5,number_format($data['sellingPrice'],0),1,0);

		$pdf -> cell(15,5,number_format($data['quantitySold'],0),1,0);

		$pdf -> cell(15,5,number_format($data['totalAmount'],0),1,0);


		$pdf -> cell(15,5,number_format(($data['sellingPrice']-$data['productionCost'])*$data['quantitySold'],0),1,1);



		$count++;



	}

	$pdf -> Cell(50,5,' ',0,1);

	$pdf -> SetFont('Arial','B',11);

	$pdf -> cell(50,5,'Total Amount(Tshs)',0,0);

	$pdf -> cell(50,5,number_format($total[0],2),0,0);

	$pdf -> Cell(50,5,' ',0,1);

	$pdf -> cell(50,5,'Total Profit(Tshs)',0,0);

	$pdf -> cell(50,5,number_format($total[1],2),0,0);

	$pdf -> Cell(50,5,' ',0,1);

	$pdf -> Cell(50,5,' ',0,1);

	$pdf -> cell(50,5,'Attendant..............................       Signature..............................',0,0);

	$pdf -> Cell(50,5,' ',0,1);

	$pdf -> Cell(50,5,' ',0,1);

	$pdf -> cell(50,5,'Reciever:...............................    				 Signature:...............................',0,0);

	$pdf -> Output();

	?>
