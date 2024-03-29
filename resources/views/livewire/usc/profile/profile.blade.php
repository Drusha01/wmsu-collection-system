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
                                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Profile</span>
                                    </div>
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
                                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                                            <div>
                                                <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                                <input type="text" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
                                            </div>
                                            <div class="relative">
                                                <label for="Role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                                <select id="Role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                    <option value="" selected>USC Admin</option>
                                                    <option value="Role1">USC Admin</option>
                                                    <option value="Role2">CSC Admin</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
                                            </div>
                                            <div class="relative">
                                                <label for="college" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College</label>
                                                <select id="college" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                    <option value="" selected>College Of Computing Studies</option>
                                                    <option value="college1">College Of Computing Studies</option>
                                                    <option value="college2">College Of Nursing</option>
                                                    <option value="college3">College Of Engineerin</option>
                                                </select>
                                            </div>
                                            <div class="relative">
                                                <label for="term" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Term</label>
                                                <select id="term" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                    <option value="" selected>2023-2024</option>
                                                    <option value="term1">2023-2024</option>
                                                    <option value="term2">2024-2025</option>
                                                </select>
                                            </div>
                                            <div class="relative">
                                                <label for="term" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                                                <select id="term" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                    <option value="" selected>University President</option>
                                                    <option value="position1">University President</option>                                                    
                                                    <option value="position2">University Vice President</option>
                                                    <option value="position3">Senator</option>
                                                </select>
                                            </div>
                                        </div>      
                                        <div class="flex justify-center mt-12">
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-3xl text-sm w-full sm:w-48 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Update Profile
                                        </button>            
                                    </div>   
                                </div>
                            </div>
                        </div>
    
                        

                    </div>
                    <div class="row my-2"></div>
                </div>
            </section>
        </main>
    </div>
    