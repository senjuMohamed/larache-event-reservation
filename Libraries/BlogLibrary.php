<?php namespace App\Libraries;

use Jenssegers\Date\Date;
use stdClass;

class BlogLibrary
{
    public function reformatBlogList($rawBlogs)
    {
        $blogs = [];

        foreach ($rawBlogs['body'] as $rawBlog) {
            $blogs[] = $this->reformatSingleBlog($rawBlog);
        }

        return [
            'data' => $blogs,
            'meta' => ['number_of_posts' => $rawBlogs['headers']['X-WP-Total'][0]]
        ];
    }

    public function reformatSingleBlog($rawBlog)
    {
        $blog = new stdClass;

        $blog->id = $rawBlog['id'];
        $blog->title = $rawBlog['title']['rendered'];
        $blog->slug = $rawBlog['slug'];
        $blog->date = Date::createFromFormat('Y-m-d\TH:i:s', $rawBlog['date']);
        $blog->excerpt = $rawBlog['excerpt']['rendered'];
        $blog->content = (new UtilLibrary)->reformatContent($rawBlog['content']['rendered']);
        $blog->seo_title = str_replace([' %%sep%%', ' %%sitename%%'], '', $rawBlog['meta']['_yoast_wpseo_title'][0] ?? $rawBlog['title']['rendered']);
        $blog->meta_description = $rawBlog['meta']['_yoast_wpseo_metadesc'][0] ?? null;
        $blog->author = $rawBlog['_embedded']['author'][0];
        $blog->featured_media = (new ImageLibrary)->reformatFeaturedImage($rawBlog['_embedded']['wp:featuredmedia'][0]);

        $categories = [];
        $tags = [];

        foreach ($rawBlog['_embedded']['wp:term'] as $items) {
            foreach ($items as $item) {
                if ($item['taxonomy'] == 'category') {
                    $categories[] = $item;
                } elseif ($item['taxonomy'] == 'post_tag') {
                    $tags[] = $item;
                }
            }
        }

        $blog->categories = $categories;
        $blog->tags = $tags;

        $comments = [];
        if (isset($rawBlog['_embedded']['replies'][0])) {
            $comments = (new CommentLibrary)->getComments($rawBlog['_embedded']['replies'][0]);
        }

        $blog->comments = $comments;

        return $blog;
    }
}
