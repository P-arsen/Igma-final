@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')
    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
        <form method="POST" action="{{ route('admin.phone.model.edit', $phone) }}">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="col-form-label">Անվանում</label>
                <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $phone->name) }}" required>
                @if ($errors->has('name'))
                    <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <label for="name" class="col-form-label">Անվանում</label>
                <select name="brand_id" id="">
                @foreach($brands as $brand)
                    @if($brand['id']==$phone->brand_id)
                        <option value="{{$brand['id']}}" selected>{{$brand['name']}}</option>
                        @else
                            <option value="{{$brand['id']}}">{{$brand['name']}}</option>
                        @endif
                @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Հաստատել</button>
            </div>
        </form>
@endsection
