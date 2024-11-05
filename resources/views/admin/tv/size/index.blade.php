@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')

    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
        <p><a href="{{ route('admin.tv.screen.add_form') }}" class="btn btn-success">Ավելացնել Էկրանի Չափս</a></p>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center">Անվանում</th>
                <th class="text-center">Խմբագրել</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($tv_sizes as $tv_size)
                <tr>
                    <td class="text-center">
                        <a href="{{ route('admin.tv.screen.edit', $tv_size) }}" style="line-height: 100px;text-align: center">{{ $tv_size->size }}</a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('admin.tv.screen.edit', $tv_size) }}" class="btn btn-primary mr-1">Խմբագրել</a>

                        <form method="POST" action="{{ route('admin.tv.screen.destroy', $tv_size) }}" class="mr-1">
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
