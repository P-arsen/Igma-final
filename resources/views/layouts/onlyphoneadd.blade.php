<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.model')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="building_type">
        @foreach($brands as $brand)
            <option value="{{$brand['name']}}">{{$brand['name']}}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.memory')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="building_type">
        @foreach($models as $model)
            <option value="{{$model['name']}}">{{$model['name']}}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.new_created')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="new_building">
        <option value="new">@lang($locale.'.new')</option>
        <option value="old">@lang($locale.'.old')</option>
        <option value="faulty">@lang($locale.'.faulty')</option>
    </select>
</div>

<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.memory')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="building_type">
        @foreach($colors as $color)
            <option value="{{$color['name_en']}}">{{$color['name_'.$locale]}}</option>
        @endforeach
    </select>
</div>
