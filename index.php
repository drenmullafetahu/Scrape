<?php
header('Content-Type: text/html; charset=utf-8');
require_once "xpath.php";

$array=array();

for($i=1;$i<11;$i++)
{	
	$startUrl1 = "http://www.haberturk.com/htyazar/fatih-altayli-1001/$i";
	$xpath1= new XPATH($startUrl1);
	$linkhrefQuery1 = $xpath1->query("//div[contains(@class,'excerpt')]/h2/a/@href");

	//$xpath->preview($linkhrefQuery);

		for($x=0; $x<$linkhrefQuery1->length; $x++)
		{		
			$linqet [$x]= "http://www.haberturk.com" .$startUrl1  = $linkhrefQuery1->item($x)->nodeValue;
		}
		 //linqet e marrun pi postoj ne ekran me i pa
			echo "<pre>";
			print_r($linqet);

			//foreach (range(0,count($linqet))as $number) 	
				
			for($j=0;$j<count($linqet);$j++)				

						{ 	//Tash neper linqet e marrun po hyj mrenda me ja marr tekstin
							$xpath= new XPATH($linqet[$j]);
							$webtitle = $xpath->query("//div[contains(@class,'group mtop10 news-tt')]/h1");//titulli nweb  
							$paragraf = $xpath->query("//div[contains(@class,'group l-top news-content-text author-detail-text')]/p");	//paragrafi nweb					
							$k=array_push($array, $j);//e deklarova ni array me emrin array mi pushirat tdhanunat qe mos tbohen override
							$myFile = "E:/wamp/www/Scrape/Yazarlar/test/".$k.".txt";
							$fh = fopen($myFile, 'a') or die("can't open file");	//Krijoj file
								foreach ($webtitle as $title1 => $title) 
									{
									 	$stringData1=$title->textContent;
									 	echo "<p>";
									 	echo $stringData1;
									 	fwrite($fh, $stringData1. PHP_EOL);
								    } 
									foreach ($paragraf as $tekste => $tekst)
										{
										 
											 $stringData=$tekst->textContent;   
											 echo "<p>";

											 echo $stringData; //Tekstet e marrun prej webit ne ekran 
											 
											 fwrite($fh, $stringData.PHP_EOL);//E qes tekstin e marrun prej webit ne file			 
									 	}					
						}				
}
fclose($fh);
?>