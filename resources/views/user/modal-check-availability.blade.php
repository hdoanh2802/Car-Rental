<div class="row">
    <div class="col">
        <label>Pick Up Office</label>
        <select class="form-control select2_init" name="pick_up_office_id" id="pick_up_office_id">
            <option value="">--Select Office--</option>
            @foreach ($offices as $office)
                <option value="{{ $office->id }}">{{ $office->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col">
        <label>Return Office</label>
        <select class="form-control select2_init" name="return_office_id" id="return_office_id">
            <option value="">--Select Office--</option>
            @foreach ($offices as $office)
                <option value="{{ $office->id }}">{{ $office->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<br>
<div class="row">
    <div class="col">
        <label for="">Pick Up Date: </label>
        <input type="datetime-local" class="form-control" name="pick_up_date" id="pick_up_date">
    </div>
    <div class="col">
        <label for="">Return Date: </label>
        <input type="datetime-local" class="form-control" name="return_date" id="return_date">
    </div>
</div>
<div class="mb-3 row" hidden>
    <label for="staticEmail" class="col-sm-2 col-form-label">Name:</label>
    <div class="col-sm-10">
        <input type="text" readonly class="form-control-plaintext" id="name" name="name">
    </div>
</div>
<input type="text" class="form-control" name="car_id" id="car_id" hidden>
