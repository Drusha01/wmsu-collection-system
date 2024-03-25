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
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Payments</span>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Student</span>
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
                        <div class=" flex flex-wrap items-center justify-start px-4 pb-4">
                            <span class="semi-semibold text-gray-700 uppercase">{{$student['department_name']}}</span>
                        </div>
                        
                    </div>

                    <!--Table Header -->
                    <div class="flex flex-col md:flex-row items-center justify-between p-4 -mt-10">
                        <div class="row text-sm font-medium text-gray-700 uppercase">
                            <h5>{{'('.$student['student_code'].') - '.$student['first_name'].' '.$student['middle_name'].' '.$student['last_name']}}</h5>
                        </div>
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <select id="course" name="course" wire:model.live="filters.semester_id" wire:change="updateSemester()"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach($enrolled_student as $key =>$value)
                                        <option value="{{$value->semester_id}}">{{$value->semester}}</option>
                                @endforeach
                            </select>
                        </div>    
                    </div>
                    <!--End Table Header -->
                  
                    <!--Table-->
                    <div class="overflow-x-auto">
                        <div class="py-2 px-2 flex items-center justify-end">
                            <button data-modal-target="receipt-modal" data-modal-toggle="receipt-modal" type="button" class=" mr-3 py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path d="M9 11H15M9 7H13M9 15H15M5 6.2V21L7.5 19L10 21L12 19L14 21L16.5 19L19 21V6.2C19 5.0799 19 4.51984 18.782 4.09202C18.5903 3.71569 18.2843 3.40973 17.908 3.21799C17.4802 3 16.9201 3 15.8 3H8.2C7.0799 3 6.51984 3 6.09202 3.21799C5.71569 3.40973 5.40973 3.71569 5.21799 4.09202C5 4.51984 5 5.0799 5 6.2Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>

                                <span class="ml-2">Download Receipt</span>
                            </button>
                            @if($total['total_amount'] > $total['total_amount_paid'])
                                <button wire:click="confirmPaymentDefault('confirmPaymentToggle')"type="button" class="py-2 px-4 flex items-center justify-center text-sm font-medium text-white bg-green-500 rounded-lg 
                                hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 
                                focus:ring-offset-white dark:bg-green-600 dark:focus:ring-offset-gray-8000">
                                    Confirm
                                </button>
                            @endif
                        </div>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">#</th>
                                    <th scope="col" class="px-4 py-3">Fee Type</th>
                                    <th scope="col" class="px-4 py-3">Fee Code</th>
                                    <th scope="col" class="px-4 py-3">Fee Name</th>
                                    <th scope="col" class="px-4 py-3">Amount</th>
                                    <th scope="col" class="px-4 py-3">Amount Paid</th>
                                    <th scope="col" class="px-4 py-3">Balance</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fees as $key =>$value)
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$key+1}}
                                        </th>
                                        <td class="px-4 py-3">{{$value->fee_type_name}}</td>
                                        <td class="px-4 py-3">{{$value->fee_code}}</td>
                                        <td class="px-4 py-3">{{$value->fee_name}}</td>
                                        <td class="px-4 py-3">{{$value->amount}}</td>
                                        <td class="px-4 py-3">@if(intval($value->paid_amount)){{$value->paid_amount}}@else 0 @endif</td>
                                        <td class="px-4 py-3">{{$value->amount - $value->paid_amount}}</td>
                                        <td class="px-4 py-3">
                                            @if(intval($value->paid_amount) && intval($value->paid_amount) < $value->amount)
                                                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-blue-400 border border-blue-100 dark:border-blue-500">
                                                    Partial
                                                </span>
                                            @elseif(intval($value->paid_amount) && intval($value->paid_amount) == $value->amount)
                                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">
                                                    Paid
                                                </span>
                                            @elseif(!(intval($value->paid_amount)))
                                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-red-400 border border-red-100 dark:border-red-500">
                                                    Unpaid
                                                </span>
                                            @endif
                                        </td>
                                      
                                    </tr>
                                @endforeach
                                <tr>
                                    <hr>
                                </tr>
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        
                                    </th>
                                    <td class="px-4 py-3"></td>
                                    <td class="px-4 py-3"></td>
                                    <th class="px-4 py-3">Total</th>
                                    <th class="px-4 py-3"> {{$total['total_amount']}}</th>
                                    <th class="px-4 py-3"> {{$total['total_amount_paid']}}</th>
                                    <th class="px-4 py-3"> {{$total['total_balance']}}</th>
                                    <th class="px-4 py-3">
                                        @if($total['total_amount'] == $total['total_amount_paid'])
                                        <span class="bg-green-900 text-green-100 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">
                                            Fully Paid
                                        </span>
                                        @endif
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>



                   
                    
                    <!-- Partial Payment Section -->
                    <button style="display:none" data-modal-target="confirmPayment" data-modal-toggle="confirmPayment" id="confirmPaymentToggle"></button>
                    <button style="display:none" data-modal-target="confirmVoidModal" data-modal-toggle="confirmVoidModal" id="confirmVoidModalToggle"></button>
                    <button style="display:none" data-modal-target="confirmPartialModal" data-modal-toggle="confirmPartialModal" id="confirmPartialModalToggle"></button>
                                
                            @if($total['total_amount'] > $total['total_amount_paid'])
                                <div class="mx-5 px-3 border-b rounded-t dark:border-gray-600">
                                    <div class="mx-5 px-3 mb-5 mt-5 border-t border-gray-300">
                                        <div class="flex items-center justify-between">
                                            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Partial Payment</h2>
                                            <div class="flex items-center space-x-4 mt-2">
                                                <button wire:click="confirmPartialDefault('confirmPartialModalToggle')" type="button" class="py-2 px-4 flex items-center justify-center text-sm font-medium text-white bg-green-500 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-white dark:bg-green-600 dark:focus:ring-offset-gray-800">
                                                    Partial Payment
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($total['total_amount_paid'] > 0)
                            <!-- Void Payment Section -->
                            <div class="mx-5 px-3 border-b rounded-t dark:border-gray-600">
                                <div class="mx-5 px-3 mb-5 mt-5 border-t border-gray-300">
                                    <div class="flex items-center mb-5 mt-2 justify-between">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Void Payment</h2>
                                        <div class="flex items-center space-x-4">
                                            <button wire:click="confirmVoidDefault('confirmVoidModalToggle')" type="button" class="py-2 px-4 flex items-center justify-center text-sm font-medium text-white bg-red-500 rounded-lg 
                                            hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 
                                            focus:ring-offset-white dark:bg-red-600 dark:focus:ring-offset-gray-800">
                                                Void Payment
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                </div>    
            </div>


            <div>
            <!-- payment history modal -->
                <div id="PaymentHistory" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-400">
                            <button type="button"  class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                            data-modal-hide="PaymentHistory">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5">
                                <div class="flex items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Payment History
                                    </h3>
                                </div>
                                <div class="p-4 md:p-5 rounded">

                                    <!-- School Year: 2023-2024 -->
                                    <div class="rounded bg-gray-100 dark:bg-gray-800 p-4 md:p-5 mb-8">
                                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">School year: 2023-2024</h1>

                                        <!-- First Semester -->
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">First Semester</h4>
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50 dark:bg-gray-600">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Type</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Code</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Name</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount Paid</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">1</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">University Fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">MSA</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">MSA</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-red-600">Unpaid</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">2</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">University Fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">UF</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">UNIVFEE</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">200</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">200</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-red-600">Unpaid</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">3</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">Local Fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">local fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">GARDEN FEE</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">300</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">300</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-red-600">Unpaid</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-right font-semibold">Total</td>
                                                        <td class="px-6 py-4 whitespace-nowrap font-semibold">560</td>
                                                        <td class="px-6 py-4 whitespace-nowrap font-semibold">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap font-semibold">560</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Second Semester -->
                                        <div class="mt-8">
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Second Semester</h4>
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50 dark:bg-gray-600">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Type</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Code</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Name</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount Paid</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">1</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">University Fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">MSA</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">MSA</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-red-600">Unpaid</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">2</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">University Fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">UF</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">UNIVFEE</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">200</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">200</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-red-600">Unpaid</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">3</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">Local Fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">local fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">GARDEN FEE</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">300</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">300</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-red-600">Unpaid</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-right font-semibold">Total</td>
                                                        <td class="px-6 py-4 whitespace-nowrap font-semibold">560</td>
                                                        <td class="px-6 py-4 whitespace-nowrap font-semibold">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap font-semibold">560</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                                                        
                                        <!-- School Year: 2024-2025 -->
                                        <div class="rounded bg-gray-100 dark:bg-gray-800 p-4 md:p-5 mb-8">
                                            <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">School year: 2024-2025</h1>

                                            <!-- First Semester -->
                                            <div>
                                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">First Semester</h4>
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-gray-50 dark:bg-gray-600">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Type</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Code</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Name</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount Paid</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">1</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">University Fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">MSA</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">MSA</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">60</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-red-600">Unpaid</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">2</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">University Fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">UF</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">UNIVFEE</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">200</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">200</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-red-600">Unpaid</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap">3</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">Local Fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">local fee</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">GARDEN FEE</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">300</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">300</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-red-600">Unpaid</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-right font-semibold">Total</td>
                                                        <td class="px-6 py-4 whitespace-nowrap font-semibold">560</td>
                                                        <td class="px-6 py-4 whitespace-nowrap font-semibold">0</td>
                                                        <td class="px-6 py-4 whitespace-nowrap font-semibold">560</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                </table>
                                            </div>

                                            <!-- Second Semester -->
                                            <div class="mt-8">
                                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Second Semester</h4>
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-gray-50 dark:bg-gray-600">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Type</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Code</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee Name</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount Paid</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                <!-- modals -->
                <div wire:ignore.self id="confirmPartialModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-400">
                            <button type="button" data-modal-hide="confirmPartialModal" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" >
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5">
                                <form wire:submit.prevent="confirmPartial('confirmPartialModal')">
                                    <div class="flex items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Partial Payment
                                        </h3>
                                    </div>
                                    <label class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Promisory Note</label>
                                    <input required wire:model.defer="partial.promisory_note" class="block w-50 mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50
                                    dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="small_size" type="file">
                                    <label class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Amount</label>
                                    <input required max="{{$total['total_balance']}}" wire:model.defer="partial.amount" type="number" placeholder="Enter Amount" class=" w-50 border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    
                                    <div class="flex justify-center mt-10">
                                        <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Confirm
                                        </button>
                                        <button data-modal-hide="confirmPartialModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modals -->
                <div wire:ignore.self id="confirmVoidModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-400">
                            <button type="button" data-modal-hide="confirmVoidModal" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" >
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5">
                                <form wire:submit.prevent="confirmVoid('confirmVoidModal')">
                                    <div class="flex items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Void Payment
                                        </h3>
                                    </div>
                                    <label class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Amount</label>
                                    <input required max="{{$total['total_amount_paid']}}" wire:model.defer="void.amount" type="number" placeholder="Enter Amount" class=" w-50 border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    
                                    <div class="flex justify-center mt-10">
                                        <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Confirm
                                        </button>
                                        <button data-modal-hide="confirmVoidModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modals -->
                <div wire:ignore.self id="confirmPayment" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                            data-modal-hide="confirmPayment">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <form wire:submit.prevent="confirmPayment('confirmPayment')">
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to confirm?</h3>
                                    <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Confirm
                                    </button>
                                    <button type="button" data-modal-hide="confirmPayment" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        No, cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- modals -->
                <div id="receipt-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                             data-modal-hide="receipt-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to confirm?</h3>
                                <button data-modal-hide="receipt-modal" type="button" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yes, I'm sure
                                </button>
                                <button data-modal-hide="receipt-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                            </div>
                        </div>
                    </div>
                </div> 

            </div>


        </section>
    </main>
</div>
