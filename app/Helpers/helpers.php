<?php
use App\Models\Language;
if(!function_exists('get_languages')){
    function get_languages(){
        $languages = Language::active()->get();
        return $languages;
    }
}
if(!function_exists('get_default_language')){
    function get_default_language(){
        return app()->getLocale();
    }
}

if(!function_exists('slugify')){
    function slugify($text){
        return str_replace(' ', '-', $text);
    }
}

if(!function_exists('changeStatus')){
    function changeStatus($resource) :string{
        $deactivate = $resource->active? "إلغاء" : "";
        $resource->active = !$resource->active;
        $resource->save();
        return sprintf('تم %s التفعيل بنجاح.', $deactivate);
    }
}
