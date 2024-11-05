@extends('layouts.appfront')

@section('content')
    @include('cabinet.profile._nav')
            <div class="col-span-12 flex flex-wrap gap-2">
                <div class="w-fit py-1 px-2 rounded-sm border border-primary1 bg-primary1 text-white">
                    <a href="{{route('cabinet.wallet.home')}}" class="hover_links"> @lang($locale.'.wallet')</a>
                </div>
                <div class="w-fit py-1 px-2 rounded-sm border border-primary1">
                    <a href="{{route('cabinet.wallet.payment')}}" class="hover_links"> @lang($locale.'.payment_list') </a>
                </div>
                <div class="w-fit py-1 px-2 rounded-sm border border-primary1">
                    <a href="#" class="hover_links"> Գործառնություններ </a>
                </div>
            </div>
            <div class="md:col-span-4 col-span-12 flex flex-col gap-1 md:border-r border-r-primary1 px-1">
                <h3 class="title_h3">@lang($locale.'.in_wallet')</h3>
                <p class="text-32 font-bold text-primary1">{{Auth::user()->price}} @lang('am.amd')</p>
{{--                <p class="text-neutral-900 opacity-90">Դրամապանակի համարը <span class="text-neutral-900 font-medium">2633782</span></p>--}}
            </div>
            <div class="md:col-span-8 col-span-12">
                <h3 class="title_h3">@lang($locale.'.add_wallet'):</h3>
                <div class="w-full flex gap-2 overflow-hidden overflow-x-auto scrollbar-hidden mt-2">
                    <button class="w-32 border flex-shrink-0 rounded-md border-primary1">
                        <img src="https://www.idram.am/assets/icons/og-idram.png" alt="" class="object-contain">
                    </button>
{{--                    <button class="w-32 border flex-shrink-0 rounded-md border-primary1">--}}
{{--                        <img src="https://www.idram.am/assets/icons/og-idram.png" alt="" class="object-contain">--}}
{{--                    </button>--}}
{{--                    <button class="w-32 border flex-shrink-0 rounded-md border-primary1">--}}
{{--                        <img src="https://www.idram.am/assets/icons/og-idram.png" alt="" class="object-contain">--}}
{{--                    </button>--}}
                </div>
                <div class="w-full py-2 px-2 mt-2">
{{--                    <h3 class="title_h3">Վճարում բանկային քարտով</h3>--}}
                    <div class="flex gap-2 mt-2">
                        <input type="number" class="w-32 py-2 border border-primary1 rounded-md px-2" placeholder="0">
                        <a href="#" class="active_button font-medium">@lang($locale.'.pay')</a>
                    </div>
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






