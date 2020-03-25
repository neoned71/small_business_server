<?php

$test_id=$_GET['test_id'];
// ob_start();
$echoed_content=file_get_contents(<?php echo $link."test_series/test_for_pdf.php?test_id=".$test_id);
// $ = ob_get_clean();
$filename="./temp.html";
$r=file_put_contents($filename, $echoed_content);

$ret_val= -1;
// system("pwd");
exec("pandoc temp.html -t latex -o temp.pdf",$output,$ret_val);
// echo json_encode($output);
// if($ret_val==0)
// {
// 	file_get_contents("temp.pdf");
// }
// else
// {
// 	echo "there is some problem with the pdf conversion";
// }
// echo $echoed_content;


?>