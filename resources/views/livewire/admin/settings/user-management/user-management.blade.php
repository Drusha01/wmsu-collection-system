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
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">User Management</span>
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
                                        <input type="text" id="simple-search" wire:model.live.debounce.250ms="filters.username"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Search username" required="">
                                </div>
                            </form>
                        </div>
                        
                        <button  type="button" data-modal-target="activateUserModal" data-modal-toggle="activateUserModal" id="activateUserModaltoggler" style="display:none;" ></button>
                        <button  type="button" data-modal-target="deleteUserModal" data-modal-toggle="deleteUserModal" id="deleteUserModaltoggler" style="display:none;" ></button>
                        <button  type="button" data-modal-target="editUserModal" data-modal-toggle="editUserModal" id="editUserModaltoggler" style="display:none;" ></button>
                        <button  type="button" data-modal-target="addUserModal" data-modal-toggle="addUserModal" id="addUserModaltoggler" style="display:none;" ></button>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button type="button" wire:click="addUser('addUserModaltoggler')" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add User
                            </button>
                        </div>
                    </div>

                    
                    <!--End Table Header -->
                    <!--Table-->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">#</th>
                                    <th scope="col" class="px-4 py-3">Username</th>
                                    <th scope="col" class="px-4 py-3">Name</th>
                                    <th scope="col" class="px-4 py-3">Term</th>
                                    <th scope="col" class="px-4 py-3">Role</th>
                                    <th scope="col" class="px-4 py-3">College</th>
                                    <th scope="col" class="px-4 py-3">Position</th>
                                    <th scope="col" class="text-center px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users_data as $key => $value)
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{($users_data->currentPage()-1)*$users_data->perPage()+$key+1 }}</th>
                                        <td class="px-4 py-3">{{ $value->username}}</td>
                                        <td class="px-4 py-3"> {{ $value->first_name. ' ' .$value->middle_name.' ' .$value->last_name }}</td>
                                        <td class="px-4 py-3">{{ $value->year_start.' - '.$value->year_end}}</td>
                                        <td class="px-4 py-3">{{ $value->role_name}}</td>
                                        <td class="px-4 py-3">{{ $value->college_name}}</td>
                                        <td class="px-4 py-3">{{ $value->position_name}} </td>
                                        <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex justify-center items-center space-x-4">
                                                {{-- <button type="button" class="py-2 px-3 flex items-center text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-2 -ml-0.5">
                                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" />
                                                    </svg>
                                                    Preview
                                                </button> --}}
                                                <button type="button" wire:click="editUser({{$value->id}},'editUserModaltoggler')" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                    </svg>
                                                    Edit
                                                </button>
                                                @if($value->is_active)
                                                <button type="button" wire:click="editUser({{$value->id}},'deleteUserModaltoggler')" class="flex items-center text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    Deactivate
                                                </button>
                                                @else 
                                                <button type="button" wire:click="editUser({{$value->id}},'activateUserModaltoggler')"  class="flex items-center text-yellow-700 hover:text-white border border-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-yellow-500 dark:text-yellow-500 dark:hover:text-white dark:hover:bg-yellow-600 dark:focus:ring-yellow-900">
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
                        <div wire:ignore.self id="addUserModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Add User
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="addUserModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveAddUser('addUserModal')">
                                        <div class="grid gap-5 mb-12 grid-cols-2">
                                            <div class="col-span-6">
                                                <label for="snumber"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                                <input type="snumber" wire:model.defer="user.first_name" name="snumber" id="snumber"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="First Name" required>
                                            </div>
                                            <div class="col-span-6">
                                                <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
                                                <input type="lname" wire:model.defer="user.middle_name" name="lname" id="lname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Middle Name">
                                            </div>
                                            <div class="col-span-6">
                                                <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                                <input type="lname" wire:model.defer="user.last_name" name="lname" id="lname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Last Name" required>
                                            </div>
                                            <div class="col-span-6">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                                <input type="text" wire:model.defer="user.username" 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Username" required>
                                            </div>

                                            <div class="col-span-6">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                                <input type="password" wire:model.defer="user.password"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Password" required>
                                            </div>

                                            <div class="col-span-6">
                                                <label for="position"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Term</label>
                                                <select id="position" required wire:model.defer="user.school_year_id" 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option selected>Select Term</option>
                                                @foreach($school_years as $key =>$value)
                                                    <option value="{{$value->id}}">{{$value->year_start.' - '.$value->year_end}}</option>
                                                @endforeach
                                                </select>
                                            </div>

                                            <div class="col-span-6">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                                <div class="flex items-center space-x-4">
                                                    @foreach($roles as $key =>$value)
                                                    @if($key == 0)
                                                        <input type="radio" checked wire:model="user.role_id" wire:change="updateRole()" id="role-{{$value->name}}" name="{{$value->name}}" value="{{$value->id}}"
                                                            class="text-primary-500 focus:ring-primary-500 dark:focus:ring-primary-500 dark:text-white">
                                                        <label for="role-{{$value->name}}"
                                                            class="text-sm font-medium text-gray-900 dark:text-white">{{$value->name}}
                                                        </label>
                                                    @else
                                                        <input type="radio"  wire:model="user.role_id" wire:change="updateRole()" id="role-{{$value->name}}" name="{{$value->name}}" value="{{$value->id}}"
                                                            class="text-primary-500 focus:ring-primary-500 dark:focus:ring-primary-500 dark:text-white">
                                                        <label for="role-{{$value->name}}"
                                                            class="text-sm font-medium text-gray-900 dark:text-white">{{$value->name}}
                                                        </label>
                                                    @endif
                                                   @endforeach
                                                </div>
                                            </div>
                                            @if($user['role_name'] == 'usc-admin')
                                                <div class="col-span-6">
                                                    <label for="position"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                                                    <select id="position" required wire:model.defer="user.position_id" 
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option selected>Select Position</option>
                                                    @foreach($positions as $key =>$value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            @elseif($user['role_name'] == 'csc-admin')
                                                <div class="col-span-6">
                                                    <label for="colleges"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College</label>
                                                    <select id="colleges" required wire:model.defer="user.college_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option selected>Select College</option>
                                                        @foreach($colleges as $key =>$value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-span-6">
                                                    <label for="position"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                                                    <select id="position" required wire:model.defer="user.position_id" 
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option selected>Select Position</option>
                                                    @foreach($positions as $key =>$value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="mt-auto flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="addUserModal"
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Add User
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div wire:ignore.self id="editUserModal" tabindex="-1" aria-hidden="true" data-modal-backdrop="static" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Edit User
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="editUserModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveEditUser({{$user['id']}},'editUserModal')">
                                        <div class="grid gap-5 mb-12 grid-cols-2">
                                            <div class="col-span-6">
                                                <label for="snumber"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                                <input type="snumber" wire:model.defer="user.first_name" name="snumber" id="snumber"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="First Name" required>
                                            </div>
                                            <div class="col-span-6">
                                                <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
                                                <input type="lname" wire:model.defer="user.middle_name" name="lname" id="lname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Middle Name">
                                            </div>
                                            <div class="col-span-6">
                                                <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                                <input type="lname" wire:model.defer="user.last_name" name="lname" id="lname"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Last Name" required>
                                            </div>
                                            <div class="col-span-6">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                                <input type="text" wire:model.defer="user.username" 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Username" required>
                                            </div>

                                            <!-- <div class="col-span-6">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                                <input type="password" wire:model.defer="user.password"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                    placeholder="Password" required>
                                            </div> -->

                                            <div class="col-span-6">
                                                <label for="position"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Term</label>
                                                <select id="position" required wire:model.defer="user.school_year_id" 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option selected>Select Term</option>
                                                @foreach($school_years as $key =>$value)
                                                    @if($user['school_year_id'] == $value->id)
                                                        <option selected value="{{$value->id}}">{{$value->year_start.' - '.$value->year_end}}</option>
                                                    @else
                                                        <option value="{{$value->id}}">{{$value->year_start.' - '.$value->year_end}}</option>
                                                    @endif
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-span-6">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                                <div class="flex items-center space-x-4">
                                                    @foreach($roles as $key =>$value)
                                                    @if($key == 0)
                                                        <input type="radio" required wire:model="user.role_id" wire:change="updateRole()" id="role-{{$value->name}}" name="roles" value="{{$value->id}}"
                                                            class="text-primary-500 focus:ring-primary-500 dark:focus:ring-primary-500 dark:text-white">
                                                        <label for="role-{{$value->name}}"
                                                            class="text-sm font-medium text-gray-900 dark:text-white">{{$value->name}}
                                                        </label>
                                                    @else
                                                        <input type="radio" required wire:model="user.role_id" wire:change="updateRole()" id="role-{{$value->name}}" name="roles" value="{{$value->id}}"
                                                            class="text-primary-500 focus:ring-primary-500 dark:focus:ring-primary-500 dark:text-white">
                                                        <label for="role-{{$value->name}}"
                                                            class="text-sm font-medium text-gray-900 dark:text-white">{{$value->name}}
                                                        </label>
                                                    @endif
                                                   @endforeach
                                                </div>
                                            </div>
                                            @if($user['role_name'] == 'usc-admin')
                                                <div class="col-span-6">
                                                    <label for="position"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                                                    <select id="position" required wire:model.defer="user.position_id" 
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option selected>Select Position</option>
                                                    @foreach($positions as $key =>$value)
                                                        @if($user['position_id'] == $value->id)
                                                            <option selected value="{{$value->id}}">{{$value->name}}</option>
                                                        @else
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>
                                            @elseif($user['role_name'] == 'csc-admin')
                                                <div class="col-span-6">
                                                    <label for="colleges"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">College</label>
                                                    <select id="colleges" required wire:model.defer="user.college_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option selected>Select College</option>
                                                        @foreach($colleges as $key =>$value)
                                                            @if($user['college_id'] == $value->id)
                                                                <option selected value="{{$value->id}}">{{$value->name}}</option>
                                                            @else
                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endif
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-span-6">
                                                    <label for="position"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                                                    <select id="position" required wire:model.defer="user.position_id" 
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option selected>Select Position</option>
                                                    @foreach($positions as $key =>$value)
                                                        @if($user['position_id'] == $value->id)
                                                            <option selected value="{{$value->id}}">{{$value->name}}</option>
                                                        @else
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                            

                                        </div>
                                        <div class="mt-auto flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="editUserModal"
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Save User
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div wire:ignore.self id="deleteUserModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Deactivate User
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="deleteUserModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveDeleteUser({{$user['id']}},'deleteUserModal')">
                                        <div class="grid gap-5 mb-12">
                                            <p>Are you sure you want to deactivate this user?</p>

                                        </div>
                                        <div class="mt-auto flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="deleteUserModal"
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Deactivate User
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div wire:ignore.self id="activateUserModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Activate User
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="activateUserModal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-7 md:p-5" wire:submit.prevent="saveActivateUser({{$user['id']}},'activateUserModal')">
                                        <div class="grid gap-5 mb-12 grid-cols-2">
                                            <p>Are you sure you want to activate this user?</p>

                                        </div>
                                        <div class="mt-auto flex items-center justify-end dark:border-gray-600 p-2">
                                            <button data-modal-toggle="activateUserModal"
                                                class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 font-bold py-2 px-3 rounded">
                                                Back
                                            </button>
                                            <button type="submit"
                                                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-bold rounded py-2 px-3 focus:outline-none ml-2">
                                                Activate User
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row my-2"></div>
                {{ $users_data->links() }}
            </div>
        </section>
    </main>
</div>
