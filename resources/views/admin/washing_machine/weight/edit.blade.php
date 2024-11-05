@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')
    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
        <form method="POST" action="{{ route('admin.washing_machine.weight.edit', $washing) }}">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="col-form-label">Բրենդի Անվանումը</label>
                <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name_am" value="{{ old('name', $washing->name) }}" required>
                @if ($errors->has('name_am'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name_am') }}</strong></span>
                @endif

                <label for="name" class="col-form-label">Անվանում Ռուսերեն</label>
                <input id="name" class="form-control{{ $errors->has('name_ru') ? ' is-invalid' : '' }}" name="name_ru" value="{{ old('name_ru', $washing->name_ru) }}" required>
                @if ($errors->has('name_ru'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name_ru') }}</strong></span>
                @endif

                <label for="name" class="col-form-label">Անվանում Անգլերեն</label>
                <input id="name" class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}" name="name_en" value="{{ old('name_en', $washing->name_en) }}" required>
                @if ($errors->has('name_en'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name_en') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Հաստատել</button>
            </div>
        </form>
@endsection
