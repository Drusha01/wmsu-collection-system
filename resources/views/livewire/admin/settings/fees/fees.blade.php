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
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                    </svg>
                                    Home
                                </span>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span
                                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">
                                        Fees</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <div class="col">
                       
                    </div>
                    <!--End Breadcrumb -->
                    <!--Table Header -->
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 mt-8">
                        <div class="w-full md:w-1/4">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                        <input type="text" id="simple-search" wire:model.live="filters.fee_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Search fee name" required="">
                                </div>
                            </form>
                        </div>
                        <div class="flex flex-col md:flex-row items-center justify-end space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="flex items-center space-x-3 w-full md:w-auto">
                                <select id="course" name="course" wire:model.live="filters.school_year_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected value="" >School Years</option>
                                    @foreach($school_years as $key =>$value)
                                            <option value="{{$value->id}}">{{$value->year_start.' - '.$value->year_end}}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>
                    </div>

            
                    

                    <!--End Table Header -->
                    <!--Table-->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">#</th>
                                    <th scope="col" class="px-4 py-3">Fee Name</th>
                                    <th scope="col" class="px-4 py-3">Fee Code</th>
                                    <th scope="col" class="px-4 py-3">Fee Type</th>
                                    <th scope="col" class="px-4 py-3">For Muslim?</th>
                                    <th scope="col" class="px-4 py-3">Academic Year</th>
                                    <th scope="col" class="px-4 py-3">Semester</th>
                                    <th scope="col" class="px-4 py-3">Start Date</th>
                                    <th scope="col" class="px-4 py-3">End Date</th>
                                    <th scope="col" class="px-4 py-3">Created By</th>
                                    <th scope="col" class="px-4 py-3">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fees_data as $key =>$value)
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{($fees_data->currentPage()-1)*$fees_data->perPage()+$key+1 }}</th>
                                        <td class="px-4 py-3">{{$value->name}}</td>
                                        <td class="px-4 py-3">{{$value->code}}</td>
                                        <td class="px-4 py-3">University Fee</td>
                                        <td class="px-4 py-3">@if($value->for_muslim) Yes @else No @endif</td>
                                        <td class="px-4 py-3">{{$value->year_start.' - '.$value->year_end}}</td>
                                        <td class="px-4 py-3">{{$value->semester}}</td>
                                        <td class="px-4 py-3">{{$months[$value->date_start_month-1]['month_name'].' '.$value->date_start_date.' ,'.$value->year_start}}</td>
                                        <td class="px-4 py-3">{{$months[$value->date_end_month-1]['month_name'].' '.$value->date_end_date.' ,'.$value->year_end}}</td>
                                        <td class="px-4 py-3">{{$value->first_name.' '.$value->middle_name.' '.$value->last_name}}</td>
                                        <td class="px-4 py-3">{{number_format($value->amount, 2, '.', ',')}}</td>
                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--End Table-->
                </div>
                <div class="row my-2"></div>
                {{ $fees_data->links() }}
            </div>
        </section>
    </main>
</div>
