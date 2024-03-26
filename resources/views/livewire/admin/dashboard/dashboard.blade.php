
<main class="p-9 sm:ml-64 pt-20 sm:pt-8 h-auto">
    <div class="p-4">
        <!-- <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="mt-6 flex justify-end mr-6">
                <button id="dropdownYearButton" data-dropdown-toggle="dropdownYear" class="inline-flex items-center px-4 py-2 mb-3 font-medium text-center
                text-white bg-green-600 rounded-lg md:mb-0 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600
                 green:hover:bg-green-700 dark:green:ring-green-800" type="button"> School Year
                 <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
    
                    <div id="dropdownYear" class="z-10 hidden bg-white divide-y divide-gray-300 rounded-lg shadow-md w-40 dark:bg-gray-800 dark:divide-gray-700 dark:shadow-md">
                        <ul class="py-2 text-sm text-center text-gray-800 dark:text-gray-200" aria-labelledby="dropdownYearButton">
                            <li>
                                <a href="#" class="block px-2 py-2 hover:bg-gray-200 rounded dark:hover:bg-gray-900 dark:hover:text-white">2023-2024</a>
                            </li>
                            <li>
                                <a href="#" class="block px-2 py-2 hover:bg-gray-200 rounded dark:hover:bg-gray-900 dark:hover:text-white">2024-2025</a>
                            </li>
                            <li>
                                <a href="#" class="block px-2 py-2 hover:bg-gray-200 rounded dark:hover:bg-gray-900 dark:hover:text-white">2025-2026</a>
                            </li>
                        </ul>
                    </div>
            </div> -->
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
           
                    <div class="row">
                        <div class="col-6">
                            <div class="flex flex-wrap items-center justify-end mt-3 px-4 p-2">
                                <div class="col-6 flex">
                                    <select id="course" name="course" wire:model.live="filters.school_year_id" 
                                        class=" mx-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        @foreach($school_years as $key =>$value)
                                                <option value="{{$value->id}}">{{$value->year_start.' - '.$value->year_end}}</option>
                                        @endforeach
                                    </select>
                                    <select id="course" name="course" wire:model.live="filters.semester_id" 
                                        class="mx-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        @foreach($semesters as $key =>$value)
                                                <option value="{{$value->id}}">{{$value->semester}}</option>
                                        @endforeach
                                    </select>
                                </div>  
                            </div>
                        </div>
                    </div> 
                    <div class="col-span-1 items-center justify-between p-4 bg-white border ml-4 border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="w-full">
                            <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Total Collected </h3>
                            <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">PHP {{number_format($dashboard_data['total_collected'], 2, '.', ',')}} </span>
                        </div>
                    </div>
                    <div class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-2 mb-4 mt-4 max-w-full">
                    
                        <div class="col-span-1 ml-4 items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <div class="w-full">
                                <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">USC shares</h3>
                                <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">PHP {{number_format($dashboard_data['usc_shares'], 2, '.', ',')}} </span>
                            </div>
                        </div>
                        <div class="col-span-1 mr-4 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <div class="w-full">
                                <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">CSC shares</h3>
                                <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">PHP {{number_format($dashboard_data['csc_shares'], 2, '.', ',')}} </span>
                            </div>
                        </div>
                        
                </div>
                @foreach($this->dashboard_data['total_remitted'] as $key =>$value)
                <div class="mr-4 max-w-full mb-5">
                    <div class="col-span-1 items-center justify-between p-4 bg-white border ml-4 border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Total Remitted by {{$value->college_code}}</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">Php {{number_format($value->total_remitted, 2, '.', ',')}} </span>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="sm:p-6 md:p-8 lg:p-10 xl:p-12 2xl:p-16 mr-4 ml-4 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 dark:bg-gray-800">
                    <div class="items-center justify-between lg:flex mb-10">
                        <div class="mb-4 lg:mb-0">
                            <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Recent Collection</h3>
                            <span class="text-base font-normal text-gray-500 dark:text-gray-400">This is a list of the latest collection this semester</span>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="flex flex-col mt-6">
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
                                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{(intval($key)+1) }}</th>
                                            <td scope="col" class="px-4 py-3">{{$value->student_code}}</td>
                                            <td class="px-4 py-3">{{ $value->student_first_name. ' ' .$value->student_middle_name.' ' .$value->student_last_name }}</td>
                                            <td scope="col" class="px-4 py-3">{{$value->fee_type_name}}</td>
                                            <td scope="col" class="px-4 py-3">{{$value->fee_code}}</td>
                                            <td scope="col" class="px-4 py-3">{{$value->fee_name}}</td>
                                            <td scope="col" class="px-4 py-3">{{$value->amount}}</td>
                                            <td class="px-4 py-3">{{ $value->collector_first_name. ' ' .$value->collector_middle_name.' ' .$value->collector_last_name }}</td>
                                            <td scope="col" class="px-4 py-3">{{date_format(date_create($value->date_created),"M d, Y h:i a")}}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                    
                        </div>
                    </div>
                </div>
        </div>

   

        <div class="px-4 pt-6 2xl:px-0 max-w-screen-xl mx-auto">
            <div class="mr-4">


    </div>
</main>

<script src="{{ asset('js/app.js') }}"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script> --}}
