<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.brand')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="brand">
        @foreach($car_brands as $car_brand)
            <option value="{{$car_brand['name']}}">{{$car_brand['name']}}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="car_models" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.model')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="model">
        @foreach($car_models as $car_model)
            <option value="{{$car_model['name']}}">{{$car_model['name']}}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.body_type')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="body_type">
        @foreach($car_types as $car_type)
            <option value="{{$car_type['name_en']}}">{{$car_type['name_am']}}</option>
        @endforeach
    </select>
</div>
<div class="mb-4">
    <label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.engine_type')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="engine_type">
        @foreach($car_motors as $car_motor)
            <option value="{{$car_motor['name_en']}}">{{$car_motor['name_am']}}</option>
        @endforeach
    </select><label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.engine_size')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="engine_size">
        @foreach($car_motor_sizes as $car_motor_size)
            <option value="{{$car_motor_size['name']}}">{{$car_motor_size['name']}}</option>
        @endforeach
    </select>

</div>
<div class="mb-4">
    <label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.year')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="year">
        @for($i=1950;$i<=date('Y');$i++)
            <option value="{{$i}}">{{$i}}</option>@endfor
    </select>
</div>
<div class="mb-4">
    <label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.transmission')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="transmission">
        <option value="manual">@lang($locale.'.transmission-manual')</option>
        <option value="automate">@lang($locale.'.transmission-automate')</option>
    </select>
</div>

<div class="mb-4">
    <label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.drive_type')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="drive_type">
        @foreach($drive_types as $drive_type)
            <option value="{{$drive_type['name_en']}}">{{$drive_type['name_'.$locale]}}</option>
        @endforeach
    </select>
    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">@lang($locale.'.destination')</label>
        <input type="number" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-sm focus:outline-none focus:ring-2 focus:ring-primary2" name="destination" value="1">
        <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                name="mils">
            <option value="km">@lang($locale.'.km')</option>
            <option value="mils">@lang($locale.'.mils')</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">@lang($locale.'.current_condition')</label>
        <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                name="damaged">
            <option value="no">@lang($locale.'.car_is_not_damaged')</option>
            <option value="yes">@lang($locale.'.car_is_damaged')</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">@lang($locale.'.gas_equipment')</label>
        <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                name="gas">
            <option value="no">@lang($locale.'.car_no_have_gas')</option>
            <option value="yes">@lang($locale.'.car_have_gas')</option>
        </select>
    </div>




    <label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.color')
    </label>
    <select id="region" class="w-full max-w-48 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="color">
        @foreach($colors as $color)
            <option value="{{$color['name_en']}}">{{$color['name_'.$locale]}}</option>
        @endforeach
        <!-- add more options here as needed -->
    </select>
</div>

<label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
    @lang($locale.'.interior_color')
</label>
<select id="region" class="w-full max-w-48 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="interior_color">
    @foreach($colors as $color)
        <option value="{{$color['name_en']}}">{{$color['name_'.$locale]}}</option>
    @endforeach
</select>

<label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
    @lang($locale.'.interior_type')
</label>
<select id="region" class="w-full max-w-48 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="interior_type">
    @foreach($interiors as $interior)
        <option value="{{$interior['name_en']}}">{{$interior['name_'.$locale]}}</option>
    @endforeach
    <!-- add more options here as needed -->
</select>

<label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
    @lang($locale.'.wheels')
</label>
<select id="region" class="w-full max-w-48 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="wheels">
    @foreach($wheels as $wheel)
        <option value="{{$wheel['name']}}">{{$wheel['name']}}</option>
    @endforeach
</select>

<label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
    @lang($locale.'.sunroof')
</label>
<select id="region" class="w-full max-w-48 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="sunroof">
        <option value="no">@lang($locale.'.no')</option>
        <option value="default_sunroof">@lang($locale.'.default_sunroof')</option>
        <option value="panoramic_sunroof">@lang($locale.'.panoramic_sunroof')</option>
    <!-- add more options here as needed -->
</select>

<label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
    @lang($locale.'.steering')
</label>
<select id="region" class="w-full max-w-48 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="steering">
        <option value="left">@lang($locale.'.left')</option>
        <option value="right">@lang($locale.'.right')</option>
</select>

<label for="car_types" class="block text-base font-medium text-gray-800 mb-2">
    @lang($locale.'.cleared')
</label>
<select id="region" class="w-full max-w-48 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" name="cleared">
        <option value="no">@lang($locale.'.no')</option>
        <option value="yes">@lang($locale.'.yes')</option>
</select>

<div class="w-full">
    <!-- Section Title -->
    <h2 class="text-lg font-semibold text-gray-800 mb-4">@lang($locale.'.comfort')</h2>

    <!-- Checkbox Group -->
    <div class="space-y-2">
        <!-- Checkbox 1 -->
        <div class="flex items-center">
            <input
                id="option1" value="yes"
                type="checkbox" name="air_conditioner"
                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
            <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                @lang($locale.'.air_conditioner')
            </label>
        </div>

        <!-- Checkbox 2 -->
        <div class="flex items-center">
            <input
                id="option2" value="yes"
                type="checkbox"
                name="heated_seats"
                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
            <label for="option2" class="ml-3 text-base font-medium text-gray-800">
                @lang($locale.'.heated_seats')
            </label>
        </div>

        <!-- Checkbox 3 -->
        <div class="flex items-center">
            <input
                id="option3" value="yes"
                type="checkbox" name="heated_steering_wheel"
                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
            <label for="option3" class="ml-3 text-base font-medium text-gray-800">
                @lang($locale.'.heated_steering_wheel')
            </label>
        </div>
        <div class="flex items-center">
            <input
                id="option3" value="yes"
                type="checkbox" name="ventilated_seats"
                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
            <label for="option3" class="ml-3 text-base font-medium text-gray-800">
                @lang($locale.'.ventilated_seats')
            </label>
        </div>
        <div class="flex items-center">
            <input
                id="option3" value="yes"
                type="checkbox" name="cruise_control"
                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
            <label for="option3" class="ml-3 text-base font-medium text-gray-800">
                @lang($locale.'.cruise_control')
            </label>
        </div>
        <div class="flex items-center">
            <input value="yes"
                id="option3"
                type="checkbox" name="tinted_windows"
                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
            <label for="option3" class="ml-3 text-base font-medium text-gray-800">
                @lang($locale.'.tinted_windows')
            </label>
        </div>
    </div>
</div>
