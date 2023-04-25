<div class="w-full md:flex flew-row md:space-x-2 items-center justify-center">
    <ul class="w-full md:w-fit md:flex flew-col md:space-x-2 ">
        @foreach ($categories as $category)
            <x-category-item :item="$category"></x-category-item>
        @endforeach
    </ul>
</div>
