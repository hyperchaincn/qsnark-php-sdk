<?php
namespace qulian\qsnark\sdk\api;

use qulian\qsnark\sdk\request;

class Contract extends request\Request
{
  private const API_COMPILE_CONTRACT = '/dev/contract/compile';
  private const API_DEPLOY_CONTRACT_ASYNC = '/dev/contract/deploy';
  private const API_DEPLOY_CONTRACT_SYNC = '/dev/contract/deploysync';
  private const API_GET_PAYLOAD = '/dev/payload';
  private const API_INVOKE_CONTRACT_ASYNC = '/dev/contract/invoke';
  private const API_INVOKE_CONTRACT_SYNC = '/dev/contract/invokesync';
  private const API_MAINTAIN_CONTRACT = '/dev/contract/maintain';
  private const API_QUERY_CONTRACT_STATUS = '/dev/contract/status';

  public function __construct()
  {
    parent::__construct();
  }

  public function compile_contract($options)
  {
    return $this->post_json(self::API_COMPILE_CONTRACT, $options);
  }

  public function deploy_contract_async($options)
  {
    return $this->post_json(self::API_DEPLOY_CONTRACT_ASYNC, $options);
  }

  public function deploy_contract_sync($options)
  {
    return $this->post_json(self::API_DEPLOY_CONTRACT_SYNC, $options);
  }

  public function get_payload($options)
  {
    return $this->post_json(self::API_GET_PAYLOAD, $options);
  }

  public function invoke_contract_async($options)
  {
    return $this->post_json(self::API_INVOKE_CONTRACT_ASYNC, $options);
  }

  public function invoke_contract_sync($options)
  {
    return $this->post_json(self::API_INVOKE_CONTRACT_SYNC, $options);
  }

  public function maintain_contract($options)
  {
    return $this->post_json(self::API_MAINTAIN_CONTRACT, $options);
  }

  public function query_contract_status($address)
  {
    $url = self::API_QUERY_CONTRACT_STATUS . "?address=$address";
    return $this->get($url);
  }
}
