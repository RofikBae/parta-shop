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
                        <label for="name">Name</label>
                        <div class="control">
                            <input name="name" class="input is-small {{$errors->has('name') ? "is-danger" : ""}}" type="text" placeholder="Name" value="{{ $me->name }}" autofocus="" required>
                            @if ($errors->has('name'))
                                <span class="help is-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <div class="control">
                            <input name="email" class="input is-small {{$errors->has('email') ? "is-danger" : ""}}" type="email" placeholder="Email" value="{{ $me->email }}" autofocus="" required>
                            @if ($errors->has('email'))
                                <span class="help is-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="field">
                        <label for="province">Province</label>
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
                        <label for="city">City</label>
                        <div class="select is-fullwidth">
                            <select name="city" id="city" class="input is-small {{$errors->has('city') ? "is-danger" : ""}}" placeholder="City" required>
                                <option value="">Select City</option>
                            </select>
                            @if ($errors->has('city'))
                                <span class="help is-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="field">
                        <label for="address">Address</label>
                        <div class="control">
                            <textarea name="address" class="input is-small {{$errors->has('address') ? "is-danger" : ""}}" placeholder="Address" value="{{old('address')}}" autofocus="" required></textarea>
                            @if ($errors->has('address'))
                                <span class="help is-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="field">
                        <label for="phone">Phone</label>
                        <div class="control">
                            <input name="phone" class="input is-small {{$errors->has('phone') ? "is-danger" : ""}}" type="number" placeholder="Phone" value="{{ $me->phone }}" autofocus="" required>
                            @if ($errors->has('phone'))
                                <span class="help is-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="field">
                        <label for="courier">Courier</label>
                        <div class="select is-fullwidth">
                            <select name="courier" id="courier" class="input is-small {{$errors->has('courier') ? "is-danger" : ""}}" placeholder="courier" required>
                                <option value="">Select courier</option>
                            </select>
                            @if ($errors->has('courier'))
                                <span class="help is-danger">{{ $errors->first('courier') }}</span> 
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="button is-block is-info is-small"><i class="fa fa-sign-in" aria-hidden="true">Save</i></button>
                </form>
                                
            </div>

            <div class="column is-4">
                <h1 class="title is-6">Order Detail</h1>
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
                    $('#province').append(option)
                });
            },
            error: function(){return}
        })

        $('#province').change(function(){
            let provinceId = $('#province').val()
            
            $('#city').empty().html(new Option("Select City"))
            $('#courier').empty().html(new Option("Select Courier"))
        
            if (provinceId == null || provinceId == "") return
                        
            $.ajax({
                type:"GET",
                url:"{{route('rajaongkir.city','provinceId')}}",
                data: "provinceId="+provinceId,
                success: function (data) {
                    let cities = data
                    cities.forEach(function(city) {
                        let option = new Option(city.type+" "+city.city_name,city.city_id)
                        $('#city').append(option)
                    });
                },
                error: function(){return}
            })
        })

        $('#city').change(function(){

            let cityId = $('#city').val()

            $('#courier').empty().html(new Option("Select Courier"))

            if (cityId == null || cityId == "") return
            
            $.ajax({
                type: "POST",
                url : "{{route('rajaongkir.cost')}}",
                data: {
                    destination: cityId},
                    weight: weight,
                },
                success: function(data){
                    console.log(data);
                    let couriers = data
                    
                    couriers.forEach(function(courier) {
                        let option = new Option(courier.code+' - '+courier.service+' ('+courier.cost+')',courier.code+' - '+courier.service)
                        $('#courier').append(option)
                    });
                },
                error: function() {return}
            })
        })
    </script>
@endpush
@endsection