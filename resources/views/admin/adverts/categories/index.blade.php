@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')
<div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
    <p><a href="{{ route('admin.adverts.categories.create') }}" class="btn btn-success">Ավելացնել Կատեգորիա</a></p>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th class="text-center">Անվանում Հայերեն</th>
            <th class="text-center">Անվանում Ռուսերեն</th>
            <th class="text-center">Անվանում Անգլերեն</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($categories as $category)
            <tr>@if($category->parent == null)

                <td class="text-center">
                    <a href="{{ route('admin.adverts.categories.show', $category) }}" style="line-height: 100px;text-align: center">{{ $category->name_am }}</a>
                    </td>
                <td class="text-center">
                    <a href="{{ route('admin.adverts.categories.show', $category) }}" style="line-height: 100px;text-align: center">{{ $category->name_ru }}</a>
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.adverts.categories.show', $category) }}" style="line-height: 100px;text-align: center">{{ $category->name_en }}</a>
                </td>

                @endif
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
@endsection
