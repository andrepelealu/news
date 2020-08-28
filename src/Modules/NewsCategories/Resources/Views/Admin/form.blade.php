<div class="row">
    <div class="small-12 medium-6 columns">
        <div class="content-block">
            <p class="content-block-title">Category Details</p>
            <div class="content">
                <div class="row">
                    <div class="small-12 columns">
                        {!! Form::label('published', 'Available on the website?', ['class' => $errors->first('published', 'is-invalid-label')])!!}
                        {!! Form::select('published', ['1' => 'Published', '0' => 'Hidden'], null, ['class' => $errors->first('published', 'is-invalid-input')])!!}
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        {!! Form::label('name', 'Name', ['name' => $errors->first('name', 'is-invalid-label')])!!}
                        {!! Form::text('name', null, ['class' => $errors->first('name', 'is-invalid-input')]) !!}
                        {!! $errors->first('name', '<span class="form-error is-visible">:message</span>' ) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="small-12 medium-6 columns">
        <div class="content-block">
            <p class="content-block-title">Search Engine Data </p>
            <div class="content">
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
