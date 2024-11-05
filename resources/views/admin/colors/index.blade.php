@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')

    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
        <p><a href="{{ route('admin.colors.add_form') }}" class="btn btn-success">Ավելացնել Գույն</a></p>

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

            @foreach ($colors as $color)
                <tr>
                    <td class="text-center">
                        <a href="{{ route('admin.colors.edit', $color) }}" style="line-height: 100px;text-align: center">{{ $color->name_am }}</a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.colors.edit', $color) }}" style="line-height: 100px;text-align: center">{{ $color->name_ru }}</a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.colors.edit', $color) }}" style="line-height: 100px;text-align: center">{{ $color->name_en }}</a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('admin.colors.edit', $color) }}" class="btn btn-primary mr-1">Խմբագրել</a>

                        <form method="POST" action="{{ route('admin.colors.destroy', $color) }}" class="mr-1">
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
