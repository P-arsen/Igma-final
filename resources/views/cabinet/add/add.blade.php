@extends('layouts.appfront')

@section('content')
    <style>
        .image-preview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .image-preview img {
            max-width: 100px;
            max-height: 100px;
            margin-right: 10px;
            margin-bottom: 10px;
        }

    </style>
<section class="w-full mt-10">
    <div class="container_width">

        <div class="w-full flex flex-col gap-2 mt-10 py-4">
            <form action="{{route('cabinet.post.addpost')}}?category={{$category}}" enctype="multipart/form-data" method="post">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
@include('layouts.locationadd')

                @if($category    ==  'Transport')
                    @include('layouts.onlycaradd')
            @elseif($category    ==  'Realestate')
                    @include('layouts.onlyrealestateadd')
            @elseif($category    ==  'Electronic')
                    @include('layouts.onlyphoneadd')
                @endif
            </div>
            <div class="bg-white w-full mt-4">
                <h2 class="text-xl font-bold text-gray-800 mb-2">@lang($locale.'.arzheq')</h2>

                <div class="flex items-center space-x-4">
                    <!-- Input Label -->
                    <label for="price" class="block text-gray-700 text-sm font-semibold">@lang($locale.'.price')</label>

                    <!-- Price Input -->
                    <input type="number" id="price" value="0" class="w-24 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" name="price">

                    <!-- Currency Dropdown -->
                    <select id="region" class="w-full max-w-48 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="currency">
                        <option value="amd">֏ (AMD)</option>
                        <option value="usd">$ (USD)</option>
                        <option value="rub">₽ (RUB)</option>
                        <option value="eur">€ (EUR)</option>
                        <!-- add more options here as needed -->
                    </select>

                </div>
            </div>
            <!-- informaciayi filter  -->

            <div class="w-full max-w-[80%] bg-white mt-4">
                <h2 class="text-xl font-bold text-gray-800 mb-2">@lang($locale.'.more_information')</h2>

                <!-- Name Input -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">@lang($locale.'.information_title')</label>
                    <input type="text" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-primary2" name="name">
                </div>

                <!-- Description Textarea -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 text-sm font-semibold mb-2">@lang($locale.'.information_description')</label>
                    <textarea id="description" rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 resize-none focus:ring-primary2" name="description"></textarea>
                </div>

            </div>


            <!-- File Upload Section -->
            <div class="w-full">
                <div>


                    <label for="images" class="block text-gray-700 text-sm font-semibold mb-2">@lang($locale.'.information_image')</label>
                    <input type="file" id="image-input" name="images[]" multiple accept="image/*" required>

                    <div id="image-preview" class="image-preview"></div>
                </div>
                <div class="w-full flex sm:justify-start justify-center flex-wrap gap-3 mt-4">
                </div>
            </div>

            <!-- contaktayin tvyalner -->
            <div class="w-full mt-4">
                <div class="w-fit h-full flex flex-col gap-1 ">
                    <h2 class="text-xl font-bold text-gray-800">@lang($locale.'.information_contact')</h2>
                    <input
                        type="checkbox"
                        class="w-4 h-4 text-primary2 border-gray-300 focus:ring-primary2">
                    <label for="no-building-number" class="ml-2 text-base font-medium text-gray-800">
                        {{ Auth::user()->phone }}
                    </label>                <input type="submit" value="add">
                </div>

                </div>
    </form>
    </div>
</section>

<script>
    document.getElementById('image-input').addEventListener('change', function(event) {
        const imagePreviewContainer = document.getElementById('image-preview');
        imagePreviewContainer.innerHTML = ''; // Clear previous previews

        const files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result; // Set the source to the file's data
                imagePreviewContainer.appendChild(img); // Append the image to the preview container
            };

            reader.readAsDataURL(file); // Read the file as a Data URL
        }
    });
</script>
@endsection
@extends('layouts.footer')
