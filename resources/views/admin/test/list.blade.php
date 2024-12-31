@forelse($files as $file)
    <div><img src="{{$file}}"/></div>
    <div>name:{{\Illuminate\Support\Str::after($file , 'brands/')}}</div>
    <a href="{{route('admin.test.delete_photo', \Illuminate\Support\Str::after($file, 'brands/'))}}">delete</a>
@empty
    <div>empty</div>
@endforelse
