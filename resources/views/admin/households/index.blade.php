@extends('admin.layout')

@section('title', 'Daftar Kartu Keluarga')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Daftar Kartu Keluarga</h1>
        <div>
            <a href="{{ route('admin.residents.index') }}" class="btn btn-sm">Lihat Penduduk</a>
        </div>
    </div>

    <div class="bg-white shadow rounded-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. KK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kepala Keluarga (Perwakilan)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Anggota</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($households as $index => $hk)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $households->firstItem() + $index }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $hk->kk_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @php
                            $rep = $hk->representative;
                            $isHead = optional($rep)->is_head ?? false;
                        @endphp
                        <div class="flex items-center gap-2">
                            <div>
                                <div class="font-medium">{{ $rep->name ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $rep->nik ?? '' }}</div>
                            </div>
                            @if($isHead)
                                <span class="ml-2 inline-flex items-center px-2 py-1 rounded bg-yellow-100 text-yellow-800 text-xs">Kepala Keluarga</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $hk->members }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                        <a href="{{ route('admin.residents.index', ['filter' => 'kk', 'kk_number' => $hk->kk_number]) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Lihat Anggota</a>

                        <form method="POST" action="{{ route('admin.households.assignHead') }}" class="inline">
                            @csrf
                            <input type="hidden" name="kk_number" value="{{ $hk->kk_number }}" />
                            <input type="hidden" name="resident_id" value="{{ $hk->representative->id ?? '' }}" />
                            <button class="text-sm text-green-600 hover:text-green-800 mr-3">Tetapkan Kepala</button>
                        </form>

                        <button onclick="openEditKkModal('{{ $hk->kk_number }}')" class="text-sm text-blue-600 hover:text-blue-800">Ubah No. KK</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $households->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
function openEditKkModal(oldKk) {
    const newKk = prompt('Masukkan No. KK yang baru untuk keluarga ' + oldKk + ':', oldKk);
    if (! newKk) return;
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('admin.households.updateKk') }}';
    const token = document.createElement('input'); token.type = 'hidden'; token.name = '_token'; token.value = '{{ csrf_token() }}'; form.appendChild(token);
    const oldInput = document.createElement('input'); oldInput.type = 'hidden'; oldInput.name = 'old_kk'; oldInput.value = oldKk; form.appendChild(oldInput);
    const newInput = document.createElement('input'); newInput.type = 'hidden'; newInput.name = 'new_kk'; newInput.value = newKk; form.appendChild(newInput);
    document.body.appendChild(form);
    form.submit();
}
</script>
@endpush
