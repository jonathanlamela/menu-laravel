 <ul class="w-full md:flex flew-row md:space-x-2 items-center justify-center">
     @foreach ($categories as $category)
         <li class="w-full md:w-auto flex items-center justify-center py-2">
             @if (Str::endsWith(url()->current(), $category->slug))
                 <a href={{ route('category.show', ['category' => $category]) }}
                     class="text-white p-4 hover:bg-slate-600 w-full text-center mx-4 md:mx-0 bg-red-900 border border-slate-50/5">{{ $category->name }}</a>
             @else
                 <a href={{ route('category.show', ['category' => $category]) }}
                     class="text-white p-4 hover:bg-slate-600 w-full text-center mx-4 md:mx-0">{{ $category->name }}</a>
             @endif
         </li>
     @endforeach
 </ul>
