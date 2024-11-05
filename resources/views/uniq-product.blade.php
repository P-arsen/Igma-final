@extends('layouts.appfront')
@section('content')


<section>
    <div class="container_width grid grid-cols-12 gap-6">
        <div class="lg:col-span-8 col-span-12 flex flex-col gap-6 lg:pb-8 pb-0 h-fit">
                <!-- Slider -->
                <div class="relative w-full group/slider">
                    <div class="overflow-hidden relative h-full max-h-[420px] rounded-lg shadow-lg">
                        <div id="slider" class="flex transition-transform duration-500 ease-in-out">
                            <!-- Slide 1 -->
                            @foreach($product->images as $image)
                            <div class="w-full flex-shrink-0">
                                <img src="{{ asset('storage/'.$image->image )}}" alt="Slide 1" class="w-full h-full object-cover cursor-pointer">
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- Left Arrow -->
                    <button id="prev" class="absolute top-1/2 transform -translate-y-1/2 left-0 text-black text-32 p-2 rounded-full bg-white/50 transition-all duration-300 group-hover/slider:opacity-100 opacity-0">
                        &#10094;
                    </button>
                    <!-- Right Arrow -->
                    <button id="next" class="absolute top-1/2 transform -translate-y-1/2 right-0 text-black text-32 p-2 rounded-full bg-white/50 transition-all duration-300 group-hover/slider:opacity-100 opacity-0">
                        &#10095;
                    </button>
                </div>

            <!-- Modal -->
            <div id="modal" class="fixed inset-0 z-50 bg-black bg-opacity-70 items-center justify-center hidden">
                <div class="bg-white rounded-lg overflow-hidden max-w-[80%] w-full">
                    <div class="relative h-fit max-h-[80%]">
                        <div id="modalSlider" class="flex transition-transform duration-500 ease-in-out">
                            <!-- Modal Slides will be injected here -->
                        </div>
                    </div>

                    <!-- Modal Left Arrow -->
                    <button id="modalPrev" class="absolute top-1/2 transform -translate-y-1/2 left-2 text-white text-32 p-2 rounded-full hover:bg-white/50 transition-all duration-300">
                        &#10094;
                    </button>

                    <!-- Modal Right Arrow -->
                    <button id="modalNext" class="absolute top-1/2 transform -translate-y-1/2 right-2 text-white text-32 p-2 rounded-full hover:bg-white/50 transition-all duration-300">
                        &#10095;
                    </button>

                    <!-- Close Button -->
                    <button id="modalClose" class="absolute w-16 h-16 top-2 right-2 flex-shrink-0 text-white text-64 rounded-full hover:bg-white/10 transition-all duration-300">&times;</button>
                </div>
            </div>

            <!-- informacian -->
            <div class="lg:hidden block">
                <h3 class="smallDesktop:text-24 text-16 opacity-80 font-medium">
                    {{$product['name_' . $locale]}}
                </h3>
                <p class="flex-shrink-0 smallDesktop:text-32 md:text-24 text-16 font-semibold z-40 mt-2">{{$product['price']}}</p>
            </div>

            <!-- hascen -->
            <div class="w-full py-2 text-blue-600 bg-neutral-100 px-2 rounded-md">{{$product['region']}} {{$product['city']}}</div>

            <!-- tan masin infon -->

            <div class="w-full">
                <h3 class="title_h3">{{$product['name']}}</h3>
                <div class="flex flex-col gap-1">
{{--                    <div class="flex items-center border-b py-1 gap-6">--}}

                        @foreach($product->getAttributes() as $key => $pr)
                            @if(!empty($pr)&&$key!='user_id'&&$key != 'created_at' && $key != 'updated_at' && $key != 'active' &&$key != 'name' && $key !='description'
                                && $key != 'region' && $key != 'city' && $key != 'id' && $key != 'currency' && $key != 'mils' && $key != 'category_id'
                            )
                                @if($key == 'price')
                                <div class="flex items-center border-b py-1 gap-6">
                                    <p class="sm:text-16 text-12 sm:font-medium font-normal text-black opacity-70 sm:w-56 w-32 flex-shrink-0">@lang($locale.'.'.$key)</p>
                                    <p class="sm:text-16 text-12 sm:font-medium font-normal text-black opacity-80">{{$pr}} @lang($locale.'.'.$product['currency'])</p>
                                </div>
                            @elseif($key == 'wheels')
                                <div class="flex items-center border-b py-1 gap-6">
                                    <p class="sm:text-16 text-12 sm:font-medium font-normal text-black opacity-70 sm:w-56 w-32 flex-shrink-0">@lang($locale.'.'.$key)</p>
                                    <p class="sm:text-16 text-12 sm:font-medium font-normal text-black opacity-80">{{$pr}}</p>
                                </div>
                                    @elseif($key == 'destination')
                                <div class="flex items-center border-b py-1 gap-6">
                                    <p class="sm:text-16 text-12 sm:font-medium font-normal text-black opacity-70 sm:w-56 w-32 flex-shrink-0">@lang($locale.'.'.$key)</p>
                                    <p class="sm:text-16 text-12 sm:font-medium font-normal text-black opacity-80">{{$pr}} @lang($locale.'.'.$product['mils'])</p>
                                </div>
                            @elseif($key=='model' || $key=='brand'|| $key=='year' || $key == 'engine_size')
                                <div class="flex items-center border-b py-1 gap-6">
                                    <p class="sm:text-16 text-12 sm:font-medium font-normal text-black opacity-70 sm:w-56 w-32 flex-shrink-0">@lang($locale.'.'.$key)</p>
                                    <p class="sm:text-16 text-12 sm:font-medium font-normal text-black opacity-80">{{$pr}}</p>
                                </div>
                            @else
                            <div class="flex items-center border-b py-1 gap-6">
                                <p class="sm:text-16 text-12 sm:font-medium font-normal text-black opacity-70 sm:w-56 w-32 flex-shrink-0">@lang($locale.'.'.$key)</p>
                                <p class="sm:text-16 text-12 sm:font-medium font-normal text-black opacity-80">@lang($locale.'.'.$pr)</p>
                            </div>@endif
                        @endif
                        @endforeach
                </div>
            </div>
            <div class="w-full">
                <h3 class="title_h3">@lang($locale . '.about')</h3>
                <p class="sm:text-16 text-12 sm:font-medium font-normal text-black opacity-70">
                    {{$product['description']}}
                </p>
            </div>
            <div class="flex justify-between gap-2 flex-wrap">
                <p class="text-12 text-black opacity-50">@lang($locale . 'announcement_number') {{$product['id']}}</p>
                <p class="text-12 text-black opacity-50">@lang($locale.'.added') {{$product['created_at']}}</p>
{{--                <p class="text-12 text-black opacity-50">Հայտարարության համարը 20978987</p>--}}
            </div>
        </div>

        <!-- user-i bajin -->
        <div class="lg:col-span-4 col-span-12 flex flex-col gap-2 mt-20">
            <div class="lg:block hidden">
                <h3 class="smallDesktop:text-24 text-16 opacity-80 font-medium">
                    {{$product['name_'.$locale]}}
                </h3>
                <p class="flex-shrink-0 smallDesktop:text-32 md:text-24 text-16 font-semibold z-40 mt-2">{{$product['price']}}
                    @if($product['currency'] == 'amd')
                        ֏
                    @elseif($product['currency'] == 'rub')
                        ₽
                    @elseif($product['currency']=='eur')
                        €
                    @elseif($product['currency']=='usd')
                        $
                    @endif

                </p>
            </div>
            <div class="py-4">
                <div class="flex gap-2 items-center">
                    <div class="w-16 h-16 rounded-full flex-shrink-0 overflow-hidden">
                        <img src="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg" alt="" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="smallDesktop:text-16 text-14 font-medium opacity-80 text-black">{{$product->user['first_name']}}  {{$product->user['last_name']}}</h3>

                    </div>
                </div>
                <p class="text-14 text-black font-light mt-2 opacity-50 ml-2">igma.am-ում է` {{$product->user['created_at']}}</p>
                <div class="flex gap-2 mt-4 border-b pb-4">
                    <button class="w-full py-1 text-16 text-white font-medium bg-blue-600 rounded-md">@lang($locale.'.write')</button>
                    <button class="w-full py-1 text-16 text-white font-medium bg-green-600 rounded-md">@lang($locale.'.call')</button>
                </div>
            </div>

            <!-- nmanatip haytararutyunner -->

            <div class="w-full flex flex-col gap-2">
                <h4 class="title_h4 mb-2">@lang($locale . '.similar_statements')</h4>

                <!-- productnery -->
                 <div class="w-full flex lg:flex-col flex-row flex-wrap justify-center gap-4">
                    <!--  -->
                     @foreach($randomProducts as $randomProduct)
                         <a href="{{route('product')}}?name={{$data}}&id={{$randomProduct['id']}}" class="w-fit flex lg:flex-row flex-col gap-2 group/prodCard">
                             <img src="{{asset('storage/'.$randomProduct->image['image'])}}" alt="" class="w-full lg:max-w-[140px] max-w-[300px] h-full max-h-[120px] group-hover/prodCard:scale-[1.01] transition-all duration-300 object-cover rounded-md overflow-hidden flex-shrink-0">
                             <div class="w-full max-w-[300px]">
                                 <p class="text-14 text-black font-light group-hover/prodCard:text-blue-600 transition-all duration-300 ">
                                 {{$randomProduct['name']}}
                                 </p>
                                 <p class="text-16 font-semibold text-black">{{$randomProduct['price']}}
                                     @if($randomProduct['currency'] == 'amd')
                                         ֏
                                     @elseif($randomProduct['currency'] == 'rub')
                                         ₽
                                     @elseif($randomProduct['currency']=='eur')
                                         €
                                     @elseif($randomProduct['currency']=='usd')
                                         $
                                     @endif
                                 </p>
                             </div>
                         </a>
                     @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript -->

<script>
        const slider = document.getElementById('slider');
        const prev = document.getElementById('prev');
        const next = document.getElementById('next');
        let currentIndex = 0;

        function showSlide(index) {
            const slides = slider.children.length;
            currentIndex = (index + slides) % slides;
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        prev.addEventListener('click', () => showSlide(currentIndex - 1));
        next.addEventListener('click', () => showSlide(currentIndex + 1));

        // Modal functionality
        const modal = document.getElementById('modal');
        const modalSlider = document.getElementById('modalSlider');
        const modalPrev = document.getElementById('modalPrev');
        const modalNext = document.getElementById('modalNext');
        const modalClose = document.getElementById('modalClose');
        let modalIndex = 0;

        function openModal(index) {
            modalIndex = index;
            modalSlider.innerHTML = slider.innerHTML; // Copy slides to modal
            modal.style.display = 'flex';
            showModalSlide(modalIndex);
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        function showModalSlide(index) {
            const slides = modalSlider.children.length;
            modalIndex = (index + slides) % slides;
            modalSlider.style.transform = `translateX(-${modalIndex * 100}%)`;
        }

        slider.querySelectorAll('img').forEach((image, index) => {
            image.addEventListener('click', () => openModal(index));
        });

        modalPrev.addEventListener('click', () => showModalSlide(modalIndex - 1));
        modalNext.addEventListener('click', () => showModalSlide(modalIndex + 1));
        modalClose.addEventListener('click', closeModal);
    </script>

@endsection
