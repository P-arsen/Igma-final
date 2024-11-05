<ul class="nav nav-tabs mb-3">
    <li class="nav-item w-100 text-center"><a class="nav-link{{ $page === '' ? ' active' : '' }}" href="{{ route('admin.home') }}">Գլխավոր</a></li>
    @can ('manage-adverts')
        <li class="nav-item w-100 text-center"><a class="nav-link{{ $page === 'adverts' ? ' active' : '' }}" href="{{ route('admin.adverts.categories.create') }}">Adverts</a></li>
{{--        <li class="nav-item w-100 text-center"><a class="nav-link{{ $page === 'adverts' ? ' active' : '' }}" href="{{ route('admin.adverts.adverts.') }}">Adverts</a></li>--}}
    @endcan
    <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.adverts.categories.index') }}">Կատեգորիաններ</a></li>
   <li class="nav-item w-100 text-center" style="font-size: 20px">Կատեգորիաններ</li>
@foreach($categoriesArray as $category)
        @can ('manage-adverts-categories')
            @if($category['parent_id']==null)
            <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.banners.index') }}">{{$category['name_am']}}</a></li>
                @endif
        @endcan
    @endforeach
    @can ('manage-banners')
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.banners.index') }}">Banners</a></li>
    @endcan
    @can ('manage-adverts-categories')
        <li class="nav-item text-center w-100"><a class="nav-link" href="{{ route('admin.adverts.categories.index') }}">Կատեգորիաններ</a></li>
    @endcan
    @can ('manage-adverts-categories-name')
        <li class="nav-item text-center w-100"><a class="nav-link" href="{{ route('admin.adverts.category_name_index') }}">ցուցակ</a></li>
    @endcan
    @can ('manage-pages')
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.pages.index') }}">Pages</a></li>
    @endcan
    @can ('manage-users')
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.users.index') }}">Հաշիվներ</a></li>
    @endcan
    @can ('manage-tickets')
{{--        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.filters.index') }}">Բաժինների Ֆիլտրացիա</a></li>--}}
    @endcan
    <li class="nav-item w-100 text-center" style="font-size: 20px"> Ընդհանուր Հատկություններ</li>
    <hr>
    @can ('manage-general')
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.regions.index') }}">Տարածաշրջաններ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.city.index') }}">Թաղամաս</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.colors.index') }}">Գույներ</a></li>
    @endcan
    <li class="nav-item w-100 text-center" style="font-size: 20px">Հատկություններ</li>
    <hr>
    <li class="nav-item w-100 text-center mt-3" style="font-size: 16px">Անշարժ Գույք</li>
    @can ('manage-real-estate')
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.real-estates.type.index') }}">Շինության տիպը</a></li>
{{--        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.real-estates.floor.index') }}">Առաստաղի բարձրություն</a></li>--}}
{{--        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.real-estates.balcony.index') }}">Պատշգամբ</a></li>--}}
{{--        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.real-estate.furniture.index') }}">Կահույք</a></li>--}}
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.real-estates.renovation.index') }}">Վերանորոգում</a></li>
{{--        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.real-estate.parking.index') }}">Կայանատեղի</a></li>--}}
{{--        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.real-estate.view.index') }}">Տեսարան</a></li>--}}
    @endcan
    <li class="nav-item w-100 text-center mt-3" style="font-size: 20px">Էլեկտրոնիկա</li>
    <hr>
    <li class="nav-item w-100 text-center mt-3" style="font-size: 16px">Հեռախոսներ</li>
    @can ('manage-electronics')
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.phone.brand.index') }}">Բրենդ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.phone.model.index') }}">Մոդելներ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.phone.memory.index') }}">Հիշողություն</a></li>

    <li class="nav-item w-100 text-center mt-3" style="font-size: 16px">Պլանշետներ</li>
    <hr>
    <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.tablet.brand.index') }}">Բրենդ</a></li>
    <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.tablet.model.index') }}">Մոդել</a></li>
    <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.tablet.size.index') }}">Էկրանի Չափ</a></li>

        <li class="nav-item w-100 text-center mt-3" style="font-size: 16px">Խաղային Համակարգեր</li>
        <hr>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.games.pc.index') }}">Համակարգչային Խաղեր</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.games.console.index') }}">Խաղային Համակարգեր</a></li>

    <li class="nav-item w-100 text-center" style="font-size: 20px">Նոթբուքեր</li>
    <hr>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.notebook.brand.index') }}">Բրենդ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.notebook.screen.index') }}">Էկրանի Չափ</a></li>
        <li class="nav-item w-100 text-center" style="font-size: 20px">Հեռուստացույցներ</li>
    <hr>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.tv.brand.index') }}">Մակնիշ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.tv.screen.index') }}">Էկրանի Չափ</a></li>

            <li class="nav-item w-100 text-center" style="font-size: 20px">Լվացքի Մեքենա</li>
        <hr>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.washing_machine.brand.index') }}">Մակնիշ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.washing_machine.weight.index') }}">Քաշը</a></li>
        <li class="nav-item w-100 text-center" style="font-size: 20px">Սառնարաններ</li>
        <hr>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.refrigerators.brand.index') }}">Մակնիշ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.refrigerators.type.index') }}">Տեսակ</a></li>
        <li class="nav-item w-100 text-center" style="font-size: 20px">Սալօջախներ</li>
        <hr>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.tickets.index') }}">Այրիչի տեսակը</a></li>

    @endcan
    <li class="nav-item w-100 text-center" style="font-size: 20px">Տրանսպորտ</li>
    <hr>

    @can ('manage-car')
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.brand.index') }}">Բրենդ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.model.index') }}">Մոդել</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.engine-type.index') }}">Թափքի Տեսակը</a></li>
{{--        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.year.index') }}">Տարի</a></li>--}}
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.motor.index') }}">Շարժիչ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.motor-size.index') }}">Շարժիչի Ծավալը</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.transmission.index') }}">Փոխանցման Տուփ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.drive_type.index') }}">Քարշակ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.wheels.index') }}">Անիվներ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.headlights.index') }}">Լուսարձակներ</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.interior.index') }}">Սրահը</a></li>
        <li class="nav-item w-100 text-center"><a class="nav-link" href="{{ route('admin.car.roof.index') }}">Լյուկ</a></li>
    @endcan
</ul>
</div>

