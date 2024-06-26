@extends('frontend.app.app')


@section('content')
<main class="main">
    <div class="container mb-80 mt-50">
        @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
        @endif
        <form role="form" action="{{ route('confirm.order') }}" method="POST" id="payment-form"
            class="require-validation">
            @csrf
            <div class="row">

                <div class="col-lg-12">
                    <div class="coupon-group">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <h4 class="mb-30">Billing Details</h4>
                        <div class="billing-detail-blk">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" required="" value="{{ auth()->user()->name }}" name="fname"
                                        placeholder="Full Name">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Email address <span class="text-danger">*</span></label>
                                    <input type="email" value="{{ auth()->user()->email }}" name="email" required=""
                                        placeholder="Email ">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Country / Region <span class="text-danger">*</span></label>
                                    <select class="form-select" name="country">

                                        <option selected value="Bangladesh">Bangladesh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>Street address <span class="text-danger">*</span></label>
                                    <input type="text" name="billing_address" required=""
                                        value="{{ auth()->user()?->address }}" placeholder="Address">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>Town / City <span class="text-danger">*</span></label>
                                    <input required="" type="text" name="city" placeholder="Town / City">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Zip <span class="text-danger">*</span></label>
                                    <input required="" type="text" name="zipcode" placeholder="ZIP ">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input required="" type="text" name="phone" placeholder="Phone "
                                        value="{{ auth()->user()?->phone1 }}">
                                </div>
                            </div>
                            <div class="ship_detail">
                                <div class="form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox"
                                                id="differentaddress">
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseAddress" class="different_address collapse in">
                                </div>
                            </div>
                            <div class="form-group mb-30">
                                <label>Order notes (optional)</label>
                                <textarea rows="3" name="note"
                                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="cart-totals mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-20">
                            <h4>Your Order</h4>
                        </div>
                        <div class="table-responsive order_table checkout">
                            <table class="table no-border mb-0">
                                <thead>
                                    <tr>
                                        <th>Product name </th>
                                        <th>SubTotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                    <tr>
                                        <td class="check-cart-img">
                                            <a
                                                href="{{ route('product.details.create', $item->product->slug_unique) }}"><img
                                                    src="{{ $item->product->image_url }}" alt="#" width="80"></a>
                                            <h6><a href="{{ route('product.details.create', $item->product->slug_unique) }}"
                                                    class="text-heading">{{ $item->product->title
                                                    }}
                                                    <span>(x
                                                        {{ $item->product_qty }})</span></a></h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand">${{ $item->price }}</h4>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @php
                        $total = App\Models\Cart::where('user_id', Auth::user()->id)->sum('price');
                        @endphp
                        <div class="total-checkout">
                            <input type="hidden" name="total_ammount" value="{{ $price->discount_price }}">
                            <input type="hidden" name="total_qty" value="{{ $cartItems->sum('product_qty') }}">
                            <h3>Total <span>${{ $price->discount_price }}</span></h3>
                        </div>
                    </div>
                    <div class="shipping">
                        <h4 class="mb-20">Shipping</h4>
                        <div class="shipping_option payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="shipping" checked="" value="home"
                                    id="home">
                                <label class="form-check-label" for="home">Home Delivery</label>
                            </div>
                        
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="shipping" value="pickup"
                                    id="pickup">
                                <label class="form-check-label" for="pickup">Pick Up Point</label>
                            </div>
                            <div class="pickupData ps-4" style="display:none">
                                
                                <div class="bg-white py-3 px-2">
                                    @foreach ($points as $point)
                                    <div class="custome-radio ">
                                        <input class="form-check-input" type="radio" name="pick_point" value="{{ $point->point_name }}" id="pickPoints{{ $point->id }}">
                                        <label class="form-check-label" for="pickPoints{{ $point->id }}">{{ $point->point_name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        

                        </div>
                    </div>
                    <div class="payment">
                        <h4 class="mb-20">Payment method</h4>
                        <div class="payment_option">


                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="payment_option" checked=""
                                    value="cod" id="cod">
                                <label class="form-check-label" for="cod">Cash On Delivery</label>

                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="payment_option" value="bkash"
                                    id="bkash">
                                <label class="form-check-label" for="bkash">Bkash</label>
                            </div>
                            <div class="bkashData mb-3 card p-3 pb-0 " style="display: none">
                                <div class="form-group"><input name="payment_phone[bkash]" type="text"
                                        placeholder="Your Phone Number"></div>
                                <div class="form-group"><input name="transaction_id[bkash]" type="text"
                                        placeholder="Your Transaction ID"></div>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="payment_option" value="nagad"
                                    id="nagad">
                                <label class="form-check-label" for="nagad">Nagad</label>

                            </div>
                            <div class="nagadData mb-3 card p-3 pb-0 " style="display: none">
                                <div class="form-group"><input name="payment_phone[nagad]" type="text"
                                        placeholder="Your Phone Number"></div>
                                <div class="form-group"><input name="transaction_id[nagad]" type="text"
                                        placeholder="Your Transition ID"></div>
                            </div>
                        </div>

                        <div class="terms-conditions-pay">
                            <p>Your personal data will be used to process your order, support your experience throughout
                                this website, and for other purposes described in our <a href="javascript:;">privacy
                                    policy.</a></p>
                        </div>
                        <div class="check-pay">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember" required> I have
                                    read and
                                    agree to the website ? <br><a href="javascript:;">terms and conditions <span
                                            class="text-danger">*</span></a>
                                </label>
                            </div>
                        </div>
                        <div class="place-orders">
                            <button class="btn btn-fill-out btn-block mt-30">Place Order</button>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>
</main>

@push('script')
<script>
    $('input[name="payment_option"]').change(function(){
        const value = $(this).val()
        if(value == 'bkash'){
            $(`.bkashData`).fadeIn()
            $(`.nagadData`).fadeOut()
        } else if(value == 'nagad'){
            $(`.bkashData`).fadeOut()
            $(`.nagadData`).fadeIn()
        } else{
            $(`.bkashData`).fadeOut()
            $(`.nagadData`).fadeOut()

        }
    })


    $('input[name="shipping"]').change(function(){
        const value = $(this).val()
        if(value  ===  'pickup'){
            $('.pickupData').fadeIn()
        } else{
            $('.pickupData').hide()
        }
    })

</script>
@endpush
@endsection