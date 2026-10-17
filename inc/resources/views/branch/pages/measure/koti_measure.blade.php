@php
    $temp_product_info = App\Models\IglTailorTemporary::where('its_temp_pname','koti')->first();
@endphp
@if (Session::get('kotiMeasureId'))

    {{ Form::open(['route' => ['branch.measure.update-koti-measure'] , 'method' => 'post', 'id' =>"koti_measure_edit"]) }}

        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Koti" name="p_name">

        <div class="modal fade" id="koti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Koti Measurement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <input type="hidden" name="koti_measure_order_slno"  value="{{ Session::get('kotiMeasureId') }}" class="form-control">

                <div class="modal-body" id="price_edit_details">
                    <div class="row">
                        <div class="col-lg-2 col-4">
                            <label for="">লম্বা</label>
                            <input type="number" name="long" step="any" value="{{ $koti_info->its_koti_measure_long }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি</label>
                            <input type="number" name="body" step="any" value="{{ $koti_info->its_koti_measure_body }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">পেট</label>
                            <input type="number" name="belly" step="any" value="{{ $koti_info->its_koti_measure_belly }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ</label>
                            <input type="number" name="hip" step="any" value="{{ $koti_info->its_koti_measure_hip }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">কাঁধ</label>
                            <input type="number" name="shoulder" step="any" value="{{ $koti_info->its_koti_measure_shoulder }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">বডি লুজ</label>
                            <input type="number" name="body_loose" step="any" value="{{ $koti_info->its_koti_measure_body_loose }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">পেট লুজ</label>
                            <input type="number" name="belly_loose" step="any" value="{{ $koti_info->its_koti_measure_belly_loose }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ লুজ</label>
                            <input type="number" name="hip_loose" step="any" value="{{ $koti_info->its_koti_measure_hip_loose }}" class="form-control">
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
                            <label for="">বেল্ট</label>
                            <select name="belt" class="form-control" id="">
                                <option value="">Select</option>
                                <option value="1">বেল্ট</option>
                                <option value="0">নো বেল্ট</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">ক্যাটালগ নং</label>
                            <input type="number" name="catalog" value="{{ $koti_info->its_koti_measure_catalog_no }}" class="form-control">
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">অর্ডার নং</label>
                            <input type="number" readonly name="order_id" value="{{ $order_id }}" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">কটি সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                        <div class="col-lg-4 col-8">
                            <label for="">অনান্য</label>
                            <textarea name="others"  class="form-control phonetic" rows="4">{{ $koti_info->its_koti_measure_others }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     @if (Session::get('oldKotiMeasuerment'))
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
    {{ Form::open(['route' => ['branch.measure.take-measure-koti'] , 'method' => 'post']) }}
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_customer_id : '' }}" name="customer">
        <input type="hidden" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_total_price : '' }}" name="price">
        <input type="hidden" value="Koti" name="p_name">

        <div class="modal fade" id="koti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Koti Measurement</h5>
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
                            <label for="">বডি লুজ</label>
                            <input type="number" step="any" name="body_loose" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">পেট লুজ</label>
                            <input type="number" step="any" name="belly_loose" class="form-control" required>
                        </div>
                        <div class="col-lg-2 col-4">
                            <label for="">হিপ লুজ</label>
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
                            <label for="">বেল্ট</label>
                            <select name="belt" class="form-control" id="" required>
                                <option value="">Select</option>
                                <option value="1">বেল্ট</option>
                                <option value="0">নো বেল্ট</option>
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
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-2 col-4">
                            <label for="">কটি সংখ্যা</label>
                            <input type="number" name="qty" value="{{ ($temp_product_info != "")? $temp_product_info->its_temp_qty : '' }}" readonly class="form-control">
                        </div>
                        <div class="col-lg-4 col-8">
                            <label for="">অনান্য</label>
                            <textarea name="others"  class="form-control phonetic" rows="4"></textarea>
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