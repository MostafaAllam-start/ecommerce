<form class="form" action="{{route('admin.test.store_photo')}}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label> photo </label>
        <label id="projectinput7" class="file center-block">
            <input type="file" id="file" name="photo">
            <span class="file-custom"></span>
        </label>
        @error('photo')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-body">
        <div class="form-actions">
            <button type="button" class="btn btn-warning mr-1"
                    onclick="history.back();">
                <i class="ft-x"></i> تراجع
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="la la-check-square-o"></i> حفظ
            </button>
        </div>

    </div>
</form>
