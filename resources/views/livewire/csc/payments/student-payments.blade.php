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
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-base">#</th>
                                    <th scope="col" class="px-4 py-3 text-base">Fee Type</th>
                                    <th scope="col" class="px-4 py-3 text-base">Fee Code</th>
                                    <th scope="col" class="px-4 py-3 text-base">Fee Name</th>
                                    <th scope="col" class="px-4 py-3 text-base">Amount</th>
                                    <th scope="col" class="px-4 py-3 text-base">Amount Paid</th>
                                    <th scope="col" class="px-4 py-3 text-base">Balance</th>
                                    <th scope="col" class="px-4 py-3 text-base">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fees as $key =>$value)
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$key+1}}
                                        </th>
                                        <td class="px-4 py-3 text-base">{{$value->fee_type_name}}</td>
                                        <td class="px-4 py-3 text-base">{{$value->fee_code}}</td>
                                        <td class="px-4 py-3 text-base">{{$value->fee_name}}</td>
                                        <td class="px-4 py-3 text-base">{{number_format($value->amount, 2, '.', ',')}}</td>
                                        <td class="px-4 py-3 text-base">@if(intval($value->paid_amount)){{number_format($value->paid_amount, 2, '.', ',')}}@else 0 @endif</td>
                                        <td class="px-4 py-3 text-base">{{number_format($value->amount - $value->paid_amount, 2, '.', ',')}}</td>
                                        <td class="px-4 py-3 text-base">
                                            @if(intval($value->paid_amount) && intval($value->paid_amount) < $value->amount)
                                                <span class="bg-blue-100 text-blue-800 text-base font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-blue-400 border border-blue-100 dark:border-blue-500">
                                                    Partial
                                                </span>
                                            @elseif(intval($value->paid_amount) && intval($value->paid_amount) == $value->amount)
                                                <span class="bg-green-100 text-green-800 text-base font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">
                                                    Paid
                                                </span>
                                            @elseif(!(intval($value->paid_amount)))
                                                <span class="bg-red-100 text-red-800 text-base font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-red-400 border border-red-100 dark:border-red-500">
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
                                    <td class="px-4 py-3 text-base"></td>
                                    <td class="px-4 py-3 text-base"></td>
                                    <th class="px-4 py-3 text-base">Total</th>
                                    <th class="px-4 py-3 text-base"> {{number_format($total['total_amount'], 2, '.', ',')}}</th>
                                    <th class="px-4 py-3 text-base"> {{number_format($total['total_amount_paid'], 2, '.', ',')}}</th>
                                    <th class="px-4 py-3 text-base"> {{number_format($total['total_balance'], 2, '.', ',')}}</th>
                                    <th class="px-4 py-3 text-base">
                                        @if($total['total_amount'] == $total['total_amount_paid'])
                                        <span class="bg-green-900 text-green-100 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">
                                            Fully Paid
                                        </span>
                                        @endif
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>



                   
                        <button style="display:none" data-modal-target="PaymentHistoryModal" data-modal-toggle="PaymentHistoryModal" id="PaymentHistoryModalToggle"></button>
                        <button style="display:none" data-modal-target="confirmPayment" data-modal-toggle="confirmPayment" id="confirmPaymentToggle"></button>
                        <button style="display:none" data-modal-target="confirmVoidModal" data-modal-toggle="confirmVoidModal" id="confirmVoidModalToggle"></button>
                        <button style="display:none" data-modal-target="confirmPartialModal" data-modal-toggle="confirmPartialModal" id="confirmPartialModalToggle"></button>
                                    
                        @if($total['total_amount'] > $total['total_amount_paid'])
                            <div class="mx-5 px-3 border-b rounded-t dark:border-gray-600">
                                <div class="mx-5 px-3 mb-5 mt-5 border-t border-gray-300">
                                    <div class="flex items-center mt-4 justify-between">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Partial Payment</h2>
                                        <div class="py-2 px-2 flex items-center justify-end">
                            
                                            @if($total['total_amount'] > $total['total_amount_paid'])
                                                <button wire:click="confirmPaymentDefault('confirmPaymentToggle')"type="button" class="py-2 px-4 flex items-center justify-center text-sm font-semibold text-white bg-green-500 rounded-lg 
                                                hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 
                                                focus:ring-offset-white dark:bg-green-600 dark:focus:ring-offset-gray-8000">
                                                    Pay full balance
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4 mt-2">
                                        <button wire:click="confirmPartialDefault('confirmPartialModalToggle')" type="button" class="py-2 px-4 flex items-center justify-center text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-white dark:bg-blue-600 dark:focus:ring-offset-gray-800">
                                            Partial Payment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($total['total_amount_paid'] > 0)
                            <div class="mx-5 px-3 border-b rounded-t dark:border-gray-600">
                                <div class="mx-5 px-3 mb-5 mt-5 border-t border-gray-300">
                                    <div class="flex items-center mt-4 justify-between">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Void Payment</h2>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <button wire:click="confirmVoidDefault('confirmVoidModalToggle')" type="button" class="py-2 px-4 flex items-center justify-center text-sm font-medium text-white bg-red-500 rounded-lg 
                                        hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 
                                        focus:ring-offset-white dark:bg-red-600 dark:focus:ring-offset-gray-800">
                                            Void Payment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="mx-5 px-3 border-b rounded-t dark:border-gray-600">
                                <div class="mx-5 px-3 mb-5 mt-5 border-t border-gray-300">
                                    <div class="flex items-center mt-4">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Payment History</h2>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <button wire:click="PaymentHistory('PaymentHistoryModalToggle')" type="button" class="py-2 px-4 flex items-center justify-center text-sm font-medium text-white bg-yellow-400 rounded-lg 
                                        hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 
                                        focus:ring-offset-white dark:bg-yellow-500 dark:focus:ring-offset-gray-800">
                                            Payment History
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>    
                </div>
            <div>
            <div wire:ignore.self id="PaymentHistoryModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-400">
                        <button type="button"  class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                        data-modal-hide="PaymentHistoryModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5" id="to_print">
                            <div class="flex items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Payment History
                                </h3>
                            </div>
                            <div class="p-4 md:p-5 rounded">
                                <div class="rounded bg-gray-100 dark:bg-gray-800 p-4 md:p-5 mb-8">
                                    <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Academic Year - {{$page_info->school_year}}</h1>

                                    <!-- First Semester -->
                                    <div>
                                        <span class="font-semibold text-gray-700 uppercase ">{{$page_info->college_name}}</span>
                                        <br>
                                        <span class="semi-semibold text-gray-700 uppercase">{{$student['department_name']}}</span>
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
                                                @foreach ($payment_history['payment_history'] as $key =>$value)              
                                                    <tr class="border-b dark:border-gray-700">
                                                        <th scope="row" class="px-4 py-3 font-xlg text-gray-900 whitespace-nowrap dark:text-white">{{($key+1) }}</th>
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

                                    <!-- Second Semester -->
                                  
                                </div>
                            </div>
                        </div>
                        <div class="mt-auto flex items-center justify-end dark:border-gray-600 p-2 m-5 pb-3">
                            <div class="col-2 flex mx-3">
                            <select id="course" name="course" wire:model="export_selected"
                                class=" col bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach($export_types as $key =>$value)
                                    @if($key == 0)
                                        <option  value="{{$value['name']}}">EXPORT {{$value['name']}}</option>
                                    @else 
                                        <option value="{{$value['name']}}">EXPORT {{$value['name']}}</option>
                                    @endif
                                @endforeach
                            
                            </select>
                            </div>
                           
                            <button type="submit"  wire:click="downloadReceipt()" class=" mx-2 text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Download Receipt
                            </button>
                            <button type="button" data-modal-toggle="PaymentHistoryModal"
                                class="text-dark-700 hover:text-dark border border-dark-700 hover:bg-dark-800 font-bold py-2 px-3 rounded">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modals -->
            <div wire:ignore.self id="confirmPartialModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-8/12 max-h-full">
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
                                <h3 class="mb-4 mt-4 font-semibold text-gray-900 dark:text-white">Choose fee to pay</h3>
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-4 py-3"></th>
                                            <th scope="col" class="px-4 py-3">#</th>
                                            <th scope="col" class="px-4 py-3">Fee Type</th>
                                            <th scope="col" class="px-4 py-3">Fee Name</th>
                                            <th scope="col" class="px-4 py-3">Amount</th>
                                            <th scope="col" class="px-4 py-3">Balance</th>

                                        </tr>
                                    </thead>
                                    <tbody>         
                                            <tr class="border-b dark:border-gray-700">
                                                <td scope="col" class="px-4 py-3">

                                                    <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                    
                                                </td>
                                                <td scope="col" class="px-4 py-3">1</td>
                                                <td scope="col" class="px-4 py-3">Local Fee</td>
                                                <td scope="col" class="px-4 py-3">Mars Fee</td>
                                                <td scope="col" class="px-4 py-3">300</td>
                                                <td scope="col" class="px-4 py-3">250</td>

                                            </tr>
                                            <tr class="border-b dark:border-gray-700">
                                                <td scope="col" class="px-4 py-3">

                                                    <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                    
                                                </td>
                                                <td scope="col" class="px-4 py-3">2</td>
                                                <td scope="col" class="px-4 py-3">Local Fee</td>
                                                <td scope="col" class="px-4 py-3">Mars Fee</td>
                                                <td scope="col" class="px-4 py-3">300</td>
                                                <td scope="col" class="px-4 py-3">250</td>

                                            </tr>
                                            <tr class="border-b dark:border-gray-700">
                                                <td scope="col" class="px-4 py-3">

                                                    <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                    
                                                </td>
                                                <td scope="col" class="px-4 py-3">3</td>
                                                <td scope="col" class="px-4 py-3">Local Fee</td>
                                                <td scope="col" class="px-4 py-3">Mars Fee</td>
                                                <td scope="col" class="px-4 py-3">300</td>
                                                <td scope="col" class="px-4 py-3">250</td>

                                            </tr>

                                    </tbody>
                                </table>

                                
                                <div class="flex flex-wrap mt-6">
                                    <div class="flex flex-col mb-4 mr-4">
                                        <h3 class="font-semibold text-gray-900 dark:text-white mt-4 mb-4">Amount</h3>
                                        <input required max="{{$total['total_balance']}}" wire:model.defer="partial.amount" type="number" step="0.01" placeholder="Enter Amount" class="w-full md:w-96 border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                    <div class="flex flex-col mb-4">
                                        <h3 class="font-semibold text-gray-900 dark:text-white mt-4 mb-4">Promissory Note</h3>
                                        <input required wire:model.defer="partial.promissory_note" class="w-full md:w-96 mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="small_size" type="file">
                                    </div>
                                </div>

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
                <div class="relative p-4 w-8/12 max-h-full">
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

                                <h3 class="mb-4 mt-4 font-semibold text-gray-900 dark:text-white">Choose fee to void</h3>
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-4 py-3"></th>
                                            <th scope="col" class="px-4 py-3">#</th>
                                            <th scope="col" class="px-4 py-3">Fee Type</th>
                                            <th scope="col" class="px-4 py-3">Fee Name</th>
                                            <th scope="col" class="px-4 py-3">Amount</th>
                                            <th scope="col" class="px-4 py-3">Balance</th>

                                        </tr>
                                    </thead>
                                    <tbody>         
                                            <tr class="border-b dark:border-gray-700">
                                                <td scope="col" class="px-4 py-3">

                                                    <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                    
                                                </td>
                                                <td scope="col" class="px-4 py-3">1</td>
                                                <td scope="col" class="px-4 py-3">Local Fee</td>
                                                <td scope="col" class="px-4 py-3">Mars Fee</td>
                                                <td scope="col" class="px-4 py-3">300</td>
                                                <td scope="col" class="px-4 py-3">250</td>

                                            </tr>
                                            <tr class="border-b dark:border-gray-700">
                                                <td scope="col" class="px-4 py-3">

                                                    <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                    
                                                </td>
                                                <td scope="col" class="px-4 py-3">2</td>
                                                <td scope="col" class="px-4 py-3">Local Fee</td>
                                                <td scope="col" class="px-4 py-3">Mars Fee</td>
                                                <td scope="col" class="px-4 py-3">300</td>
                                                <td scope="col" class="px-4 py-3">250</td>

                                            </tr>
                                            <tr class="border-b dark:border-gray-700">
                                                <td scope="col" class="px-4 py-3">

                                                    <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"></label>
                    
                                                </td>
                                                <td scope="col" class="px-4 py-3">3</td>
                                                <td scope="col" class="px-4 py-3">Local Fee</td>
                                                <td scope="col" class="px-4 py-3">Mars Fee</td>
                                                <td scope="col" class="px-4 py-3">300</td>
                                                <td scope="col" class="px-4 py-3">250</td>

                                            </tr>

                                    </tbody>
                                </table>
                                <label class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">Amount</label>
                                <input required max="{{$total['total_amount_paid']}}" wire:model.defer="void.amount" type="number" step="0.01" placeholder="Enter Amount" class="w-96 border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                
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
                                <h3 class="mb-5 text-lg font-bold text-gray-500 dark:text-gray-400">Are you sure you want to pay your balance?</h3>
                                <button type="submit" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yes, I want to pay
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



        </section>
    </main>
    <script>
        window.print_this = function(id) {
            var prtContent = document.getElementById(id);
            var WinPrint = window.open('', '', 'left=0,top=0,width=1500,height=900,toolbar=0,scrollbars=0,status=0');
            
            WinPrint.document.write('<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">');
            
            // To keep styling
            /*var file = WinPrint.document.createElement("link");
            file.setAttribute("rel", "stylesheet");
            file.setAttribute("type", "text/css");
            file.setAttribute("href", 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
            WinPrint.document.head.appendChild(file);*/

            
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.setTimeout(function(){
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
            }, 1000);
        }
    </script>
</div>
