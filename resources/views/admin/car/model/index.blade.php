@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')

    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
        <p><a href="{{ route('admin.car.model.add_form') }}" class="btn btn-success">Ավելացնել Մոդել</a></p>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center">Անվանում</th>
                <th class="text-center">Մոդելի ID</th>
                <th class="text-center">Խմբագրել</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($cars as $car)
                <tr>
                    <td class="text-center">
                        <a href="{{ route('admin.car.model.edit', $car) }}" style="line-height: 100px;text-align: center">{{ $car->name }}</a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.car.model.edit', $car) }}" style="line-height: 100px;text-align: center">{{ $car->brand_id }}</a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('admin.car.model.edit', $car) }}" class="btn btn-primary mr-1">Խմբագրել</a>

                        <form method="POST" action="{{ route('admin.car.model.destroy', $car) }}" class="mr-1">
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
