<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Arr;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        // update the status of each related vendor to be the same as the main_category status
        if(Arr::exists($category->getChanges(), 'active')){
            $vendors = $category->vendors;
            foreach($vendors as $vendor){
                $vendor->update(['active' => $category->active]);
            }
        }
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
