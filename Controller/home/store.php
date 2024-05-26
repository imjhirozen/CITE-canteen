<?php

$currentDateTime = date('Ymd-H-i-s');
$conn = new Database( config() );
$receipt = json_decode($_POST['receipt'], true);


try {

    $conn->query("INSERT INTO receipts (casher_name, receipt_created, user_id) values(:casher_name, :receipt_created, :user_id)", [
        "casher_name" => $_SESSION['fullName'],
        "receipt_created" => $currentDateTime . ".pdf",
        "user_id" => $_SESSION['user_id']
    ]);

    createPDF("resibo/{$currentDateTime}.pdf", $receipt, $_POST['customer_pay'], $_SESSION['fullName'], $_SESSION['role']);

}catch (Exception $e) {
    echo $e;

}

redirect('/');

function createPDF($file, $products, $customerPaymentAmount, $cashier = 'RANIELO L SULTONES', $role = 'cashier') {
    // PDF header
    $pdf  = "%PDF-1.3\n";
    $pdf .= "1 0 obj\n";
    $pdf .= "<< /Type /Catalog /Pages 2 0 R >>\n";
    $pdf .= "endobj\n";
    $pdf .= "2 0 obj\n";
    $pdf .= "<< /Type /Pages /Kids [3 0 R] /Count 1 >>\n";
    $pdf .= "endobj\n";
    $pdf .= "3 0 obj\n";
    $pdf .= "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Contents 4 0 R /Resources << >> >>\n";
    $pdf .= "endobj\n";

    // PDF content (product details)
    $content = "BT /F1 24 Tf 100 750 Td (Receipt) Tj ET\n";
    $yPos = 700; // Starting position for products
    $total = 0;  // Initialize total

    foreach ($products as $product) {
        $productName = $product['product_name'];
        $productQuantity = $product['product_quantity'];
        $productTotalPrice = $product['product_total_price'];
        $content .= "BT /F1 12 Tf 100 $yPos Td ($productQuantity x $productName - Total: $productTotalPrice) Tj ET\n";
        $yPos -= 20; // Move down for the next product

        // Calculate total (assuming price is in format "P xxx.xx")
        $price = floatval(str_replace('P ', '', $productTotalPrice));
        $total += $price;
    }
    $yPos -= 50;

    // Add total to the PDF content
    $content .= "BT /F1 14 Tf 100 $yPos Td (Grand Total: P " . number_format($total, 2) . ") Tj ET\n";
    $yPos -= 20;

    // Add customer payment to the PDF content
    $content .= "BT /F1 14 Tf 100 $yPos Td (Customer Payment: P " . number_format($customerPaymentAmount, 2) . ") Tj ET\n";
    $yPos -= 20;

    // Calculate and add change to the PDF content
    $change = $customerPaymentAmount - $total;
    $content .= "BT /F1 14 Tf 100 $yPos Td (Change: P " . number_format($change, 2) . ") Tj ET\n";
    $yPos -= 20;

    $content .= "BT /F1 14 Tf 100 $yPos Td (" . "THANK YOU FOR BUYING" . ") Tj ET\n";
    $yPos -= 20;

    $content .= "BT /F1 14 Tf 100 $yPos Td (" . "CANTEEN CITE Talamban Rd, Cebu City, 6000 Cebu" . ") Tj ET\n";
    $yPos -= 20;

    $content .= "BT /F1 14 Tf 100 $yPos Td (" . "CITE $role $cashier" . ") Tj ET\n";
    $yPos -= 20;

    // Calculate content length
    $contentLength = strlen($content);

    // Add content to PDF
    $pdf .= "4 0 obj\n";
    $pdf .= "<< /Length $contentLength >>\n";
    $pdf .= "stream\n";
    $pdf .= $content . "\n";
    $pdf .= "endstream\n";
    $pdf .= "endobj\n";

    // PDF cross-reference table
    $xrefOffset = strlen($pdf);
    $pdf .= "xref\n";
    $pdf .= "0 5\n";
    $pdf .= "0000000000 65535 f \n";
    $pdf .= "0000000010 00000 n \n";
    $pdf .= "0000000053 00000 n \n";
    $pdf .= "0000000102 00000 n \n";
    $pdf .= "0000000175 00000 n \n";
    $pdf .= "trailer\n";
    $pdf .= "<< /Size 5 /Root 1 0 R >>\n";
    $pdf .= "startxref\n";
    $pdf .= "$xrefOffset\n";
    $pdf .= "%%EOF";

    // Write PDF to file
    file_put_contents($file, $pdf);
}