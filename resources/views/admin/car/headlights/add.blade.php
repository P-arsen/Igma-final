@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')
    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">

        <form action="{{route('admin.car.headlights.store')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="name" class="col-form-label">Անվանումը Հայերեն</label>
                <input id="name" class="form-control{{ $errors->has('name_am') ? ' is-invalid' : '' }}" name="name_am" value="{{ old('name_am') }}" required>
                @if ($errors->has('name_am'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name_am') }}</strong></span>
                @endif
                <label for="name" class="col-form-label">Անվանում Ռուսերեն</label>
                <input id="name" class="form-control{{ $errors->has('name_ru') ? ' is-invalid' : '' }}" name="name_ru" value="{{ old('name_ru') }}" required>
                @if ($errors->has('name_ru'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name_ru') }}</strong></span>
                @endif
                <label for="name" class="col-form-label">Անվանումը Անգլերեն</label>
                <input id="name" class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}" name="name_en" value="{{ old('name_en') }}" required>
                @if ($errors->has('name_en'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name_en') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Հաստատել</button>
            </div>
        </form>
    </div>
@endsection

