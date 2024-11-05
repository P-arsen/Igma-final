@extends('layouts.appfront')

@section('content')
    @include('cabinet.profile._nav')
                <!--  -->

                <div class="col-span-12">
{{--                    <div class="w-full h-fit flex gap-2">--}}
{{--                        <a href="#" class="active_button">--}}
{{--                            @lang($locale.'.active')--}}
{{--                        </a>--}}
{{--                        <a href="#" class="pasiv_button">--}}
{{--                            @lang($locale.'.inactive')--}}
{{--                        </a>--}}
{{--                        <a href="#" class="pasiv_button">--}}
{{--                            @lang($locale.'.canceled')--}}
{{--                        </a>--}}
{{--                    </div>--}}

                    <!-- ete ka es enq cuyc talis  -->
                    <div class="w-full grid md:grid-cols-minmax220 grid-cols-12 sm:gap-4 gap-2 mt-5">

                        @foreach($my_posts as $my_post)
                            @foreach($my_post as $post)

                            <a href="#" class="w-full h-fit cart_hover md:col-span-1 col-span-6 bg-neutral-100 border p-1 rounded-sm overflow-hidden flex flex-col">
                            <div class="w-full h-full">
                                <img src="{{asset('storage/'.$post->image['image'])}}" alt="" class="w-full h-full object-cover rounded-sm">
                            </div>
                            <div class="w-full h-fit">
                                <p class="md:text-24 text-16 font-semibold">{{$post['price']}} @lang($locale.'.'.$post['currency'] ) </p>
                                <p class="sm:text-16 text-14 font-light line-clamp-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil, asperiores?</p>
                            </div>
                        </a>@endforeach
                        @endforeach

                    </div>

                    <!-- ete chka es  -->
@if(empty($my_posts))

                    <div class="w-full">
                        <h3 class="title_h3 opacity-60 my-5">@lang($locale.'.no_active_announcements')</h3>
                        <a href="#" class="active_button px-4 py-2">@lang($locale.'.add_post') </a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
