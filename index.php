<?php

function pdftohtml($path){
// Include Composer autoloader if not already done.
include 'vendor/autoload.php';
// initiate
$pdf = new \TonchikTm\PdfToHtml\Pdf($path, [
    'pdftohtml_path' => __DIR__.'/poppler-0.68.0/bin/pdftohtml.exe',
    'pdfinfo_path' => __DIR__.'/poppler-0.68.0/bin/pdfinfo.exe'
]);

// example for windows
// $pdf = new \TonchikTm\PdfToHtml\Pdf('test.pdf', [
//     'pdftohtml_path' => '/path/to/poppler/bin/pdftohtml.exe',
//     'pdfinfo_path' => '/path/to/poppler/bin/pdfinfo.exe'
// ]);

// get pdf info
$pdfInfo = $pdf->getInfo();

// get count pages
$countPages = $pdf->countPages();

// get content from one page
$contentFirstPage = $pdf->getHtml()->getPage(1);
$html = '';
// get content from all pages and loop for they
foreach ($pdf->getHtml()->getAllPages() as $page) {
    $html .= $page . '<br/>';
}
echo $html;
}


function doctohtml($path){
    include 'vendor/autoload.php';
  /* Filename */
  
  $phpWord = \PhpOffice\PhpWord\IOFactory::load($path);
  $htmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter( $phpWord,'HTML');
//
$content =  $htmlWriter->save($path .'.html');
$myfile = fopen($path .'.html', "r") or die("Unable to open file!");
$html =  fread($myfile,filesize($path .'.html'));
fclose($myfile);
echo $html;
}

doctohtml('quan_tri_tai_chinh.docx');
pdftohtml('sample.pdf');
?>