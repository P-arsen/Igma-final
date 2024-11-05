<div class="w-full">
    <!-- Section Title -->
    <h2 class="text-lg font-semibold text-gray-800">@lang($locale .'.your_status')</h2>
    <!-- Option 1 -->
    <div class="flex items-start mt-4">
        <input
            id="status1"
            type="radio"
            name="user_type"
            value="0"
            class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500"
            checked
        >
        @csrf
        <label for="status1" class="ml-3 text-base font-medium text-gray-800">
            @lang($locale.'.anhat')
            <p class="text-sm text-gray-500">
            </p>
        </label>
    </div>


    <!-- Option 2 -->
    <div class="flex items-start mt-4">
        <input
            id="status2"
            type="radio"
            name="user_type"
            value="1"
            class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500"
        >
        <label for="status2" class="ml-3 text-base font-medium text-gray-800">
            @lang($locale.'.gortakalutyun')
            <p class="text-sm text-gray-500">
            </p>
        </label>
        <input type="hidden" name="category_id" value="{{$category_id}}">
    </div>
</div>
<div class="w-full">
    <!-- Section Title -->
{{--    <h2 class="text-lg font-semibold text-gray-800 mb-4">@lang($locale.'.location')</h2>--}}

    <!-- Տարածաշրջանը (Dropdown) -->
    <div class="mb-4 mt-10">
        <label for="region" class="block text-base font-medium text-gray-800 mb-2">
            @lang($locale.'.region')
        </label>
        <select id="region" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="region">
            @foreach($regions as $region)
                @if($region['parent_id']==null)
                <option value="{{$region['name_en']}}">{{$region['name_'.$locale]}}</option>
                @endif
            @endforeach
        </select>
        <label for="region" class="block text-base font-medium text-gray-800 mb-2">
            @lang($locale.'.city')
        </label>
        <select id="city" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="city">
            @foreach($regions as $region)
                @if($region['parent_id']!= null)
                    <option value="{{$region['name_en']}}">{{$region['name_'.$locale]}}</option>
                @endif
            @endforeach
        </select>
    </div>

