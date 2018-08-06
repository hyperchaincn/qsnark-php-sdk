<?php
namespace qulian\qsnark\sdk\api;

use qulian\qsnark\sdk\request;

class Block extends request\Request
{
  private const API_QUERY_SINGLE_BLOCK = '/dev/block/query';
  private const API_QUERY_BLOCKS_BY_PAGE = '/dev/blocks/page';
  private const API_QUERY_BLOCKS_BY_RANGE = '/dev/blocks/range';

  public function __construct()
  {
    parent::__construct();
  }

  public function query_block_by_number($number)
  {
    $url = self::API_CREATE_ACCOUNT . "?type=number&value=$number";
    return $this->get($url);
  }

  public function query_block_by_hash($hash)
  {
    $url = self::API_CREATE_ACCOUNT . "?type=hash&value=$hash";
    return $this->get($url);
  }

  public function query_blocks_by_page($page, $page_size)
  {
    $url = self::API_QUERY_BLOCKS_BY_PAGE . "?index=$page&pageSize=$page_size";
    return $this->get($url);
  }

  public function query_blocks_by_range($from, $to)
  {
    $url = self::API_QUERY_BLOCKS_BY_RANGE . "?from=$from&to=$to";
    return $this->get($url);
  }
}
