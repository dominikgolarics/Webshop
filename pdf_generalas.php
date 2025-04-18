<?php
require('fpdf/fpdf.php');

class ReceiptGenerator extends FPDF {
    private $orderData;
    private $companyInfo;
    
    public function __construct($orderData, $companyInfo) {
        parent::__construct();
        $this->orderData = $orderData;
        $this->companyInfo = $companyInfo;
        
    }
    
    // UTF-8 to Hungarian character conversion
    private function utftohun($string) {
        return iconv('UTF-8', 'ISO-8859-2//TRANSLIT', $string);
    }
    
    function Header() {
        // Set font and output company info
        $this->SetFont('Arial','B',16);
        $this->Cell(0,10,$this->utftohun($this->companyInfo['name']),0,1,'C');
        
        $this->SetFont('Arial','',10);
        $this->Cell(0,5,$this->utftohun($this->companyInfo['address']),0,1,'C');
        $this->Cell(0,5,$this->utftohun($this->companyInfo['phone'].' | '.$this->companyInfo['email']),0,1,'C');
        $this->Ln(10);
        
        // Order information
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,$this->utftohun('Nyugta #'.$this->orderData['order_id']),0,1,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(0,5,$this->utftohun('Dátum: '.$this->orderData['order_date']),0,1,'L');
        $this->Ln(5);
    }
    
    function CustomerInfo() {
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,$this->utftohun('Vásárlói adatok'),0,1,'L');
        
        $this->SetFont('Arial','',10);
        $this->Cell(0,5,$this->utftohun($this->orderData['customer']['name']),0,1,'L');
        $this->Cell(0,5,$this->utftohun($this->orderData['customer']['email']),0,1,'L');
        $this->Cell(0,5,$this->utftohun($this->orderData['customer']['phone']),0,1,'L');
        $this->Cell(0,5,$this->utftohun($this->orderData['customer']['address']),0,1,'L');
        $this->Ln(10);
    }
    
    function OrderItems() {
        // Table header
        $this->SetFont('Arial','B',10);
        $this->Cell(100,7,$this->utftohun('Termék'),1,0);
        $this->Cell(30,7,$this->utftohun('Ár'),1,0,'R');
        $this->Cell(20,7,$this->utftohun('Mennyiség'),1,0,'C');
        $this->Cell(30,7,$this->utftohun('Összesen'),1,1,'R');
        
        // Table data
        $this->SetFont('Arial','',10);
        foreach($this->orderData['items'] as $item) {
            $this->Cell(100,7,$this->utftohun($item['name']),1,0);
            $this->Cell(30,7,number_format($item['price'],2).' Ft',1,0,'R');
            $this->Cell(20,7,$item['quantity'],1,0,'C');
            $this->Cell(30,7,number_format($item['price']*$item['quantity'],2).' Ft',1,1,'R');
        }
        
        // Order summary
        $this->SetFont('Arial','B',10);
        $this->Cell(150,7,$this->utftohun('Részösszeg:'),0,0,'R');
        $this->Cell(30,7,number_format($this->orderData['subtotal'],2).' Ft',1,1,'R');
        
        if($this->orderData['shipping'] > 0) {
            $this->Cell(150,7,$this->utftohun('Szállítás:'),0,0,'R');
            $this->Cell(30,7,number_format($this->orderData['shipping'],2).' Ft',1,1,'R');
        }
        
        if($this->orderData['discount'] > 0) {
            $this->Cell(150,7,$this->utftohun('Kedvezmény:'),0,0,'R');
            $this->Cell(30,7,'-'.number_format($this->orderData['discount'],2).' Ft',1,1,'R');
        }
        
        $this->Cell(150,7,$this->utftohun('Végösszeg:'),0,0,'R');
        $this->Cell(30,7,number_format($this->orderData['total'],2).' Ft',1,1,'R');
        $this->Ln(10);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,$this->utftohun('Köszönjük a vásárlást!'),0,0,'C');
    }
    
    public function generate() {
        $this->AddPage();
        $this->CustomerInfo();
        $this->OrderItems();
        return $this->Output('S');
    }
}
?>