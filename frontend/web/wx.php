<?php

require(__DIR__ . '/../../vendor/autoload.php');

use EasyWeChat\Foundation\Application;

			$options = [
				'debug'  => true,
				'app_id' => 'wx46b3ddbed629ab60',
				'secret' => '001ceea70afddeed87978962daae4304',
				'token'  => 'zfimZoG9z33fymYG3Yo3630gEI3Z3O90',
				'log' => [
					'level' => 'debug',
					'file'  => __DIR__ . '/../../tmp/wechat.log',  
				],
			]; 
			$app = new Application($options);
							
			$app->server->setMessageHandler(function ($message) {
				file_put_contents('../../tmp/we.log', $message);
				return "您好！";
			});
			$response = $app->server->serve();
			// 将响应输出
			$response->send(); 
  