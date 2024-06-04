<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('buku.create') }}" class="btn btn-md btn-success mb-3">Tambah Buku</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Cover</th>
                                    <th>Name</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bukus as $buku)
                                    <tr>
                                        <td class="text-center">{{ $bukus->firstItem() + $loop->index }}</td>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $buku->cover_image) }}" class="rounded" style="width: 150px">
                                        </td>
                                        <td>{{ $buku->name }}</td>
                                        <td>{{ $buku->author }}</td>
                                        <td>{{ $buku->is_published ? 'Published' : 'Not Published' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>

                                            <form method="POST" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>

                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="7" class="alert alert-danger">
                                            Data Buku Belum Tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $bukus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>

</body>

</html>
