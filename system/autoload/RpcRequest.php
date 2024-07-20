<?php
class RpcRequest
{
  public $action;
  public $params;

  public function __construct($action, $params)
  {
    $this->action = $action;
    $this->params = $params;
  }
}
