<div class="row">
    <div class="small-12 medium-8 columns">
        <div class="content-block">
            <p class="content-block-title">Article Content</p>
            <div class="content">
                {!! Form::textarea('content', null, ['class' => 'advanced-editor ' . $errors->first('content', 'is-invalid-input'), 'rows' => '30']) !!}
            </div>
        </div>
    </div>
    <div class="small-12 medium-4 columns">
        <div class="content-block">
            <p class="content-block-title">Article Details</p>
            <div class="row">
                <div class="small-12 columns">
                    {!! Form::label('published', 'Published', ['class' => $errors->first('published', 'is-invalid-label')])!!}
                    {!! Form::select('published', ['1' => 'Published', '0' => 'Hidden'], null, ['class' => $errors->first('published', 'is-invalid-input')])!!}
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    {!! Form::label('title', 'Title', ['class' => $errors->first('title', 'is-invalid-label')])!!}
                    {!! Form::text('title', null, ['class' => $errors->first('title', 'is-invalid-input')]) !!}
                    {!! $errors->first('title', '<span class="form-error is-visible">:message</span>' ) !!}
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    {!! Form::label('feature_image', 'Feature Image', ['class' => $errors->first('feature_image', 'is-invalid-label')])!!}
                    <div class="input-group">
                        {!! Form::text('feature_image', null, ['class' => 'input-group-field ' . $errors->first('feature_image', 'is-invalid-input')]) !!}
                        <div class="input-group-button">
                            <input type="submit" class="button black moxie-image-browse" data-moxie-field="feature_image" value="Browse">
                        </div>
                    </div>
                    {!! $errors->first('feature_image', '<span class="form-error is-visible">:message</span>') !!}
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    {!! Form::label('published_date', 'Published Date', ['class' => $errors->first('published_date', 'is-invalid-label')])!!}
                    {!! Form::text('published_date', (isset($article) ? $article->published_date->format('d/m/Y') : null), ['class' => 'datepicker ' . $errors->first('published_date', 'is-invalid-input')]) !!}
                    {!! $errors->first('published_date', '<span class="form-error is-visible">:message</span>' ) !!}
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    {!! Form::label('author_id', 'Author', ['class' => $errors->first('author_id', 'is-invalid-label')])!!}
                    {!! Form::select('author_id', ['' => 'No Author'] + $authors->pluck('first_name', 'id')->toArray(), null, ['class' => $errors->first('author_id', 'is-invalid-input')]) !!}
                    {!! $errors->first('author_id', '<span class="form-error is-visible">:message</span>' ) !!}
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    {!! Form::label('summary', 'Summary', ['class' => $errors->first('summary', 'is-invalid-label')]) !!}
                    {!! Form::textarea('summary', null, ['class' => 'basic-editor ' . $errors->first('summary', 'is-invalid-input'), 'rows' => 5]) !!}
                    {!! $errors->first('summary', '<span class="form-error is-visible">:message</span>' ) !!}
                </div>
            </div>
        </div>
        @if($newscategories->count() > 0)
            <div class="content-block">
                <p class="content-block-title">Categories</p>
                <div class="content">
                    <div class="row small-up-1 medium-up-2">
                        @foreach($newscategories as $newscategory)
                            <div class="column">
                                {!! Form::checkbox('categories[]', $newscategory->id, null, ['id' => 'newscategory-' . $newscategory->id]) !!}
                                {!! Form::label('newscategory-' . $newscategory->id, $newscategory->name) !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="content-block">
            <p class="content-block-title">Search Engine Data <a href="#" class="expand-collapse collapsed" id=""></a>
            </p>
            <div class="content" style="display:none;">
                <div class="row">
                    <div class="small-12 columns">
                        {!! Form::label('meta_title', 'Meta Title', ['class' => $errors->first('meta_title', 'is-invalid-label')])!!}
                        {!! Form::text('meta_title', null, ['class' => $errors->first('meta_title', 'is-invalid-input')]) !!}
                        {!! $errors->first('meta_title', '<span class="form-error is-visible">:message</span>' ) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        {!! Form::label('meta_description', 'Meta Description', ['class' => $errors->first('meta_description', 'is-invalid-label')])!!}
                        {!! Form::text('meta_description', null, ['class' => $errors->first('meta_description', 'is-invalid-input')]) !!}
                        {!! $errors->first('meta_description', '<span class="form-error is-visible">:message</span>' ) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        {!! Form::label('slug', 'Slug', ['class' => $errors->first('slug', 'is-invalid-label')])!!}
                        {!! Form::text('slug', null, ['class' => $errors->first('slug', 'is-invalid-input')]) !!}
                        {!! $errors->first('slug', '<span class="form-error is-visible">:message</span>' ) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        {!! Form::label('meta_canonical', 'Canonical Tag', ['class' => $errors->first('meta_canonical', 'is-invalid-label')])!!}
                        {!! Form::text('meta_canonical', null, ['class' => $errors->first('meta_canonical', 'is-invalid-input')]) !!}
                        {!! $errors->first('meta_canonical', '<span class="form-error is-visible">:message</span>' ) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="button-block text-right">
    <div class="row">
        <div class="small-12 columns">
            {!! Form::submit($submit, ['class' => 'button success']) !!}
        </div>
    </div>
</div>