<div>
<main class="p-9 sm:ml-64 pt-20 sm:pt-8 h-auto">
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-1">

            <div class="mx-5 px-3 lg:px-4">
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
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">College</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <!--End Breadcrumb -->
                    <!--Table Header -->
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/4">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                                </div>
                            </form>
                        </div>
                        <button  type="button" data-modal-target="addDepartmentModal" data-modal-toggle="addDepartmentModal" id="addDepartmentModaltoggler" style="display:none;" ></button>
                        <button  type="button" data-modal-target="viewDepartmentModal" data-modal-toggle="viewDepartmentModal" id="viewDepartmentModaltoggler" style="display:none;" ></button>
                        <button  type="button" data-modal-target="viewCollegeModal" data-modal-toggle="viewCollegeModal" id="viewCollegeModaltoggler" style="display:none;" ></button>
                        <button  type="button" data-modal-target="activateCollegeModal" data-modal-toggle="activateCollegeModal" id="activateCollegeModaltoggler" ></button>
                        <button  type="button" data-modal-target="deleteCollegeModal" data-modal-toggle="deleteCollegeModal" id="deleteCollegeModaltoggler" style="display:none;" ></button>
                        <button  type="button" data-modal-target="editCollegeModal" data-modal-toggle="editCollegeModal" id="editCollegeModaltoggler" style="display:none;" ></button>
                        <button  wire:ignore.self type="button" wire:click="addCollege()" data-modal-target="addCollegeModal" data-modal-toggle="addCollegeModal" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                            Add College
                        </button>
                    </div>
                    <!--End Table Header -->
                    <!--Table-->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">#</th>
                                    <th scope="col" class="px-4 py-3">College Code</th>
                                    <th scope="col" class="px-4 py-3">College Name</th>
                                    <th scope="col" class="text-center px-4 py-3">Department</th>
                                    <th scope="col" class="text-center px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($college_data as $key => $value)
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{($college_data->currentPage()-1)*$college_data->perPage()+$key+1 }}</th>
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$value->code}}</th>
                                        <td class="px-4 py-3">{{$value->name}}</td>
                                        <td>
                                            <div class="flex justify-center items-center space-x-4">
                                                <button type="button" wire:click="ViewDepartment({{$value->id}},'viewDepartmentModaltoggler')" class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                    </svg>
                                                        View Department      
                                                </button>
                                                <button wire:click="addDepartment({{$value->id}},'addDepartmentModaltoggler')" type="button"class="py-2 px-3 flex items-center text-sm font-medium text-center text-blue-900 focus:outline-none bg-white rounded-lg border border-blue-200 hover:bg-blue-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-700 dark:bg-blue-800 dark:text-blue-400 dark:border-blue-600 dark:hover:text-white dark:hover:bg-blue-700" >
                                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                                    </svg>
                                                    Add Department
                                                </button>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            

                                            <div class="flex justify-center items-center space-x-4">
                                              
                                                <button wire:click="editCollege({{$value->id}},'viewCollegeModaltoggler')" type="button"class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                    </svg>
                                                    View
                                                </button>
                                                <button wire:click="editCollege({{$value->id}},'editCollegeModaltoggler')" type="button" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none
                                                    focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
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
                                                @if($value->is_active)
                                                    <button wire:click="editCollege({{$value->id}},'deleteCollegeModaltoggler')" type="button" class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        Deactivate
                                                    </button>
                                                @else
                                                    <button wire:click="editCollege({{$value->id}},'activateCollegeModaltoggler')" type="button" class="flex items-center text-yellow-700 hover:text-white border border-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-yellow-500 dark:text-yellow-500 dark:hover:text-white dark:hover:bg-yellow-600 dark:focus:ring-yellow-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        Activate
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        <div id="addCollegeModal" wire:ignore.self tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Add College
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addCollegeModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveAddCollege('addCollegeModal')">
                                        @csrf
                                        <div class="grid gap-4 mb-5 grid-cols-2">
                                            <div class="col-span-6">
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College Name</label>
                                                <input wire:model.defer="college.name" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the full name for the college" required value="{{ old('name') }}">
                                                <span class="text-sm font-thin text-gray-500 dark:text-gray-400">Enter the full name of the college</span>
                                                @error('name')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                                @enderror 
                                            </div>
                                            <div class="col-span-6">
                                                <label for="college_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College Code</label>
                                                <input  wire:model.defer="college.code" type="text" name="college_code" id="college_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the code for the college" required value="{{ old('college_code') }}">
                                                <span class="text-sm font-thin text-gray-500 dark:text-gray-400">Enter the code for the college  </span>
                                                @error('college_code')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                                @enderror 
                                            </div>
                                        </div>
                                        <div id="courses-container">
                                            <!-- Dynamic Input for Courses -->
                                        </div>
                                        <div class="flex justify-end items-center mt-2">

                                            <button type="button" data-modal-toggle="addCollegeModal" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                                Close
                                            </button>
                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                Add College
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div id="editCollegeModal" wire:ignore.self tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Edit College
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editCollegeModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    @if(isset($college['id']))
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveEditCollege({{$college['id']}},'editCollegeModal')">
                                        @csrf
                                        <div class="grid gap-4 mb-5 grid-cols-2">
                                            <div class="col-span-6">
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College Name</label>
                                                <input wire:model.defer="college.name" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the full name of the college" required value="{{ old('name') }}">
                                                <span class="text-sm font-thin text-gray-500 dark:text-gray-400">Enter the full name of the college</span>
                                                @error('name')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                                @enderror 
                                            </div>
                                            <div class="col-span-6">
                                                <label for="college_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College Code</label>
                                                <input  wire:model.defer="college.code" type="text" name="college_code" id="college_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the code for the college" required value="{{ old('college_code') }}">
                                                <span class="text-sm font-thin text-gray-500 dark:text-gray-400">Enter the code for the college  </span>
                                                @error('college_code')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                                @enderror 
                                            </div>
                                        </div>
                                        <div id="courses-container">
                                            <!-- Dynamic Input for Courses -->
                                        </div>
                                        <div class="flex justify-end items-center mt-2">

                                            <button type="button" data-modal-toggle="editCollegeModal" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                                Close
                                            </button>
                                            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                                Save College
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="viewCollegeModal" wire:ignore.self tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            View College
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="viewCollegeModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    @if(isset($college['id']))
                                    <form class="p-7 md:p-5" >
                                        @csrf
                                        <div class="grid gap-4 mb-5 grid-cols-2">
                                            <div class="col-span-6">
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College Name</label>
                                                <input disabled wire:model.defer="college.name" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the full name of the college" required value="{{ old('name') }}">
                                                <span class="text-sm font-thin text-gray-500 dark:text-gray-400">Enter the full name of the college</span>
                                                @error('name')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                                @enderror 
                                            </div>
                                            <div class="col-span-6">
                                                <label for="college_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College Code</label>
                                                <input disabled  wire:model.defer="college.code" type="text" name="college_code" id="college_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the code for the college" required value="{{ old('college_code') }}">
                                                <span class="text-sm font-thin text-gray-500 dark:text-gray-400">Enter the code for the college  </span>
                                                @error('college_code')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                                @enderror 
                                            </div>
                                        </div>
                                        <div id="courses-container">
                                            <!-- Dynamic Input for Courses -->
                                        </div>
                                        <div class="flex justify-end items-center mt-2" data-modal-toggle="viewCollegeModal">
                                            <button type="button"  class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800" data-modal-target="viewCollegeModal">
                                                Close
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="deleteCollegeModal" wire:ignore.self tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Delete College
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="deleteCollegeModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    @if(isset($college['id']))
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveDeleteCollege({{$college['id']}},'deleteCollegeModal')">
                                        @csrf
                                        <div class="grid gap-4 mb-5">
                                            <p>Are you sure you want to deactivate this college?</p>
                                        </div>
                                        <div id="courses-container">
                                            <!-- Dynamic Input for Courses -->
                                        </div>
                                        <div class="flex justify-end items-center mt-2">

                                            <button type="button" data-modal-toggle="deleteCollegeModal" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                                Close
                                            </button>
                                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                                Deactivate College
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="activateCollegeModal" wire:ignore.self tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Activate College
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="activateCollegeModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    @if(isset($college['id']))
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveActivateCollege({{$college['id']}},'activateCollegeModal')">
                                        @csrf
                                        <div class="grid gap-4 mb-5 grid-cols-2">
                                            <p>Are you sure you want to delete this college?</p>
                                        </div>
                                        <div id="courses-container">
                                            <!-- Dynamic Input for Courses -->
                                        </div>
                                        <div class="flex justify-end items-center mt-2">

                                            <button type="button" data-modal-toggle="activateCollegeModal" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                                Close
                                            </button>
                                            <button type="submit" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800">
                                                Activate College
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="viewDepartmentModal" wire:ignore.self tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{$college['name'].' ('.$college['code'].')'}}
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8
                                             ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="viewDepartmentModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    @if(isset($college['id']))
                                    <form class="p-7 md:p-5" >
                                        @csrf
                                        @forelse($departments as $key => $value)
                                        <div class="grid gap-4 grid-cols-2">
                                            <div class="col-span-6">
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{$value->name.' ('.$value->code.')'}}</label>
                                            </div>
                                        </div>
                                        @empty 
                                            <div class="grid gap-4 grid-cols-2">
                                                <div class="col-span-6">
                                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NO DATA</label>
                                                </div>
                                            </div>
                                        @endforelse
                                        <div id="courses-container">
                                            <!-- Dynamic Input for Courses -->
                                        </div>
                                        <div class="flex justify-end items-center mt-2" data-modal-toggle="viewDepartmentModal">
                                            <button type="button"  class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                                Close
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="addDepartmentModal" wire:ignore.self tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{$college['name'].' ('.$college['code'].')'}}
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8
                                             ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addDepartmentModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    @if(isset($college['id']))
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveAddDepartment('addDepartmentModal')">
                                        @csrf
                                        <div class="grid gap-4 mb-5 grid-cols-2">
                                            <div class="col-span-6">
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department Name</label>
                                                <input wire:model.defer="department.name" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the full name of the college" required value="{{ old('name') }}">
                                                <span class="text-sm font-thin text-gray-500 dark:text-gray-400">Enter the full name of the college</span>
                                                @error('name')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                                @enderror 
                                            </div>
                                            <div class="col-span-6">
                                                <label for="college_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department Code</label>
                                                <input  wire:model.defer="department.code" type="text" name="college_code" id="college_code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter the code for the college" required value="{{ old('college_code') }}">
                                                <span class="text-sm font-thin text-gray-500 dark:text-gray-400">Enter the code for the college  </span>
                                                @error('college_code')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                                                @enderror 
                                            </div>
                                        </div>
                                        <div id="courses-container">
                                            <!-- Dynamic Input for Courses -->
                                        </div>
                                        <div class="flex justify-end items-center mt-2">

                                            <button type="button" data-modal-toggle="editCollegeModal" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                                Close
                                            </button>
                                            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                                Add Department
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Table-->
                    <!--Table Pagination-->
                    <!-- <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                            Showing
                            <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                            of
                            <span class="font-semibold text-gray-900 dark:text-white">1000</span>
                        </span>
                        <ul class="inline-flex items-stretch -space-x-px">
                            <li>
                                <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                            </li>
                            <li>
                                <a href="#" aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-red-600 bg-red-50 border border-red-300 hover:bg-red-100 hover:text-red-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav> -->
                    <!--End Table Pagination-->
                </div>
                <div class="row my-2"></div>
                {{ $college_data->links() }}
            </div>
        </section>
    </main>
</div>