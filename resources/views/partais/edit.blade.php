<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Partai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('partais.update', $partai->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Logo Patai</label>
                                <input type="file" class="form-control" name="logo_partai">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Partai</label>
                                <input type="text" class="form-control @error('nama_partai') is-invalid @enderror" name="nama_partai" value="{{ old('nama_partai', $partai->nama_partai) }}" placeholder="Masukkan Nama Partai">
                            
                                <!-- error message untuk nama -->
                                @error('nama_partai')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Pimpinan</label>
                                <input type="text" class="form-control @error('pimpinan') is-invalid @enderror" name="pimpinan" value="{{ old('pimpinan', $partai->pimpinan) }}" placeholder="Pimpinan">
                            
                                <!-- error message untuk nama -->
                                @error('pimpinan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Visi Misi</label>
                                <textarea class="form-control @error('vmisi') is-invalid @enderror" name="vmisi" rows="3" placeholder="Masukkan Visi Misi">{{ old('vmisi', $partai->vmisi) }}</textarea>
                            
                                <!-- error message untuk content -->
                                @error('vmisi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Masa Periode</label>
                                <input type="text" class="form-control @error('periode') is-invalid @enderror" name="periode" value="{{ old('periode', $partai->periode) }}" placeholder="Masa Periode">
                            
                                <!-- error message untuk title -->
                                @error('periode')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
</body>
</html>