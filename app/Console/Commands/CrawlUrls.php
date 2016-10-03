<?php

namespace App\Console\Commands;

use App\Monitor;
use App\Url;
use Arachnid\Crawler;
use Illuminate\Console\Command;

class CrawlUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor:crawl 
                            {monitor : The ID of the monitor}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Grab all URLs for given monitor and save them into database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $monitor = Monitor::findOrFail($this->argument('monitor'));

        $this->table(['URL'], [[$monitor->url]]);

        $this->grabUrls($monitor);
    }

    /**
     * @param Monitor $monitor
     */
    private function grabUrls(Monitor $monitor)
    {
        $crawler = new Crawler($monitor->url, 2);
        $crawler->traverse();

        // Get link data
        $links = $crawler->getLinks();

        $plain_links = [];

        foreach ($links as $link => $data) {
            if (!isset($data['absolute_url']) || $data['absolute_url'] == "") continue;

            $plain_links[] = [$data['absolute_url']];

            // insert or update URL in database
            Url::firstOrCreate(['url' => $data['absolute_url'], 'monitors_id' => $monitor->id]);
        }

        $this->table(['URL'], $plain_links);
    }
}
