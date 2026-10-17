@if (Session::get('shirtMeasureId'))
    <script>
        document.forms['shirt_measure_edit'].elements['type'].value        = {{ $shirt_info->its_shirt_msr_types }}
        document.forms['shirt_measure_edit'].elements['plet'].value        = {{ $shirt_info->its_shirt_msr_plet }}
        document.forms['shirt_measure_edit'].elements['collar'].value      = {{ $shirt_info->its_shirt_msr_collar }}
        document.forms['shirt_measure_edit'].elements['collar_size'].value = {{ $shirt_info->its_shirt_msr_collar_size }}
        document.forms['shirt_measure_edit'].elements['cuff_size'].value   = {{ $shirt_info->its_shirt_msr_cuff_size }}
        document.forms['shirt_measure_edit'].elements['pocket'].value      = {{ $shirt_info->its_shirt_msr_pocket }}
        document.forms['shirt_measure_edit'].elements['inner_pocket'].value= {{ $shirt_info->its_shirt_msr_pocket_inner }}
    </script>
@endif
@if (Session::get('pantMeasureId'))
    <script>
        document.forms['pant_measure_edit'].elements['pocket'].value       =  {{ $pant_info->its_pant_measure_pocket_type }}
        document.forms['pant_measure_edit'].elements['back_pocket'].value  =  {{ $pant_info->its_pant_measure_pocket_backside }}
        document.forms['pant_measure_edit'].elements['inner_pocket'].value =  {{ $pant_info->its_pant_measure_pocket_inner }}
        document.forms['pant_measure_edit'].elements['mohuri_type'].value  =  {{ $pant_info->its_pant_measure_muhuri_type }}
        document.forms['pant_measure_edit'].elements['loop'].value         =  {{ $pant_info->its_pant_measure_loop }}
        document.forms['pant_measure_edit'].elements['loop_size'].value    =  {{ $pant_info->its_pant_measure_loop_size }}
        document.forms['pant_measure_edit'].elements['kuci'].value         =  {{ $pant_info->its_pant_measure_kuci }}
    </script>
@endif
@if (Session::get('blazerMeasureId'))
    <script>
        document.forms['blazer_measure_edit'].elements['button'].value     =  {{ $blazer_info->its_blazer_measure_button_num }}
        document.forms['blazer_measure_edit'].elements['nepel'].value      =  {{ $blazer_info->its_blazer_measure_nepel }}
        document.forms['blazer_measure_edit'].elements['open'].value       =  {{ $blazer_info->its_blazer_measure_side }}
        document.forms['blazer_measure_edit'].elements['best'].value       =  {{ $blazer_info->its_blazer_measure_best }}
        document.forms['blazer_measure_edit'].elements['bottom'].value     =  {{ $blazer_info->its_blazer_measure_under }}
    </script>
@endif
@if (Session::get('panjabiMeasureId'))
    <script>
        document.forms['panjabi_measure_edit'].elements['collar_size'].value     =  {{ $panjabi_info->its_panjabi_msr_collar_size }}
        document.forms['panjabi_measure_edit'].elements['collar_type'].value     =  {{ $panjabi_info->its_panjabi_msr_collar_type }}
        document.forms['panjabi_measure_edit'].elements['pocket'].value          =  {{ $panjabi_info->its_panjabi_msr_pocket }}
        document.forms['panjabi_measure_edit'].elements['plet'].value            =  {{ $panjabi_info->its_panjabi_msr_plet }}
        document.forms['panjabi_measure_edit'].elements['inner_pocket'].value    =  {{ $panjabi_info->its_panjabi_msr_inner_pocket }}
    </script>
@endif
@if (Session::get('payjamaMeasureId'))
    <script>
        document.forms['payjama_measure_edit'].elements['pocket'].value    =  {{ $payjama_info->its_payjama_measure_pocket }}
    </script>
@endif
     
@if (Session::get('safariMeasureId'))
    <script>
        document.forms['safari_measure_edit'].elements['collar_size'].value   =  {{ $safari_info->its_safari_measure_collar_size }}
        document.forms['safari_measure_edit'].elements['plet'].value          =  {{ $safari_info->its_safari_measure_plet }}
        document.forms['safari_measure_edit'].elements['pocket'].value        =  {{ $safari_info->its_safari_measure_pocket }}
        document.forms['safari_measure_edit'].elements['back_side'].value     =  {{ $safari_info->its_safari_measure_back_side }}
        document.forms['safari_measure_edit'].elements['collar'].value        =  {{ $safari_info->its_safari_measure_collar }}
        document.forms['safari_measure_edit'].elements['inner_pocket'].value  =  {{ $safari_info->its_safari_measure_inner_pocket }}
        document.forms['safari_measure_edit'].elements['type'].value          =  {{ $safari_info->its_safari_measure_type }}
    </script>
@endif
@if (Session::get('photuaMeasureId'))
    <script>
        document.forms['photua_measure_edit'].elements['type'].value          =  {{ $photua_info->its_photua_measure_types }}
        document.forms['photua_measure_edit'].elements['plet'].value          =  {{ $photua_info->its_photua_measure_plet }}
        document.forms['photua_measure_edit'].elements['collar'].value        =  {{ $photua_info->its_photua_measure_collar }}
        document.forms['photua_measure_edit'].elements['collar_size'].value   =  {{ $photua_info->its_photua_measure_collar_size }}
        document.forms['photua_measure_edit'].elements['cuff_size'].value     =  {{ $photua_info->its_photua_measure_cuff_size }}
        document.forms['photua_measure_edit'].elements['pocket'].value        =  {{ $photua_info->its_photua_measure_pocket }}
        document.forms['photua_measure_edit'].elements['inner_pocket'].value  =  {{ $photua_info->its_photua_measure_pocket_inner }}
        document.forms['photua_measure_edit'].elements['open'].value          =  {{ $photua_info->its_photua_measure_open }}
    </script>
@endif
@if (Session::get('mojibCortMeasureId'))
    <script>
        document.forms['mojib_cort_measure_edit'].elements['collar'].value        =  {{ $mojibcort_info->its_mojibcort_measure_collar }}
        document.forms['mojib_cort_measure_edit'].elements['pocket'].value        =  {{ $mojibcort_info->its_mojibcort_measure_pocket }}
        document.forms['mojib_cort_measure_edit'].elements['inner_pocket'].value  =  {{ $mojibcort_info->its_mojibcort_measure_inner_pocket }}
        document.forms['mojib_cort_measure_edit'].elements['open'].value          =  {{ $mojibcort_info->its_mojibcort_measure_open }}       
    </script>
@endif
@if (Session::get('kableMeasureId'))
    <script>
        document.forms['kable_measure_edit'].elements['collar_type'].value   =  {{ $kable_info->its_kable_measure_collar_type }}
        document.forms['kable_measure_edit'].elements['pocket'].value        =  {{ $kable_info->its_kable_measure_pocket }}
        document.forms['kable_measure_edit'].elements['plate'].value         =  {{ $kable_info->its_kable_measure_plet }}
    </script>
@endif
@if (Session::get('kotiMeasureId'))
    <script>
        document.forms['koti_measure_edit'].elements['pocket'].value   =  {{ $koti_info->its_koti_measure_pocket }}
        document.forms['koti_measure_edit'].elements['belt'].value     =  {{ $koti_info->its_koti_measure_belt }}
    </script>
@endif
