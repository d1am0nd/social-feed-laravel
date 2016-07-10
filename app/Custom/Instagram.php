<?php

namespace App\Custom;

use Exception;

class Instagram implements SocialInterface
{

    public function __construct()
    {
        
    }

    public function getLastFromFeed()
    {
        return $this->getPageFeed()[0];
    }

    private function getPageFeed()
    {
        $userUrl = 'https://api.instagram.com/v1/users/' . env('INSTAGRAM_ID', 'self') . '/media/recent/?access_token=' . env('INSTAGRAM_ACCESS_TOKEN', '');

        try{
            $result = $this->decode(file_get_contents($userUrl))->data;
        } catch(Exception $e) {
            throw new Exception('There was a problem getting Instagram feed');
        }

        return $result;
    }

    private function decode($stuff)
    {
        return json_decode($stuff);
    }
}
