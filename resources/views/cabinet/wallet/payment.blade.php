@extends('layouts.appfront')

@section('content')
    @include('cabinet.profile._nav')
    <div class="col-span-12 flex flex-wrap gap-2">
        <div class="w-fit py-1 px-2 rounded-sm border border-primary1">

            <a href="{{route('cabinet.wallet.home')}}" class="hover_links"> @lang($locale.'.wallet')</a>
        </div>
            <div class="w-fit py-1 px-2 rounded-sm border border-primary1 bg-primary1 text-white">

            <a href="{{route('cabinet.wallet.payment')}}" class="hover_links"> @lang($locale.'.payment_list') </a>
        </div>
        <div class="w-fit py-1 px-2 rounded-sm border border-primary1">
            <a href="#" class="hover_links"> Գործառնություններ </a>
        </div>
    </div>
        <div class="w-100 mt-20">
        @foreach($payments as $payment)
            @if($payment['service_id']==null)
                <div class="w-100">
                    @lang($locale.'.wallet_pay')
                {{$payment['code']}}
                {{$payment['price']}}@lang('am.amd')
                {{$payment['created_at']}}
                @if($payment['status']==1)
                    @lang($locale.'.agree')
                @endif
        </div>
            @else
                    <div class="w-100">
                {{$payment->service['name_'.$locale]}}
                    {{$payment['code']}}
                    {{$payment['price']}}@lang('am.amd')
                    {{$payment['created_at']}}
                    @if($payment['status']==1)
                        @lang($locale.'.agree')
                    @endif
            @endif
                    </div>
        @endforeach
    </div>
    </div>
    </div>
    </div>
    </section>


    <script>
        const eserWalletDropdownButton = document.getElementById('eserWalletDropdownButton');
        const userWalletDropdown = document.getElementById('userWalletDropdown');

        // Открытие/закрытие выпадающего меню по клику на кнопку
        eserWalletDropdownButton.addEventListener('click', () => {
            userWalletDropdown.classList.toggle('hidden');
        });

        // Закрытие меню, если клик был за пределами меню
        document.addEventListener('click', function(event) {
            if (!eserWalletDropdownButton.contains(event.target) && !userWalletDropdown.contains(event.target)) {
                userWalletDropdown.classList.add('hidden');
            }
        });
    </script>
@endsection
