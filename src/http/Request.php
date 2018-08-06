<?php
namespace qulian\qsnark\sdk\request;

class Request
{
  private const BASE_URL = 'https://dev.hyperchain.cn/v1';
  private const API_REFRESH_ACCESS_TOKEN = '/token/rtoken';

  public function __construct()
  {
    $this->base_url = self::BASE_URL;
  }

  private function handle_request($url, $options)
  {
    try {
      $context = stream_context_create($options);
      $response = file_get_contents($url, false, $context);

      if ($response === false) {
        return json_decode('{"err": "接口调用失败"}', true);
      }

      $result = json_decode($response, true);

      var_dump($result);

      // code 1008，invalid access token
      if (abs($result['Code']) === 1008) {
        $this->refresh_access_token();

        // update auth token
        $options['http']['header'] = "Authorization: " . $GLOBALS['sdk_access_token'] . "\r\n";

        // request again
        $this->handle_request($url, $options);
      }

      return $result;
    } catch (Exception $e) {
      return json_decode('{"err": "' . $e->getMessage() . '"}', true);
    }
  }

  public function get($url)
  {
    if (empty($GLOBALS['sdk_access_token'])) {
      throw new \Exception('access_token can not be empty');
    }

    $url = $this->base_url . $url;
    $options = array(
      'http' => array(
        'method' => "GET",
        'header' => "Authorization: " . $GLOBALS['sdk_access_token'] . "\r\n",
      ),
    );

    return $this->handle_request($url, $options);
  }

  public function post_form($url, $data)
  {
    $data = http_build_query($data);
    $url = $this->base_url . $url;
    $options = array(
      'http' => array(
        'method' => "POST",
        'header' => "Authorization: " . $GLOBALS['sdk_access_token'] . "\r\n"
        . "Content-type: application/x-www-form-urlencoded\r\n",
        'content' => $data,
      ),
    );

    return $this->handle_request($url, $options);
  }

  public function post_json($url, $data)
  {
    if (empty($GLOBALS['sdk_access_token'])) {
      throw new \Exception('access_token can not be empty');
    }

    $url = $this->base_url . $url;
    $options = array(
      'http' => array(
        'method' => "POST",
        'header' => "Authorization: " . $GLOBALS['sdk_access_token'] . "\r\n"
        . "Content-type: application/json\r\n",
        'content' => json_encode($data),
      ),
    );

    return $this->handle_request($url, $options);
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
