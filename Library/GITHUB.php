<?php

require_once('./Library/Github/vendor/autoload.php'); //autoload do composer

class GITHUB {

    static $github_personal_token = "faa9c479f5ec61e1d1381c7d38e0385e3cfd3f3b";

    static function get_opened_issues() {
        $client = new \Github\Client();
        $client->authenticate(self::$github_personal_token, null, \Github\Client::AUTH_URL_TOKEN);
        $issues = $client->currentUser()->issues(array("state" => "opened", "since" => "2019-03-27T00:00:00Z"));
        return $issues;
    }

    static function get_closed_issues() {
        $client = new \Github\Client();
        $client->authenticate(self::$github_personal_token, null, \Github\Client::AUTH_URL_TOKEN);
        $issues = $client->currentUser()->issues(array("state" => "closed", "since" => "2019-03-27T00:00:00Z"));
        return $issues;
    }

    static function count_issues() {
        $client = new \Github\Client();
        $client->authenticate(self::$github_personal_token, null, \Github\Client::AUTH_URL_TOKEN);
        $issues = $client->currentUser()->issues();
        return count($issues);
    }

}
