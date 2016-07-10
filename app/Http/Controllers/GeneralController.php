<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cache;
use App\Http\Requests;
use App\Custom\FeedFactory;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class GeneralController extends Controller
{

    public function getFb()
    {
        $feed = FeedFactory::create('facebook', env('FACEBOOK_ID'), env('FACEBOOK_DISPLAY_NAME'));
        return $feed->getArray();
    }

    public function getTw()
    {
        $feed = FeedFactory::create('twitter', env('TWITTER_ID'));
        return $feed->getArray();
    }

    public function getInsta()
    {
        $feed = FeedFactory::create('instagram', env('INSTAGRAM_ID'));
        return $feed->getArray();
    }

    public function getFeed()
    {
        $fbFeed = FeedFactory::create('facebook', env('FACEBOOK_ID'), env('FACEBOOK_DISPLAY_NAME'));
        $twFeed = FeedFactory::create('twitter', env('TWITTER_ID'));
        $instaFeed = FeedFactory::create('instagram', env('INSTAGRAM_ID'));

        /**
         * Create collection of all 3 feeds
         * and sort it by timestamp. 
         * Newest first
         */
        $feeds = collect([
            $fbFeed->getArray(),
            $twFeed->getArray(),
            $instaFeed->getArray()
        ])->sortByDesc('timestamp')->values()->all();

        return view('master', compact('feeds'));
    }

    public function checkCache()
    {
        $return = [
            'twitter' => Cache::has('twitter'),
            'facebook' => Cache::has('facebook'),
            'instagram' => Cache::has('instagram')
        ];

        return $return;
    }
}
