@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">📁 {{ __('app.my_files') }}</h2>
        <a href="{{ route('email.create') }}" class="btn btn-outline-secondary">
            ✉️ {{ __('app.send_email') }}
        </a>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Upload Form --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-semibold">{{ __('app.upload_new_file') }}</div>
        <div class="card-body">
            <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-9">
                        <label for="file" class="form-label">
                            {{ __('app.choose_file') }}
                            <small class="text-muted">
                                ({{ __('app.max_size') }}: 10MB — jpg, png, pdf, doc, xls, txt, zip, csv)
                            </small>
                        </label>
                        <input type="file" name="file" id="file"
                               class="form-control @error('file') is-invalid @enderror">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            ⬆️ {{ __('app.upload') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- File List --}}
    <div class="card shadow-sm">
        <div class="card-header fw-semibold">
            {{ __('app.uploaded_files') }}
            <span class="badge bg-primary ms-1">{{ $files->count() }}</span>
        </div>
        <div class="card-body p-0">
            @if($files->isEmpty())
                <div class="text-center text-muted py-5">
                    <p class="mb-0">{{ __('app.no_files') }}</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('app.file_name') }}</th>
                                <th>{{ __('app.type') }}</th>
                                <th>{{ __('app.size') }}</th>
                                <th>{{ __('app.uploaded') }}</th>
                                <th class="text-end">{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                            <tr>
                                <td class="text-muted">{{ $loop->iteration }}</td>
                                <td>{{ Str::limit($file->original_name, 40) }}</td>
                                <td>{{ last(explode('/', $file->mime_type)) }}</td>
                                <td>{{ $file->formatted_size }}</td>
                                <td>{{ $file->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('files.download', $file) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        ⬇ {{ __('app.download') }}
                                    </a>

                                    <form action="{{ route('files.destroy', $file) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('{{ __('app.delete_confirm') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            🗑 {{ __('app.delete') }}
                                        </button>
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
@endsection