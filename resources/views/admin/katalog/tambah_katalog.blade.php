@extends('layouts.admin')

@section("title", "Tambah Katalog")
@section("header", "Tambah Katalog")
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Tambah Katalog</h3>
            </div>

            <form action="{{ url('data/katalog') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_katalog">Nama Katalog</label>
                        <input type="text" class="form-control" id="nama_katalog" name="nama_katalog">
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