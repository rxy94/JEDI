<!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <a href="{{route('dashboard')}}" class="rounded-md bg-gray-900 px-3 py-2 text-lg font-medium text-white" aria-current="page">Home</a>
                        <a href="{{route('dashboard')}}" class="rounded-md px-3 py-2 text-lg font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Departamentos</a>
                        <a href="#" class="rounded-md px-3 py-2 text-lg font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Edificios</a>
                    </div>
                </div>
            </div>

            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <a href="#" class="rounded-md bg-gray-900 px-3 py-2 text-lg font-medium text-white" aria-current="page">Perfil</a>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="rounded-md px-3 py-2 text-lg font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
  