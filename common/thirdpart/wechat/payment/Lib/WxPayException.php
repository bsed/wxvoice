<?php
/**
 *
 * 微信支付API异常类
 * @author widyhu
 *
 */
namespace common\thirdpart\wechat\payment\Lib;

use Exception;

class WxPayException extends Exception {
	public function errorMessage()
	{
		return $this->getMessage();
	}
}
