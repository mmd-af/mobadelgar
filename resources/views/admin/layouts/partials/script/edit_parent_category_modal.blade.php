<div class="modal fade" id="editParentCategory" tabindex="-1" aria-labelledby="editParentCategoryLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h1 class="modal-title fs-5" id="editParentCategoryLabel">Edit Parent Category</h1>
            </div>
            <div class="modal-body">
                <div id="show_alert"></div>
                <form action="#" method="POST" onsubmit="event.preventDefault();updateCategoryForm()"
                      id="editCategoryForm">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="title">نام دسته بندی:</label>
                            <input class="form-control" id="title" name="title" type="text"
                                   value="">
                        </div>
                        <div class="form-group mt-4">
                            <label for="slug">نام دسته بندی به انگلیسی:</label>
                            <input class="form-control" id="slug" name="slug" type="text"
                                   value="" disabled>
                        </div>
                        <div class="form-group mt-4">
                            <label for="image">تصویر:</label>
                            <div class="input-group">
          <span class="input-group-append">
            <a id="edit" data-input="image" data-preview="holder1" class="btn btn-primary text-white">
               انتخاب
            </a>
          </span>
                                <input type="text" id="image" class="form-control" name="url" value="">
                            </div>
                            <div class="text-center mt-5" id="holder1" style="max-height:150px;">
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
                            <input type="hidden" name="category_id" id="category_id" value="">
                            <input type="hidden" name="parent_id" id="parent_id" value="0">
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
