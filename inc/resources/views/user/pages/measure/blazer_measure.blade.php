@php
    $temp_product_info = App\Models\IglTailorTemporary::where('its_temp_pname','blazer')->first();
@endphp
@if (Session::get('blazerMeasureId'))
    
    {{ Form::open(['route' => ['user.measure.update-blazer-measure'] , 'method' => 'post', 'id' =>"blazer_measure_edit"]) }}
    
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Blazer" name="p_name">
    
        <div class="modal fade" id="blazer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Blazer Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="hidden" name="blazer_measure_order_slno"  value="{{ Session::get('blazerMeasureId') }}" class="form-control">

                <div class="modal-body" id="blazer_edit_details">
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <label for="">লম্বা</label>
                            <input type="number" name="long" step="any" value="{{ $blazer_info->its_blazer_measure_long }}" class="form-control" min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি</label>
                            <input type="number" name="body" step="any" value="{{ $blazer_info->its_blazer_measure_body }}" class="form-control" min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট</label>
                            <input type="number" name="belly" step="any" value="{{ $blazer_info->its_blazer_measure_belly }}"  class="form-control" min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ</label>
                            <input type="number" name="hip" step="any" value="{{ $blazer_info->its_blazer_measure_hip }}"  class="form-control" min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাঁধ</label>
                            <input type="number" name="shoulder" step="any" value="{{ $blazer_info->its_blazer_measure_shoulder }}"  class="form-control" min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা-লম্বা</label>
                            <input type="number" name="hand_long" step="any" value="{{ $blazer_info->its_blazer_measure_hand_long }}"  class="form-control" min="1">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা-মহরি</label>
                            <input type="number" name="hand_muhuri" step="any" value="{{ $blazer_info->its_blazer_measure_hand_muhuri }}"  class="form-control" min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ক্রস ব্যাক</label>
                            <input type="number" name="cross_back" step="any" value="{{ $blazer_info->its_blazer_measure_cross_back }}"  class="form-control" min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বুতাম</label>
                            <select name="button" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">1 টা</option>
                                <option value="2">2 টা</option>
                                <option value="3">3 টা</option>
                                <option value="4">4 টা</option>
                                <option value="5">5 টা</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">নেপেল</label>
                            <select name="nepel" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="2">2.00</option>
                                <option value="2.25">2.25</option>
                                <option value="2.5">2.50</option>
                                <option value="2.75">2.75</option>
                                <option value="3">3.00</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ওপেন</label>
                            <select name="open" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">ব্যাক ওপেন</option>
                                <option value="2">সাইড ওপেন</option>
                                <option value="3">নো ওপেন</option>
                                <option value="4">ব্যাক/সাইড ওপেন</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বেস্ট</label>
                            <select name="best" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="2">ডাবল</option>
                                <option value="1">সিংগেল</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">নিচে</label>
                            <select name="bottom" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="0">রাউন্ড</option>
                                <option value="1">স্ক্য়ার</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কেটালগ নং</label>
                            <input type="number" name="catalog" value="{{ $blazer_info->its_blazer_measure_catalog_no }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ব্লেজারের সংখ্যা</label>
                            <input type="number" readonly name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" class="form-control">
                        </div>    
                        <div class="col-lg-4 col-8">
                            <label for="">অনান্য</label>
                            <textarea name="others" class="form-control phonetic"  rows="4">{{ $blazer_info->its_blazer_measure_others }}</textarea>
                        </div>
                    </div>
                  </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if (Session::get('oldBlazerMeasuerment'))
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
    {{ Form::open(['route' => ['user.measure.take-measure-blazer'] , 'method' => 'post']) }}
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Blazer" name="p_name">
    
        <div class="modal fade" id="blazer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Blazer Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="price_edit_details">
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <label for="">লম্বা</label>
                            <input type="number" autocomplete="off" name="long" step="any" class="form-control" required min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি</label>
                            <input type="number" autocomplete="off" name="body" step="any" class="form-control" required min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট</label>
                            <input type="number" autocomplete="off" name="belly" step="any" class="form-control" required min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ</label>
                            <input type="number" autocomplete="off" name="hip" step="any" class="form-control" required min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাঁধ</label>
                            <input type="number" autocomplete="off" name="shoulder" step="any" class="form-control" required min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা-লম্বা</label>
                            <input type="number" autocomplete="off" name="hand_long" step="any" class="form-control" required min="1">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হাতা-মহরি</label>
                            <input type="number" autocomplete="off" name="hand_muhuri" step="any" class="form-control" required min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ক্রস ব্যাক</label>
                            <input type="number" autocomplete="off" name="cross_back" step="any" class="form-control" required min="1">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বুতাম</label>
                            <select name="button" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">1 টা</option>
                                <option value="2">2 টা</option>
                                <option value="3">3 টা</option>
                                <option value="4">4 টা</option>
                                <option value="5">5 টা</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">নেপেল</label>
                            <select name="nepel" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="2">2.00</option>
                                <option value="2.25">2.25</option>
                                <option value="2.5">2.50</option>
                                <option value="2.75">2.75</option>
                                <option value="3">3.00</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ওপেন</label>
                            <select name="open" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">ব্যাক ওপেন</option>
                                <option value="2">সাইড ওপেন </option>
                                <option value="3">নো ওপেন </option>
                                <option value="4">ব্যাক/সাইড ওপেন </option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বেস্ট</label>
                            <select name="best" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="2">ডাবল</option>
                                <option value="1">সিংগেল</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">নিচে</label>
                            <select name="bottom" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="0">রাউন্ড</option>
                                <option value="1">স্ক্য়ার</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কেটালগ নং</label>
                            <input type="number" autocomplete="off" name="catalog" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ব্লেজারের সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>    
                        <div class="col-4">
                            <label for="">অনান্য</label>
                            <textarea name="others" autocomplete="off" class="form-control phonetic" rows="4"></textarea>
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

