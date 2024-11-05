<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.building_type')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="building_type">
            <option value="stone">@lang($locale.'.stone')</option>
            <option value="panel">@lang($locale.'.panel')</option>
            <option value="monolith">@lang($locale.'.monolith')</option>
            <option value="bricks">@lang($locale.'.bricks')</option>
            <option value="cassete">@lang($locale.'.cassete')</option>
            <option value="wooden">@lang($locale.'.wooden')</option>
    </select>
</div>

<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.new_created')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="new_building">
        <option value="no">@lang($locale.'.no')</option>
        <option value="yes">@lang($locale.'.yes')</option>
    </select>
</div>

<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.elevator')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="elevator">
        <option value="no">@lang($locale.'.no')</option>
        <option value="yes">@lang($locale.'.yes')</option>
    </select>
</div>

<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.parking')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="parking">
        <option value="outdoor_parking">@lang($locale.'.outdoor_parking')</option>
        <option value="covered_parking">@lang($locale.'.covered_parking')</option>
        <option value="garage">@lang($locale.'.garage')</option>
    </select>
</div>
<div class="flex items-center space-x-4">
    <!-- Input Label -->
    <label for="price" class="block text-gray-700 text-sm font-semibold">@lang($locale.'.area')</label>

    <!-- Price Input -->
    <input type="number" id="price" value="0" class="w-24 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
           name="area">
</div>
<div class="flex items-center space-x-4">
    <!-- Input Label -->
    <label for="price" class="block text-gray-700 text-sm font-semibold">@lang($locale.'.floor')</label>

    <!-- Price Input -->
    <input type="number" id="price" value="0" class="w-24 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
           name="floor">
</div>
<div class="flex items-center space-x-4">
    <!-- Input Label -->
    <label for="price" class="block text-gray-700 text-sm font-semibold">@lang($locale.'.bathroom')</label>

    <!-- Price Input -->
    <input type="number" id="price" value="1" class="w-24 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
           name="bathroom">
</div>

<div class="flex items-center space-x-4">
    <!-- Input Label -->
    <label for="price" class="block text-gray-700 text-sm font-semibold">@lang($locale.'.room')</label>

    <!-- Price Input -->
    <input type="number" id="price" value="1" class="w-24 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
           name="rooms">
</div>

<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.celling_height')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="celling_height">
        <option value="2.5">2.5</option>
        <option value="2.6">2.6</option>
        <option value="2.7">2.7</option>
        <option value="2.8">2.8</option>
        <option value="2.9">2.9</option>
        <option value="3.0">3.0</option>
        <option value="3.1">3.1</option>
        <option value="3.2">3.2</option>
        <option value="3.3">3.3</option>
        <option value="3.4">3.4</option>
        <option value="3.5">3.5</option>
    </select>
</div>

<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.balcony')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="balcony">
        <option value="no">@lang($locale.'.no')</option>
        <option value="open_balcony">@lang($locale.'.open_balcony')</option>
        <option value="closed_balcony">@lang($locale.'.closed_balcony')</option>
        <option value="multiple_balcony">@lang($locale.'.multiple_balcony')</option>
    </select>
</div>


<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.furniture')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="furniture">
        <option value="no">@lang($locale.'.no')</option>
        <option value="yes">@lang($locale.'.yes')</option>
        <option value="closed_balcony">@lang($locale.'.partial_furniture')</option>
        <option value="multiple_balcony">@lang($locale.'.agreement')</option>
    </select>
</div>


<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.renovation')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="renovation">
        <option value="no">@lang($locale.'.no')</option>
        <option value="old_renovation">@lang($locale.'.open_balcony')</option>
        <option value="partial_renovation">@lang($locale.'.closed_balcony')</option>
        <option value="cosmetic_renovation">@lang($locale.'.multiple_balcony')</option>
        <option value="euro_renovation">@lang($locale.'.multiple_balcony')</option>
        <option value="designer_renovation">@lang($locale.'.multiple_balcony')</option>
        <option value="major_renovation">@lang($locale.'.major_renovation')</option>
    </select>
