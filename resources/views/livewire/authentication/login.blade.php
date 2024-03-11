<div>
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-36">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-64 h-64 mr-2" src="/images/logo.jpg" alt="logo">
            </a>
            <div class="w-full md:mt-0 sm:max-w-md xl:p- dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" wire:submit="login()">
                        @csrf
                        <div>
                            <label for="text" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Username</label>
                            <input wire:model.defer="username" type="text" name="username" id="username" class="bg-gray-50 border border-gray-300
                            text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                            dark:focus:border-blue-500" placeholder="Enter your username" required="">
                            @error('username')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                            @enderror

                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Password</label>
                            <input  wire:model.defer="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none
                        focus:ring-primary-300 font-medium rounded-lg text-md px-5 py-2.5 text-center dark:bg-primary-600
                        dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
