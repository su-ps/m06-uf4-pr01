<?php

namespace m07uf4pr01\ApiTransactions;

require_once('dbconn.php');

class Transaction extends DBConn {
	private function query_transaction($stmt) {
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$formatted_results = [];

		if (count($result) > 0) {
			foreach($result as $row) {
				array_push($formatted_results, $this->decode_transaction($row));
			}
		} 
		return $result;
	}

	function get_all_transactions() {
		$sql = 'SELECT * FROM transaction;';
		$stmt = $this->connect()->prepare($sql);
		return $this->query_transaction($stmt);
	}

	function get_transactions_by_date($date) {
		$sql = "SELECT * FROM transaction WHERE transaction_date LIKE CONCAT('%', :date, '%');";
		$stmt = $this->connect()->prepare($sql);

		if ($stmt->bindValue(':date', $date, PDO::PARAM_STR)) {
			return $this->query_transaction($stmt);
		} else {
			return [];
		}
	}

	function get_transactions_by_client($cli_name) {
		$sql = "SELECT * FROM transaction WHERE client_name LIKE CONCAT('%', :cli_name, '%');";
		$stmt = $this->connect()->prepare($sql);

		if ($stmt->bindValue(':cli_name', $cli_name, PDO::PARAM_STR)) {
			return $this->query_transaction($stmt);
		} else {
			return [];
		}
	}

	private function decode_transaction($query_row) {
		$register = array(
			'id' => $query_row['id'],
			'cli_name' => $query_row['client_name'],
			'cli_bank_account' => $query_row['client_bank_account'],
			'cli_phone_num' => $query_row['client_phone_num'],
			'transaction_date' => $query_row['transaction_date'],
			'qty' => $query_row['qty']
		);

		return $register;
	}
}
