@extends('layouts.admin')

@section("title", "Ubah Katalog")
@section("header", "Ubah Katalog")
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Ubah Katalog</h3>
            </div>

            <form action="{{ url('data/katalog/' . $katalog->id) }}" method="POST">
                @csrf
                <!-- {{ method_field("PUT") }} -->
                @method("PUT")
                <!-- method request -->

                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_katalog">Nama Katalog</label>
                        <input type="text" class="form-control" id="nama_katalog" name="nama_katalog" value="{{ $katalog->nama }}">
                        @error('nama_katalog')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection