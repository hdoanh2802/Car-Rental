    <div class="form-group">
        <label>Enter Old Password :</label>
        <input type="password" id="first-name" class="form-control" placeholder="Enter old password" name="oldpassword"
            value="">
        @if ($errors->has('oldpassword'))
            <span class="text-danger">{{ $errors->first('oldpassword') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label>Enter New Password :</label>
        <input type="password" id="first-name" placeholder="Enter new password" class="form-control"
            name="newpassword">
        @if ($errors->has('newpassword'))
            <span class="text-danger">{{ $errors->first('newpassword') }}</span>
        @endif
    </div>
    <div class="form-group">
        <label>Enter Confirm Password :</label>
        <input type="password" id="first-name" class="form-control" placeholder="Enter password confirmation"
            name="password_confirmation">
        @if ($errors->has('newpassword'))
            <span class="text-danger">{{ $errors->first('newpassword') }}</span>
        @endif
    </div>
