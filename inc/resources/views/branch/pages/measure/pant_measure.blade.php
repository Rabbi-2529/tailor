@php
    $temp_product_info = App\Models\IglTailorTemporary::where('its_temp_pname','pant')->first();
@endphp
@if (Session::get('pantMeasureId'))
        
    {{ Form::open(['route' => ['branch.measure.update-pant-measure'] , 'method' => 'post', 'id' => "pant_measure_edit" ]) }}

        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Pant" name="p_name"> 

        <div class="modal fade" id="pant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pant Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="hidden" name="pant_measure_order_slno"  value="{{ Session::get('pantMeasureId') }}" class="form-control">

                <div class="modal-body" id="pant_edit_details">
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <label for="">লম্বা</label>
                            <input type="number" name="long" step="any"  value="{{ $pant_info->its_pant_measure_long }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কোমর</label>
                            <input type="number" name="komor" step="any" value="{{ $pant_info->its_pant_measure_komor }}"class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ</label>
                            <input type="number" name="hip" step="any"  value="{{ $pant_info->its_pant_measure_hip }}"class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">মুহুরি</label>
                            <input type="number" name="muhuri" step="any" value="{{ $pant_info->its_pant_measure_mohuri }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">রান</label>
                            <input type="number" name="thigh" step="any" value="{{ $pant_info->its_pant_measure_thigh }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাই</label>
                            <input type="number" name="high" step="any" value="{{ $pant_info->its_pant_measure_high }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">ফ্লাই</label>
                            <input type="number" name="fly" step="any" value="{{ $pant_info->its_pant_measure_fly }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পকেট</label>
                            <select name="pocket" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="0">ক্র্স</option>
                                <option value="1">সোজা</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পকেট পিছ্নে</label>
                            <select name="back_pocket" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="inner_pocket">ইনার পকেট</label>
                            <select name="inner_pocket" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">হ্যা</option>
                                <option value="0">না</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">মুহুরি</label>
                            <select name="mohuri_type" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">ফ্লাডিং</option>
                                <option value="2">নর্মাল</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">লুপ</label>
                            <select name="loop" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="6">6 টা</option>
                                <option value="7">7 টা</option>
                                <option value="8">8 টা</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">লুপ সাইড</label>
                            <select name="loop_size" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="0.25">0.25</option>
                                <option value="0.5">0.50</option>
                                <option value="0.75">0.75</option>
                                <option value="1">1.00</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কুচি</label>
                            <select name="kuci" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1"> হ্যা</option>
                                <option value="0">না</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="catalog">কেটালগ নং</label>
                            <input type="number" name="catalog" value="{{ $pant_info->its_pant_measure_catalog_no }}"  class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="qty">প্যান্টের সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অনান্য</label>
                            <textarea name="others" class="form-control phonetic"  rows="4">{{ $pant_info->its_pant_measure_others }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     @if (Session::get('oldPantMeasuerment'))
                        <button type="submit" class="btn btn-primary">Save</button>
                    @else
                       <button type="submit" class="btn btn-primary">Update</button>
                    @endif
                    
                </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
@else
   {{ Form::open(['route' => ['branch.measure.take-measure-pant'] , 'method' => 'post']) }}
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Pant" name="p_name"> 

        <div class="modal fade" id="pant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pant Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="price_edit_details">
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <label for="">লম্বা</label>
                            <input type="number" step="any" name="long" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কোমর</label>
                            <input type="number" step="any" name="komor" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ</label>
                            <input type="number" step="any" name="hip" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">মুহুরি</label>
                            <input type="number" step="any" name="muhuri" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">রান</label>
                            <input type="number" step="any" name="thigh" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাই</label>
                            <input type="number" step="any" name="high" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">ফ্লাই</label>
                            <input type="number" step="any" name="fly" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পকেট</label>
                            <select name="pocket" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="0">ক্র্স</option>
                                <option value="1">সোজা</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পকেট পিছ্নে</label>
                            <select name="back_pocket" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="inner_pocket">ইনার পকেট</label>
                            <select name="inner_pocket" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1"> হ্যা</option>
                                <option value="0">না</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">মুহুরি</label>
                            <select name="mohuri_type" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">ফ্লাডিং</option>
                                <option value="2">নর্মাল</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">লুপ</label>
                            <select name="loop" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="6">6 টা</option>
                                <option value="7">7 টা</option>
                                <option value="8">8 টা</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">লুপ সাইড</label>
                            <select name="loop_size" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="0.25">0.25</option>
                                <option value="0.5">0.50</option>
                                <option value="0.75">0.75</option>
                                <option value="1">1.00</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কুচি</label>
                            <select name="kuci" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1"> হ্যা</option>
                                <option value="0">না</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="catalog">কেটালগ নং</label>
                            <input type="number" name="catalog" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="qty">প্যান্টের সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অনান্য</label>
                            <textarea name="others" class="form-control phonetic"  rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}

@endif