</div>

<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.children')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="children">
        <option value="yes">@lang($locale.'.yes')</option>
        <option value="no">@lang($locale.'.no')</option>
        <option value="negotiable">@lang($locale.'.negotiable')</option>
    </select>
</div>

<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.pets')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="pets">
        <option value="yes">@lang($locale.'.yes')</option>
        <option value="no">@lang($locale.'.no')</option>
        <option value="negotiable">@lang($locale.'.negotiable')</option>
    </select>
</div>


<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.done')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="done">
        <option value="yes">@lang($locale.'.yes')</option>
        <option value="no">@lang($locale.'.no')</option>
    </select>
</div>

<div class="mb-4">
    <label for="car_brands" class="block text-base font-medium text-gray-800 mb-2">
        @lang($locale.'.window_view')
    </label>
    <select id="car_model" class="w-full max-w-96 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            name="window_view">
        <option value="yard">@lang($locale.'.yard')</option>
        <option value="street">@lang($locale.'.street')</option>
        <option value="city">@lang($locale.'.city')</option>
        <option value="park">@lang($locale.'.park')</option>
        <option value="Ararat">@lang($locale.'.ararat')</option>
    </select>
</div>

<div class="space-y-2">
    <!-- Checkbox 1 -->
    <div class="flex items-center">
        <input
            id="option1" value="yes"
            type="checkbox" name="television"
            class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
        <label for="option1" class="ml-3 text-base font-medium text-gray-800">
            @lang($locale.'.television')
        </label>
    </div>

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
        <div class="space-y-2">
            <!-- Checkbox 1 -->
            <div class="flex items-center">
                <input
                    id="option1" value="yes"
                    type="checkbox" name="internet"
                    class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                    @lang($locale.'.internet')
                </label>
            </div>

            <div class="space-y-2">
                <!-- Checkbox 1 -->
                <div class="flex items-center">
                    <input
                        id="option1" value="yes"
                        type="checkbox" name="parking_space"
                        class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                        @lang($locale.'.parking_space')
                    </label>
                </div>

                <div class="flex items-center">
                    <input
                        id="option1" value="yes"
                        type="checkbox" name="water"
                        class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                        @lang($locale.'.water')
                    </label>
                </div>

                <div class="flex items-center">
                    <input
                        id="option1" value="yes"
                        type="checkbox" name="parking_space"
                        class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                        @lang($locale.'.gas')
                    </label>
                </div>

                <div class="flex items-center">
                    <input
                        id="option1" value="yes"
                        type="checkbox" name="parking_space"
                        class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                        @lang($locale.'.sauna')
                    </label>
                </div>

                <div class="flex items-center">
                    <input
                        id="option1" value="yes"
                        type="checkbox" name="loghavazan"
                        class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                        @lang($locale.'.loghavazan')
                    </label>
                </div>


                <div class="flex items-center">
                    <input
                        id="option1" value="yes"
                        type="checkbox" name="ghorovati_vararan"
                        class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                        @lang($locale.'.ghorovati_vararan')
                    </label>
                </div>

                <div class="flex items-center">
                    <input
                        id="option1" value="yes"
                        type="checkbox" name="taghavar"
                        class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                        @lang($locale.'.taghavar')
                    </label>
                </div>
                <div class="flex items-center">
                    <input
                        id="option1" value="yes"
                        type="checkbox" name="security"
                        class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                        @lang($locale.'.security')
                    </label>
                </div>

                <div class="flex items-center">
                    <input
                        id="option1" value="yes"
                        type="checkbox" name="salojagh"
                        class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                    <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                        @lang($locale.'.salojagh')
                    </label>
                </div>

                <div class="space-y-2">
                    <!-- Checkbox 1 -->
                    <div class="flex items-center">
                        <input
                            id="option1" value="yes"
                            type="checkbox" name="fridge"
                            class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                            @lang($locale.'.fridge')
                        </label>
                    </div>

                    <div class="space-y-2">
                        <!-- Checkbox 1 -->
                        <div class="flex items-center">
                            <input
                                id="option1" value="yes"
                                type="checkbox" name="stove"
                                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                                @lang($locale.'.stove')
                            </label>
                        </div>
                        <div class="space-y-2">
                            <!-- Checkbox 1 -->
                            <div class="flex items-center">
                                <input
                                    id="option1" value="yes"
                                    type="checkbox" name="microwave"
                                    class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                                    @lang($locale.'.microwave')
                                </label>
                            </div>

                            <div class="space-y-2">
                                <!-- Checkbox 1 -->
                                <div class="flex items-center">
                                    <input
                                        id="option1" value="yes"
                                        type="checkbox" name="coffee_maker"
                                        class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                                        @lang($locale.'.coffee_maker')
                                    </label>
                                </div>

                                <div class="space-y-2">
                                    <!-- Checkbox 1 -->
                                    <div class="flex items-center">
                                        <input
                                            id="option1" value="yes"
                                            type="checkbox" name="dishwasher"
                                            class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                        <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                                            @lang($locale.'.dishwasher')
                                        </label>
                                    </div>

                                    <div class="space-y-2">
                                        <!-- Checkbox 1 -->
                                        <div class="flex items-center">
                                            <input
                                                id="option1" value="yes"
                                                type="checkbox" name="gaz"
                                                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                                                @lang($locale.'.gaz')
                                            </label>
                                        </div>
                                    </div>


                                    <div class="space-y-2">
                                        <!-- Checkbox 1 -->
                                        <div class="flex items-center">
                                            <input
                                                id="option1" value="yes"
                                                type="checkbox" name="elektrakanutyun"
                                                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                                                @lang($locale.'.elektrakanutyun')
                                            </label>
                                        </div>

                                    <div class="space-y-2">
                                        <!-- Checkbox 1 -->
                                        <div class="flex items-center">
                                            <input
                                                id="option1" value="yes"
                                                type="checkbox" name="washing_machine"
                                                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                                                @lang($locale.'.washing_machine')
                                            </label>
                                        </div>
                                        <div class="space-y-2">
                                            <!-- Checkbox 1 -->
                                            <div class="flex items-center">
                                                <input
                                                    id="option1" value="yes"
                                                    type="checkbox" name="drying_machine"
                                                    class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                                                    @lang($locale.'.drying_machine')
                                                </label>
                                            </div>

                                            <div class="space-y-2">
                                                <!-- Checkbox 1 -->
                                                <div class="flex items-center">
                                                    <input
                                                        id="option1" value="yes"
                                                        type="checkbox" name="water_heater"
                                                        class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                    <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                                                        @lang($locale.'.water_heater')
                                                    </label>
                                                </div>
                                                    <div class="space-y-2">
                                                        <!-- Checkbox 1 -->
                                                        <div class="flex items-center">
                                                            <input
                                                                id="option1" value="yes"
                                                                type="checkbox" name="hair_dryer"
                                                                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                                            <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                                                                @lang($locale.'.hair_dryer')
                                                            </label>
                                                        </div>
    <div class="space-y-2">
        <!-- Checkbox 1 -->
        <div class="flex items-center">
            <input
                id="option1" value="yes"
                type="checkbox" name="domofon"
                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
            <label for="option1" class="ml-3 text-base font-medium text-gray-800">
                @lang($locale.'.domofon')
            </label>
        </div>

        <!-- Checkbox 2 -->
        <div class="flex items-center">
            <input
                id="option2" value="yes"
                type="checkbox"
                name="drnapah"
                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
            <label for="option2" class="ml-3 text-base font-medium text-gray-800">
                @lang($locale.'.drnapah')
            </label>
        </div>


            <!-- Checkbox 3 -->
        <div class="flex items-center">
            <input
                id="option3" value="yes"
                type="checkbox" name="heated_steering_wheel"
                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
            <label for="option3" class="ml-3 text-base font-medium text-gray-800">
                @lang($locale.'.xaxahraparak')
            </label>
        </div>
    </div>
</div>
