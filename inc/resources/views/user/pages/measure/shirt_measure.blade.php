@php
    $temp_product_info = App\Models\IglTailorTemporary::where('its_temp_pname','shirt')->first();
@endphp
@if(Session::get('shirtMeasureId'))
    
    {{ Form::open(['route' => ['user.measure.update-shirt-measure'] , 'method' => 'post', 'id' =>"shirt_measure_edit" ])  }}  

        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Shirt" name="p_name">
        
        <div class="modal fade" id="shirt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Shirt Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <input type="hidden" name="shirt_measure_order_slno"  value="{{ Session::get('shirtMeasureId') }}" class="form-control">
                
                <div class="modal-body" id="shirt_edit_details">
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <label for="">লম্বা</label>
                            <input type="number" name="long" step="any"  value="{{ $shirt_info->its_shirt_msr_long }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি</label>
                            <input type="number" name="body" step="any"  value="{{ $shirt_info->its_shirt_msr_body }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট</label>
                            <input type="number" name="bally" step="any" value="{{ $shirt_info->its_shirt_msr_bally }}"  class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ</label>
                            <input type="number" name="hip" step="any"  value="{{ $shirt_info->its_shirt_msr_hip }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাধ</label>
                            <input type="number" name="shoulder" step="any" value="{{ $shirt_info->its_shirt_msr_shoulder }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা লম্বা</label>
                            <input type="number" name="hand_long" step="any" value="{{ $shirt_info->its_shirt_msr_hand_long }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা কাপ</label>
                            <input type="number" name="hand_cuff" step="any" value="{{ $shirt_info->its_shirt_msr_hand_cuff }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">গলা</label>
                            <input type="number" name="neck" step="any" value="{{ $shirt_info->its_shirt_msr_neck }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা মোজা</label>
                            <input type="number" name="hand_moja" step="any" value="{{ $shirt_info->its_shirt_msr_hand_moja }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা কুনু</label>
                            <input type="number" name="hand_kunu" step="any" value="{{ $shirt_info->its_shirt_msr_hand_kunu }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি লুজ</label>
                            <input type="number" name="body_loose" step="any" value="{{ $shirt_info->its_shirt_msr_body_loose }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট লুজ</label>
                            <input type="number" name="bally_loose" step="any" value="{{ $shirt_info->its_shirt_msr_bally_loose }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ লুজ</label>
                            <input type="number" name="hip_loose" step="any" value="{{ $shirt_info->its_shirt_msr_hip_loose }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ধরন</label>
                            <select name="type" id="" class="form-control">
                                <option value="">Select</option>
                                <option value="1">চাইনিজ</option>
                                <option value="2">হাওয়াই</option>
                                <option value="3">হাফ</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">প্লেট</label>
                            <select name="plet" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">সেলাই প্লেট</option>
                                <option value="2">বক্স প্লেট</option>
                                <option value="3">ইনার প্লেট</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কলার</label>
                            <select name="collar" id="" class="form-control">
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
                            <label for="">কাফ সাইজ</label>
                            <select name="cuff_size" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1.5">1.50</option>
                                <option value="1.75">1.75</option>
                                <option value="2">2.00</option>
                                <option value="2.25">2.25</option>
                                <option value="2.5">2.50</option>
                                <option value="2.75">2.75</option>
                                <option value="3">3.00</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
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
                            <label for="inner_pocket">ভিতর পকেট</label>
                            <select name="inner_pocket" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">পকেট হবে</option>
                                <option value="0">পকেট হবে না</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কেটালগ নং</label>
                            <input type="number" name="catalog"  value="{{ $shirt_info->its_shirt_msr_catalog_no }}"  class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">জামার সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অনান্য</label>
                            <textarea  name="others" class="form-control phonetic"  rows="4" >{{ $shirt_info->its_shirt_msr_others }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if (Session::get('oldShirtMeasuerment'))
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

    {{ Form::open(['route' => ['user.measure.take-measure-shirt'] , 'method' => 'post']) }}
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Shirt" name="p_name">
        
        <div class="modal fade" id="shirt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Shirt Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="price_edit_details">
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <label for="">লম্বা</label>
                            <input type="number" name="long" step="any" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি</label>
                            <input type="number" name="body" step="any" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট</label>
                            <input type="number" name="bally" step="any" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ</label>
                            <input type="number" name="hip" step="any" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাধ</label>
                            <input type="number" name="shoulder" step="any" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা লম্বা</label>
                            <input type="number" name="hand_long" step="any" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা কাপ</label>
                            <input type="number" name="hand_cuff" step="any" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">গলা</label>
                            <input type="number" name="neck" step="any" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা মোজা</label>
                            <input type="number" name="hand_moja" step="any" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা কুনু</label>
                            <input type="number" name="hand_kunu" step="any" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি লুজ</label>
                            <input type="number" name="body_loose" step="any" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট লুজ</label>
                            <input type="number" name="bally_loose" step="any" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ লুজ</label>
                            <input type="number" name="hip_loose" step="any" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ধরন</label>
                            <select name="type" id="" class="form-control" required>
                                <option value="">Select</option>
                                <option value="1">চাইনিজ</option>
                                <option value="2">হাওয়াই</option>
                                <option value="3">হাফ</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">প্লেট</label>
                            <select name="plet" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">সেলাই প্লেট</option>
                                <option value="2">বক্স প্লেট</option>
                                <option value="3">ইনার প্লেট</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কলার</label>
                            <select name="collar" id="" class="form-control" required>
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
                            <label for="">কাফ সাইজ</label>
                            <select name="cuff_size" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1.5">1.50</option>
                                <option value="1.75">1.75</option>
                                <option value="2">2.00</option>
                                <option value="2.25">2.25</option>
                                <option value="2.5">2.50</option>
                                <option value="2.75">2.75</option>
                                <option value="3">3.00</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
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
                            <label for="inner_pocket">ভিতর পকেট</label>
                            <select name="inner_pocket" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">পকেট হবে</option>
                                <option value="0">পকেট হবে না</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কেটালগ নং</label>
                            <input type="number" name="catalog"  class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}"  class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">জামার সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অনান্য</label>
                            <textarea  name="others" class="form-control phonetic" rows="4" ></textarea>
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

