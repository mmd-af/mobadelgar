<div class="sticky-bottom">
    <input type="checkbox" id="check">
    <label class="chat-btn" for="check">
        <a class="" data-bs-toggle="offcanvas" href="#noteOffcanvas" role="button" aria-controls="offcanvasExample">
            <i class="fa-solid fa-book mt-2"></i>
        </a>
    </label>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="noteOffcanvas" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">یادداشت ها</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <div class="card border-primary m-3">
                <div class="card-body">
                    <p class="card-text">
                        <strong>
                     طراحی زیبا و منحصر به فرد برای کسانی که قدرش را بدانند :))
                        </strong>
                    </p>
                </div>
                <div class="d-flex justify-content-between m-3">
                    <p>نویسنده: محمد افشار</p>
                    <p>تاریخ: 1402/05/07</p>
                    <i class="fa-solid fa-trash-can text-danger fa-lg mt-2"></i>
                </div>
            </div>

            <div class="form-control mt-5">
                <textarea name="description" class="form-control" id="" cols="30" rows="3" placeholder="یادداشت جدید بنویسید..."></textarea>
                <button type="submit" class="btn btn-success mt-2">ثبت</button>
            </div>
        </div>
    </div>
</div>
