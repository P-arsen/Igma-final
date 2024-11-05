@extends('layouts.appfront')

@section('content')
    @include('cabinet.profile._nav')


                <div class="xl:col-span-9 lg:col-span-8 col-span-12 flex flex-col">
                    <div class="flex gap-2">
                        <a href="{{route('cabinet.tickets.index')}}" class="active_button">Մուտքային</a>
                        <a href="{{route('cabinet.tickets.index')}}?type=send" class="pasiv_button">Ուղարկված</a>
                    </div>

                    <!-- ete ka es enq cuyc talis  -->
                    <!-- namakneri containerna -->
                    <div class="w-full flex flex-col gap-1 mt-5">
                        <!-- mi namaki cartna -->
                        @foreach($conversations as $conversation)
                        <a href="#" class="w-full h-fit p-2 flex items-center gap-4 hover:bg-neutral-200 transition-all duration-300 rounded-sm">
                            <img src="{{asset('storage/'.$conversation->user['image'])}}" alt="" class="w-16 h-16 rounded-full flex-shrink-0 object-cover">

                            <div class="w-full flex md:flex-row flex-col justify-between md:items-center items-start">
                                <div class="flex flex-col">
                                    <h4 class="title_h4">{{$conversation->user['first_name']}}</h4>
                                    <p class="sm:text-16 text-14 font-medium text-neutral-900">{{$conversation['announcement']['name']}}</p>
                                    <p class="text-16 font-light text-neutral-700">{{$conversation->messages['message']}}</p>
                                </div>
                                <p class="text-14 text-neutral-700">{{$conversation['created_at']}}</p>
                            </div>
                        </a>
                        @endforeach


                    </div>

                    <!-- ete chka es  -->

                </div>
            </div>
        </div>
    </section>


    </body>
    </html>



    <script>
        const eserMessagesDropdownButton = document.getElementById('eserMessagesDropdownButton');
        const userMessagesDropdown = document.getElementById('userMessagesDropdown');

        // Открытие/закрытие выпадающего меню по клику на кнопку
        eserMessagesDropdownButton.addEventListener('click', () => {
            userMessagesDropdown.classList.toggle('hidden');
        });

        // Закрытие меню, если клик был за пределами меню
        document.addEventListener('click', function(event) {
            if (!eserMessagesDropdownButton.contains(event.target) && !userMessagesDropdown.contains(event.target)) {
                userMessagesDropdown.classList.add('hidden');
            }
        });
    </script>

@endsection
