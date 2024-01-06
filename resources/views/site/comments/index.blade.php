<div class="container my-5 py-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-11 col-xl-8">
            <div class="border border-3 rounded-3">
                <div class="border border-3 rounded-3 p-4">
                    <h4 class="text-center mb-4 pb-2">نظرات</h4>
                    <div class="row">
                        <div class="col" id="commentBox">
                            <div class="d-flex flex-start mt-4">
                                <div class="spinner-grow text-primary m-2 p-4" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <div class="spinner-grow text-primary m-2 p-4" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-3 border-0" style="background-color: #f8f9fa;">
                <form action="" method="post" id="commentForm">
                    @csrf
                    <div class="d-flex flex-start w-100">
                        <i class="fa-regular fa-user fa-2x shadow-lg h-100 m-3"></i>
                        <div class="form-outline w-100">
                            <label class="form-label" for="textAreaExample">نام:</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <label class="form-label" for="textAreaExample">متن کامنت:</label>
                            <textarea class="form-control px-5" id="commentText" rows="4"></textarea>
                            <input type="hidden" name="parent_id" id="parent_id" value="0">
                        </div>
                    </div>
                    <div class="px-5 mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
