@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')

    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
        <p><a href="{{ route('admin.tablet.size.add_form') }}" class="btn btn-success">Ավելացնել Էկրանի Չափս</a></p>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center">Անվանում</th>
                <th class="text-center">Խմբագրել</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($phones as $phone)
                <tr>
                    <td class="text-center">
                        <a href="{{ route('admin.tablet.size.edit', $phone) }}" style="line-height: 100px;text-align: center">{{ $phone->size }}</a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('admin.tablet.size.edit', $phone) }}" class="btn btn-primary mr-1">Խմբագրել</a>

                        <form method="POST" action="{{ route('admin.tablet.size.destroy', $phone) }}" class="mr-1">
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
