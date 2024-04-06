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
                                <span class="inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                    </svg>
                                    Home
                                </span>
                            </li>
                            <li aria-current="page">
                                <a href="{{ route('usc-remittance')}}" class="flex items-center">
                                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400">Remittance</span>
                                </a>
                            </li>
                        </ol>
                    </nav>
                    <!--End Breadcrumb -->
                    <div class="col">
                        <div class="flex flex-wrap items-center justify-between mt-3 px-4 p-2">
                            <h6 class="font-bold text-base text-gray-700 uppercase">Academic Year {{$page_info->school_year}}</h6>
                            <button style="display:none" id="downloadExportModalToggler" data-modal-toggle="downloadExportModal" data-modal-target="downloadExportModal">asdf</button>
                            <button type="button" 
                                wire:click="downloadExportDefault('downloadExportModalToggler')"
                                class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none
                                focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                <svg class="w-6 h-6 mr-2 text-white-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v9.293l-2-2a1 1 0 0 0-1.414 1.414l.293.293h-6.586a1 1 0 1 0 0 2h6.586l-.293.293A1 1 0 0 0 18 16.707l2-2V20a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z" clip-rule="evenodd"/>
                                </svg>                              
                                Download Export
                            </button>

                        </div>
                    </div>
                    <!--Table Header -->
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-3/4 flex">
                            <div class="flex items-center">
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
                            <button style="display:none" id="FilterTableModalToggler" data-modal-toggle="FilterTableModal" data-modal-target="FilterTableModal"></button>
                            <div class="flex flex-col md:flex-row items-center justify-end space-y-3 md:space-y-0 md:space-x-4 ">
                                <div class="flex items-center space-x-3 w-full md:w-auto">
                                    <button type="button" wire:click="tableFilter('FilterTableModalToggler')" class="text-dark-400 hover:text-dark border border-dark-900
                                        hover:bg-dark-800 font-bold py-2 px-3 rounded">
                                        Columns
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <div class="flex items-center space-x-3 w-full md:w-auto">
                                <button  type="button" data-modal-target="ApproveRemitModal" data-modal-toggle="ApproveRemitModal" id="ApproveRemitModalToggle" style="display:none;" ></button>
                                <button  type="button" data-modal-target="CancelRemitModal" data-modal-toggle="CancelRemitModal" id="CancelRemitModalToggle" style="display:none;" ></button>
                            </div>
                            <div class="flex items-center space-x-3 ">
                                <select id="course" name="course" wire:model.live="filters.college_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected value="" >Filter College </option>
                                    @foreach($college_data as $key =>$value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
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
                                    @foreach($table_filters['filter_content']  as $key =>$value)
                                        @if($value['active'])
                                            <th scope="col" class="px-4 py-3">{{$value['column']}}</th>
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($remittance_data as $key => $value)
                                <tr class="border-b dark:border-gray-700">
                                    @foreach($table_filters['filter_content']  as $filter_key =>$filter_value)
                                        @if($filter_value['active'])
                                            @if($filter_value['column'] == '#')
                                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{($remittance_data->currentPage()-1)*$remittance_data->perPage()+$key+1 }}</th>
                                            @elseif($filter_value['column'] == 'Remitted By')
                                                <td class="px-4 py-3">{{ $value->remitted_by_first_name. ' ' .$value->remitted_by_middle_name.' ' .$value->remitted_by_last_name }}</td>
                                            @elseif($filter_value['column'] == 'Approved By')
                                                <td class="px-4 py-3">@if(strlen($value->appoved_by)>0) {{ $value->approved_by_first_name. ' ' .$value->approved_by_middle_name.' ' .$value->approved_by_last_name }} @else Pending @endif</td>
                                            @elseif($filter_value['column'] == 'Date')
                                                <td class="px-4 py-3">{{date_format(date_create( $value->{$filter_value['column_name']}),"M d, Y")}}</td>
                                            @elseif($filter_value['column'] == 'Date')
                                                <td class="px-4 py-3">@if(strlen($value->appoved_by)>0) Approved @else Pending @endif</td>
                                            @elseif($filter_value['column'] == 'Proof')
                                                <td class="px-4 py-3">
                                                    <a href="{{asset('storage/content/remit_photo/'.$value->remit_photo)}}" target="_blank">
                                                        <button class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 font-bold py-2 px-3 rounded">
                                                            View Proof
                                                        </button>
                                                    </a>
                                                </td>
                                            @elseif($filter_value['column'] == 'Approval Status')
                                                <td class="px-4 py-3">@if(strlen($value->appoved_by)>0) Approved @else Pending @endif</td>
                                            @elseif($filter_value['column'] == 'Action')
                                                <td class="px-4 py-3">
                                                    @if(strlen($value->appoved_by)>0)
                                                        <button wire:click="editRemit({{$value->id}},'CancelRemitModalToggle')"class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                            Cancel
                                                        </button> 
                                                    @else 
                                                        <button wire:click="editRemit({{$value->id}},'ApproveRemitModalToggle')"class="text-yellow-700 hover:text-white border border-yellow-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                            Approve
                                                        </button> 
                                                    @endif
                                                </td>
                                            @else
                                                <td class="px-4 py-3">{{ $value->{$filter_value['column_name']} }}</td>
                                            @endif
                                        @endif
                                    @endforeach
                                    
                                 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div wire:ignore.self id="FilterTableModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
                            <div class="relative w-8/12 max-w-6xl p-8 max-h-screen flex flex-col">
                                <!-- Modal content -->
                                <form action="#" wire:submit.prevent="saveTableFilter({{$table_filters['id']}},'FilterTableModal')">
                                    <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 flex-1">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Columns
                                            </h3>
                                        </div>
                                        <!-- Close Button - Upper Right Corner -->
                                        <button type="button"
                                            class="absolute top-4 right-4 text-gray-400 bg-transparent 
                                            hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="FilterTableModal">
                                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="flex flex-row justify-between">
                                            <div action="#" class="grid gap-6">
                                                <div class="m-5 ">
                                                    @foreach($table_filters['filter_content']  as $key =>$value)
                                                        <div class="flex items-center mb-4">
                                                            <input wire:model="table_filters.filter_content.{{$key}}.active" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$value['column']}}</label>
                                                        </div>
                                                    @endforeach 
                                                </div> 
                                            </div>
                                        </div>
                                        <!-- Save Fees Button - Bottom Section -->
                                        <div class="mt-4 flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="FilterTableModal" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div wire:ignore.self id="ApproveRemitModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
                            <div class="relative w-8/12 max-w-6xl p-8 max-h-screen flex flex-col">
                                <!-- Modal content -->
                                <form action="#" wire:submit.prevent="saveApproveRemit({{$remit['id']}},'ApproveRemitModal')">
                                    <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 flex-1">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Approve Remit
                                            </h3>
                                        </div>
                                        <!-- Close Button - Upper Right Corner -->
                                        <button type="button"
                                            class="absolute top-4 right-4 text-gray-400 bg-transparent 
                                            hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="ApproveRemitModal">
                                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="flex flex-row justify-between">
                                            <p> Are you sure you want to approve this remittance?</p>

                                        </div>
                                        <!-- Save Fees Button - Bottom Section -->
                                        <div class="mt-4 flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="ApproveRemitModal" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Approve
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <div wire:ignore.self id="CancelRemitModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
                            <div class="relative w-8/12 max-w-6xl p-8 max-h-screen flex flex-col">
                                <!-- Modal content -->
                                <form action="#" wire:submit.prevent="saveCancelRemit({{$remit['id']}},'CancelRemitModal')">
                                    <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 flex-1">
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Cancel Remit
                                            </h3>
                                        </div>
                                        <!-- Close Button - Upper Right Corner -->
                                        <button type="button"
                                            class="absolute top-4 right-4 text-gray-400 bg-transparent 
                                            hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="ApproveRemitModal">
                                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="flex flex-row justify-between">
                                            <p> Are you sure you want to cancel approval this remittance?</p>

                                        </div>
                                        <!-- Save Fees Button - Bottom Section -->
                                        <div class="mt-4 flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="CancelRemitModal" type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>

              {{-- Modals  --}}

              <div wire:ignore.self id="downloadExportModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 max-h-full w-2/4">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-400">
                            <button type="button"  class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                            data-modal-hide="downloadExportModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5" id="to_print">
                                <div class="flex items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Export Remittance
                                    </h3>
                                </div>
                            </div>
                            <div class="grid gap-6 mb-6 md:grid-cols-1 w-full">
                                <div class="flex items-center space-x-3 w-full md:w-auto">
                                    <select id="course" name="course" wire:model="downloadfilters.college_id"
                                    class="mx-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected value="" >Filter College </option>
                                        @foreach($college_data as $key =>$value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="flex items-center space-x-3 w-full md:w-auto">
                                    <select id="course" name="course" wire:model="export_selected"
                                    class="mx-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach($export_types as $key =>$value)
                                        @if($key == 0)
                                            <option  value="{{$value['name']}}">EXPORT {{$value['name']}}</option>
                                        @else 
                                            <option value="{{$value['name']}}">EXPORT {{$value['name']}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-auto flex items-center justify-end dark:border-gray-600 p-2 m-5 pb-3">
                                <button type="button" data-modal-toggle="downloadExportModal" class="text-dark-700 hover:text-dark border border-dark-700
                                        hover:bg-dark-800 font-bold py-2 px-3 rounded">
                                    Back
                                    </button>
        
                                <button type="submit" wire:click="downloadExport('downloadExportModal')" class=" mx-2 text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Download 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--End Table-->
                    <div class="row my-2"></div>
                    {{$remittance_data->links()}}
                </div>
               
            </div>

            
        </section>
    </main>
</div>
