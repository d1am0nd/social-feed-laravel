<?php

namespace App\Custom;

use Carbon\Carbon;
use App\Custom\FeedAbstract;

class FacebookFeed extends FeedAbstract
{

    private $json, $name;

    public function __construct($json, $name = 'unknown')
    {
        $this->json = $json;
        $this->name = $name;
    }

    public function getTimestamp()
    {
        return Carbon::parse($this->json->created_time->date);
    }

    public function getMessage()
    {
        return $this->json->message;
    }

    public function getSocialNetworkName() 
    {
        return "Facebook";
    }

    public function getUserName() 
    {
        return $this->name;
    }

    public function getUrl()
    {
        $urlParts = explode('_', $this->getId());
        return 'https://www.facebook.com/' . $urlParts[0] . '/posts/' . $urlParts[1];
    }

    private function getId()
    {
        return $this->json->id;
    }
}
