<?php namespace App\Libraries;

use GuzzleHttp\Client;
use DB;
use Cache;

class RequestLibrary
{
    public function __construct()
    {
        $this->token = DB::table('WpAuth')->first()->access_token;
        $this->client = new Client();
        $this->params = [
            'headers' => [
                'Authorization' => 'Bearer '.$this->token,
                'Accept' => 'application/json'
            ]
        ];
    }

    public function getData($url, $type = null)
    {
        $url = config('services.wp_api.url').'/wp-json/wp/v2/'.$url;
        $cacheKey = md5($url);

        return Cache::remember($cacheKey, 86400, function() use ($url, $type) {

            try {
                $response = $this->client->request('GET', $url, $this->params);
                $body = $response->getBody()->getContents();
                $data = [
                    'body' => json_decode($body, true),
                    'headers' => $response->getHeaders()
                ];

                if ($type == 'post') {
                    return (new BlogLibrary)->reformatBlogList($data);
                } elseif ($type == 'page') {
                    return (new PageLibrary)->reformatPage($data);
                }
                return $data;

            } catch (\Exception $e) {
                abort(500, $e->getMessage());
            }
        });
    }
}
