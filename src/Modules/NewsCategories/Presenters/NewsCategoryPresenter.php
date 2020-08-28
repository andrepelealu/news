<?php namespace MissionControl\News\Modules\NewsCategories\Presenters;

use Karl456\Presenter\Presenter;

/**
 * Class NewsCategoryPresenter
 * @package MissionControl\News\Modules\NewsCategories\Presenters
 */
class NewsCategoryPresenter extends Presenter
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
    public function getMetaTitle()
    {
        if($this->meta_title != '') {
            return $this->meta_title;
        }
        return $this->getName() . ' ' . config('news.name', 'News') . ' Articles';
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        if($this->meta_description != '') {
            return $this->meta_description;
        }
        return 'All ' . $this->getName() . ' ' . config('news.name', 'News') . ' Articles';
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
