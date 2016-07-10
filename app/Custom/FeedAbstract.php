<?php 

namespace App\Custom;

abstract class FeedAbstract {

    abstract public function getTimestamp();

    abstract public function getMessage();

    abstract public function getSocialNetworkName();

    abstract public function getUserName();

    abstract public function getUrl();

    public function getArray() {
        $ts = $this->getTimestamp()->tz('Europe/Ljubljana');
        $message = $this->getMessage();
        $user = $this->getUserName();
        $social = $this->getSocialNetworkName();
        $url = $this->getUrl();

        return array(
            'timestamp' => $ts->timestamp,
            'pretty_time' => $ts->format('j.n.y') . ' ob ' . $ts->format('H:i'),
            'message' => $message,
            'user' => $user,
            'url' => $url,
            'social_network' => $social
        );
    }
}