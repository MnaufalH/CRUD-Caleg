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
                    <h3 class="text-center my-4">WEBSITE DAFTAR CALON LEGISLATIF</h3>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <div class="pb-3">
                            <form class="d-flex" action="{{ route('calegs.index') }}" method="GET">
                                <input class="form-control me-1" type="search" name="searchkey"
                                value="{{ Request::get('searchkey') }}" placeholder="Masukkan kata kunci"
                                aria-label="Search">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </form>
                        </div>
                        <a href="{{ route('calegs.create') }}" class="btn btn-md btn-success mb-3">DAFTAR CALEG</a>
                        <div class="float-right">
                            <a href="{{ route('partais.index') }}" class="btn btn-md btn-info mb-3">LIHAT PARTAI</a>
                            <a href="{{ route('partais.index') }}" class="btn btn-md btn-warning mb-3">LIHAT PEMILU</a>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col" class="text-center">FOTO</th>
                                <th scope="col" class="text-center">NAMA</th>
                                <th scope="col" class="text-center">TTL</th>
                                <th scope="col" class="text-center">JENIS KELAMIN</th>
                                <th scope="col" class="text-center">ALAMAT</th>
                                <th scope="col" class="text-center">PENDIDIKAN TERAKHIR</th>
                                <th scope="col" class="text-center">PARTAI</th>
                                <th scope="col" class="text-center">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($calegs as $caleg)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('/storage/calegs/'.$caleg->foto) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center">{{ $caleg->nama }}</td>
                                    <td class="text-center">{{ $caleg->ttl }}</td>
                                    <td class="text-center">{{ $caleg->gender }}</td>
                                    <td class="text-center">{!! $caleg->alamat !!}</td>
                                    <td class="text-center">{{ $caleg->pendidikan_terakhir }}</td>
                                    <td class="text-center">{{ $caleg->partaiId }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('calegs.destroy', $caleg->id) }}" method="POST">
                                            <a href="{{ route('calegs.show', $caleg->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="{{ route('calegs.edit', $caleg->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
                          {{ $calegs->withQueryString()->links() }}
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