<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Arr;

class MainCategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $main_category): void
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $main_category): void
    {
        // update the status of each related vendor to be the same as the main_category status
        if(Arr::exists($main_category->getChanges(), 'active')){
            $vendors = $main_category->vendors;
            foreach($vendors as $vendor){
                $vendor->update(['active' => $main_category->active]);
            }
        }
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $main_category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $main_category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $main_category): void
    {
        //
    }
}
