@extends('layouts.master')
@section ('title','Payment')
@section ('content')
    <div class="container">
        <div class="bg-content">
            <h2>Ödeme</h2>
            <form action="{{ route('pay') }}" method="post">
            <div class="row">
                <div class="col-md-5">
                    <h3>Payment Detail</h3>
                    <div class="form-group">
                        <label id="card_no" for="kartno">Credit Card Number</label>
                        <input type="text" class="form-control kredikarti" id="card_no" name="card_no" style="font-size:20px;" required>
                    </div>
                    <div class="form-group">
                        <label id="expired_date_month" for="cardexpiredatemonth">Expired Date</label>
                        <div class="row">
                            <div class="col-md-6">
                                Month
                                <select name="expired_date_month" id="expired_date_month" class="form-control" required>
                                    <option>1</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                Year
                                <select name="expired_date_year" id="expired_date_year" class="form-control" required>
                                    <option>2017</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardcvv2">CVV (Security Number)</label>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control kredikarti_cvv" name="cardcvv2" id="cardcvv2" required>
                            </div>
                        </div>
                    </div>
                    <form>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox">I have read and accept the preliminary information form.</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox">I have read and accept the distance selling agreement.</label>
                            </div>
                        </div>
                    </form>
                    <button type="submit" class="btn btn-success btn-lg">Pay</button>
                </div>
                <div class="col-md-7">
                    <h4>Amount to be paid</h4>
                    <span class="price">{{ Cart::total() }} <small>TL</small></span>
                    <h4>Contact And Billing İnformation</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                value="{{ auth()->user()->username }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" required
                                       value="{{ $user_detail->address }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" name="phone" id="phone" required value="{{ $user_detail->phone }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <</form>
        </div>
    </div>
@endsection

@section("footer")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('.kredikarti').mask('0000-0000-0000-0000', { placeholder: "____-____-____-____" });
        $('.kredikarti_cvv').mask('000', { placeholder: "___" });
        $('.telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
    </script>
@endsection
