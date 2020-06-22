<?php
echo "Введите имя файла и тип операции";
echo "</br>";
	
print "<form method=post>";
print "<input type=text name=file_name placeholder='имя файла' required>";
print "<input type=text name=operation placeholder='тип операции' required>";
print "<input type=submit value='Отправить'>";
print "</form>";
// echo "</br>";
$file = "";
$neg = 'neg.txt';
$pos = 'pos.txt';
$_neg = fopen($neg, 'a+');
$_pos = fopen($pos, 'a+');

if (isset($_POST['operation'])) {

	$op = $_POST['operation'];
	$file = $_POST['file_name'].".txt";

	if(file_exists($file)){

		$handle = fopen($file, 'r');
		
		while(!feof($handle)) {

			$str = fgets($handle);
			$ns =  explode(" ", $str);
			print_r($ns);
			echo "</br>";

			switch ($op) {
			    case "+":
			        $result = intval($ns[0]) + intval($ns[1]);
			        break;
			    case "-":
			        $result = intval($ns[0]) - intval($ns[1]);
			        break;
			    case "*":
			        $result = intval($ns[0]) * intval($ns[1]);
			        break;
			    case "/":
			        $result = intval($ns[0]) / intval($ns[1]);
			        break;
			}
			
			if ($result>0) {
				fwrite($_pos, "\n".$result);
			}else{
				fwrite($_neg, "\n".$result);
			}
			echo $result;
			echo "</br>";
		}	
		fclose($handle);

	}else{
		echo "Такой файл недоступен";
	}

	
}//isset post
fclose($_neg);
fclose($_pos);

unlink($neg);
unlink($pos);
?>