@php
    $temp_product_info = App\Models\IglTailorTemporary::where('its_temp_pname','photua')->first();
@endphp
@if (Session::get('photuaMeasureId'))

    {{ Form::open(['route' => ['user.measure.update-photua-measure'] , 'method' => 'post' , 'id' =>"photua_measure_edit" ]) }} 

        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Photua" name="p_name">

        <div class="modal fade" id="photua" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Photua Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="hidden" name="photua_measure_order_slno"  value="{{ Session::get('photuaMeasureId') }}" class="form-control">

                <div class="modal-body" id="price_edit_details">
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <label for="">লম্বা</label>
                            <input type="number" step="any" name="long" value="{{ $photua_info->its_photua_measure_long }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি</label>
                            <input type="number" step="any" name="body" value="{{ $photua_info->its_photua_measure_body }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট</label>
                            <input type="number" step="any" name="belly" value="{{ $photua_info->its_photua_measure_belly }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ</label>
                            <input type="number" step="any" name="hip" value="{{ $photua_info->its_photua_measure_hip }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাঁধ</label>
                            <input type="number" step="any" name="shoulder" value="{{ $photua_info->its_photua_measure_shoulder }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা লম্বা</label>
                            <input type="number" step="any" name="hand_long" value="{{ $photua_info->its_photua_measure_hand_long }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা কাপ</label>
                            <input type="number" step="any" name="hand_cuff" value="{{ $photua_info->its_photua_measure_hand_cuff }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">গলা</label>
                            <input type="number" step="any" name="neck" value="{{ $photua_info->its_photua_measure_neck }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা কুনু</label>
                            <input type="number" step="any" name="hand_kunu" value="{{ $photua_info->its_photua_measure_hand_kunu }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা মোজা</label>
                            <input type="number" step="any" name="hand_moja" value="{{ $photua_info->its_photua_measure_hand_moja }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি লুজ</label>
                            <input type="number" name="body_loose" value="{{ $photua_info->its_photua_measure_body_loose }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ধরন</label>
                            <select name="type" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">চাইনিজ</option>
                                <option value="2">হাওয়াই</option>
                                <option value="3">হাফ</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="plet">প্লেট</label>
                            <select name="plet" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="2">সেলাই প্লেট</option>
                                <option value="3">ইনার প্লেট</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কলার</label>
                            <select name="collar" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">এরো</option>
                                <option value="2">টাই</option>
                                <option value="3">বেন</option>
                                <option value="4">পাঞ্জাবি</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কলারের মাপ</label>
                            <select name="collar_size" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="0.5">0.50</option>
                                <option value="0.75">0.75</option>
                                <option value="1">1.00</option>
                                <option value="1.25">1.25</option>
                                <option value="1.50">1.50</option>
                                <option value="1.75">1.75</option>
                                <option value="2">2.00</option>
                                <option value="2.25">2.25</option>
                                <option value="2.50">2.50</option>
                                <option value="2.75">2.75</option>
                                <option value="3">3.00</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাফ সাইজ</label>
                            <select name="cuff_size" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1.50">1.50</option>
                                <option value="1.75">1.75</option>
                                <option value="2">2.00</option>
                                <option value="2.25">2.25</option>
                                <option value="2.50">2.50</option>
                                <option value="2.75">2.75</option>
                                <option value="3">3.00</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পকেট</label>
                            <select name="pocket" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="0">পকেট হবে না</option>
                                <option value="1">1 টা পকেট</option>
                                <option value="2">2 টা পকেট</option>
                                <option value="3">3 টা পকেট</option>
                                <option value="4">4 টা পকেট</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ভিতর পকেট</label>
                            <select name="inner_pocket" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">পকেট হবে</option>
                                <option value="0">পকেট হবে না</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">ওপেন</label>
                            <select name="open" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">ওপেন</option>
                                <option value="2">নো ওপেন</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কেটালগ নং</label>
                            <input type="number" name="catalog" value="{{ $photua_info->its_photua_measure_catalog_no }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ফতুয়া সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                        <div class="col-lg-4 col-8">
                            <label for="">অনান্য </label>
                            <textarea name="others" class="form-control phonetic"  rows="4">{{ $photua_info->its_photua_measure_others }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if (Session::get('oldPhotuaMeasuerment'))
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
    {{ Form::open(['route' => ['user.measure.take-measure-photua'] , 'method' => 'post']) }}
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Photua" name="p_name">

        <div class="modal fade" id="photua" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Photua Measurement</h5>
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
                            <label for="">হাতা লম্বা</label>
                            <input type="number" step="any" name="hand_long" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা কাপ</label>
                            <input type="number" step="any" name="hand_cuff" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">গলা</label>
                            <input type="number" step="any" name="neck" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা কুনু</label>
                            <input type="number" step="any" name="hand_kunu" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা মোজা</label>
                            <input type="number" step="any" name="hand_moja" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি লুজ</label>
                            <input type="number" step="any" name="body_loose" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ধরন</label>
                            <select name="type" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">চাইনিজ</option>
                                <option value="2">হাওয়াই</option>
                                <option value="3">হাফ</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="plet">প্লেট</label>
                            <select name="plet" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="2">সেলাই প্লেট</option>
                                <option value="3">ইনার প্লেট</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কলার</label>
                            <select name="collar" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">এরো</option>
                                <option value="2">টাই</option>
                                <option value="3">বেন</option>
                                <option value="4">পাঞ্জাবি</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কলারের মাপ</label>
                            <select name="collar_size" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="0.5">0.50</option>
                                <option value="0.75">0.75</option>
                                <option value="1">1.00</option>
                                <option value="1.25">1.25</option>
                                <option value="1.50">1.50</option>
                                <option value="1.75">1.75</option>
                                <option value="2">2.00</option>
                                <option value="2.25">2.25</option>
                                <option value="2.50">2.50</option>
                                <option value="2.75">2.75</option>
                                <option value="3">3.00</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাফ সাইজ</label>
                            <select name="cuff_size" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1.50">1.50</option>
                                <option value="1.75">1.75</option>
                                <option value="2">2.00</option>
                                <option value="2.25">2.25</option>
                                <option value="2.50">2.50</option>
                                <option value="2.75">2.75</option>
                                <option value="3">3.00</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পকেট</label>
                            <select name="pocket" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="0">পকেট হবে না</option>
                                <option value="1">1 টা পকেট</option>
                                <option value="2">2 টা পকেট</option>
                                <option value="3">3 টা পকেট</option>
                                <option value="4">4 টা পকেট</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ভিতর পকেট</label>
                            <select name="inner_pocket" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">পকেট হবে</option>
                                <option value="0">পকেট হবে না</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">ওপেন</label>
                            <select name="open" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">ওপেন</option>
                                <option value="2">নো ওপেন</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কেটালগ নং</label>
                            <input type="number" name="catalog" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                           <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ফতুয়া সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                        <div class="col-lg-4 col-8">
                            <label for="">অনান্য </label>
                            <textarea name="others" class="form-control phonetic" rows="4"></textarea>
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