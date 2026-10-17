@php
    $temp_product_info = App\Models\IglTailorTemporary::where('its_temp_pname','payjama')->first();
@endphp
@if (Session::get('payjamaMeasureId'))
    
    {{ Form::open(['route' => ['branch.measure.update-payjama-measure'] , 'method' => 'post', 'id' => "payjama_measure_edit"]) }}
    
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Payjama" name="p_name"> 

        <div class="modal fade" id="payjama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payjama Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="hidden" name="payjama_measure_order_slno"  value="{{ Session::get('payjamaMeasureId') }}" class="form-control">
                
                <div class="modal-body" id="price_edit_details">
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <label for="">লম্বা</label>
                            <input type="number" step="any" name="long"  value="{{ $payjama_info->its_payjama_measure_long }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কোমর</label>
                            <input type="number" step="any" name="komor" value="{{ $payjama_info->its_payjama_measure_komor }}"  class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ</label>
                            <input type="number" step="any" name="hip" value="{{ $payjama_info->its_payjama_measure_hip }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">মুহুরি</label>
                            <input type="number" step="any" name="muhuri" value="{{ $payjama_info->its_payjama_measure_muhuri }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">থাই</label>
                            <input type="number" step="any" name="thigh" value="{{ $payjama_info->its_payjama_measure_thigh }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ফ্লাই</label>
                            <input type="number" step="any" name="fly" value="{{ $payjama_info->its_payjama_measure_fly }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হাই</label>
                            <input type="number" step="any" name="high" value="{{ $payjama_info->its_payjama_measure_high }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ লুস</label>
                            <input type="number" step="any" name="hip_loose" value="{{ $payjama_info->its_payjama_measure_hip_loose }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পকেট</label>
                            <select name="pocket" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">1টি</option>
                                <option value="2">2টি</option>
                                <option value="3">3টি</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ক্যাটালগ নং</label>
                            <input type="number" name="catalog" value="{{ $payjama_info->its_payjama_measure_catalog_no }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পাজামা সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-6 col-6">
                            <label for="">অনান্য</label>
                            <textarea name="others" id=""  class="form-control phonetic" cols="45" rows="5">{{ $payjama_info->its_payjama_measure_others }}</textarea>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @if (Session::get('oldPayjamaMeasuerment'))
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
    {{ Form::open(['route' => ['branch.measure.take-measure-payjama'] , 'method' => 'post']) }}
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Payjama" name="p_name"> 

        <div class="modal fade" id="payjama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payjama Measurement</h5>
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
                            <label for="">থাই</label>
                            <input type="number" step="any" name="thigh" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ফ্লাই</label>
                            <input type="number" step="any" name="fly" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">হাই</label>
                            <input type="number" step="any" name="high" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ লুস</label>
                            <input type="number" step="any" name="hip_loose" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পকেট</label>
                            <select name="pocket" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">1টি</option>
                                <option value="2">2টি</option>
                                <option value="3">3টি</option>
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
                            <label for="">পাজামা সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-6 col-4">
                            <label for="">অনান্য</label>
                            <textarea name="others" id=""  class="form-control phonetic"  rows="4"></textarea>
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