<?php
use App\Models\Language;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

if(!function_exists('get_languages'))
{
    /**
     * @return mixed
     */
    function get_languages()
    {
        $languages = Language::active()->get();
        return $languages;
    }
}
if(!function_exists('get_default_language'))
{
    /**
     * @return string
     */
    function get_default_language():string
    {
        return app()->getLocale();
    }
}

if(!function_exists('slugify'))
{
    /**
     * @param $text
     * @return string
     */
    function slugify($text):string
    {
        return str_replace(' ', '-', $text);
    }
}

if(!function_exists('changeStatus'))
{
    /**
     * @param $resource
     * @return string
     */
    function changeStatus($resource) :string{
        $deactivate = $resource->is_active? "إلغاء" : "";
        $resource->is_active = !$resource->is_active;
        $resource->save();
        return sprintf('تم %s التفعيل بنجاح.', $deactivate);
    }
}


if(!function_exists('saveFile')){
     function saveFile(UploadedFile $file, $disk='public'):string
     {
        $path = $file->store('/', $disk);
        return basename($path);
    }
}
if(!function_exists('getFilePublicURL'))
{
    function getFilePublicURL($file_name, $disk='public'):string {
        return Storage::disk($disk)->url($file_name);
    }
}
if(!function_exists('deleteFile'))
{
    /**
     * @param $file_name
     * @param string $disk
     * @return void
     */
    function deleteFile($file_name, string $disk='public'):void
    {
        Storage::disk($disk)->delete($file_name);
    }
}
if(!function_exists('fileExists'))
{
    function fileExists($file_name, $disk='public'):bool
    {
        return Storage::disk($disk)->exists($file_name);
    }
}

