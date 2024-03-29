<div>    
    <x-loading-indicator/>
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
                                        Local Fee</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <div class="col">
                        <div class="flex flex-wrap items-center justify-start mt-3 px-4 p-2">
                            <h6 class="font-bold text-base text-gray-700 uppercase">Academic Year - {{$page_info->school_year}}</h6>
                        </div>
                        <div class=" flex flex-wrap items-center justify-start px-4">
                            <span class="font-semibold text-gray-700 uppercase ">{{$page_info->college_name}}</span>
                        </div>
                    </div>
                    <!--End Breadcrumb -->
                    <!--Table Header -->
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 mt-8">
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
                                        <input type="text" id="simple-search" wire:model.live.debounce.250ms="filters.fee_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Search fee name" required="">
                                </div>
                            </form>
                        </div>
                        <button  type="button" data-modal-target="DeleteUniversityFeeModal" data-modal-toggle="DeleteUniversityFeeModal" id="DeleteFeeToggle" style="display:none;" ></button>
                        <button  type="button" data-modal-target="ActivateUniversityFeeModal" data-modal-toggle="ActivateUniversityFeeModal" id="ActivateFeeToggle" style="display:none;" ></button>
                        <button  type="button" data-modal-target="EditUniversityFeeModal" data-modal-toggle="EditUniversityFeeModal" id="EditFeeToggle" style="display:none;" ></button>
                        <button  type="button" data-modal-target="AddUniversityFeeModal" data-modal-toggle="AddUniversityFeeModal" id="AddFeeToggle" style="display:none;" ></button>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button type="button" wire:click="addFees('AddFeeToggle')"
                                class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add New Fees
                            </button>
                        </div>
                    </div>

                    <div wire:ignore.self id="AddUniversityFeeModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
                        <div class="relative w-8/12 max-w-6xl p-8 max-h-screen flex flex-col">
                            <!-- Modal content -->
                            <form action="#" wire:submit.prevent="saveAddFees('AddUniversityFeeModal')">
                                <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 flex-1">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Add Local Fees
                                        </h3>
                                    </div>
                                    <!-- Close Button - Upper Right Corner -->
                                    <button type="button"
                                        class="absolute top-4 right-4 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="AddUniversityFeeModal">
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
                                                <h3 class="text-2xl font-semibold mb-4">Fee Details</h3>
                                                <div action="#" class="grid gap-6">
                                                    <div class="mb-4">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code</label>
                                                        <input type="text" wire:model.defer="fee.code" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                    dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Fee code">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                        <input type="text" wire:model.defer="fee.name" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                    dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Fee name">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="amount"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                                                        <input type="number" step="0.01" wire:model.defer="fee.amount" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                    dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="P300">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="semester"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                                                        <select id="semester" wire:model.defer="fee.department_id" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option selected="0">Select Course</option>
                                                            @foreach($departments as $key =>$value)
                                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Right Section - Fee Scheduling -->
                                            <div class="mt-8 basis-1/2 pl-4">
                                                <h3 class="text-2xl font-semibold mb-4">Fee Scheduling</h3>
                                                <div class="grid gap-6">
                                                    <div class="mb-2">
                                                        <label for="academic-year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                            Academic
                                                            Year {{$term->year_start.' - '.$term->year_end}}</label>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="semester"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester</label>
                                                        <select id="semester" wire:model.defer="fee.semester_id" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option selected="">Select Semester</option>
                                                            @foreach($semesters as $key =>$value)
                                                                <option value="{{$value->id}}">{{$value->semester.'  ('.$months[$value->date_start_month-1]['month_name'].' '.$value->date_start_date.' - '.$months[$value->date_end_month-1]['month_name'].' '.$value->date_end_date.')'}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Save Fees Button - Bottom Section -->
                                        <div class="mt-4 flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="AddUniversityFeeModal"
                                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                            Back
                                        </button>
                                        <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                        Add Fee
                                    </button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self id="EditUniversityFeeModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
                        <div class="relative w-8/12 max-w-6xl p-8 max-h-screen flex flex-col">
                            <!-- Modal content -->
                            <form action="#" wire:submit.prevent="saveEditFees({{$fee['id']}},'EditUniversityFeeModal')">
                                <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 flex-1">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Add Local Fees
                                        </h3>
                                    </div>
                                    <!-- Close Button - Upper Right Corner -->
                                    <button type="button"
                                        class="absolute top-4 right-4 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="EditUniversityFeeModal">
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
                                                <h3 class="text-2xl font-semibold mb-4">Fee Details</h3>
                                                <div action="#" class="grid gap-6">
                                                    <div class="mb-4">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code</label>
                                                        <input type="text" wire:model.defer="fee.code" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                    dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Fee code">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                        <input type="text" wire:model.defer="fee.name" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                    dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="Fee name">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="amount"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                                                        <input type="number" step="0.01" wire:model.defer="fee.amount" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                    focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                    dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                            placeholder="P300">
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="semester"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                                                        <select id="semester" wire:model.defer="fee.department_id" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option value="0">Select Course</option>
                                                            @foreach($departments as $key =>$value)
                                                                @if($fee['department_id'] == $value->id)
                                                                    <option selected value="{{$value->id}}">{{$value->name}}</option>
                                                                @else 
                                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Right Section - Fee Scheduling -->
   
                                            <div class="mt-8 basis-1/2 pl-4">
                                                <h3 class="text-2xl font-semibold mb-4">Fee Scheduling</h3>
                                                <div class="grid gap-6">
                                                    <div class="mb-2">
                                                        <label for="academic-year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                            Academic
                                                            Year {{$term->year_start.' - '.$term->year_end}}</label>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="semester"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester</label>
                                                        <select id="semester" wire:model.defer="fee.semester_id" required
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <option selected="">Select Semester</option>
                                                            @foreach($semesters as $key =>$value)
                                                                @if($fee['semester_id'] == $value->id)
                                                                    <option selected value="{{$value->id}}">{{$value->semester.'  ('.$months[$value->date_start_month-1]['month_name'].' '.$value->date_start_date.' - '.$months[$value->date_end_month-1]['month_name'].' '.$value->date_end_date.')'}}</option>
                                                                @else
                                                                    <option value="{{$value->id}}">{{$value->semester.'  ('.$months[$value->date_start_month-1]['month_name'].' '.$value->date_start_date.' - '.$months[$value->date_end_month-1]['month_name'].' '.$value->date_end_date.')'}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Save Fees Button - Bottom Section -->
                                        <div class="mt-4 flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="EditUniversityFeeModal"
                                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                            Back
                                        </button>
                                        <button type="submit"
                                        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                        Save Fee
                                    </button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self id="DeleteUniversityFeeModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
                        <div class="relative w-8/12 max-w-6xl p-8 max-h-screen flex flex-col">
                            <!-- Modal content -->
                            <form action="#" wire:submit.prevent="saveDeleteFees({{$fee['id']}},'DeleteUniversityFeeModal')">
                                <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 flex-1">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Edit Local Fees
                                        </h3>
                                    </div>
                                    <!-- Close Button - Upper Right Corner -->
                                    <button type="button"
                                        class="absolute top-4 right-4 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="DeleteUniversityFeeModal">
                                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                        <p> Are you sure you want to delete this Fee?</p>
                                        <!-- Save Fees Button - Bottom Section -->
                                        <div class="mt-4 flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="DeleteUniversityFeeModal"
                                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                            Back
                                        </button>
                                        <button type="submit"
                                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                        Delete Fee
                                    </button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>

                    <!--End Table Header -->
                    <!--Table-->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">ID</th>
                                    <th scope="col" class="px-4 py-3">Fee Name</th>
                                    <th scope="col" class="px-4 py-3">Fee Type</th>
                                    <th scope="col" class="px-4 py-3">Fee Code</th>
                                    <th scope="col" class="px-4 py-3">Semester</th>
                                    <th scope="col" class="px-4 py-3">Amount</th>
                                    <th scope="col" class="px-4 py-3">Academic Year</th>
                                    <th scope="col" class="px-4 py-3">Semester</th>
                                    <th scope="col" class="px-4 py-3">Department</th>
                                    <th scope="col" class="px-4 py-3">Duration</th>
                                    <th scope="col" class="px-4 py-3">Created By</th>
                                    <th scope="col" class="text-center px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($local_fees_data as $key =>$value)
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{($local_fees_data->currentPage()-1)*$local_fees_data->perPage()+$key+1 }}</th>
                                        <td class="px-4 py-3">{{$value->name}}</td>
                                        <td class="px-4 py-3">Local Fee</td>
                                        <td class="px-4 py-3">{{$value->code}}</td>
                                        <td class="px-4 py-3">{{$value->semester}}</td>
                                        <td class="px-4 py-3">{{number_format($value->amount, 2, '.', ',')}}</td>
                                        <td class="px-4 py-3">{{$value->year_start.' - '.$value->year_end}}</td>
                                        <td class="px-4 py-3">{{$value->semester}}</td>
                                        <td class="px-4 py-3">{{$value->department_name}}</td>
                                        <td class="px-4 py-3">{{$months[$value->date_start_month-1]['month_name'].' '.$value->date_start_date.' - '.$months[$value->date_end_month-1]['month_name'].' '.$value->date_end_date}}</td>
                                        <td class="px-4 py-3">{{$value->first_name.' '.$value->middle_name.' '.$value->last_name}}</td>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex justify-center items-center space-x-4">
                                                <button type="button" wire:click="editFees({{$value->id}},'EditFeeToggle')"
                                                    class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                        viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd"
                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Edit
                                                </button>
                                                <button type="button"  wire:click="editFees({{$value->id}},'DeleteFeeToggle')"
                                                    class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                        viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--End Table-->
                </div>
                <div class="row my-2"></div>
                {{ $local_fees_data->links() }}
            </div>
        </section>
    </main>
</div>
