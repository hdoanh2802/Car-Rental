<div class="form-group">
    <label>Name</label>
    <input value="{{ Auth::user()->username }}" type="text" class="form-control" name="username"
        placeholder="username">
    @if ($errors->has('username'))
        <span class="text-danger">{{ $errors->first('username') }}</span>
    @endif
</div>
<div class="form-group">
    <label>Email</label>
    <input value="{{ Auth::user()->email }}" type="email" class="form-control" name="email" placeholder="email">
    @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
    @endif
</div>
<div class="form-group">
    <label>Full Name</label>
    <input value="{{ Auth::user()->userInfo->fullname }}" type="text" class="form-control" name="fullname"
        placeholder="fullname">
    @if ($errors->has('fullname'))
        <span class="text-danger">{{ $errors->first('fullname') }}</span>
    @endif
</div>
<div class="form-group">
    <label>Address</label>
    <input value="{{ Auth::user()->userInfo->address }}" type="text" class="form-control" name="address"
        placeholder="address">
    @if ($errors->has('address'))
        <span class="text-danger">{{ $errors->first('address') }}</span>
    @endif
</div>
<div class="form-group">
    <label>Phone</label>
    <input value="{{ Auth::user()->userInfo->phone }}" type="text" class="form-control" name="phone"
        placeholder="phone">
    @if ($errors->has('phone'))
        <span class="text-danger">{{ $errors->first('phone') }}</span>
    @endif
</div>
<div class="form-group">
    <label>Age</label>
    <input value="{{ Auth::user()->userInfo->age }}" type="text" class="form-control" name="age" placeholder="age">
    @if ($errors->has('age'))
        <span class="text-danger">{{ $errors->first('age') }}</span>
    @endif
</div>
