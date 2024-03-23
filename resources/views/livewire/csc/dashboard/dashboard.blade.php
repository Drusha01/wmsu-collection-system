<main class="p-9 sm:ml-64 pt-20 sm:pt-8 h-auto">
    <div class="p-4">
        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            <div class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 mb-4 mt-4 max-w-full">
            
                <!-- First Section -->
                <div class="col-span-1 items-center justify-between p-4 bg-white border ml-4 border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Total Collected </h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">52,250</span>
                    </div>
                </div>

                <!-- Second Section -->
                <div class="col-span-1 items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">USC shares</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">Php 15,675</span>
                </div>
            </div>

            <!-- Third Section -->
            <div class="col-span-1 mr-4 p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">CSC shares</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">Php 36,575</span>
                </div>
            </div>

        </div>
        <div class="px-4 pt-6 2xl:px-0 max-w-screen-xl mx-auto -mt-8">
            <div class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-2 mb-4 mt-4 max-w-full">
            
                <!-- First Section -->
                <div class="col-span-1 items-center justify-between p-4 bg-white border ml-4 border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Number of student enrolled</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">300</span>
                    </div>
                </div>

                <!-- Second Section -->
                <div class="col-span-1 mr-4 items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="w-full">
                        <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Number of paid students</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">260</span>
                    </div>
            </div>

        </div>            
        <div class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-2 mb-4 mt-4 max-w-full">
            
            <!-- First Section -->
            <div class="items-center flex justify-around p-4 bg-white border ml-4 border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="items-center content-center lg:flex mb-10">
                    <canvas id="cscChart1"></canvas>
                 </div>
            </div>

            <!-- Second Section -->
            <div class="col-span-1 items-center flex justify-around p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800 mr-4">
                <div class="items-center content-center lg:flex mb-10">
                    <canvas id="cscChart2"></canvas>
                 </div>
        </div>
            <!-- Third Section -->
            <div class="col-span-1 items-center flex justify-around p-4 bg-white border ml-4 border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="mt-5 w-full">
                    <canvas id="FeeChart"></canvas>
                </div>
            </div>

            <!-- Fourth Section -->
            <div class="col-span-1 items-center flex justify-around p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800 mr-4">
                <div class="mt-5 w-full h-40">
                    <canvas id="semesterRemittedChart"></canvas>
                </div>
        </div>
    </div>
            <div class="sm:p-6 md:p-8 lg:p-10 xl:p-12 2xl:p-16 ml-4 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 dark:bg-gray-800">
                <div class="items-center justify-between lg:flex mb-10">
                    <div class="mb-4 lg:mb-0">
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Recent Collection</h3>
                        <span class="text-base font-normal text-gray-500 dark:text-gray-400">This is a list of the latest collection this semester</span>
                    </div>
                    <div class="items-center sm:flex">
                        <div class="px-4 pt-6 2xl:px-0 max-w-screen-xl mx-auto">
                            <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                                class="mb-4 sm:mb-0 mr-4 inline-flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                type="button">
                                Filter by status
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                                    Category
                                </h6>
                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                    <li class="flex items-center">
                                        <input id="apple" type="checkbox" value=""
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                        <label for="apple"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Paid
                                        </label>
                                    </li>

                                    <li class="flex items-center">
                                        <input id="fitbit" type="checkbox" value="" checked
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />

                                        <label for="fitbit"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Remitted
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="flex flex-col mt-6">
                    <div class="overflow-x-auto rounded-lg">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden shadow sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Transaction
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    CSC Fee
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Date & Time
                                </th>
                                <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Amount
                                </th>
                                <th scope="col" class="p-5 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                    Status
                                </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">                       
                                <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                    Payment from <span class="font-semibold">Alphabet LLC</span>
                                </td>
                                <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                    Php 200
                                </td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    Mar 23 ,2021
                                </td>
                                <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                    Php 25,000
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">Paid</span>
                                </td>
                                </tr>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                    Payment from <span class="font-semibold">Bonnie Green</span>
                                </td>
                                <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                    Php 200
                                </td>
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    Mar 23 ,2021
                                </td>
                                <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                    Php 25,000
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500">Paid</span>
                                </td>
                                </tr>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                    Remitted by <span class="font-semibold">Ye Boi</span>
                                    </td>
                                    <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                    Php 200
                                    </td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    Mar 23 ,2021
                                    </td>
                                    <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                    Php 10,000
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-purple-100 dark:bg-gray-700 dark:border-purple-500 dark:text-purple-400">Remitted</span>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
           </div>
</main>
