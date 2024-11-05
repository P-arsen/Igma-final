@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')
    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
        <form method="POST" action="{{ route('admin.tv.screen.edit', $tv_size) }}">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="col-form-label">Անվանում</label>
                <input id="name" class="form-control{{ $errors->has('size') ? ' is-invalid' : '' }}" name="size" value="{{ old('size', $tv_size->size) }}" required>
                @if ($errors->has('size'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('size') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Հաստատել</button>
            </div>
        </form>
@endsection
