<?php

namespace App\Custom;

use Carbon\Carbon;
use App\Custom\FeedAbstract;

class InstagramFeed extends FeedAbstract
{

    private $json;

    public function __construct($json)
    {
        $this->json = $json;
    }

    public function getTimestamp()
    {
        return Carbon::createFromTimestamp($this->json->caption->created_time);
    }

    public function getMessage()
    {
        return $this->json->caption->text;
    }

    public function getSocialNetworkName() 
    {
        return "Instagram";
    }

    public function getUserName() 
    {
        return $this->json->user->username;
    }

    public function getUrl()
    {
        return $this->json->link;
    }
}
