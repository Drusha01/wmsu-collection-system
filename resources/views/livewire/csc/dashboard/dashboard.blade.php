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
                    <div class=" flex flex-wrap items-center justify-start px-4">
                        <span class="font-semibold text-gray-700 uppercase ">{{$page_info->college_name}}</span>
                    </div>
                </div>
            </div> 
            <div class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-2 mb-4 mt-4 max-w-full">
            
                <!-- First Section -->
                <div class="col-span-1 items-center justify-between p-4 bg-white border ml-4 border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Total Collected </h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">PHP {{number_format($dashboard_data['total_collected'], 2, '.', ',')}} </span>
                    </div>
                </div>

                <div class="col-span-1 mr-4 items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">    
                    <div class="w-full mr-4">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Total Remitted</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">PHP {{number_format($dashboard_data['total_remitted'], 2, '.', ',')}} </span>
                    </div>
                </div>

                <!-- Second Section -->
                <div class="col-span-1 ml-4 items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
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
        <!-- <div class="px-4 pt-6 2xl:px-0 max-w-screen-xl mx-auto -mt-8">
            <div class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-2 mb-4 mt-4 max-w-full">
            
                <div class="col-span-1 items-center justify-between p-4 bg-white border ml-4 border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Number of student enrolled</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">300</span>
                    </div>
                </div>

                <div class="col-span-1 mr-4 items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Number of paid students</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">260</span>
                    </div>
            </div>

        </div>             -->
        <div class="mb-10 mr-4 content-center w-50">
            @foreach ($paid_per_department as $key=>$value)
            <div class="col-span-1 items-center justify-between p-4 bg-white border ml-4 border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Total Collection for {{$value->department_code}}</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">Php {{number_format($value->paid_per_department, 2, '.', ',')}}</span>
                </div>
            </div>
            @endforeach
        </div>
        
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
    <script wire:ignore.self src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script wire:ignore.self type="text/javascript" src="jscript/graph.js"></script>
    
    <script wire:ignore.self>
        var cscChart1 = document.getElementById('cscChart1').getContext('2d');
        var cscChart2 = document.getElementById('cscChart2').getContext('2d');
        var ctxSchoolYear = document.getElementById('FeeChart').getContext('2d');
        var ctxSemester = document.getElementById('semesterRemittedChart').getContext('2d');
        var cscChart1Var;
        var cscChart2Var;
        var schoolYearRemittedChart;
        var semesterRemittedChart;
        window.addEventListener('renderCharts', function(){
            console.log('dfasf');
            if(cscChart1Var){
                cscChart1Var.destroy();
            }
            if(cscChart2Var){
                cscChart2Var.destroy();
            }
            if(schoolYearRemittedChart){
                schoolYearRemittedChart.destroy();
            }
            if(semesterRemittedChart){
                semesterRemittedChart.destroy();
            }

            cscChart1Var = new Chart(cscChart1, {
                type: 'doughnut',
                data: {
                    labels: [
                        <?php foreach ($paid_per_department as $key => $value) {
                            echo('\''.$value->department_code.' ( PHP '. $value->paid_per_department .' )'.'\',');
                        }
                        ?>
                    ],
                    datasets: [{
                        label: 'Collected Payment',
                        data: [
                            <?php foreach ($paid_per_department as $key => $value) {
                                echo('\''.$value->paid_per_department.'\',');
                            }
                        ?>
                        ],
                        backgroundColor: [
                            <?php foreach ($paid_per_department as $key => $value) {
                                echo('\'rgba('.(rand(100,255)).', '.(rand(100,255)).', '.(rand(100,255)).', 0.4)\',');
                            }
                        ?>
        
                        ],
                        borderColor: [
                            <?php foreach ($paid_per_department as $key => $value) {
                                echo('\'rgba('.(rand(100,255)).', '.(rand(100,255)).', '.(rand(100,255)).', 0.4)\',');
                            }
                        ?>
                         
                        ],
                        borderWidth: 2
                    }]
                },
                    options: {
                    responsive: false
                }
            });
            
           
            cscChart2Var = new Chart(cscChart2, {
                type: 'doughnut',
                data: {
                    labels: ['First Semester', 'Second Semester'],
                    datasets: [{
                        label: 'Collected Payment',
                        data: [30000, 25000,],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                    options: {
                    responsive: false
                }
            });

            
            schoolYearRemittedChart = new Chart(ctxSchoolYear, {
                type: 'bar',
                data: {
                    labels: ['University Fee', 'Local Fee'], 
                    datasets: [{
                        label: 'Total Remitted',
                        data: [25000, 35000], 
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: false
                }
            });

   
            semesterRemittedChart = new Chart(ctxSemester, {
                type: 'bar',
                data: {
                    labels: ['First Semester', 'Second Semester'],
                    datasets: [{
                        label: 'Total Amount Collected',
                        data: [15000, 25000], 
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: false,
                    maintainAspectRatio: false, 
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                }
            });
        }); 
    </script>
 
</main>
