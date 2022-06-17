<?php


namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;

class OneSignalService
{
    private $playerIdList = [];
    private $baseEndPoint = '';
    private $authKey = '';
    private $appId = '';

    public function __construct(array $playerIdList = null)
    {
        $this->playerIdList = $playerIdList;
        $this->baseEndPoint = 'https://onesignal.com/api/v1/notifications';
        $this->authKey = $_ENV['ONE_SIGNAL_AUTH_KEY'];
        $this->appId = 'ae206aa4-3fdd-4e55-9f49-e7d74c35489c';
    }

    public function sendPushNotification(String $message)
    {
        $content = array(
            'en' => $message,
            'pt-br' => $message
        );

        $fields = array(
            'app_id' => $this->appId,
            'include_player_ids' => $this->playerIdList,
            'data' => array('foo' => 'bar'),
            'contents' => $content
        );

        $httpClient = HttpClient::create([]);
        $response = $httpClient->request('POST', $this->baseEndPoint,
            [
                'headers' => [
                    'Content-Type' => 'application/json; charset=utf-8',
                    'Authorization' => 'Basic ' . $this->authKey,
                ],
                'body' => json_encode($fields)
            ]
        );

        return json_decode($response->getContent(false), true);
    }
}