<x-app-layout>
    <div class="dashboard-frame">
        <div class="dashboard-grid">
            <!-- Sidebar -->
            <aside class="sidebar">
                <h4 class="font-semibold mb-3">Admin</h4>
                <nav>
                    <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
                    <a href="{{ route('admin.letters') }}">Letters</a>
                    <a href="{{ route('admin.reports') }}">Reports</a>
                    <a href="#">Users</a>
                    <a href="#">Settings</a>
                </nav>
            </aside>

            <!-- Main content -->
            <section>
                <div class="mb-4 top-stats">
                    <div class="stat-card w-1/3">
                        <div class="text-sm text-gray-500">Letters</div>
                        <div class="text-2xl font-bold text-indigo-600">{{ $lettersCount }}</div>
                    </div>
                    <div class="stat-card w-1/3">
                        <div class="text-sm text-gray-500">Reports</div>
                        <div class="text-2xl font-bold text-pink-600">{{ $reportsCount }}</div>
                    </div>
                    <div class="stat-card w-1/3">
                        <div class="text-sm text-gray-500">Open Tasks</div>
                        <div class="text-2xl font-bold text-green-600">0</div>
                    </div>
                </div>

                <div class="main-card">
                    <h4 class="text-lg font-medium text-gray-700">Monthly activity (last 12 months)</h4>
                    <div class="mt-4">
                        <canvas id="activityChart" class="w-full" height="320"
                            data-labels='{!! json_encode($labels) !!}'
                            data-letters='{!! json_encode($lettersData) !!}'
                            data-reports='{!! json_encode($reportsData) !!}'
                        ></canvas>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="widget">
                        <h5 class="font-semibold mb-2">Recent Letters</h5>
                        <p class="text-sm text-gray-500">No recent letters.</p>
                    </div>
                    <div class="widget">
                        <h5 class="font-semibold mb-2">Recent Reports</h5>
                        <p class="text-sm text-gray-500">No recent reports.</p>
                    </div>
                </div>
            </section>

            <!-- Right widgets -->
            <aside>
                <div class="widget">
                    <h5 class="font-semibold mb-2">Quick Actions</h5>
                    <a href="{{ route('user.letters.create') }}" class="block text-indigo-600 hover:underline mb-2">Create Letter</a>
                    <a href="{{ route('user.reports.create') }}" class="block text-indigo-600 hover:underline">Create Report</a>
                </div>

                <div class="widget mt-4">
                    <h5 class="font-semibold mb-2">Stats</h5>
                    <div class="text-sm text-gray-600">Letters this year: {{ $lettersCount }}</div>
                    <div class="text-sm text-gray-600">Reports this year: {{ $reportsCount }}</div>
                </div>
            </aside>
        </div>
    </div>

    {{-- External admin assets (CSS/JS). Use CDN for Chart.js as a fallback if node deps aren't installed --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</x-app-layout>
