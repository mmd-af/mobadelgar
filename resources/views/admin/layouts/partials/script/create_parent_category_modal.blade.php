<div class="modal fade" id="createParentCategory" tabindex="-1" aria-labelledby="createParentCategoryLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h1 class="modal-title fs-5" id="createParentCategoryLabel">Create Parent Category</h1>
            </div>
            <div class="modal-body">
                @include('admin.layouts.partials.errors')
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title">نام دسته بندی:</label>
                            <input class="form-control" id="title" name="title" type="text"
                                   value="{{ old('title') }}">
                        </div>
                        <div class="form-group mt-4">
                            <label for="slug">نام دسته بندی به انگلیسی:</label>
                            <input class="form-control" id="slug" name="slug" type="text"
                                   value="{{ old('slug') }}">
                        </div>
                        <div class="form-group mt-4">
                            <div class="input-group">
          <span class="input-group-append">
            <a id="create" data-input="image1" data-preview="holder" class="btn btn-primary text-white">
               انتخاب
            </a>
          </span>
                                <input type="text" id="image1" class="form-control" name="url" value="{{ old('url') }}">
                            </div>
                            <div class="text-center mt-5" id="holder" style="max-height:150px;">
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="is_active">وضعیت</label>
                            <select class="form-control" id="is_active" name="is_active">
                                <option value="1" selected>فعال</option>
                                <option value="0">غیرفعال</option>
                            </select>
                        </div>
                        <div class="form-group mt-4 text-center">
                            <input id="parent_id" name="parent_id" type="hidden" value="0">
                            <button class="btn btn-success px-5" type="submit">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
