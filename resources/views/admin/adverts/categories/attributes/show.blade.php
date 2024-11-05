@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')

    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8 mb-3">
    <table class="table table-bordered table-striped">

        <p><a href="{{ route('admin.adverts.categories.attributes.create', $attributes[0]->category_id) }}" class="btn btn-success">Ավելացնել</a></p>
        @foreach($attributes as $attribute)
        <tbody>
        <tr>
            <th>ID</th><td>{{ $attribute->id }}</td>
        </tr>

        <tr>

            <th>Անվանում Հայերեն</th><td>{{ $attribute->name_am }}</td>
        </tr>
        <tr>
            <th>Անվանում Ռուսերեն</th><td>{{ $attribute->name_ru }}</td>
        </tr>
        <tr>
            <th>Անվանում Անգլերեն</th><td>{{ $attribute->name_en }}</td>
        </tr>
        <tr><th>Փոփոխել</th><td>
                <a href="{{ route('admin.adverts.categories.attributes.edit', [$category, $attribute]) }}" class="btn btn-primary mr-1">Խմբագրել</a>
                <form method="POST" action="{{ route('admin.adverts.categories.attributes.destroy', [$category, $attribute->id]) }}" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Հեռացնել</button>
                </form></td>
        </tr>


        <tbody>
        </tbody>@endforeach
    </table>
    </div>
@endsection
