@extends('layouts.app')

@section('content')
    @include('admin.adverts.categories._nav')

    <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
        <p><a href="{{ route('admin.notebook.screen.add_form') }}" class="btn btn-success">Ավելացնել Էկրանի Չափս</a></p>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center">Անվանում</th>
                <th class="text-center">Խմբագրել</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($notebooks as $notebook)
                <tr>
                    <td class="text-center">
                        <a href="{{ route('admin.notebook.screen.edit', $notebook) }}" style="line-height: 100px;text-align: center">{{ $notebook->size }}</a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('admin.notebook.screen.edit', $notebook) }}" class="btn btn-primary mr-1">Խմբագրել</a>

                        <form method="POST" action="{{ route('admin.notebook.screen.destroy', $notebook) }}" class="mr-1">
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
