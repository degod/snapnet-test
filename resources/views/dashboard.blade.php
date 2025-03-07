<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-3 pt-9">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                    <p class="text-3xl font-bold text-orange-500">{{ $totalUsers }}</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">All Admin Users</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalAdminUsers }}</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">All Regular Users</h3>
                    <p class="text-3xl font-bold text-green-500">{{ $totalRegularUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Total Projects</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $totalProjects }}</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Total Tasks</h3>
                    <p class="text-3xl font-bold text-green-500">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Pending Tasks</h3>
                    <p class="text-3xl font-bold text-yellow-500">{{ $pendingTasks }}</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">In-Progress Tasks</h3>
                    <p class="text-3xl font-bold text-orange-500">{{ $inProgressTasks }}</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Completed Tasks</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $completedTasks }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-700">Failed Jobs</h3>
                    <p class="text-3xl font-bold text-red-500">{{ $failedJobs }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>