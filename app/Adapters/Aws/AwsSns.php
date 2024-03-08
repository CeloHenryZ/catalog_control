<?php

namespace App\Adapters\Aws;

use Aws\Sns\SnsClient;

class AwsSns
{
    private SnsClient $snsClient;

    public function __construct() {
        $this->snsClient = new SnsClient([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
    }

    public function publish($topic, Array $message) {
        $this->snsClient->publish([
            'TopicArn' => $topic,
            'Message' => json_encode($message)
        ]);
    }

}
