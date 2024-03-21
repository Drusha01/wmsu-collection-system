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
                                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Students</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <!--End Breadcrumb -->
                    <!--Table Header -->
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/4">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search" wire:model.live="student_id_search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Search student code" required="">
                                </div>
                            </form>
                        </div>
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Filter
                                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div id="filterDropdown"
                                class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">School Year</h6>
                                <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                    <li class="flex items-center">
                                        <input id="firstyear" type="checkbox" value=""
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="firstyear"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">First
                                            Year</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="secondyear" type="checkbox" value=""
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="secondyear"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Second
                                            Year</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="thirdyear" type="checkbox" value=""
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="thirdyear"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Third
                                            Year</label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="fourthyear" type="checkbox" value=""
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="fourthyear"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Fourth
                                            Year</label>
                                    </li>
                                </ul>
                            </div>
                            <button style="display:none" id="activateStudentModalToggler" data-modal-target="activateStudentModal" data-modal-toggle="activateStudentModal">asdf</button>
                            <button style="display:none" id="deleteStudentModalToggler" data-modal-target="deleteStudentModal" data-modal-toggle="deleteStudentModal">asdf</button>
                            <button style="display:none" id="viewStudentModalToggler" data-modal-target="viewStudentModal" data-modal-toggle="viewStudentModal">asdf</button>
                            <button style="display:none" id="editStudentModalToggler" data-modal-target="editStudentModal" data-modal-toggle="editStudentModal">asdf</button>
                            <button style="display:none" id="addStudentModalToggler" data-modal-target="addStudentModal" data-modal-toggle="addStudentModal">asdf</button>
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <button wire:click="addStudent('addStudentModalToggler')"
                                    class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300
                                    dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Add Students
                                </button>
                            </div>
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <button data-modal-target="addcsv-modal" data-modal-toggle="addcsv-modal"
                                    class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Import Students CSV
                                </button>
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
                                    <th scope="col" class="px-4 py-3">Student ID</th>
                                    <th scope="col" class="px-4 py-3">Student Name</th>
                                    <th scope="col" class="px-4 py-3">College</th>
                                    <th scope="col" class="px-4 py-3">Course</th>
                                    <th scope="col" class="px-4 py-3">Email</th>
                                    <th scope="col" class="px-4 py-3">Is active</th>
                                    <th scope="col" class="px-4 py-3">Is muslim</th>
                                    <th scope="col" class="text-center px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($student_data as $key => $value)
                                    <tr class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{($student_data->currentPage()-1)*$student_data->perPage()+$key+1 }}</th>
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $value->student_code }}</th>
                                        <td class="px-4 py-3">
                                            {{ $value->first_name. ' ' .$value->middle_name.' ' .$value->last_name }}
                                        </td>
                                        <td class="px-4 py-3">{{ $value->college_code }}</td>
                                        <td class="px-4 py-3">{{ $value->department_code }}</td>
                                        <td class="px-4 py-3">{{ $value->email }}</td>
                                        <td class="px-4 py-3">@if($value->is_active) Yes  @else NO @endif</td>
                                        <td class="px-4 py-3">@if($value->is_muslim) Yes  @else NO @endif</td>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex justify-center items-center space-x-4">
                                                <button type="button" wire:click="editStudent({{$value->id}},'viewStudentModalToggler')"
                                                    class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24"
                                                        fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                    </svg>
                                                    Preview
                                                </button>
                                                <button type="button" wire:click="editStudent({{$value->id}},'editStudentModalToggler')"
                                                    class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none
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
                                                    <button type="button" wire:click="editStudent({{$value->id}},'deleteStudentModalToggler')"
                                                        class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                            viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Deactivate
                                                    </button>
                                                @else
                                                    <button type="button" wire:click="editStudent({{$value->id}},'activateStudentModalToggler')"
                                                        class="flex items-center text-yellow-700 hover:text-white border border-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-yellow-500 dark:text-yellow-500 dark:hover:text-white dark:hover:bg-yellow-600 dark:focus:ring-yellow-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5"
                                                            viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Activate
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <div wire:ignore.self id="addStudentModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100% - 1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-3xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Add Student
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="addStudentModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveAddStudent('addStudentModal')">
                                        @csrf
                                        <div class="grid gap-4 mb-12 grid-cols-2">
                                            <div class="col-span-6">
                                                <label for="snumber"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student ID</label>
                                                <input type="text" wire:model.defer="student.student_code" name="snumber" id="snumber"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Student ID" required="" value="{{ old('snumber') }}">
                                                @error('snumber')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                                                    Name</label>
                                                <input type="text" wire:model.defer="student.first_name" name="fname" id="fname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="First Name" required="" value="{{ old('fname') }}">
                                                @error('fname')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="mname"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                                                    Name</label>
                                                <input type="text" wire:model.defer="student.middle_name" name="mname" id="mname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Middle Name" value="{{ old('mname') }}">
                                                @error('mname')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                                                    Name</label>
                                                <input type="text" wire:model.defer="student.last_name" name="lname" id="lname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Last Name" required="" value="{{ old('lname') }}">
                                                @error('lname')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                                <input type="email" wire:model.defer="student.email" name="email" id="email"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Email Address" required="" value="{{ old('email') }}">
                                                @error('email')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-span-6">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Is Muslim?</label>
                                                <input type="checkbox" wire:model.defer="student.is_muslim"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="" value="0">
                                                @error('email')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="college"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Colleges</label>
                                                <select id="college" required wire:model="student.college_id" wire:change="updateDepartments()" name="college"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option selected >Select your college</option>
                                                    @foreach ( $colleges_data as $college)
                                                        <option value="{{ $college->id }}">{{ $college->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('college')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="course"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course</label>
                                                <select id="course" name="course" wire:model.defer="student.department_id"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option selected >Select your course</option>
                                                    @foreach ( $department_data as $department)
                                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('course')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-auto flex items-center justify-end dark:border-gray-600 p-2">
                                            <button type="button" data-modal-toggle="addStudentModal"
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Save Student
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div wire:ignore.self id="viewStudentModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100% - 1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-3xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            View Student
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="viewStudentModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-7 md:p-5" >
                                        @csrf
                                        <div class="grid gap-4 mb-12 grid-cols-2">
                                            <div class="col-span-6">
                                                <label for="snumber"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student ID</label>
                                                <input disabled type="text" wire:model.defer="student.student_code" name="snumber" id="snumber"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Student ID" required="" value="{{ old('snumber') }}">
                                                @error('snumber')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                                                    Name</label>
                                                <input disabled type="text" wire:model.defer="student.first_name" name="fname" id="fname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="First Name" required="" value="{{ old('fname') }}">
                                                @error('fname')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="mname"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                                                    Name</label>
                                                <input disabled type="text" wire:model.defer="student.middle_name" name="mname" id="mname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Middle Name" value="{{ old('mname') }}">
                                                @error('mname')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                                                    Name</label>
                                                <input disabled type="text" wire:model.defer="student.last_name" name="lname" id="lname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Last Name" required="" value="{{ old('lname') }}">
                                                @error('lname')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                                <input disabled type="email" wire:model.defer="student.email" name="email" id="email"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Email Address" required="" value="{{ old('email') }}">
                                                @error('email')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-span-6">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Is Muslim?</label>
                                                <input type="checkbox" wire:key="is_muslim-view{{$value->id}}" @if($student['is_muslim'] == 1) checked @endif
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="" value="0">
                                                @error('email')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="college"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Colleges</label>
                                                <select disabled id="college" required wire:model="student.college_id" wire:change="updateDepartments()" name="college"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option selected >Select your college</option>
                                                    @foreach ( $colleges_data as $college)
                                                        <option value="{{ $college->id }}">{{ $college->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('college')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="course"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course</label>
                                                <select disabled id="course" name="course" wire:model.defer="student.department_id"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option selected >Select your course</option>
                                                    @foreach ( $department_data as $department)
                                                        @if($student['department_id'] == $department->id)
                                                            <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                                                        @else
                                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('course')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-auto flex items-center justify-end dark:border-gray-600 p-2">
                                            <button type="button" data-modal-toggle="addStudentModal"
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div wire:ignore.self id="editStudentModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100% - 1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-3xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Edit Student
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="editStudentModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveEditStudent({{$student['id']}},'editStudentModal')">
                                        @csrf
                                        <div class="grid gap-4 mb-12 grid-cols-2">
                                            <div class="col-span-6">
                                                <label for="snumber"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student ID</label>
                                                <input type="text" wire:model.defer="student.student_code" name="snumber" id="snumber"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Student ID" required="" value="{{ old('snumber') }}">
                                                @error('snumber')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                                                    Name</label>
                                                <input type="text" wire:model.defer="student.first_name" name="fname" id="fname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="First Name" required="" value="{{ old('fname') }}">
                                                @error('fname')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="mname"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle
                                                    Name</label>
                                                <input type="text" wire:model.defer="student.middle_name" name="mname" id="mname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Middle Name" value="{{ old('mname') }}">
                                                @error('mname')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                                                    Name</label>
                                                <input type="text" wire:model.defer="student.last_name" name="lname" id="lname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Last Name" required="" value="{{ old('lname') }}">
                                                @error('lname')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                                <input type="email" wire:model.defer="student.email" name="email" id="email"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Email Address" required="" value="{{ old('email') }}">
                                                @error('email')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>


                                            {{--
                                                New Is Muslim Check Box

                                                <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                                                <input checked id="bordered-checkbox-2" type="checkbox" value="" name="bordered-checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="bordered-checkbox-2" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Checked state</label>
                                            </div>

                                            --}}

                                            <div class="col-span-6">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Is Muslim?</label>
                                                <input type="checkbox" wire:key="is_muslim{{$value->id}}" wire:model.defer="student.is_muslim"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="" value="{{$student['is_muslim']}}">
                                                @error('email')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-span-6">
                                                <label for="college"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Colleges</label>
                                                <select id="college" required wire:model="student.college_id" wire:change="updateDepartments()" name="college"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option selected >Select your college</option>
                                                    @foreach ( $colleges_data as $college)
                                                        <option value="{{ $college->id }}">{{ $college->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('college')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="col-span-6">
                                                <label for="course"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course</label>
                                                <select id="course" name="course" wire:model="student.department_id"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option selected >Select your course</option>
                                                    @foreach ( $department_data as $department)
                                                        @if($student['department_id'] == $department->id)
                                                            <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                                                        @else
                                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('course')
                                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mt-auto flex items-center justify-end dark:border-gray-600 p-2">
                                            <button type="button" data-modal-toggle="editStudentModal"
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Save Student
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div wire:ignore.self id="deleteStudentModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100% - 1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-3xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Deactivate Student
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="deleteStudentModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveDeleteStudent({{$student['id']}},'deleteStudentModal')">
                                        @csrf
                                        <div class="grid gap-4 mb-12">
                                            <p>Are you sure you want to deactivate this student?</p>
                                        </div>
                                        <div class="mt-auto flex items-center justify-end dark:border-gray-600 p-2">
                                            <button type="button" data-modal-toggle="deleteStudentModal"
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Deactivate Student
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div wire:ignore.self id="activateStudentModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100% - 1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-3xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Activate Student
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="activateStudentModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveActivateStudent({{$student['id']}},'activateStudentModal')">
                                        @csrf
                                        <div class="grid gap-4 mb-12 grid-cols-2">
                                            <p>Are you sure you want to deactivate this student?</p>
                                        </div>
                                        <div class="mt-auto flex items-center justify-end dark:border-gray-600 p-2">
                                            <button type="button" data-modal-toggle="activateStudentModal"
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Activate Student
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div  wire:ignore.self id="addcsv-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100% - 1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Add CSV
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="addcsv-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form id="csv-upload-form" class="p-7 md:p-5" method="POST" enctype="multipart/form-data">
                                        <div class="grid gap-4 mb-12 grid-cols-1">
                                            <div class="flex items-center justify-center w-full">
                                                <label for="dropzone-file"
                                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                        </svg>
                                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                                class="font-semibold">Click to upload</span> or drag and drop</p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">CSV files only</p>
                                                    </div>
                                                    <input id="dropzone-file" type="file" class="hidden" accept=".csv" />
                                                </label>
                                            </div>
                                        </div>
                                        <button type="button" onclick="readCSV()"
                                            class="absolute bottom-4 right-4 text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Add CSV
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row my-2"></div>
                {{ $student_data->links() }}
            </div>
        </section>
    </main>
</div>
