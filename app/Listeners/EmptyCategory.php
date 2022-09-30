<?php

namespace App\Listeners;

use App\Models\Category;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmptyCategory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle()
    {
    //    $category=new Category();
    //    $category->name="majed";
    //    $category->save();
    Category::empty();
    }
}
