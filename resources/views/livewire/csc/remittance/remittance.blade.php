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
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Remittance</span>
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
                    <!--Table Header -->
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/4">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                                </div>
                        </div>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <div class="flex items-center space-x-3 w-full md:w-auto">
                                <button  type="button" data-modal-target="DeleteRemitModal" data-modal-toggle="DeleteRemitModal" id="DeleteRemitModalToggle" style="display:none;" ></button>
                                <button  type="button" data-modal-target="AddRemitModal" data-modal-toggle="AddRemitModal" id="AddRemitModalToggle" style="display:none;" ></button>
                                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                    <button type="button" wire:click="addRemit('AddRemitModalToggle')"
                                        class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                        </svg>
                                        Remit
                                    </button>
                                </div>
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
                                    <th scope="col" class="px-4 py-3">Remitted By</th>
                                    <th scope="col" class="px-4 py-3">School Year</th>
                                    <th scope="col" class="px-4 py-3">Semester</th>
                                    <th scope="col" class="px-4 py-3">Date</th>
                                    <th scope="col" class="px-4 py-3">Proof</th>
                                    <th scope="col" class="px-4 py-3">Approval Status</th>
                                    <th scope="col" class="px-4 py-3">Approved By</th>
                                    <th scope="col" class="px-4 py-3">Amount</th>
                                    <th scope="col" class="px-4 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($remittance_data as $key => $value)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{($remittance_data->currentPage()-1)*$remittance_data->perPage()+$key+1 }}</th>
                                    <td class="px-4 py-3">{{ $value->remitted_by_first_name. ' ' .$value->remitted_by_middle_name.' ' .$value->remitted_by_last_name }}</td>
                                    <td class="px-4 py-3">{{$value->year_start.' - '.$value->year_end}}</td>
                                    <td class="px-4 py-3">{{$value->semester}}</td>
                                    <td class="px-4 py-3">{{date_format(date_create($value->remitted_date),"M d, Y")}}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{asset('storage/content/remit_photo/'.$value->remit_photo)}}" target="_blank">
                                            <button class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 font-bold py-2 px-3 rounded">
                                                View Proof
                                            </button>
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">@if(strlen($value->appoved_by)>0) Approved @else Pending @endif</td>
                                    <td class="px-4 py-3">@if(strlen($value->appoved_by)>0) {{ $value->approved_by_first_name. ' ' .$value->approved_by_middle_name.' ' .$value->approved_by_last_name }} @else Pending @endif</td>
                                    <td class="px-4 py-3">{{number_format($value->amount, 2, '.', ',')}}</td>
                                    <td class="px-4 py-3">
                                        @if(strlen($value->appoved_by)>0)
                                        @else 
                                            <button wire:click="editRemit({{$value->id}},'DeleteRemitModalToggle')"class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Delete
                                            </button> 
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div wire:ignore.self id="AddRemitModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
                            <div class="relative w-8/12 max-w-6xl p-8 max-h-screen flex flex-col">
                                <!-- Modal content -->
                                <form action="#" wire:submit.prevent="saveAddRemit('AddRemitModal')">
                                    <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 flex-1">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Add Remit
                                            </h3>
                                        </div>
                                        <!-- Close Button - Upper Right Corner -->
                                        <button type="button"
                                            class="absolute top-4 right-4 text-gray-400 bg-transparent 
                                            hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="AddRemitModal">
                                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="flex flex-row justify-between">
                                            <!-- Left Section - Fee Details -->
                                            <div class="mt-8 basis-1/2 pr-4">
                                                <h3 class="text-2xl font-semibold mb-4">Remittance details</h3>

                                                <div class="mb-2">
                                                    <label for="semester"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        Semester
                                                    </label>
                                                    <select id="semester" wire:model.defer="remit.semester_id" required
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option value="0">Select Semester</option>
                                                        @foreach($semesters as $key =>$value)
                                                            @if($remit['semester_id'] == $value->id)
                                                                <option selected value="{{$value->id}}">{{$value->semester}}</option>
                                                            @else 
                                                                <option value="{{$value->id}}">{{$value->semester}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div action="#" class="grid gap-6">
                                                    <label class="block mt-5 mb-2 text-sm font-medium text-gray-900 dark:text-white" for="small_size">
                                                        Remittance Proof
                                                    </label>
                                                    <input required wire:model.defer="remit.remit_photo" class="block w-50 mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="{{$remit['remit_photo_id']}}" type="file">
                                                    <div class="mb-4">
                                                        <label for="amount"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                                                        <input type="number" wire:model.defer="remit.amount" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                    dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="P300">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Save Fees Button - Bottom Section -->
                                        <div class="mt-4 flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="AddRemitModal" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Remit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                       
                        <div wire:ignore.self id="DeleteRemitModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
                            <div class="relative w-8/12 max-w-6xl p-8 max-h-screen flex flex-col">
                                <!-- Modal content -->
                                <form action="#" wire:submit.prevent="saveDeleteRemit({{$remit['id']}},'DeleteRemitModal')">
                                    <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 flex-1">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Delete Remit
                                            </h3>
                                        </div>
                                        <!-- Close Button - Upper Right Corner -->
                                        <button type="button"
                                            class="absolute top-4 right-4 text-gray-400 bg-transparent 
                                            hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="DeleteRemitModal">
                                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="flex flex-row justify-between">
                                            <p> Are you sure you want to delete this remittance?</p>

                                        </div>
                                        <!-- Save Fees Button - Bottom Section -->
                                        <div class="mt-4 flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="DeleteRemitModal" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Table-->
                 
                </div>
            </div>
        </section>
    </main>
</div>
