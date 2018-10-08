<?php

class PdfController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->view->disable();
    }
    
    public function partsAction()
    {
        $this->view->disable();
        require('fpdf/fpdf.php');


        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(false);

        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(40,10,'Current Parts Inventory');

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'greenleaf';

        $conn = new mysqli($host, $username, $password, $database);
        $query_result = "SELECT * FROM PART order by partnumber";
        $result = $conn->query($query_result);


        $pdf->SetFillColor(170, 170, 170);
        $pdf->setFont("Arial","B","9");
        $pdf->setXY(10, 30); 
        $pdf->Cell(40, 10, "Part Number", 1, 0, "L", 1);  
        $pdf->Cell(40, 10, "Description", 1, 0, "L", 1);
        $pdf->Cell(30, 10, "Onhand", 1, 0, "L", 1);
        $pdf->Cell(30, 10, "Min", 1, 0, "L", 1); 
        $pdf->Cell(30, 10, "Max", 1, 0, "L", 1); 
 
        $y = 40;
        $x = 10;  

        $pdf->setXY($x, $y);

        $pdf->setFont("Arial","","9");

        while($row = $result->fetch_assoc())
        {
                $pdf->Cell(40, 8, $row['partnumber'], 1);   
                $pdf->Cell(40, 8, $row['description'], 1);
                $pdf->Cell(30, 8, $row['onhand'], 1);
                $pdf->Cell(30, 8, $row['min'], 1);
                $pdf->Cell(30, 8, $row['max'], 1);

                $y += 8;

                if ($y > 260)    
                {
                    $pdf->AddPage();
                    $y = 40;

                }

                $pdf->setXY($x, $y);
        }

        $pdf->Output();
    }
    
    public function nozzleAction()
    {
        $this->view->disable();
        require('fpdf/fpdf.php');


        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(false);

        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(40,10,'Nozzle Inventory');

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'greenleaf';

        $conn = new mysqli($host, $username, $password, $database);
        $query_result = "SELECT * FROM NOZZLE order by partnumber";
        $result = $conn->query($query_result);


        $pdf->SetFillColor(170, 170, 170);
        $pdf->setFont("Arial","B","9");
        $pdf->setXY(10, 30); 
        $pdf->Cell(40, 10, "Part Number", 1, 0, "L", 1);  
        $pdf->Cell(40, 10, "Description", 1, 0, "L", 1);
        $pdf->Cell(30, 10, "Onhand", 1, 0, "L", 1);
        $pdf->Cell(30, 10, "Min", 1, 0, "L", 1); 
        $pdf->Cell(30, 10, "Max", 1, 0, "L", 1); 
 
        $y = 40;
        $x = 10;  

        $pdf->setXY($x, $y);

        $pdf->setFont("Arial","","9");

        while($row = $result->fetch_assoc())
        {
                $pdf->Cell(40, 8, $row['partnumber'], 1);   
                $pdf->Cell(40, 8, $row['description'], 1);
                $pdf->Cell(30, 8, $row['onhand'], 1);
                $pdf->Cell(30, 8, $row['min'], 1);
                $pdf->Cell(30, 8, $row['max'], 1);

                $y += 8;

                if ($y > 260)    
                {
                    $pdf->AddPage();
                    $y = 40;

                }

                $pdf->setXY($x, $y);
        }

        $pdf->Output();
    }
    /*
    public function customerAction()
    {
        $this->view->disable();
        require('fpdf/fpdf.php');


        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(false);

        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(40,10,'Parts Inventory');

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'greenleaf';

        $conn = new mysqli($host, $username, $password, $database);
        $query_result = "SELECT * FROM PART";
        $result = $conn->query($query_result);


        $pdf->SetFillColor(170, 170, 170);
        $pdf->setFont("Arial","B","9");
        $pdf->setXY(10, 30); 
        $pdf->Cell(40, 10, "Part Number", 1, 0, "L", 1);  
        $pdf->Cell(40, 10, "Description", 1, 0, "L", 1);
        $pdf->Cell(30, 10, "Onhand", 1, 0, "L", 1);
        $pdf->Cell(30, 10, "Min", 1, 0, "L", 1); 
        $pdf->Cell(30, 10, "Max", 1, 0, "L", 1); 
 
        $y = 40;
        $x = 10;  

        $pdf->setXY($x, $y);

        $pdf->setFont("Arial","","9");

        while($row = $result->fetch_assoc())
        {
                $pdf->Cell(40, 8, $row['partnumber'], 1);   
                $pdf->Cell(40, 8, $row['description'], 1);
                $pdf->Cell(30, 8, $row['onhand'], 1);
                $pdf->Cell(30, 8, $row['min'], 1);
                $pdf->Cell(30, 8, $row['max'], 1);

                $y += 8;

                if ($y > 260)    
                {
                    $pdf->AddPage();
                    $y = 40;

                }

                $pdf->setXY($x, $y);
        }

        $pdf->Output();
    }
    
    public function partsBySalesAction()
    {
        $this->view->disable();
        require('fpdf/fpdf.php');


        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(false);

        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(40,10,'Parts Inventory');

        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'greenleaf';

        $conn = new mysqli($host, $username, $password, $database);
        $query_result = "SELECT * FROM PART";
        $result = $conn->query($query_result);


        $pdf->SetFillColor(170, 170, 170);
        $pdf->setFont("Arial","B","9");
        $pdf->setXY(10, 30); 
        $pdf->Cell(40, 10, "Part Number", 1, 0, "L", 1);  
        $pdf->Cell(40, 10, "Description", 1, 0, "L", 1);
        $pdf->Cell(30, 10, "Onhand", 1, 0, "L", 1);
        $pdf->Cell(30, 10, "Min", 1, 0, "L", 1); 
        $pdf->Cell(30, 10, "Max", 1, 0, "L", 1); 
 
        $y = 40;
        $x = 10;  

        $pdf->setXY($x, $y);

        $pdf->setFont("Arial","","9");

        while($row = $result->fetch_assoc())
        {
                $pdf->Cell(40, 8, $row['partnumber'], 1);   
                $pdf->Cell(40, 8, $row['description'], 1);
                $pdf->Cell(30, 8, $row['onhand'], 1);
                $pdf->Cell(30, 8, $row['min'], 1);
                $pdf->Cell(30, 8, $row['max'], 1);

                $y += 8;

                if ($y > 260)    
                {
                    $pdf->AddPage();
                    $y = 40;

                }

                $pdf->setXY($x, $y);
        }

        $pdf->Output();
    }
    */
}

