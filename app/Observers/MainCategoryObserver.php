<?php

namespace App\Observers;

use App\Models\MainCategory;
use Illuminate\Support\Arr;

class MainCategoryObserver
{
    /**
     * Handle the MainCategory "created" event.
     */
    public function created(MainCategory $main_category): void
    {
        //
    }

    /**
     * Handle the MainCategory "updated" event.
     */
    public function updated(MainCategory $main_category): void
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
     * Handle the MainCategory "deleted" event.
     */
    public function deleted(MainCategory $main_category): void
    {
        //
    }

    /**
     * Handle the MainCategory "restored" event.
     */
    public function restored(MainCategory $main_category): void
    {
        //
    }

    /**
     * Handle the MainCategory "force deleted" event.
     */
    public function forceDeleted(MainCategory $main_category): void
    {
        //
    }
}
