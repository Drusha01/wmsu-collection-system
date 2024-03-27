<div>
    <main class="p-9 sm:ml-64 pt-20 sm:pt-8 h-auto">
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-1">
            <div class="mx-5 px-3 ">
                <!-- Start coding here -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <!-- Breadcrumb -->
                    <nav class="flex px-5 py-3 text-gray-700" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <span class="inline-flex items-center text-sm font-medium text-gray-700 dark:text-gray-400">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                    </svg>
                                    Home
                                </span>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Payment Records</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <!--End Breadcrumb -->
                    
                    <div class="col">
                        <div class="flex flex-wrap items-center justify-start mt-3 px-4 p-2">
                            <h6 class="font-bold text-base text-gray-700 uppercase">Academic Year - {{$page_info->school_year}}</h6>
                        </div>
                        <div class=" flex flex-wrap items-center justify-start px-4">
                            <span class="font-semibold text-gray-700 uppercase ">{{$page_info->college_name}}</span>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-3/4 flex">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search" wire:model.live.debounce.500ms="filters.search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search " required="">
                                </div>
                            </div>
                            <div class="flex flex-col md:flex-row items-center justify-end space-y-3 md:space-y-0 md:space-x-4 p-4">
                                    <div class="flex items-center space-x-3 w-full md:w-auto">
                                        <select id="filterFee" name="filterFee" wire:model.live="filters.search_by" wire:change="updateSearchDefault()"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            @foreach ($search_by as $key=> $value)
                                                <option  value="{{$value}}" >{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <div class="flex items-center space-x-3 w-full md:w-auto">
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row items-center justify-end space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="flex items-center space-x-3 w-full md:w-auto">
                                <select id="filterFee" name="filterFee" wire:model.live="filters.fee_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected value="" >Filter Fees</option>
                                    @foreach($fees as $key =>$value)
                                        <option  value="{{$value->id}}" >{{$value->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">#</th>
                                    <th scope="col" class="px-4 py-3">Student Code</th>
                                    <th scope="col" class="px-4 py-3">Student Name</th>
                                    <th scope="col" class="px-4 py-3">Fee Type</th>
                                    <th scope="col" class="px-4 py-3">Fee Code</th>
                                    <th scope="col" class="px-4 py-3">Fee Name</th>
                                    <th scope="col" class="px-4 py-3">Amount Collected</th>
                                    <th scope="col" class="px-4 py-3">Collected By</th>
                                    <th scope="col" class="px-4 py-3">Collected at</th>
                                </tr>
                            </thead>
                            <tbody>         
                                @foreach ($payment_records_data as $key =>$value)              
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{($payment_records_data->currentPage()-1)*$payment_records_data->perPage()+$key+1 }}</th>
                                        <td scope="col" class="px-4 py-3">{{$value->student_code}}</td>
                                        <td class="px-4 py-3">{{ $value->student_first_name. ' ' .$value->student_middle_name.' ' .$value->student_last_name }}</td>
                                        <td scope="col" class="px-4 py-3">{{$value->fee_type_name}}</td>
                                        <td scope="col" class="px-4 py-3">{{$value->fee_code}}</td>
                                        <td scope="col" class="px-4 py-3">{{$value->fee_name}}</td>
                                        <td scope="col" class="px-4 py-3">{{number_format($value->amount, 2, '.', ',')}}</td>
                                        <td class="px-4 py-3">{{ $value->collector_first_name. ' ' .$value->collector_middle_name.' ' .$value->collector_last_name }}</td>
                                        <td scope="col" class="px-4 py-3">{{date_format(date_create($value->date_created),"M d, Y h:i a")}}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                
                    </div>
                </div>
                <div class="row my-2"></div>
                {{$payment_records_data->links()}}
            </div>
        </section>
    </main>
</div>
