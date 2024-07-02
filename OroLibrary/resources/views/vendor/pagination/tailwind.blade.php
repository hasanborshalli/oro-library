@if ($paginator->hasPages())
    <nav style="padding-bottom:20px;" role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div style="display:flex; gap:80%;width:100%;" >
            @if ($paginator->onFirstPage())
                <span style="width:200px;height:40px;padding:10px;font-size:25px;border-radius:15px; color:black; background-color:#cff8ff" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                    Prev
                </span>
            @else
                <a style="width:200px;height:40px;padding:10px;font-size:25px;border-radius:15px; color:blue; background-color:#cff8ff" href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                    Prev
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a style="width:200px;height:40px;padding:10px;font-size:25px;border-radius:15px; color:blue; background-color:#cff8ff" href="{{ $paginator->nextPageUrl() }}"  class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                    Next
                </a>
            @else
                <span style="width:200px;height:40px;padding:10px;font-size:25px;border-radius:15px; color:black; background-color:#cff8ff" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                    Next
                </span>
            @endif
        </div>

        
    </nav>
@endif
