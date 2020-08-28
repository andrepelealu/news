<?php namespace MissionControl\News\Modules\News\Presenters;

use Karl456\Presenter\Presenter;

/**
 * Class NewsPresenter
 * @package MissionControl\News\Modules\News\Presenters
 */
class NewsPresenter extends Presenter
{
    /**
     * @return mixed|string
     */
    public function getSlug()
    {
        return '/' . config('news.slug', 'news') . '/' . $this->slug;
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed|string
     */
    public function getPublished()
    {
        if($this->published == true) {
            return 'Published';
        }
        return 'Hidden';
    }

    /**
     * @return string
     */
    public function getPublishedLabel()
    {
        if($this->published == true) {
            return '<span class="label success">Published</span>';
        }
        return '<span class="label alert">Hidden</span>';
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getMetaTitle()
    {
        if($this->meta_title == '') {
            return $this->title;
        }

        return $this->meta_title;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        if($this->meta_description == '') {
            return strip_tags($this->summary);
        }

        return $this->meta_description;
    }

    /**
     * @return mixed
     */
    public function getMetaCanonical()
    {
        if($this->meta_canonical != '') {
            return $this->meta_canonical;
        }
        return url()->current();
    }

    /***
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at->format('d/m/Y - g:i A');
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at->format('d/m/Y - g:i A');
    }

    /**
     * @return mixed
     */
    public function getDeletedAt()
    {
        return $this->deleted_at->format('d/m/Y - g:i A');
    }
}
