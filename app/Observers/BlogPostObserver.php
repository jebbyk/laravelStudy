<?php

namespace App\Observers;

use App\Models\BlogPost;
use Carbon\Carbon;

class BlogPostObserver
{

    public function updating(BlogPost $blogPost)
    {
        // $test[] = $blogPost->isDirty();//has changes?
        // $test[] = $blogPost->isDirty('is_published');
        //$test[] = $blogPost->isDirty('user_id');
        //$test[] = $blogPost->getAttribute('is_published')//
        //$test[] = $blogPost->is_published;
        //$test[] = $blogPost->getOriginal('is_published');//get attribute from DB
        $this->setPublishedAt($blogPost);

        $this->setSlug($blogPost);


    }

    protected function setPublishedAt(BlogPost $blogPost)
    {
        if(empty($blogPost->published_at) && $blogPost->is_published)
        {
            $blogPost->published_at = Carbon::now();//curent time
        }
    }

    protected function setSlug(BlogPost $blogPost)
    {
        //dd($blogPost);

        if(empty($blogPost->slug)){
            $blogPost->slug = str_slug($blogPost->title);
        }
    }

    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHtml($blogPost);
        $this->setUser($blogPost);
    }

    protected function setHtml(BlogPost $blogPost)
    {
        if($blogPost->isDirty('content_raw')){
            //TODO generate md -> html
            $blogPost->content_html = $blogPost->content_raw;
        }
    }

    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }

    /**
     * Handle the models blog post "created" event.
     *
     * @param  \App\Models\BlogPost  $modelsBlogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the models blog post "updated" event.
     *
     * @param  \App\Models\BlogPost  $modelsBlogPost
     * @return void
     */
    public function updated(BlogPost $blogPost)
    {
        //

    }

    /**
     * Handle the models blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $modelsBlogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the models blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $modelsBlogPost
     * @return void
     */
    public function restored(BlogPost $mblogPost)
    {
        //
    }

    /**
     * Handle the models blog post "force deleted" event.
     *
     * @param  \App\Models\logPost  $modelsBlogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
