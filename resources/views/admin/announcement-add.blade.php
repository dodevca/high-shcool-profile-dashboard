@extends('admin')

@section('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
    @include('partials.breadcrumbs', [
        'breadcrumbs' => [
            ['label' => 'Dashboard',    'url' => route('admin.home')],
            ['label' => 'Pengumuman',   'url' => route('admin.announcement.index')],
            ['label' => 'Buat'],
        ]
    ])
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title mb-0">Buat Pengumuman Baru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form id="add-form" action="{{ route('api.admin.announcement.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul pengumuman" required>
                        </div>
                        <div class="mb-3">
                            <label for="announcement-content" class="form-label">Isi Pengumuman</label>
                            <textarea class="form-control d-none" id="announcement-content" name="content" rows="16" placeholder="Tulis isi pengumuman di sini..." required></textarea>
                            <div id="quill-container" class="rounded-bottom" style="height: 398px;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="major_id" class="form-label">Jurusan</label>
                            <select class="form-select" id="major_id" name="major_id">
                                <option value="">Semua Jurusan</option>
                                @foreach($majors as $major)
                                    <option value="{{ $major->id }}">{{ $major->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">
                                Pilih jurusan terkait atau kosongi untuk semua jurusan.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Lampirkan Gambar</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*">
                            <div class="form-text">
                                Jenis berkas: jpg, jpeg, png, atau webp.
                                <br>
                                Ukuran maksimal: 2.0 MB.
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.announcement.index') }}" class="btn btn-outline-danger">Batal</a>
                            <button type="button" class="btn btn-primary" id="add">Buat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/add.js') }}"></script>
    <script>
        const quill = new Quill('#quill-container', {
            placeholder: 'Tulis isi pengumuman di sini...',
            theme: 'snow'
        });
    </script>
    <script>
        $(function() {
            $('#add').on('click', function(){
                var html = quill.root.innerHTML;

                $('#announcement-content').val(html);

                addData();
            });
        });
    </script>
@endsection
