@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')

    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8 mb-3">
        <a href="{{ route('admin.adverts.categories.edit', $category) }}" class="btn btn-primary mr-1">Խմբագրել Կատեգորիան</a>
        <form method="POST" action="{{ route('admin.adverts.categories.destroy', $category) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Ջնջել Կատեգորիան</button>
        </form>


    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $category->id }}</td>
        </tr>
        <tr>
            <th>Անվանում Հայերեն</th><td>{{ $category->name_am }}</td>
        </tr>
        <tr>
            <th>Անվանում Ռուսերեն</th><td>{{ $category->name_ru }}</td>
        </tr>
        <tr>
            <th>Անվանում Անգլերեն</th><td>{{ $category->name_en }}</td>
        </tr>
        <tbody>
        </tbody>
    </table>

    <p><a href="{{ route('admin.adverts.categories.attributes.create', $category) }}" class="btn btn-success">Ավելացնել</a></p>

    <table class="table table-bordered">
        <thead>
        <tr><th colspan="4">Ենթակատեգորիաններ</th></tr>
        <tr>
            <th>Անվանում Հայերեն</th>
            <th>Անվանում Ռուսերեն</th>
            <th>Անվանում Անգլերեն</th>
        </tr>
        </thead>
        <tbody>



        @forelse ($attributes as $attribute)

            <tr>
                <td>
                    <a href="{{ route('admin.adverts.categories.attributes.show', [$category, $attribute]) }}">{{ $attribute->name_am }}</a>
                </td>
                <td>
                    <a href="{{ route('admin.adverts.categories.attributes.show', [$category, $attribute]) }}">{{ $attribute->name_ru }}</a>
                </td>
                <td>
                    <a href="{{ route('admin.adverts.categories.attributes.show', [$category, $attribute]) }}">{{ $attribute->name_en }}</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Դատարկ</td></tr>
        @endforelse


        </tbody>
    </table>
    </div>
@endsection
