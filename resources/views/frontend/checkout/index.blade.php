@extends('layouts.app')

@section('content')
<div class="container">
        @if (!$products)
            <div class="column is-6 is-offset-3">
                <div class="card">
                    <div class="card-content">
                        <div class="is-size-6 is-info">
                            No item
                        </div>
                    </div>
                </div>          
            </div>
        @else
        <h1 class="title is-2">Checkout</h1>
        <div class="columns">
            <div class="column is-8">

                <h1 class="title is-6">Shipping Address</h1>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="field">
                        <div class="control">
                            <input name="name" class="input is-small {{$errors->has('name') ? "is-danger" : ""}}" type="text" placeholder="Name" value="{{old('name')}}" autofocus="" required>
                            @if ($errors->has('name'))
                                <span class="help is-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <input name="email" class="input is-small {{$errors->has('email') ? "is-danger" : ""}}" type="email" placeholder="Email" value="{{old('email')}}" autofocus="" required>
                            @if ($errors->has('email'))
                                <span class="help is-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="field">
                        <div class="select is-fullwidth">
                            <select name="province" id="province" class="input is-small {{$errors->has('province') ? "is-danger" : ""}}" placeholder="Province" required>
                                <option value="">Select Province</option>
                            </select>
                            @if ($errors->has('province'))
                                <span class="help is-danger">{{ $errors->first('province') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="field">
                        <div class="select is-fullwidth">
                            <select name="city" id="city" class="input is-small {{$errors->has('city') ? "is-danger" : ""}}" placeholder="City" required>
                                <option value="1">Select City</option>
                            </select>
                            @if ($errors->has('city'))
                                <span class="help is-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <textarea name="address" class="input is-small {{$errors->has('address') ? "is-danger" : ""}}" placeholder="Address" value="{{old('address')}}" autofocus="" required></textarea>
                            @if ($errors->has('address'))
                                <span class="help is-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <input name="phone" class="input is-small {{$errors->has('phone') ? "is-danger" : ""}}" type="number" placeholder="Phone" value="{{old('phone')}}" autofocus="" required>
                            @if ($errors->has('phone'))
                                <span class="help is-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="button is-block is-info is-small"><i class="fa fa-sign-in" aria-hidden="true">Save</i></button>
                </form>
                
                <h1 class="title is-6">Shoping Cart</h1>
                @php
                $totalItem = 0;
                $totalPrice = 0;
                @endphp
                @foreach ($products as $product)
                    @php
                    $totalItem += $product['qty'];
                    $totalPrice += $product['price'];
                    @endphp
                    <div class="card">
                        <div class="card-header">
                            <p class="card-header-title"> {{ $product['name'] }} </p>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <div class="columns">
                                    <div class="column is-3">
                                        <img src="{{ $product['image'] }}" alt="" class="image">
                                    </div>
                                    <div class="column is-9">
                                        <p> {{ $product['description'] }} </p>
                                        <p> {{ rupiah_format($product['price']) }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="column is-4">
                <h1 class="title is-6">Total</h1>
                <div class="card">
                    <div class="card-content">
                        <div class="content">
                            <p> Total Item  : {{$totalItem}} </p>
                            <p> Total Price : {{rupiah_format($totalPrice)}} </p>
                        </div>
                        <div class="card-action">
                            <a href="" class="button is-danger is-fullwidth">Go To Payment</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@push('script')
    <script>
        $.ajax({
            type:"GET",
            url:"{{route('rajaongkir.province')}}",
            success: function (data) {
                let provinces = data
                provinces.forEach(function(province) {
                    let option = new Option(province.province,province.province_id)
                    $(option).html(province.province)
                    $('#province').append(option)
                });
            }
        })

        $('#province').change(function(){
            let provinceId = $('#province').val()
            
            if (provinceId == null || provinceId == "") {
                $('#city').empty()
                let option = new Option("Select City")
                $(option).html("Select City")
                $('#city').append(option)
                return
            }
            
            $('#city').empty()

            $.ajax({
                type:"GET",
                url:"{{route('rajaongkir.city','provinceId')}}",
                data: "province_id="+provinceId,
                success: function (data) {
                    let cities = data
                    console.log(cities)
                    cities.forEach(function(city) {
                        let option = new Option(city.city_name,city.city_id)
                        $(option).html(city.type+" "+city.city_name)
                        $('#city').append(option)
                    });
                },
                error: function () {
                    $('#city').empty()
                    let option = new Option("Select City")
                    $(option).html("Select City")
                    $('#city').append(option)
                    return
                } 
            })
        })
    </script>
@endpush
@endsection