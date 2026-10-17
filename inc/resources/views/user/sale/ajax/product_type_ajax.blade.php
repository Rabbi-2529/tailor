@if (count($pro_types) > 0)
    <option value="">Select One</option>
@endif
@foreach ($pro_types as $pro_type)
    <option {{  ( Session::get('sale_type_id')  == $pro_type->productTypepro->its_protype_slno) ? 'selected' : '' }} value="{{ $pro_type->productTypepro->its_protype_slno }}">
        {{ $pro_type->productTypepro->its_protype_name }}
    </option>
@endforeach