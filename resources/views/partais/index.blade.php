<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Caleg DPRD 2024</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background-image: url('assets/img/indonesia.jpg')">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Data-Data Partai</h3>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <div class="pb-3">
                            <form class="d-flex" action="{{ route('partais.index') }}" method="GET">
                                <input class="form-control me-1" type="search" name="searchkey"
                                value="{{ Request::get('searchkey') }}" placeholder="Masukkan kata kunci"
                                aria-label="Search">
                                <button class="btn btn-primary float-right" type="submit">Search</button>
                            </form>
                        </div>
                        <a href="{{ route('partais.create') }}" class="btn btn-md btn-success mb-3">DAFTAR PARTAI</a>
                        <a href="{{ route('calegs.index') }}" class="btn btn-md btn-info mb-3 float-right">LIHAT CALEG</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col" class="text-center">Logo Partai</th>
                                <th scope="col" class="text-center">Nama Partai</th>
                                <th scope="col" class="text-center">Pimpinan</th>
                                <th scope="col" class="text-center">Visi Misi</th>
                                <th scope="col" class="text-center">Periode</th>
                                <th scope="col" class="text-center">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($partais as $partai)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('/storage/partais/'.$partai->logo_partai) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center">{{ $partai->nama_partai }}</td>
                                    <td class="text-center">{{ $partai->pimpinan }}</td>
                                    <td class="text-center">{!! $partai->vmisi !!}</td>
                                    <td class="text-center">{{ $partai->periode }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('partais.destroy', $partai->id) }}" method="POST">
                                            <a href="{{ route('partais.show', $partai->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="{{ route('partais.edit', $partai->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Caleg belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $partais->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>

</body>
</html>