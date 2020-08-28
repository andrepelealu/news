<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Eyeweb\MissionControl\Modules\Pages\Models\Page;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('news', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->nullable();
            $table->boolean('published')->default(0);
            $table->string('title');
            $table->string('slug');
            $table->string('feature_image');
            $table->text('summary');
            $table->text('content');
            $table->date('published_date');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_canonical')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Page::create([
            'pagetemplate_id' => 2,
            'slug' => 'news',
            'title' => 'News',
            'is_module' => true,
            'published' => true
        ]);
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop('news');
    }
}
