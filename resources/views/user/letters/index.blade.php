<x-app-layout>
    <div class="container">
        <h1>Your Letters</h1>

        <a href="{{ route('user.letters.create') }}" class="btn btn-primary mb-3">New Letter</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($letters as $letter)
                <tr>
                    <td>{{ $letter->id }}</td>
                    <td>{{ $letter->type }}</td>
                    <td>{{ $letter->status }}</td>
                    <td>{{ $letter->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $letters->links() }}
    </div>
</x-app-layout>
