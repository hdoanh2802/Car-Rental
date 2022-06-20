  <div class="modal-body">
        @if (Auth::check())
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">User Name:</label>
                {{ Auth::user()->username }}
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Email:</label>
                {{ Auth::user()->email }}
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Full Name:</label>
                {{ Auth::user()->userInfo->fullname }}
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Address:</label>
                {{ Auth::user()->userInfo->address }}
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Phone:</label>
                {{ Auth::user()->userInfo->phone }}
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Age:</label>
                {{ Auth::user()->userInfo->age }}
            </div>
        @endif
    </div>

