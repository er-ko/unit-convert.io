<x-public-layout>

    <x-slot name="meta_desc">{{ 'unit converter' }}</x-slot>
    <x-slot name="meta_keywords">{{ 'unit, convert, converter, io' }}</x-slot>

    <div class="w-full">
        <x-input id="number" type="number" class="w-full px-4 py-5 rounded-xl border-0 ring-0" placeholder="number" autofocus />
    </div>
    <div class="mt-3 w-full">
        <select class="form-control select2 w-full" id="input-unit" placeholder="{{ __('messages.input_unit') }}">
            <option></option>
            @foreach ($units as $group => $unit)
                <optgroup label="{{ $group }}">
                    @foreach ($unit as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    </div>
    <div class="mt-3 w-full">
        <select class="form-control select2 w-full p-8" id="output-unit" placeholder="{{ __('messages.output_unit') }}">
            <option></option>
            @foreach ($units as $group => $unit)
                <optgroup label="{{ $group }}">
                    @foreach ($unit as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
    </div>

    <div class="mt-5 p-8 w-full flex items-center justify-center font-bold rounded-xl shadow-xl text-teal-400 bg-gray-900">
        <span class="result">0123..</span>
    </div>
    <div class="mt-1 p-2 w-full flex items-center justify-center text-gray-400">
    <span class="result-info"></span>
    </div>

    @push('slotscript')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var inputUnit = $('#input-unit').attr('placeholder');
                var outputUnit = $('#output-unit').attr('placeholder');
                $('#input-unit').select2({
                    placeholder: inputUnit,
                    allowClear: false
                });
                $('#output-unit').select2({
                    placeholder: outputUnit,
                    allowClear: false,
                });

                $('#number').keyup(function(e){
                    e.preventDefault();
                    if ($(this).val()) {
                        if ($('#input-unit').find(':selected').parent().attr('label') === $('#output-unit').find(':selected').parent().attr('label')) {
                            convert( $(this).val(), $('#input-unit').find(':selected').val(), $('#output-unit').find(':selected').val() );
                        } else {
                            $('.result').text('...');
                            $('.result-info').text('');
                        }
                    } else {
                        $('.result').text('?');
                        $('.result-info').text('');
                    }
                });
                $('#input-unit').change(function(){
                    if ($(this).find(':selected').parent().attr('label') === $('#output-unit').find(':selected').parent().attr('label') && $('#number').val() !== '') {
                        convert( $('#number').val(), $(this).find(':selected').val(), $('#output-unit').find(':selected').val() );
                    } else {
                        $('.result').text('...');
                        $('.result-info').text(''); 
                    }
                });
                $('#output-unit').change(function(){
                    if ($('#input-unit').find(':selected').parent().attr('label') === $(this).find(':selected').parent().attr('label') && $('#number').val() !== '') {
                        convert( $('#number').val(), $('#input-unit').find(':selected').val(), $(this).find(':selected').val() );
                    } else {
                        $('.result').text('...');
                        $('.result-info').text('');
                    }
                });

            });

            function convert($number, $input, $output) {
                if ($input === 'in') {
                    switch ($output) {
                        case "ft":
                            $('.result').text(parseFloat($number * 0.0833333333));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0833333333).toFixed(2) + ' ' + $output);
                            break;
                        case "yd":
                            $('.result').text(parseFloat($number * 0.0277777778));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0277777778).toFixed(2) + ' ' + $output);
                            break;
                        case "mi": 
                            $('.result').text(parseFloat($number * 1.57828283 * (1/100000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1.57828283 * (1/100000)).toFixed(2) + ' ' + $output);
                            break;
                        case "mm":
                            $('.result').text(parseFloat($number * 25.4));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 25.4).toFixed(2) + ' ' + $output);
                            break;
                        case "cm": 
                            $('.result').text(parseFloat($number * 2.54));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 2.54).toFixed(2) + ' ' + $output);
                            break;
                        case "dm":
                            $('.result').text(parseFloat($number * .254));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * .254).toFixed(2) + ' ' + $output);
                            break;
                        case "m": 
                            $('.result').text(parseFloat($number * .0254));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * .0254).toFixed(2) + ' ' + $output);
                            break;
                        case "km":
                            $('.result').text(parseFloat($number * .00254));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * .00254).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'ft') {
                    switch ($output) {
                        case "in":
                            $('.result').text(parseFloat($number * 12));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0833333333).toFixed(2) + ' ' + $output);
                            break;
                        case "yd":
                            $('.result').text(parseFloat($number * 0.333333333));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.333333333).toFixed(2) + ' ' + $output);
                            break;
                        case "mi": 
                            $('.result').text(parseFloat($number * 0.000189393939));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.000189393939).toFixed(2) + ' ' + $output);
                            break;
                        case "mm":
                            $('.result').text(parseFloat($number * 304.8));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 304.8).toFixed(2) + ' ' + $output);
                            break;
                        case "cm": 
                            $('.result').text(parseFloat($number * 30.48));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 30.48).toFixed(2) + ' ' + $output);
                            break;
                        case "dm":
                            $('.result').text(parseFloat($number * 3.048));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 3.048).toFixed(2) + ' ' + $output);
                            break;
                        case "m": 
                            $('.result').text(parseFloat($number * 0.3048));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.3048).toFixed(2) + ' ' + $output);
                            break;
                        case "km":
                            $('.result').text(parseFloat($number * 0.0003048));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0003048).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'yd') {
                    switch ($output) {
                        case "in":
                            $('.result').text(parseFloat($number * 36));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 36).toFixed(2) + ' ' + $output);
                            break;
                        case "ft":
                            $('.result').text(parseFloat($number * 3));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 3).toFixed(2) + ' ' + $output);
                            break;
                        case "mi": 
                            $('.result').text(parseFloat($number * 0.000568181818));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.000568181818).toFixed(2) + ' ' + $output);
                            break;
                        case "mm":
                            $('.result').text(parseFloat($number * 914.4));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 914.4).toFixed(2) + ' ' + $output);
                            break;
                        case "cm": 
                            $('.result').text(parseFloat($number * 91.44));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 91.44).toFixed(2) + ' ' + $output);
                            break;
                        case "dm":
                            $('.result').text(parseFloat($number * 9.144));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 9.144).toFixed(2) + ' ' + $output);
                            break;
                        case "m": 
                            $('.result').text(parseFloat($number * 0.9144));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.9144).toFixed(2) + ' ' + $output);
                            break;
                        case "km":
                            $('.result').text(parseFloat($number * 0.0009144));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0009144).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'mi') {
                    switch ($output) {
                        case "in":
                            $('.result').text(parseFloat($number * 63360));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 63360).toFixed(2) + ' ' + $output);
                            break;
                        case "ft":
                            $('.result').text(parseFloat($number * 5280));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 5280).toFixed(2) + ' ' + $output);
                            break;
                        case "yd": 
                            $('.result').text(parseFloat($number * 1760));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1760).toFixed(2) + ' ' + $output);
                            break;
                        case "mm":
                            $('.result').text(parseFloat($number * 1609344));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1609344).toFixed(2) + ' ' + $output);
                            break;
                        case "cm": 
                            $('.result').text(parseFloat($number * 160934.4));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 160934.4).toFixed(2) + ' ' + $output);
                            break;
                        case "dm":
                            $('.result').text(parseFloat($number * 16093.44));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 16093.44).toFixed(2) + ' ' + $output);
                            break;
                        case "m": 
                            $('.result').text(parseFloat($number * 1609.344));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1609.344).toFixed(2) + ' ' + $output);
                            break;
                        case "km":
                            $('.result').text(parseFloat($number * 1.609344));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1.609344).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'mm') {
                    switch ($output) {
                        case "in":
                            $('.result').text(parseFloat($number * 0.0393700787));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0393700787).toFixed(2) + ' ' + $output);
                            break;
                        case "ft":
                            $('.result').text(parseFloat($number * 0.0032808399));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0032808399).toFixed(2) + ' ' + $output);
                            break;
                        case "yd": 
                            $('.result').text(parseFloat($number * 0.0010936133));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0010936133).toFixed(2) + ' ' + $output);
                            break;
                        case "mi":
                            $('.result').text(parseFloat($number * 6.21371192 * (1/10000000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 6.21371192 * (1/10000000)).toFixed(2) + ' ' + $output);
                            break;
                        case "cm": 
                            $('.result').text(parseFloat($number * 0.1));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.1).toFixed(2) + ' ' + $output);
                            break;
                        case "dm":
                            $('.result').text(parseFloat($number * 0.01));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.01).toFixed(2) + ' ' + $output);
                            break;
                        case "m": 
                            $('.result').text(parseFloat($number * 0.001));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.001).toFixed(2) + ' ' + $output);
                            break;
                        case "km":
                            $('.result').text(parseFloat($number * (1/1000000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * (1/1000000)).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'cm') {
                    switch ($output) {
                        case "in":
                            $('.result').text(parseFloat($number * 0.393700787));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.393700787).toFixed(2) + ' ' + $output);
                            break;
                        case "ft":
                            $('.result').text(parseFloat($number * 0.032808399));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.032808399).toFixed(2) + ' ' + $output);
                            break;
                        case "yd": 
                            $('.result').text(parseFloat($number * 0.010936133));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.010936133).toFixed(2) + ' ' + $output);
                            break;
                        case "mi":
                            $('.result').text(parseFloat($number * 6.21371192 * (1/1000000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 6.21371192 * (1/1000000)).toFixed(2) + ' ' + $output);
                            break;
                        case "mm": 
                            $('.result').text(parseFloat($number * 10));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 10).toFixed(2) + ' ' + $output);
                            break;
                        case "dm":
                            $('.result').text(parseFloat($number * 0.1));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.1).toFixed(2) + ' ' + $output);
                            break;
                        case "m": 
                            $('.result').text(parseFloat($number * 0.01));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.01).toFixed(2) + ' ' + $output);
                            break;
                        case "km":
                            $('.result').text(parseFloat($number * (1/100000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * (1/100000)).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'dm') {
                    switch ($output) {
                        case "in":
                            $('.result').text(parseFloat($number * 3.93700787));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 3.93700787).toFixed(2) + ' ' + $output);
                            break;
                        case "ft":
                            $('.result').text(parseFloat($number * 0.32808399));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.32808399).toFixed(2) + ' ' + $output);
                            break;
                        case "yd": 
                            $('.result').text(parseFloat($number * 0.10936133));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.10936133).toFixed(2) + ' ' + $output);
                            break;
                        case "mi":
                            $('.result').text(parseFloat($number * 6.21371192 * (1/100000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 6.21371192 * (1/100000)).toFixed(2) + ' ' + $output);
                            break;
                        case "mm": 
                            $('.result').text(parseFloat($number * 100));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 100).toFixed(2) + ' ' + $output);
                            break;
                        case "cm":
                            $('.result').text(parseFloat($number * 10));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 10).toFixed(2) + ' ' + $output);
                            break;
                        case "m": 
                            $('.result').text(parseFloat($number * 0.1));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.1).toFixed(2) + ' ' + $output);
                            break;
                        case "km":
                            $('.result').text(parseFloat($number * 0.0001));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0001).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'm') {
                    switch ($output) {
                        case "in":
                            $('.result').text(parseFloat($number * 39.3700787));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 39.3700787).toFixed(2) + ' ' + $output);
                            break;
                        case "ft":
                            $('.result').text(parseFloat($number * 3.2808399));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 3.2808399).toFixed(2) + ' ' + $output);
                            break;
                        case "yd": 
                            $('.result').text(parseFloat($number * 1.0936133));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1.0936133).toFixed(2) + ' ' + $output);
                            break;
                        case "mi":
                            $('.result').text(parseFloat($number * 0.000621371192));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.000621371192).toFixed(2) + ' ' + $output);
                            break;
                        case "mm": 
                            $('.result').text(parseFloat($number * 1000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1000).toFixed(2) + ' ' + $output);
                            break;
                        case "cm":
                            $('.result').text(parseFloat($number * 100));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 100).toFixed(2) + ' ' + $output);
                            break;
                        case "dm": 
                            $('.result').text(parseFloat($number * 10));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 10).toFixed(2) + ' ' + $output);
                            break;
                        case "km":
                            $('.result').text(parseFloat($number * 0.001));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.001).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'km') {
                    switch ($output) {
                        case "in":
                            $('.result').text(parseFloat($number * 39370.0787));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 39370.0787).toFixed(2) + ' ' + $output);
                            break;
                        case "ft":
                            $('.result').text(parseFloat($number * 3280.8399));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 3280.8399).toFixed(2) + ' ' + $output);
                            break;
                        case "yd": 
                            $('.result').text(parseFloat($number * 1093.6133));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1093.6133).toFixed(2) + ' ' + $output);
                            break;
                        case "mi":
                            $('.result').text(parseFloat($number * 0.621371192));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.621371192).toFixed(2) + ' ' + $output);
                            break;
                        case "mm": 
                            $('.result').text(parseFloat($number * 1000000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1000000).toFixed(2) + ' ' + $output);
                            break;
                        case "cm":
                            $('.result').text(parseFloat($number * 100000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 100000).toFixed(2) + ' ' + $output);
                            break;
                        case "dm": 
                            $('.result').text(parseFloat($number * 10000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 10000).toFixed(2) + ' ' + $output);
                            break;
                        case "m":
                            $('.result').text(parseFloat($number * 1000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1000).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'dr') {
                    switch ($output) {
                        case "oz":
                            $('.result').text(parseFloat($number * 0.0625));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0625).toFixed(2) + ' ' + $output);
                            break;
                        case "lb":
                            $('.result').text(parseFloat($number * 0.00390625));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.00390625).toFixed(2) + ' ' + $output);
                            break;
                        case "mg": 
                            $('.result').text(parseFloat($number * 1771.8452));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1771.8452).toFixed(2) + ' ' + $output);
                            break;
                        case "g":
                            $('.result').text(parseFloat($number * 1.7718452));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1.7718452).toFixed(2) + ' ' + $output);
                            break;
                        case "dag": 
                            $('.result').text(parseFloat($number * 0.17718452));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.17718452).toFixed(2) + ' ' + $output);
                            break;
                        case "kg":
                            $('.result').text(parseFloat($number * 0.0017718452));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0017718452).toFixed(2) + ' ' + $output);
                            break;
                        case "t": 
                            $('.result').text(parseFloat($number * 1.953125 * (1/1000000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1.953125 * (1/1000000)).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'oz') {
                    switch ($output) {
                        case "dr":
                            $('.result').text(parseFloat($number * 16));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 16).toFixed(2) + ' ' + $output);
                            break;
                        case "lb":
                            $('.result').text(parseFloat($number * 0.0625));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0625).toFixed(2) + ' ' + $output);
                            break;
                        case "mg": 
                            $('.result').text(parseFloat($number * 28349.5231));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 28349.5231).toFixed(2) + ' ' + $output);
                            break;
                        case "g":
                            $('.result').text(parseFloat($number * 28.3495231));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 28.3495231).toFixed(2) + ' ' + $output);
                            break;
                        case "dag": 
                            $('.result').text(parseFloat($number * 2.83495231));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 2.83495231).toFixed(2) + ' ' + $output);
                            break;
                        case "kg":
                            $('.result').text(parseFloat($number * 0.0283495231));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0283495231).toFixed(2) + ' ' + $output);
                            break;
                        case "t": 
                            $('.result').text(parseFloat($number * 3.12500 * (1/100000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 3.12500 * (1/100000)).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'lb') {
                    switch ($output) {
                        case "dr":
                            $('.result').text(parseFloat($number * 256));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 256).toFixed(2) + ' ' + $output);
                            break;
                        case "oz":
                            $('.result').text(parseFloat($number * 16));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 16).toFixed(2) + ' ' + $output);
                            break;
                        case "mg": 
                            $('.result').text(parseFloat($number * 453592.37));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 453592.37).toFixed(2) + ' ' + $output);
                            break;
                        case "g":
                            $('.result').text(parseFloat($number * 453.59237));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 453.59237).toFixed(2) + ' ' + $output);
                            break;
                        case "dag": 
                            $('.result').text(parseFloat($number * 45.359237));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 45.359237).toFixed(2) + ' ' + $output);
                            break;
                        case "kg":
                            $('.result').text(parseFloat($number * 0.45359237));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.45359237).toFixed(2) + ' ' + $output);
                            break;
                        case "t": 
                            $('.result').text(parseFloat($number * 0.45359237 * (1/1000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.45359237 * (1/1000)).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'mg') {
                    switch ($output) {
                        case "dr":
                            $('.result').text(parseFloat($number * 0.000564383391));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.000564383391).toFixed(2) + ' ' + $output);
                            break;
                        case "oz":
                            $('.result').text(parseFloat($number * 3.52739619 * (1/100000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 3.52739619 * (1/100000)).toFixed(2) + ' ' + $output);
                            break;
                        case "lb": 
                            $('.result').text(parseFloat($number * 2.20462262 * (1/1000000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 2.20462262 * (1/1000000)).toFixed(2) + ' ' + $output);
                            break;
                        case "g":
                            $('.result').text(parseFloat($number * 0.001));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.001).toFixed(2) + ' ' + $output);
                            break;
                        case "dag": 
                            $('.result').text(parseFloat($number * 0.0001));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0001).toFixed(2) + ' ' + $output);
                            break;
                        case "kg":
                            $('.result').text(parseFloat($number * (1/1000000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * (1/1000000)).toFixed(2) + ' ' + $output);
                            break;
                        case "t": 
                            $('.result').text(parseFloat($number * 1.10231131 * (1/1000000000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1.10231131 * (1/1000000000)).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'g') {
                    switch ($output) {
                        case "dr":
                            $('.result').text(parseFloat($number * 0.564383391));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.564383391).toFixed(2) + ' ' + $output);
                            break;
                        case "oz":
                            $('.result').text(parseFloat($number * 0.0352739619));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0352739619).toFixed(2) + ' ' + $output);
                            break;
                        case "lb": 
                            $('.result').text(parseFloat($number * 0.00220462262));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.00220462262).toFixed(2) + ' ' + $output);
                            break;
                        case "mg":
                            $('.result').text(parseFloat($number * 1000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1000).toFixed(2) + ' ' + $output);
                            break;
                        case "dag": 
                            $('.result').text(parseFloat($number * 0.1));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.1).toFixed(2) + ' ' + $output);
                            break;
                        case "kg":
                            $('.result').text(parseFloat($number * 0.001));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.001).toFixed(2) + ' ' + $output);
                            break;
                        case "t": 
                            $('.result').text(parseFloat($number * (1/1000000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * (1/1000000)).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'mg') {
                    switch ($output) {
                        case "dr":
                            $('.result').text(parseFloat($number * 0.000564383391));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.000564383391).toFixed(2) + ' ' + $output);
                            break;
                        case "oz":
                            $('.result').text(parseFloat($number * 3.52739619 * (1/00000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 3.52739619 * (1/00000)).toFixed(2) + ' ' + $output);
                            break;
                        case "lb": 
                            $('.result').text(parseFloat($number * 2.20462262 * (1/1000000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 2.20462262 * (1/1000000)).toFixed(2) + ' ' + $output);
                            break;
                        case "g":
                            $('.result').text(parseFloat($number * 0.001));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.001).toFixed(2) + ' ' + $output);
                            break;
                        case "dag": 
                            $('.result').text(parseFloat($number * 0.0001));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0001).toFixed(2) + ' ' + $output);
                            break;
                        case "kg":
                            $('.result').text(parseFloat($number * (1/1000000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * (1/1000000)).toFixed(2) + ' ' + $output);
                            break;
                        case "t": 
                            $('.result').text(parseFloat($number * 1.10231131 * (1/1000000000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1.10231131 * (1/1000000000)).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'dag') {
                    switch ($output) {
                        case "dr":
                            $('.result').text(parseFloat($number * 5.64383391));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 5.64383391).toFixed(2) + ' ' + $output);
                            break;
                        case "oz":
                            $('.result').text(parseFloat($number * 0.352739619));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.352739619).toFixed(2) + ' ' + $output);
                            break;
                        case "lb": 
                            $('.result').text(parseFloat($number * 0.0220462262));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0220462262).toFixed(2) + ' ' + $output);
                            break;
                        case "mg": 
                            $('.result').text(parseFloat($number * 10000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 10000).toFixed(2) + ' ' + $output);
                            break;
                        case "g":
                            $('.result').text(parseFloat($number * 10));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 10).toFixed(2) + ' ' + $output);
                            break;
                        case "kg":
                            $('.result').text(parseFloat($number * 0.01));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.01).toFixed(2) + ' ' + $output);
                            break;
                        case "t": 
                            $('.result').text(parseFloat($number * 1.10231131 * (1/100000)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1.10231131 * (1/100000)).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'kg') {
                    switch ($output) {
                        case "dr":
                            $('.result').text(parseFloat($number * 564.383391));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 564.383391).toFixed(2) + ' ' + $output);
                            break;
                        case "oz":
                            $('.result').text(parseFloat($number * 35.2739619));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 35.2739619).toFixed(2) + ' ' + $output);
                            break;
                        case "lb": 
                            $('.result').text(parseFloat($number * 2.20462262));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 2.20462262).toFixed(2) + ' ' + $output);
                            break;
                        case "mg": 
                            $('.result').text(parseFloat($number * 1000000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1000000).toFixed(2) + ' ' + $output);
                            break;
                        case "g":
                            $('.result').text(parseFloat($number * 1000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1000).toFixed(2) + ' ' + $output);
                            break;
                        case "dag":
                            $('.result').text(parseFloat($number * 100));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 100).toFixed(2) + ' ' + $output);
                            break;
                        case "t": 
                            $('.result').text(parseFloat($number * 0.001));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.001).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 't') {
                    switch ($output) {
                        case "dr":
                            $('.result').text(parseFloat($number * 564383.391));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 564383.391).toFixed(2) + ' ' + $output);
                            break;
                        case "oz":
                            $('.result').text(parseFloat($number * 35273.9619));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 35273.9619).toFixed(2) + ' ' + $output);
                            break;
                        case "lb": 
                            $('.result').text(parseFloat($number * 2204.62262));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 2204.62262).toFixed(2) + ' ' + $output);
                            break;
                        case "mg": 
                            $('.result').text(parseFloat($number * 1000000000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1000000000).toFixed(2) + ' ' + $output);
                            break;
                        case "g":
                            $('.result').text(parseFloat($number * 1000000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1000000).toFixed(2) + ' ' + $output);
                            break;
                        case "dag":
                            $('.result').text(parseFloat($number * 100000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 100000).toFixed(2) + ' ' + $output);
                            break;
                        case "kg": 
                            $('.result').text(parseFloat($number * 1000));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1000).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'f') {
                    switch ($output) {
                        case "c":
                            $('.result').text(parseFloat(($number - 32) / (9/5)));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat(($number - 32) / (9/5)).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'c') {
                    switch ($output) {
                        case "f":
                            $('.result').text(parseFloat($number * (9/5) + 32));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * (9/5) + 32).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'mph') {
                    switch ($output) {
                        case "km/h":
                            $('.result').text(parseFloat($number * 1.609344));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 1.609344).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'km/h') {
                    switch ($output) {
                        case "mph":
                            $('.result').text(parseFloat($number * 0.621371192));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.621371192).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'mpg') {
                    switch ($output) {
                        case "l/100km":
                            $('.result').text(parseFloat(235.214583 / $number));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0833333333).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'l/100km') {
                    switch ($output) {
                        case "mpg":
                            $('.result').text(parseFloat(235.214583 / $number));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0833333333).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'wh/mi') {
                    switch ($output) {
                        case "kwh/100km":
                            $('.result').text(parseFloat($number * 0.0621371192));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 0.0621371192).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                } else if ($input === 'kwh/100km') {
                    switch ($output) {
                        case "wh/mi":
                            $('.result').text(parseFloat($number * 16.09344));
                            $('.result-info').text($number + ' ' + $input + ' = ' + parseFloat($number * 16.09344).toFixed(2) + ' ' + $output);
                            break;
                        default: 
                            $('.result').text($number);
                            $('.result-info').text($number + ' ' + $input + ' = ' + $number + ' ' + $output);
                            break;
                    }
                }
            }
        </script>
    @endpush

</x-public-layout>