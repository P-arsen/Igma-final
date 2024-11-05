@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')
    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">

        <form action="{{route('admin.car.model.store')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="name" class="col-form-label">Անվանումը Հայերեն</label>
                <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>
            <div class="form-group">
                <label for="name" class="col-form-label">Անվանումը Հայերեն</label>
                <select name="brand_id" id="">
                    @foreach($brands as $brand)
                        <option value="{{$brand['id']}}">{{$brand['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Հաստատել</button>
            </div>
        </form>
    </div>
@endsection

