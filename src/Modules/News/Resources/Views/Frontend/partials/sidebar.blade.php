<div id="categories-archive-sidebar">
    <div id="news-categories">
        <h3>Categories</h3>
        <ul>
            <li><a href="{{ route(config('news.slug', 'news') . '.index') }}">All Categories</a></li>
            @foreach($newscategories as $newscategory)
                <li>
                    <a href="{{ $newscategory->present()->getSlug }}">{{ $newscategory->present()->getName }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <div id="news-archive">
        <h3>Archive</h3>
        <ul class="accordion" data-accordion>
            @foreach($archive as $year => $months)
                <li class="accordion-item {{ ($loop->first ? 'is-active' : '') }}" data-accordion-item>
                    <a href="#" class="accordion-title">{{ $year }}</a>
                    <div class="accordion-content" data-tab-content>
                        <ul>
                            @foreach($months as $month)
                                <li><a href="{{ route(config('news.slug', 'news') . '.archive', [$year, $month->month_name]) }}">{{ $month->month_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>