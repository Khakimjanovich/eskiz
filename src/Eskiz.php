<?php

namespace NotificationChannels\Eskiz;

use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHTtp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use NotificationChannels\Eskiz\Exceptions\CouldNotSendNotification;
use Psr\Http\Message\ResponseInterface;

class Eskiz
{
    /**
     * @var string ESKIZ API URL.
     */
    protected string $apiUrl = 'https://notify.eskiz.uz/api';

    /**
     * @var HttpClient HTTP Client.
     */
    protected HttpClient $http;

    /**
     * @var null|string Eskiz API Key.
     */
    protected ?string $apiKey;

    /**
     * @param string|null $apiKey
     * @param HttpClient|null $http
     */
    public function __construct(string $apiKey = null, HttpClient $http = null)
    {
        $this->apiKey = $apiKey;
        $this->http = $http;
    }

    /**
     * Get API key.
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Set API key.
     *
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Send text message.
     *
     * <code>
     * $params = [
     *      'mobile_phone="998991234567"' \
     *      'message="Тест начинается"' \
     *      'from="4546"' \
     *      'callback_url="http://0000.uz/test.php"'
     * ];
     * </code>
     *
     * @link https://documenter.getpostman.com/view/663428/RzfmES4z?version=latest#intro
     *
     * @param array $params
     * @return ResponseInterface
     * @throws CouldNotSendNotification|GuzzleException
     */
    public function sendMessage(array $params): ResponseInterface
    {
        return $this->sendRequest('/message/sms/send', $params);
    }

    /**
     * @throws CouldNotSendNotification|GuzzleException
     */
    public function sendRequest(string $endpoint, array $params): ResponseInterface
    {
        if (empty($this->apiKey)) {
            throw CouldNotSendNotification::apiKeyNotProvided();
        }

        try {
            return $this->httpClient()->post($this->apiUrl . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ],
                'form_params' => $params,
            ]);
        } catch (ClientException $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        } catch (Exception $exception) {
            throw CouldNotSendNotification::serviceNotAvailable($exception);
        }
    }

    /**
     * Get HttpClient.
     *
     * @return HttpClient
     */
    protected function httpClient(): HttpClient
    {
        return $this->http ?? new HttpClient();
    }
}
