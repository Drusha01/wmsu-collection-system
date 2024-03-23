<div>
    <main class="p-9 sm:ml-64 pt-20 sm:pt-8 h-auto">
        <div class="px-6 py-8 bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            <ol class="relative border-s border-gray-200 dark:border-gray-700">                  
                @foreach($system_logs as $key =>$value)
                <li class="mb-2 ms-2">            
                    <!-- <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                    </span> -->
                    <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:bg-gray-700 dark:border-gray-600">
                        <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{date_format(date_create($value->date_created),"M d, Y h:i a")}}</time>
                        <div class="text-sm font-normal text-gray-500 dark:text-gray-300">
                            <a href="{{$value->link}}" class="font-semibold text-blue-600 dark:text-blue-500 hover:underline">
                                ({{$value->username}}) - {{$value->first_name.' '.$value->middle_name.' '.$value->last_name}}
                                {{$value->log_details}}
                            </a>
                        </div>
                    </div>
                </li>
               @endforeach 
            </ol>

        </div>
        <div class="row my-2"></div>
        {{ $system_logs->links() }}
    </main>
</div>
