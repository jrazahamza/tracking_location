<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(config('services.twilio.sid'), config('services.twilio.token'));
    }

    public function sendSMS($to, $message)
    {
        $response = $this->client->messages->create($to, [
            'from' => config('services.twilio.from'),
            'body' => $message,
        ]);


        if ($response->status === 'failed' || $response->status === 'undelivered') {
            throw new \Exception("Twilio SMS failed to send. Status: " . $response->status);
        }

        return $response;
    }


    public function sendWhatsApp($to, $message)
    {
        $response = $this->client->messages->create("whatsapp:{$to}", [
            'from' => config('services.twilio.whatsapp_from'),
            'body' => $message,
        ]);

        if ($response->status === 'failed' || $response->status === 'undelivered') {
            throw new \Exception("Twilio WhatsApp failed to send. Status: " . $response->status);
        }

        return $response;
    }
}
