<?php

namespace Megoxv\ZeroMsg\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ZeroMsgClient
{
    protected $client;
    protected $apiKey;
    protected $deviceId;
    protected $message;
    protected $to;
    protected $type;
    protected $url;
    protected $filename;
    protected $link;
    protected $latitude;
    protected $longitude;
    protected $title;
    protected $address;
    protected $buttonText;
    protected $sections;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('zeromsg.api_key');
        $this->deviceId = config('zeromsg.device_id');
    }

    public static function create()
    {
        return new static();
    }

    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    public function to($phone)
    {
        $this->to = $phone;
        return $this;
    }

    public function image($url, $filename)
    {
        $this->type = 'image';
        $this->url = $url;
        $this->filename = $filename;
        return $this;
    }

    public function voice($url)
    {
        $this->type = 'voice';
        $this->url = $url;
        return $this;
    }

    public function media($url, $filename)
    {
        $this->type = 'media';
        $this->url = $url;
        $this->filename = $filename;
        return $this;
    }

    public function listMessage($title, $buttonText, $sections)
    {
        $this->type = 'list-message';
        $this->title = $title;
        $this->buttonText = $buttonText;
        $this->sections = $sections;
        return $this;
    }

    public function linkPreview($link)
    {
        $this->type = 'link-preview';
        $this->link = $link;
        return $this;
    }

    public function location($latitude, $longitude, $title = '', $address = '')
    {
        $this->type = 'location';
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->title = $title;
        $this->address = $address;
        return $this;
    }

    protected function postRequest($endpoint, $body)
    {
        try {
            $response = $this->client->post('https://app.zeromsg.com/api' . $endpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($body),
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw $e;
        }
    }

    public function send()
    {
        $body = [
            'device' => $this->deviceId, 
            'phone' => $this->to,
            'type' => $this->type ?? 'text',
            'message' => $this->message,
        ];

        if ($this->type === 'image' || $this->type === 'media' || $this->type === 'voice') {
            $body['url'] = $this->url;
            $body['filename'] = $this->filename;
        }

        if($this->type === 'list-message') {
            $body['title'] = $this->title;
            $body['button_text'] = $this->buttonText;
            $body['sections'] = $this->sections;
        }

        if ($this->type === 'link-preview') {
            $body['url'] = $this->link;
        }

        if ($this->type === 'location') {
            $body['lat'] = $this->latitude;
            $body['lng'] = $this->longitude;
            $body['title'] = $this->title;
            $body['address'] = $this->address;
        }

        return $this->postRequest('/send-message', $body);
    }
}
