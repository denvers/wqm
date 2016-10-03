<?php

namespace App;

use Arachnid\Crawler;
use Illuminate\Database\Eloquent\Model;
use HtmlValidator\Validator;

class QualityCheck extends Model
{
    public function run(Monitor $monitor)
    {
        switch ($this->id) {
            case 1:
                return $this->returnsHttp200($monitor);
                break;
            case 2:
                return $this->randomUrlReturns404($monitor);
                break;
            case 3:
                return $this->nonWwwRedirectsToWww($monitor);
                break;
            case 4:
                return $this->robotsTxtExists($monitor);
                break;
            case 5:
                return $this->faviconExists($monitor);
                break;
            case 6:
                return $this->htmlIsValid($monitor);
                break;
        }
    }

    /**
     * @param Monitor $monitor
     * @return bool
     */
    private function returnsHttp200(Monitor $monitor)
    {
        $crawler = new Crawler($monitor->url, 1);
        $crawler->traverse();

        // Get link data
        $links = $crawler->getLinks();

        if (isset($links[$monitor->url]) && $links[$monitor->url]['status_code'] == 200) {
            return '√';
        } else {
            return 'fail :(';
        }
    }

    /**
     * @param Monitor $monitor
     * @return string
     */
    private function randomUrlReturns404(Monitor $monitor)
    {
        $random_url = $monitor->url . "/" . str_random(16);

        $crawler = new Crawler($random_url, 1);
        $crawler->traverse();

        // Get link data
        $links = $crawler->getLinks();

        if (isset($links[$random_url]) && $links[$random_url]['status_code'] == 404) {
            return '√';
        } else {
            return 'fail :(';
        }
    }

    /**
     * @param Monitor $monitor
     * @return string
     */
    private function nonWwwRedirectsToWww(Monitor $monitor)
    {
        $url_parsed = parse_url($monitor->url);
        if (substr($url_parsed['host'], 0, 4) == "www.") {
            // This one is a www. URL
            $nonwww = $url_parsed['scheme'] . "://" . substr($url_parsed['host'], 4, strlen($url_parsed['host'])) . @$url_parsed['path'];

            $crawler = new Crawler($nonwww, 1);
            $crawler->traverse();

            // Get link data
            $links = $crawler->getLinks();

            return 'Non-www returns ' . $links[$nonwww]['status_code'];

        } else {
            // This one is NOT a www.URL
            return 'This one is not a www. URL.';
        }
    }

    /**
     * @param Monitor $monitor
     * @return string
     */
    private function robotsTxtExists(Monitor $monitor)
    {
        $robotsurl = $monitor->url . "/robots.txt";
        $crawler = new Crawler($robotsurl, 1);
        $crawler->traverse();

        // Get link data
        $links = $crawler->getLinks();

        if ( $links[$robotsurl]['status_code'] == 200 ) {
            return "√";
        } else {
            return "HTTP " . $links[$robotsurl]['status_code'];
        }
    }

    /**
     * @param Monitor $monitor
     * @return string
     */
    private function faviconExists(Monitor $monitor)
    {
        $robotsurl = $monitor->url . "/favicon.ico";
        $crawler = new Crawler($robotsurl, 1);
        $crawler->traverse();

        // Get link data
        $links = $crawler->getLinks();

        if ( $links[$robotsurl]['status_code'] == 200 ) {
            return "√";
        } else {
            return "HTTP " . $links[$robotsurl]['status_code'];
        }
    }

    private function htmlIsValid(Monitor $monitor)
    {
        return "Not implemented";

//        $validator_url = "https://validator.w3.org/nu/?doc=" . urlencode($monitor->url) . "&out=json";
//        dump($validator_url);
//        $results = file_get_contents($validator_url);
//        dd(json_encode($results));
//
//        if ( true ) {
//            return "x";
//        } else {
//            return "√";
//        }
    }
}
