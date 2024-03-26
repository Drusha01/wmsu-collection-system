
<main class="p-9 sm:ml-64 pt-20 sm:pt-8 h-auto">
    <div class="p-4">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            <div class="row">
                <div class="col-6">
                    <div class="flex flex-wrap items-center justify-between mt-3 px-4 p-2">
                        <h6 class="font-bold text-base text-gray-700 uppercase">Academic Year - {{$page_info->school_year}}</h6>
                        <div class="col-6">
                            <select id="course" name="course" wire:model.live="filters.semester_id" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach($semesters as $key =>$value)
                                        <option value="{{$value->id}}">{{$value->semester}}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>
                </div>
            </div> 
        <div class="col-span-1 mr-4 p-4 bg-white border border-gray-200 rounded-lg shadow-sm  sm:p-6 dark:bg-gray-800">
                <div class="col-span-1 items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">    
                    <div class="w-full mr-4">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Total Remitted</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">PHP {{number_format($dashboard_data['total_remitted'], 2, '.', ',')}} </span>
                    </div>
                </div>
            </div>

            <div class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 mb-4 mt-4 max-w-full">
            
                <!-- First Section -->
                <div class="col-span-1 items-center justify-between p-4 bg-white border ml-4 border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Total Collected </h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">PHP {{number_format($dashboard_data['total_collected'], 2, '.', ',')}} </span>
                    </div>
                </div>

                <!-- Second Section -->
                <div class="col-span-1 items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">USC shares</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">PHP {{number_format($dashboard_data['usc_shares'], 2, '.', ',')}} </span>
                    </div>
                </div>

                <!-- Third Section -->
                <div class="col-span-1 mr-4 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">CSC shares</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">PHP {{number_format($dashboard_data['csc_shares'], 2, '.', ',')}} </span>
                    </div>
                </div>

        </div>

        </div>

        <div class="px-4 pt-6 2xl:px-0 max-w-screen-xl mx-auto">
            <div class="mr-4">

            <!-- College Bar Chart -->
            <div class="sm:p-6 md:p-8 lg:p-10 xl:p-12 2xl:p-16 ml-4 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 dark:bg-gray-800">
                <div class="items-center justify-between lg:flex mb-10">
                    <canvas id="myChart"></canvas>
            </div>
        </div>

    </div>
</main>

<script src="{{ asset('js/app.js') }}"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script> --}}
