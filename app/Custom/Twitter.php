<?php

namespace App\Custom;

use Exception;
use Twitter as TwitterSdk;
use App\Custom\SocialInterface;

class Twitter implements SocialInterface
{

    public function __construct()
    {

    }

    public function getLastFromFeed()
    {
        return Twitter::getPageFeed(1)[0];
    }

    private function getPageFeed($count = 5)
    {
        return $this->decode(TwitterSdk::getUserTimeline(['screen_name' => env('TWITTER_ID'), 'count' => $count, 'format' => 'json']));
    }

    private function decode($stuff)
    {
        return json_decode($stuff);
    }
}
