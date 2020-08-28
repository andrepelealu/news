<div class="row align-right">
	<div class="small-12 medium-5 large-3 columns">
		<div id="search-block" style="position: relative;">
			{!! Form::select('news', [], null, ['id' => 'news']) !!}
		</div>
	</div>
	<div class="small-12 medium-2 large-6 columns">&nbsp;</div>
	<div class="small-12 medium-5 large-3 columns">
		<select id="filter" name="filter">
			<option value=" " {{ request()->is('news') ? 'selected' : '' }}>All Articles</option>
			<option value="deleted" {{ request()->input('filter') == 'deleted' ? 'selected' : ''}}>Deleted Articles</option>
		</select>
	</div>
</div>