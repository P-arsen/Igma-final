@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')

    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
        <p><a href="{{ route('admin.real-estates.type.add_form') }}" class="btn btn-success">Ավելացնել Վերանորոգում</a></p>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center">Անվանում Հայերեն</th>
                <th class="text-center">Անվանում Ռուսերեն</th>
                <th class="text-center">Անվանում Անգլերեն</th>
                <th class="text-center">Խմբագրել</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($flat_types as $flat_type)
                <tr>
                    <td class="text-center">
                        <a href="{{ route('admin.real-estates.type.edit', $flat_type) }}" style="line-height: 100px;text-align: center">{{ $flat_type->name_am }}</a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.real-estates.type.edit', $flat_type) }}" style="line-height: 100px;text-align: center">{{ $flat_type->name_ru }}</a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.real-estates.type.edit', $flat_type) }}" style="line-height: 100px;text-align: center">{{ $flat_type->name_en }}</a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('admin.real-estates.type.edit', $flat_type) }}" class="btn btn-primary mr-1">Խմբագրել</a>

                        <form method="POST" action="{{ route('admin.real-estates.type.destroy', $flat_type) }}" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Հեռացնել</button>
                        </form>
                    </td>

                    <td>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
