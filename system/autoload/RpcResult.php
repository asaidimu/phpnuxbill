<?php
class RpcResult
{
  public $success;
  public $message;
  public $result;
  public $meta;

  public function __construct($success, $message, $result = null, $meta = null)
  {
    $this->success = $success;
    $this->message = $message;
    $this->result = $result;
    $this->meta = $meta;
  }
}
