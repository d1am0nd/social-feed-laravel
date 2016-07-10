<?php

namespace App\Custom;

use Cache;
use App\Custom\Twitter;
use App\Custom\Facebook;
use App\Custom\Instagram;
use App\Custom\TwitterFeed;
use App\Custom\FacebookFeed;
use App\Custom\InstagramFeed;
use App\Custom\SocialInterface;

class FeedFactory
{
    public static function create($social, $id, $name = null)
    {
        if($social == 'facebook') {
            $json = self::fetchJson(Facebook::class, $social, $id);
            return new FacebookFeed($json, $name);
        } elseif($social == 'twitter') {
            $json = self::fetchJson(Twitter::class, $social, $id);
            return new TwitterFeed($json);
        } elseif($social == 'instagram') {
            $json = self::fetchJson(Instagram::class, $social, $id);
            return new InstagramFeed($json);
        } else {
            return null;
        }
    }

    /**
     * $social = path to social class
     * $cacheKey = key for cached json
     * 
     * Checks if json is already cached, else 
     * it fetches a new one and caches it.
     */
    private static function fetchJson($social, $cacheKey, $id) {
        $json = Cache::get($cacheKey);
        if(is_null($json)) {
            $parameters = ['id' => $id];
            $socObj = app($social, ['id' => $id]); // Resolve social class dependencies and create an instance
            $json = $socObj->getLastFromFeed(); // Gets last item from feed (json)
            Cache::put($cacheKey, $json, 5); // Caches the new json
        }
        return $json;
    }
}
