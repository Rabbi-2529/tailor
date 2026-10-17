@php
    $temp_product_info = App\Models\IglTailorTemporary::where('its_temp_pname','safari')->first();
@endphp
@if(Session::get('safariMeasureId'))

    {{ Form::open(['route' => ['branch.measure.update-safari-measure'] , 'method' => 'post', 'id' =>"safari_measure_edit" ]) }}   

        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Safari" name="p_name">

        <div class="modal fade" id="safari" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Safari Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="hidden" name="safari_measure_order_slno"  value="{{ Session::get('safariMeasureId') }}" class="form-control">

                <div class="modal-body" id="safari_edit_details">
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <label for="">লম্বা</label>
                            <input type="number" step="any" name="long"  value="{{ $safari_info->its_safari_measure_long }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি</label>
                            <input type="number" step="any" name="body"  value="{{ $safari_info->its_safari_measure_body }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট</label>
                            <input type="number" step="any" name="belly" value="{{ $safari_info->its_safari_measure_belly }}"  class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ</label>
                            <input type="number" step="any" name="hip" value="{{ $safari_info->its_safari_measure_hip }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাঁধ</label>
                            <input type="number" step="any" name="shoulder" value="{{ $safari_info->its_safari_measure_shoulder }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ক্রস ব্যাক</label>
                            <input type="number" step="any" name="cross_back" value="{{ $safari_info->its_safari_measure_cross_back }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা লম্বা</label>
                            <input type="number" step="any" name="hand_long"  value="{{ $safari_info->its_safari_measure_hand_long }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাপ</label>
                            <input type="number" step="any" name="cuff" value="{{ $safari_info->its_safari_measure_hand_cuff }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">গলা</label>
                            <input type="number" step="any" name="neck" value="{{ $safari_info->its_safari_measure_neck }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি লুজ</label>
                            <input type="number" step="any" name="body_loose" value="{{ $safari_info->its_safari_measure_body_loose }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট লুজ</label>
                            <input type="number" step="any" name="belly_loose" value="{{ $safari_info->its_safari_measure_belly_loose }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ লুজ</label>
                            <input type="number" step="any" name="hip_loose" value="{{ $safari_info->its_safari_measure_hip_loose }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">কলার সাইজ</label>
                            <select name="collar_size" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="0.5">0.50</option>
                                <option value="0.75">0.75</option>
                                <option value="1">1.00</option>
                                <option value="1.25">1.25</option>
                                <option value="1.5">1.50</option>
                                <option value="1.75">1.75</option>
                                <option value="2">2.00</option>
                                <option value="2.25">2.25</option>
                                <option value="2.5">2.50</option>
                                <option value="2.75">2.75</option>
                                <option value="3">3.00</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">প্লেট</label>
                            <select name="plet" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">বক্স প্লেট</option>
                                <option value="2">সেলাই প্লেট</option>
                                <option value="3">সেলাই ছাড়া</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পকেট</label>
                            <select name="pocket" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">1 টা পকেট</option>
                                <option value="2">2 টা পকেট</option>
                                <option value="3">3 টা পকেট</option>
                                <option value="4">4 টা পকেট</option>
                                <option value="5">5 টা পকেট</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ব্যাক সাইড</label>
                            <select name="back_side" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">ওপেন</option>
                                <option value="2">নো ওপেন</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কলার</label>
                            <select name="collar" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">শার্ট কলার</option>
                                <option value="2">ব্যান্ড কলার</option>
                                <option value="3">ওপেন কলার</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ইনার পকেট</label>
                            <select name="inner_pocket" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">হবে</option>
                                <option value="0">হবে না</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="type">সাফারি ধরণ</label>
                            <select name="type" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">ফুল হাতা</option>
                                <option value="0">হাফ হাতা</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ক্যাটালগ নং</label>
                            <input type="number" name="catalog" value="{{ $safari_info->its_safari_measure_catalog_no }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">সাফারি সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                        <div class="col-lg-4 col-6">
                            <label for="">অনান্য</label>
                            <textarea name="others" class="form-control phonetic" id="" cols="50" rows="5">{{ $safari_info->its_safari_measure_others }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if (Session::get('oldSafariMeasuerment'))
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
    {{ Form::open(['route' => ['branch.measure.take-measure-safari'] , 'method' => 'post']) }}
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Safari" name="p_name">

        <div class="modal fade" id="safari" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Safari Measurement</h5>
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
                            <label for="">বডি</label>
                            <input type="number" step="any" name="body" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট</label>
                            <input type="number" step="any" name="belly" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ</label>
                            <input type="number" step="any" name="hip" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাঁধ</label>
                            <input type="number" step="any" name="shoulder" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ক্রস ব্যাক</label>
                            <input type="number" step="any" name="cross_back" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা লম্বা</label>
                            <input type="number" step="any" name="hand_long" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাপ</label>
                            <input type="number" step="any" name="cuff" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">গলা</label>
                            <input type="number" step="any" name="neck" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি লুজ</label>
                            <input type="number" step="any" name="body_loose" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট লুজ</label>
                            <input type="number" step="any" name="belly_loose" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ লুজ</label>
                            <input type="number" step="any" name="hip_loose" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">কলার সাইজ</label>
                            <select name="collar_size" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="0.5">0.50</option>
                                <option value="0.75">0.75</option>
                                <option value="1">1.00</option>
                                <option value="1.25">1.25</option>
                                <option value="1.5">1.50</option>
                                <option value="1.75">1.75</option>
                                <option value="2">2.00</option>
                                <option value="2.25">2.25</option>
                                <option value="2.5">2.50</option>
                                <option value="2.75">2.75</option>
                                <option value="3">3.00</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">প্লেট</label>
                            <select name="plet" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">বক্স প্লেট</option>
                                <option value="2">সেলাই প্লেট</option>
                                <option value="3">সেলাই ছাড়া</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পকেট</label>
                            <select name="pocket" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">1 টা</option>
                                <option value="2">2 টা</option>
                                <option value="3">3 টা</option>
                                <option value="4">4 টা</option>
                                <option value="5">5 টা</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ব্যাক সাইড</label>
                            <select name="back_side" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">ওপেন</option>
                                <option value="2">নো ওপেন</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কলার</label>
                            <select name="collar" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">শার্ট কলার</option>
                                <option value="2">ব্যান্ড কলার</option>
                                <option value="3">ওপেন কলার</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ইনার পকেট</label>
                            <select name="inner_pocket" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">হ্যাঁ</option>
                                <option value="0">না</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="type">সাফারি ধরণ</label>
                            <select name="type" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">ফুল হাতা</option>
                                <option value="0">হাফ হাতা</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ক্যাটালগ নং</label>
                            <input type="number" name="catalog" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">সাফারি সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                        <div class="col-lg-4 col-6">
                            <label for="">অনান্য </label>
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