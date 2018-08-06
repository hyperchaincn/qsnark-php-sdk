<?php
namespace qulian\qsnark\sdk\api;

use qulian\qsnark\sdk\request;

class AccessToken extends request\Request
{
  private const API_GET_ACCESS_TOKEN = '/token/gtoken';
  private const API_REFRESH_ACCESS_TOKEN = '/token/rtoken';

  public function __construct($config)
  {
    parent::__construct();

    // handle exception
    if (is_array($config)) {
      if (empty($config['phone'])) {
        throw new \Exception('$config: missing argument [phone]');
      }

      if (empty($config['password'])) {
        throw new \Exception('$config: missing argument [password]');
      }

      if (empty($config['client_id'])) {
        throw new \Exception('$config: missing argument [client_id]');
      }

      if (empty($config['client_secret'])) {
        throw new \Exception('$config: missing argument [client_secret]');
      }
    } else {
      throw new \Exception('$config: must be an array');
    }

    $this->config = $config;

    $GLOBALS['sdk_client_id'] = $config['client_id'];
    $GLOBALS['sdk_client_secret'] = $config['client_secret'];

    $this->get_access_token();
  }

  public function get_access_token()
  {
    $config = $this->config;
    $response = $this->post_form(self::API_GET_ACCESS_TOKEN, $config);

    if (empty($response['access_token'])) {
      throw new \Exception(json_encode($response));
    } else {
      $GLOBALS['sdk_access_token'] = $response['access_token'];
    }

    if (empty($response['refresh_token'])) {
      throw new \Exception(json_encode($response));
    } else {
      $GLOBALS['sdk_refresh_token'] = $response['refresh_token'];
    }

    return $response;
  }

  public function refresh_access_token()
  {
    $config = array(
      'refresh_token' => $GLOBALS['sdk_refresh_token'],
      'client_id' => $GLOBALS['sdk_client_id'],
      'client_secret' => $GLOBALS['sdk_client_secret'],
    );

    $response = $this->post_form(self::API_REFRESH_ACCESS_TOKEN, $config);

    if (empty($response['access_token'])) {
      throw new \Exception(json_encode($response));
    } else {
      $GLOBALS['sdk_access_token'] = $response['access_token'];
    }

    if (empty($response['refresh_token'])) {
      throw new \Exception(json_encode($response));
    } else {
      $GLOBALS['sdk_refresh_token'] = $response['refresh_token'];
    }

    return $response;
  }
}
