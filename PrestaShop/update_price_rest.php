<?php

/*
 *  @author Igor Klimets <igor35hh@gmail.com>
 */

	require_once(dirname(__FILE__).'/config/config.inc.php');
	
	$the_report = "";
	
	$ftp_server    = 'ftp.mlife.dp.ua';
	$ftp_user_name = 'healthshop';
	$ftp_user_pass = 'J1m7gOKu6TFN0q8k';
	
	$conn_id = ftp_connect($ftp_server);
	$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
	ftp_pasv($conn_id, true);
	
	try {
	
		$fname = 'order.csv';
	
		if (!file_exists($fname)) {
			
			$wasrecord = 0;
				
			$fileCsv = fopen($fname,"a+");
				
			$date_start = date("Y-m-d 00:00:00");
			$date_end   = date("Y-m-d 23:59:59");
				
			$date_start = date("2017-03-06 00:00:00");
			$date_end   = date("2017-03-06 23:59:59");
				
			$sql = "Select ad.phone, ad.phone_mobile, ad.city, ad.firstname, ad.lastname, ad.alias, ad.address1,
			ad.address2, po.payment, po.date_add, po.total_paid, po.id_order, os.name From ps_orders po
			LEFT JOIN ps_address ad ON (po.id_address_delivery= ad.id_address)
			LEFT JOIN ps_order_state_lang os ON (po.current_state= os.id_order_state And po.id_lang= os.id_lang)
			WHERE po.current_state in (1,2,3,10,11) And po.date_add BETWEEN
			STR_TO_DATE('$date_start', '%Y-%m-%d %H:%i:%s')
			AND STR_TO_DATE('$date_end', '%Y-%m-%d %H:%i:%s')";
				
			if ($results = Db::getInstance()->ExecuteS($sql)) {
				foreach ($results as $row) {
						
					$headOfCap = array(
							'phone','phone_mobile','city','firstname','lastname','alias','address1',
							'address2','payment','date_add','total_paid','id_order','name'
					);
						
					fputcsv($fileCsv, $headOfCap, ';');
						
					fputcsv($fileCsv, $row, ';');
						
					$headOfRow = array(
							'reference','product_quantity','product_price'
					);
						
					fputcsv($fileCsv, $headOfRow, ';');
					
					$wasrecord = 1;
						
					$id_order = $row['id_order'];
						
					$sql = "Select p.reference, od.product_quantity, od.product_price From ps_order_detail od
					LEFT JOIN ps_product p ON (od.product_id= p.id_product)
					where od.id_order='$id_order'";
						
					if ($results = Db::getInstance()->ExecuteS($sql)) {
						foreach ($results as $rowgod) {
								
							fputcsv($fileCsv, $rowgod, ';');
	
						}
					}
						
				}
				
				if($wasrecord = 1) {
					$the_report = "Orders have unloaded \n" . $the_report;
				}
			}
				
			fclose($fileCsv);
			
			
			if (($conn_id) || ($login_result)) {
				if (ftp_put($conn_id, $fname, $fname, FTP_ASCII)) {
					try { unlink($fname); } catch (Exception $e) {}
				}
			}
	
		}
	
	} catch (Exception $e) {
		//echo 'Exeption of update price: ',  $e->getMessage(), "\n";
	}
	
	if (($conn_id) || ($login_result)) {
		
		ftp_get($conn_id, 'product_price.csv', 'product_price.csv', FTP_ASCII);
		ftp_get($conn_id, 'product_rest.csv', 'product_rest.csv', FTP_ASCII);
		ftp_get($conn_id, 'combination_rest.csv', 'combination_rest.csv', FTP_ASCII);
		ftp_get($conn_id, 'order_answer.csv', 'order_answer.csv', FTP_ASCII);
		//
		ftp_delete($conn_id, 'product_price.csv');
		ftp_delete($conn_id, 'product_rest.csv');
		ftp_delete($conn_id, 'combination_rest.csv');
		ftp_delete($conn_id, 'order_answer.csv');
	}
	
	ftp_close($conn_id);
	
	try {
		
		$fname = 'product_price.csv';
		
		if (file_exists($fname)) {
			
			$lines = file($fname);
			
			$wasrecord = 0;
			
			foreach($lines as $line) {
			
				$log = explode(';', $line);
			
				if ($log[0] == 'Name') {
					continue;
				}
					
				$name    = $log[0];
				$article = pSQL($log[1]); // or Db::getInstance()->escape($string, false);
				$price   = (float)$log[2];
					
				$update = array (
						'price' => $price,
				);
					
				$sql = "SELECT p.id_product FROM ps_product p WHERE p.reference = '$article'";
				if ($row = Db::getInstance()->getRow($sql)) {
					$id_product = $row['id_product'];
					$where = "id_product=$id_product";
			
					Db::getInstance() -> update('product_shop', $update, $where);
					Db::getInstance() -> update('product', $update, $where);
					
					$wasrecord = 1;
				}
			
			}
			
			if($wasrecord = 1) {
				$the_report = "Prices have loaded \n" . $the_report;
			}
			
			try { unlink($fname); } catch (Exception $e) {}
			
		}		
		
	} catch (Exception $e) {
		//echo 'Exeption of update price: ',  $e->getMessage(), "\n";
	}
		
	try {
		
		$fname = 'product_rest.csv';
		
		if (file_exists($fname)) {
		
			$lines = file($fname);
			
			$wasrecord = 0;
			
			foreach($lines as $line) {
			
				$log = explode(';', $line);
			
				if ($log[0] == 'Name') {
					continue;
				}
						
				$name    = $log[0];
				$article = pSQL($log[1]); // or Db::getInstance()->escape($string, false);
				$rest   = (float)$log[2];
						
				$update = array (
						'quantity' => $rest,
				);
				
				$sql = "SELECT p.id_product FROM ps_product p WHERE p.reference = '$article'";
				if ($row = Db::getInstance()->getRow($sql)) {
					$id_product = $row['id_product'];
					
					$where = "id_product=$id_product and id_product_attribute=0";
					Db::getInstance() -> update('stock_available', $update, $where);
					
					$wasrecord = 1;
				}
					
			}
			
			if($wasrecord = 1) {
				$the_report = "Rests of products have loaded \n" . $the_report;
			}
			
			try { unlink($fname); } catch (Exception $e) {}
		
		}
				
		
	} catch (Exception $e) {
		//echo 'Exeption of update rest: ',  $e->getMessage(), "\n";
	}
	
	try {
	
		$fname = 'combination_rest.csv';
		
		if (file_exists($fname)) {
	
			$lines = file($fname);
			
			$totalcount = array ();
			
			$wasrecord = 0;
		
			foreach($lines as $line) {
		
				$log = explode(';', $line);
		
				if ($log[0] == 'Name') {
					continue;
				}
					
				$name    = $log[0];
				$article = pSQL($log[1]); // or Db::getInstance()->escape($string, false);
				$rest   = (float)$log[2];
					
				$update = array (
						'quantity' => $rest,
				);
					
				$sql = "SELECT pa.id_product, pa.id_product_attribute FROM ps_product_attribute pa
							WHERE pa.reference = '$article'";
						
				if ($row = Db::getInstance()->getRow($sql)) {
					$id_product           = $row['id_product'];
					$id_product_attribute = $row['id_product_attribute'];
		
					$where = "id_product=$id_product and id_product_attribute=$id_product_attribute";
					Db::getInstance() -> update('stock_available', $update, $where);
					
					$totalcount[$id_product] = $id_product;
					
					$wasrecord = 1;
					
					//if (isset($totalcount[$id_product])) {
						//$totalcount[$id_product] += $rest;
					//} else {
						//$totalcount[$id_product] = $rest;
					//}
				}
		
			}
			
			foreach ($totalcount as $key => $value) {
				
				$sql = "select Sum(pa.quantity) sum from ps_stock_available pa 
						WHERE pa.id_product = '$key' And pa.id_product_attribute != 0";
				if ($row = Db::getInstance()->getRow($sql)) {
					$update = array (
							'quantity' => $row['sum'],
					);
					$where = "id_product=$key and id_product_attribute=0";
					Db::getInstance() -> update('stock_available', $update, $where);
					
					$wasrecord = 1;
				}
			}
			
			if($wasrecord = 1) {
				$the_report = "Rests of combinations have loaded \n" . $the_report;
			}
			
			try { unlink($fname); } catch (Exception $e) {}
		
		}
		
	
	} catch (Exception $e) {
		//echo 'Exeption of update rest: ',  $e->getMessage(), "\n";
	}
	
	try {
	
		$fname = 'order_answer.csv';
	
		if (file_exists($fname)) {
				
			$lines = file($fname);
			
			$wasrecord = 0;
				
			foreach($lines as $line) {
					
				$log = explode(';', $line);
					
				if ($log[0] == 'Id') {
					continue;
				}
					
				$id_order = pSQL($log[0]);
				$id_order_state  = $log[1]; // or Db::getInstance()->escape($string, false);
					
				$update = array (
						'current_state' => $id_order_state,
				);
					
				$sql = "SELECT o.id_order FROM ps_orders o WHERE o.id_order = '$id_order'";
				if ($row = Db::getInstance()->getRow($sql)) {
					$where = "id_order=$id_order";	
					Db::getInstance() -> update('orders', $update, $where);
					
					$date_add = date("Y-m-d H:i:s");
					
					$update = array (
							'id_employee' => 0,
							'id_order' => $id_order,
							'id_order_state' => $id_order_state,
							'date_add' => $date_add,
					);
		
					Db::getInstance() -> insert('order_history', $update, $where);
					
					$wasrecord = 1;
				}
					
			}
			
			if($wasrecord = 1) {
				$the_report = "Statuses of orders have loaded \n" . $the_report;
			}
				
			try { unlink($fname); } catch (Exception $e) {}
				
		}
	
	} catch (Exception $e) {
		//echo 'Exeption of update price: ',  $e->getMessage(), "\n";
	}
	
	try {
		
		if($the_report != "") {
		
			$to      = 'kelembet@svcorp.com.ua'; //kelembet@svcorp.com.ua
			$subject = "Health Shop's report";
			$message = $the_report;
			$headers = 'From: info@healthshop.com.ua' . "\r\n" .
					'Reply-To: info@healthshop.com.ua' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
			
			mail($to, $subject, $message, $headers);
		
		}
	
	} catch (Exception $e) {
		//echo 'Exeption of sendding mail: ',  $e->getMessage(), "\n";
	}

?>