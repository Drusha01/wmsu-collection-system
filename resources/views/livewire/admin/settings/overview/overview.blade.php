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
                                <a href="{{route('admin-overview')}}" class="flex items-center">
                                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400">Overview</span>
                                </a>
                            </li>
                        </ol>
                    </nav>
                    <!--End Breadcrumb -->
                    <!--Table Header -->
                    <div class="flex flex-col md:flex-row items-center justify-end space-y-3 md:space-y-0 md:space-x-4 p-4">

                        <button  id="Semester" style="display:none" type="button" data-modal-target="SemesterModal" data-modal-toggle="SemesterModal" class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                            1st Semester Span
                        </button>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0" >
                            <button wire:click="editSemester(1,'Semester')" type="button" class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                1st Semester Span
                            </button>
                        </div>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0" data-modal-target="overview-modal" data-modal-toggle="overview-modal">
                            <button type="button" wire:click="editSemester(2,'Semester')"  class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                2nd Semester Span
                            </button>
                        </div>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0" data-modal-target="overview-modal" data-modal-toggle="overview-modal">
                            <button wire:click="addSchoolYear()" type="button" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add Academic Year
                            </button>
                        </div>
                    </div>

                    <div wire:ignore.self id="EditAcademicYearModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
                        <div class="relative w-8/12 max-w-6xl p-8 max-h-screen flex flex-col">
                            <!-- Modal content -->
                            <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 flex-1">
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Edit Year 
                                        {{$school_year['year_start'].' - '.$school_year['year_end']}}
                                    </h3>
                                </div>
                                <!-- Close Button - Upper Right Corner -->
                                <button type="button"
                                    class="absolute top-4 right-4 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="EditAcademicYearModal">
                                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>

                                <form  class="grid gap-6 grid-cols-1" wire:submit.prevent="saveEditAcademicYear({{$school_year['id']}},'EditAcademicYearModal')">
                                    <div class="mt-8 ">
                                        <label class="text-md font-large">{{$school_year['year_start']}}</label>
                                        <div class="mb-2">
                                            <label for="start-date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                Start Month
                                            </label>
                                            <select id="month" required wire:model.defer="school_year.date_start_month"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                @foreach($months as $key =>$value)
                                                    @if($school_year['date_start_month'] == $value['month_number'])
                                                        <option selected value="{{$value['month_number']}}">{{$value['month_name']}}</option>
                                                    @else
                                                        <option value="{{$value['month_number']}}">{{$value['month_name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="start-date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                Start Date
                                            </label>

                                            @if($school_year['date_start_month'] >0)
                                            <select id="month" required wire:model.defer="school_year.date_start_date"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                @for($i = 0 ; $i< $months[$school_year['date_start_month']]['max_date']; $i++)
                                                    <option value="{{($i+1)}}">{{($i+1)}}</option>
                                                @endfor
                                            </select>
                                            @endif
                                        </div>
                                        <label class="text-md font-large">{{$school_year['year_end']}}</label>
                                        <div class="mb-2">
                                            <label for="start-date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                End Month
                                            </label>
                                            <select id="month" required wire:model.defer="school_year.date_end_month"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                @foreach($months as $key =>$value)
                                                    @if($school_year['date_end_month'] == $value['month_number'])
                                                        <option selected value="{{$value['month_number']}}">{{$value['month_name']}}</option>
                                                    @else
                                                        <option value="{{$value['month_number']}}">{{$value['month_name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="start-date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                End Date
                                            </label>

                                            @if($school_year['date_end_month'] >0)
                                            <select id="month" required wire:model.defer="school_year.date_end_date"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                @for($i = 0 ; $i< $months[$school_year['date_end_month']-1]['max_date']; $i++)
                                                    <option value="{{($i+1)}}">{{($i+1)}}</option>
                                                @endfor
                                            </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end rounded-t dark:border-gray-600 p-2 mt-4">
                                        <button data-modal-toggle="EditAcademicYearModal"
                                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                            Back
                                        </button>
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self id="SemesterModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
                        <div class="relative w-8/12 max-w-6xl p-8 max-h-screen flex flex-col">
                            <!-- Modal content -->
                            <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 flex-1">
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{$semester['semester']}} Span
                                    </h3>
                                </div>
                                <!-- Close Button - Upper Right Corner -->
                                <button type="button"
                                    class="absolute top-4 right-4 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="SemesterModal">
                                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>

                                <form action="#" class="grid gap-6 grid-cols-1" wire:submit.prevent="saveSemester({{$semester['id']}},'SemesterModal')">
                                    <div class="mt-8 ">
                                        <div class="mb-2">
                                            <label for="start-date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                Start Month
                                            </label>
                                            <select id="month" required wire:model.defer="semester.date_start_month"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                @foreach($months as $key =>$value)
                                                    @if($semester['date_start_month'] == $value['month_number'])
                                                        <option selected value="{{$value['month_number']}}">{{$value['month_name']}}</option>
                                                    @else
                                                        <option value="{{$value['month_number']}}">{{$value['month_name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="start-date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                Start Date
                                            </label>

                                            @if($semester['date_start_month'] >0)
                                            <select id="month" required wire:model.defer="semester.date_start_date"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                @for($i = 0 ; $i< $months[$semester['date_start_month']]['max_date']; $i++)
                                                    <option value="{{($i+1)}}">{{($i+1)}}</option>
                                                @endfor
                                            </select>
                                            @endif
                                        </div>

                                        <div class="mb-2">
                                            <label for="start-date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                End Month
                                            </label>
                                            <select id="month" required wire:model.defer="semester.date_end_month"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                @foreach($months as $key =>$value)
                                                    @if($semester['date_end_month'] == $value['month_number'])
                                                        <option selected value="{{$value['month_number']}}">{{$value['month_name']}}</option>
                                                    @else
                                                        <option value="{{$value['month_number']}}">{{$value['month_name']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="start-date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                End Date
                                            </label>

                                            @if($semester['date_end_month'] >0)
                                            <select id="month" required wire:model.defer="semester.date_end_date"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                @for($i = 0 ; $i< $months[$semester['date_end_month']-1]['max_date']; $i++)
                                                    <option value="{{($i+1)}}">{{($i+1)}}</option>
                                                @endfor
                                            </select>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end rounded-t dark:border-gray-600 p-2 mt-4">
                                        <button data-modal-toggle="SemesterModal"
                                            class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                            Back
                                        </button>
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!--End Table Header -->
                    <!--Table-->
                    <button style="display:none" id="EditAcademicYearModalToggler" data-modal-target="EditAcademicYearModal" data-modal-toggle="EditAcademicYearModal">asdf</button>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">#</th>
                                    <th scope="col" class="px-4 py-3">School Year</th>
                                    <th scope="col" class="px-4 py-3">Start Date</th>
                                    <th scope="col" class="px-4 py-3">End Date</th>
                                    <th scope="col" class="text-center px-4 py-3">Actions</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($school_years as $key =>$value)
                                <tr class="border-b dark:border-gray-700">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{($school_years->currentPage()-1)*$school_years->perPage()+$key+1 }}</th>
                                    <td class="px-4 py-3">{{$value->year_start.' - '.$value->year_end}}</td>
                                    <td scope="col" class="px-4 py-3">{{date_format(date_create($value->date_start),"M d, Y")}}</td>
                                    <td scope="col" class="px-4 py-3">{{date_format(date_create($value->date_end),"M d, Y")}}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex justify-center items-center space-x-4">
                                            <button type="button" wire:click="editAcademicYear({{$value->id}},'EditAcademicYearModalToggler')" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                </svg>
                                                Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row my-2"></div>
                {{ $school_years->links() }}
            </div>
        </section>
    </main>
</div>
