<div class="row g-0">
    <div class="col-lg-12">
        <div class="row g-0 pt-2 pb-2 bg-secondary">
            <div class="col-lg-12 d-flex justify-content-center align-items-center ">
                <div class="row g-0">
                    <div class="col-lg-12 d-flex justify-content-center align-items-center">
                        <ul class="nav flex-column flex-md-row category-pills">
                            @foreach($categories as $category)
                            <x-category-item :item="$category"></x-category-item>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
