<x-controlpanel>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3 mb-0">Manajemen Diskon</h6>
                            {{-- UBAH INI: Tambahkan 'admin.' prefix --}}
                            <a href="{{ route('admin.discounts.create') }}" class="btn btn-light btn-sm text-dark me-3 mb-0">
                                <i class="material-icons opacity-10 me-1">add</i> Tambah Diskon Baru
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if ($discounts->isEmpty())
                            <div class="alert alert-info text-center mx-4" role="alert">
                                Belum ada diskon yang tersedia. Klik "Tambah Diskon Baru" untuk membuat diskon pertama Anda!
                            </div>
                        @else
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Diskon</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kode</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Berlaku Sampai</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-secondary opacity-7">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($discounts as $discount)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $discount->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $discount->description ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $discount->code ?? 'N/A' }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        @if ($discount->type == 'percentage')
                                                            Persentase
                                                        @else
                                                            Nilai Tetap
                                                        @endif
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($discount->type == 'percentage')
                                                        <span class="badge badge-sm bg-gradient-success">{{ $discount->value }}%</span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-info">Rp {{ number_format($discount->value, 0, ',', '.') }}</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ \Carbon\Carbon::parse($discount->ends_at)->format('d M Y') }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if ($discount->is_active && \Carbon\Carbon::now()->lessThanOrEqualTo($discount->ends_at))
                                                        <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                                    @elseif (\Carbon\Carbon::now()->greaterThan($discount->ends_at))
                                                        <span class="badge badge-sm bg-gradient-danger">Kedaluwarsa</span>
                                                    @else
                                                        <span class="badge badge-sm bg-gradient-secondary">Non-Aktif</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    {{-- UBAH INI: Tambahkan 'admin.' prefix --}}
                                                    <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                    {{-- UBAH INI: Tambahkan 'admin.' prefix --}}
                                                    <form action="{{ route('admin.discounts.destroy', $discount->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0" onclick="return confirm('Apakah Anda yakin ingin menghapus diskon ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-controlpanel>