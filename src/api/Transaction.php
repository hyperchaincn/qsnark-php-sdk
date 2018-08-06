<?php
namespace qulian\qsnark\sdk\api;

use qulian\qsnark\sdk\request;

class Transaction extends request\Request
{
  private const API_COUNT_TRANSACTION = '/dev/transaction/count';
  private const API_QUERY_TRANSACTION_BY_HASH = '/dev/transaction/query';
  private const API_QUERY_TXRECEIPT_BY_HASH = '/dev/transaction/txreceipt';
  private const API_QUERY_ALL_ILLEGAL_TRANSACTIONS = '/dev/transactions/discard';

  public function __construct()
  {
    parent::__construct();
  }

  public function count_transaction()
  {
    return $this->get(self::API_COUNT_TRANSACTION);
  }

  public function query_transaction_by_hash($hash)
  {
    $url = self::API_QUERY_TRANSACTION_BY_HASH . "?hash=$hash";
    return $this->get($url);
  }

  public function query_txreceipt_by_hash($hash)
  {
    $url = self::API_QUERY_TXRECEIPT_BY_HASH . "?txhash=$hash";
    return $this->get($url);
  }

  public function query_all_illegal_transactions($start, $end)
  {
    $url = self::API_QUERY_ALL_ILLEGAL_TRANSACTIONS . "?start=$start&end=$end";
    return $this->get($url);
  }
}
