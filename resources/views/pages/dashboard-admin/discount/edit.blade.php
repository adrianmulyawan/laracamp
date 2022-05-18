@extends('layouts.app')

@section('title', 'Add Discount')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-12 col-md-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        Add New Discount
                    </div>
                    <div class="card-body">
                        <form action="{{ route('discount.update', $data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- Untuk mengetahui id data yang sedang di edit --}}
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">
                                    Name
                                </label>
                                <input name="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Discount Name" value="{{ old('name') ?: $data->name }}" required>
                                @if ($errors->has('name'))
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="code" class="form-label">
                                    Code Discount
                                </label>
                                <input name="code" type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" id="code" placeholder="Discount Code" value="{{ old('code') ?: $data->code }}" maxlength="5" required>
                                @if ($errors->has('code'))
                                    <p class="text-danger">{{ $errors->first('code') }}</p>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">
                                    Description
                                </label>
                                <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" cols="30" rows="10" required>
                                    {{ old('description') ?: $data->description }}
                                </textarea>
                                @if ($errors->has('description'))
                                    <p class="text-danger">{{ $errors->first('description') }}</p>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="percentage" class="form-label">
                                    Discount Percentage
                                </label>
                                <input name="percentage" type="number" class="form-control {{ $errors->has('percentage') ? 'is-invalid' : '' }}" id="percentage" placeholder="Discount Percentage" value="{{ old('percentage') ?: $data->percentage }}" min="1" max="100" required>
                                @if ($errors->has('percentage'))
                                    <p class="text-danger">{{ $errors->first('percentage') }}</p>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@endpush