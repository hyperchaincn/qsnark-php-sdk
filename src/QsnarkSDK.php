<?php
namespace qulian\qsnark\sdk;

require_once dirname(__FILE__) . '/http/Request.php';
require_once dirname(__FILE__) . '/api/AccessToken.php';
require_once dirname(__FILE__) . '/api/Account.php';
require_once dirname(__FILE__) . '/api/Block.php';
require_once dirname(__FILE__) . '/api/Contract.php';
require_once dirname(__FILE__) . '/api/Transaction.php';

use \qulian\qsnark\sdk\api;

class QsnarkSDK
{
  public function __construct($config)
  {
    $this->token = new api\AccessToken($config);
    $this->account = new api\Account();
    $this->block = new api\Block();
    $this->contract = new api\Contract();
    $this->transaction = new api\Transaction();
  }
}
