<?php

namespace m07uf4pr01\ApiTransactions;

include_once('transaction.php');

class Api {
	function process_request($get_data) {
		$transaction = new Transaction();
		$result = [];
		
		if (array_key_exists('name', $get_data)) {
			$result = $transaction->get_transactions_by_client($get_data['name']);
		} else if (array_key_exists('date', $get_data)) {
			$result = $transaction->get_transactions_by_date($get_data['date']);
		} else {
			$result = $transaction->get_all_transactions();
		}

		if (!count($result)) {
			http_response_code(404);
			echo json_encode(array("message" => "No matches found."));
		} else {
			http_response_code(200);
			echo json_encode($result);
		}
	}
}

$api = new Api();
$api->process_request($_GET);
