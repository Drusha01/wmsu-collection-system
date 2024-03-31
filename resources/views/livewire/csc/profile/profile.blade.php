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
                                    <span class="inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                                        </svg>
                                        Home
                                    </span>
                                </li>
                                <li aria-current="page">
                                    <a href="{{route('csc-profile')}}" class="flex items-center">
                                        <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                        </svg>
                                        <span class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400">Profile</span>
                                    </a>
                                </li>
                            </ol>
                        </nav>
                        <!--End Breadcrumb -->

                        <div class="flex flex-row md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class=" w-screen grid grid-rows-4 grid-flow-row gap-4 items-center justify-between p-4  border mr-4 ml-4 border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                                <div class="w-full">
                                    <div class="mb-10 justify-start">
                                        <h1 class="text-base font-bold text-gray-900 sm:text-2xl">Personal Information </h1>
                                        <hr class="w-full border mt-8">
                                    </div>
                                    <div>
                                        <div class="grid gap-6 mb-6 md:grid-cols-1 w-3/6">
                                            <div>
                                                <div class="grid grap-3 mb-3 md:grid cols-2">
                                                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Username</label> 
                                                <span id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                    {{$user_info['username']}}
                                                </span>
                                            </div>
                                            
                                        </div>
                                        <div class="relative">
                                            <label for="fname" wire:model="user_details.first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                            <span id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                {{$user_info['first_name']}}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="relative">
                                            <label for="mname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
                                            <span id="mname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block  mb-5 h-10 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                {{$user_info['middle_name']}}
                                            </span>
                                        </div>
                                        <div class="relative">
                                            <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                            <span id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                {{$user_info['last_name']}}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                                        <div class="relative">
                                            <label for="term" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Term</label>
                                            <span id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                {{$user_info['term']}}
                                            </span>
                                        </div>
                                        <div class="relative">
                                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                            <span id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                {{$user_info['role_name']}}
                                            </span>
                                        </div>
                                        <div class="relative">
                                            <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                                            <span id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                {{$user_info['position_name']}}
                                            </span>
                                        </div>
                                        <div class="relative">
                                            <label for="college" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College</label>
                                            <span id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                                                {{$user_info['college_name']}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex justify-center mt-12">
                                        <button data-modal-target="name-modal" data-modal-toggle="name-modal" class="rounded-3xl  w-full sm:w-36 
                                        text-white inline-flex items-center  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300
                                        font-medium text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.944-4.742A2.907 2.907 0 0 0 18.092 8Z" clip-rule="evenodd"/>
                                        </svg>
                                            Edit Details
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div id="name-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-lg max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit Profile 
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="name-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" wire:submit.prevent="updateProfile('name-modal')">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                <input type="text" wire:model="user_info.first_name" name="fname" id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                 placeholder="{{$user_info['first_name']}}" required="">
                            </div>
                            <div class="col-span-2">
                                <label for="mname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
                                <input type="text" wire:model="user_info.middle_name" name="mname" id="mname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full min-w-max p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                placeholder="{{$user_info['middle_name']}}">
                            </div>
                            <div class="col-span-2">
                                <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                <input type="text" wire:model="user_info.last_name" name="lname" id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                placeholder="{{$user_info['last_name']}}" required="">
                            </div>
                        </div>

                            <div class="flex justify-center content-center text-center mt-10">
                            <button data-modal-hide="name-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                            <button type="submit" class="mx-2 rounded-lg text-sm w-full sm:w-40  text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">                    
                                Save
                            </button>
                        </div>
                    </form>
                </div>
        </div> 
            
    </main>
</div>
      