<?php

namespace App\Custom;

use Carbon\Carbon;
use App\Custom\FeedAbstract;

class TwitterFeed extends FeedAbstract
{

    private $json;

    public function __construct($json)
    {
        $this->json = $json;
    }

    public function getTimestamp()
    {
        return Carbon::parse($this->json->created_at);
    }

    public function getMessage()
    {
        return $this->json->text;
    }

    public function getSocialNetworkName() 
    {
        return "Twitter";
    }

    public function getUserName() 
    {
        return "@" . $this->json->user->screen_name;
    }

    public function getUrl()
    {
        return 'https://twitter.com/statuses/' . $this->getId();
    }

    private function getId()
    {
        return $this->json->id_str;
    }
}
