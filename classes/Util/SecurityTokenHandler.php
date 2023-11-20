<?php

namespace Util;

use Config\Config;

/**
 * handling access token (jwt-like)
 * 
 * @author Bata Jozsef
 */
class SecurityTokenHandler
{

	/**
	 * @var string
	 */
	protected $secretKey;

	/**
	 * @param array $config
	 *
	 * @throws \Exception
	 */
	public function __construct()
	{
		$this->secretKey = Config::getInstance()->getValue('tokensecret');
	}

	/**
	 * @param array $data
	 *
	 * @return string
	 */
	public function getToken(array $data = [])
	{
		$payload          = json_encode($data);
		$base64UrlPayload = base64_encode($payload);

		$signature = hash_hmac('sha256', $base64UrlPayload, $this->secretKey, true);

		$base64UrlSignature = base64_encode($signature);
		$base64UrlSignature = $this->clean($base64UrlSignature);

		$token = $base64UrlPayload . "." . $base64UrlSignature;

		return $token;
	}

	/**
	 * Returns the payload as array or false if checksum error
	 *
	 * @return array|bool
	 */
	public function checkToken(string $token)
	{
		$parts           = explode('.', $token);
		$payloadBase64   = $parts[0] ?? '';
		$signatureBase64 = $parts[1] ?? '';
		$checkSum        = hash_hmac('sha256', $payloadBase64, $this->secretKey, true);
		$checkSumBase64  = base64_encode($checkSum);
		$checkSumBase64  = $this->clean($checkSumBase64);
		if ($checkSumBase64 !== $signatureBase64) {
			return false;
		}
		$payload = base64_decode($payloadBase64);
		$data    = json_decode($payload, true);

		return $data;
	}

	protected function clean(string $signatureBase64)
	{
		$signatureBase64 = str_replace(
			['+', '/', '='],
			['-', '_', '' ],
			$signatureBase64
		);

		return $signatureBase64;
	}
}
