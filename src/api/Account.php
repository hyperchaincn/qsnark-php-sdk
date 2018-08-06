<?php
namespace qulian\qsnark\sdk\api;

use qulian\qsnark\sdk\request;

class Account extends request\Request
{
  private const API_CREATE_ACCOUNT = '/dev/account/create';

  public function __construct()
  {
    parent::__construct();
  }

  public function create_account()
  {
    return $this->get(self::API_CREATE_ACCOUNT);
  }
}
