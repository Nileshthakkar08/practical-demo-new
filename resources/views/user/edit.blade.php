<!DOCTYPE html>
<html lang="en-us">

<head>
    <style>
        * {
            box-sizing: border-box;
        }

        .parsley-required {
            color: red
        }

        .parsley-mincheck {
            color: red
        }

        input[type=text],
        input[type=email],
        input[type=number],
        input[type=select],
        input[type=date],
        input[type=select],
        input[type=password],
        input[type=tel] {
            width: 45%;
            padding: 12px;
            border: 1px solid rgb(168, 166, 166);
            border-radius: 4px;
            resize: vertical;
        }

        textarea {
            width: 45%;
            padding: 12px;
            border: 1px solid rgb(168, 166, 166);
            border-radius: 4px;
            resize: vertical;
        }

        input[type=radio],
        input[type=checkbox] {
            width: 1%;
            padding-left: 0%;
            border: 1px solid rgb(168, 166, 166);
            border-radius: 4px;
            resize: vertical;
        }

        h1 {
            font-family: Arial;
            font-size: medium;
            font-style: normal;
            font-weight: bold;
            color: brown;
            text-align: center;
            text-decoration: underline;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        button[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: left;
        }

        input[type=submit]:hover {
            background-color: #32a336;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .col-10 {
            float: left;
            width: 10%;
            margin-top: 6px;
        }

        .col-90 {
            float: left;
            width: 90%;
            margin-top: 6px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        @media screen and (max-width: 600px) {

            .col-10,
            .col-90,
            input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
    </style>

    <meta charset="UTF-8">
    <title>Responsive Registaration Form</title>
    <link rel="stylesheet" href="./responsiveRegistration.css">
    <script type="text/javascript" lang="javascript" src="./responsiveRegistaration.js"></script>
</head>

<body>
    <h1>Edit Form</h1>
    <div class="container">
        <form action="{{ route('user.update', $user->id) }}" method="post" id="form-submit" enctype="multipart/form-data"
            data-parsley-validate>
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-10">
                    <label for="lname">Name:</label>
                </div>
                <div class="col-90">
                    <input type="text" id="name" name="name" value="{{ $user->name }}"
                        placeholder="Enter your name" data-parsley-required
                        data-parsley-required-message="Please Enter Name">
                </div>
                <span class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>

            </div>
            <div class="row">
                <div class="col-10">
                    <label for="email">Email:</label>
                </div>
                <div class="col-90">
                    <input type="email" id="email" name="email" value="{{ $user->email }}"
                        placeholder="it should contain @,." data-parsley-required
                        data-parsley-required-message="Please Enter Email" data-parsley-type="email"
                        data-parsley-type-message="Please Enter Valid Email">
                </div>
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>

            </div>
            <div class="row">
                <div class="col-10">
                    <label for="mobile">Contact Number:</label>
                </div>
                <div class="col-90">
                    <input type="text" id="contact_number" name="contact_number" value="{{ $user->contact_number }}"
                        placeholder="only 10 digits are allowed" data-parsley-required
                        data-parsley-required-message="Please Enter Contact Number" data-parsley-maxlength="10">
                </div>
                <span class="text-danger">
                    @error('contact_number')
                        {{ $message }}
                    @enderror
                </span>

            </div>
            <div class="row">
                <div class="col-10">
                    <label for="gender" required>Gender:</label>
                </div>
                <div class="col-90">
                    <input type="radio" id="male" name="gender" value="male"
                        {{ $user->gender == 'male' ? 'checked' : '' }} required="" />Male
                    <input type="radio" id="female" name="gender" value="female"
                        {{ $user->gender == 'female' ? 'checked' : '' }} />Female
                </div>
                <span class="text-danger">
                    @error('gender')
                        {{ $message }}
                    @enderror
                </span>

            </div>

            <div class="row">
                <div class="col-10">
                    <label for="specialization">hobbies:</label>
                </div>
                <div class="col-90">

                    @php $mainArr = []; @endphp
                    @foreach ($user->hobbies as $hobbies)
                        @php $mainArr[] = $hobbies->name;  @endphp
                    @endforeach


                    <input type="checkbox" class="specialization" id="cs" name="hobbies[]" value="Cricket"
                        data-parsley-mincheck="2" @if (in_array('Cricket', $mainArr)) checked @endif>Cricket<br />
                    <input type="checkbox" class="specialization" id="it" name="hobbies[]" value="Singing"
                        @if (in_array('Singing', $mainArr)) checked @endif>Singing<br />
                    <input type="checkbox" class="specialization" id="ca" name="hobbies[]" value="Acting"
                        @if (in_array('Acting', $mainArr)) checked @endif>Acting<br />
                    <input type="checkbox" class="specialization" id="tc" name="hobbies[]" value="Dance"
                        @if (in_array('Dance', $mainArr)) checked @endif>Dance<br />
                </div>
                <span class="text-danger">
                    @error('hobbies')
                        {{ $message }}
                    @enderror
                </span>

            </div>

            <div class="row">
                <div class="col-10">
                    <label for="qualification" required>States:</label>
                </div>
                <div class="col-90">
                    <select name="state_id" id="states" data-parsley-required
                        data-parsley-required-message="Please Select State">
                        <option value="">Select</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" {{ $user->state_id == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="text-danger">
                    @error('state_id')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="row">
                <div class="col-10">
                    <label for="qualification" required>City:</label>
                </div>
                <div class="col-90">
                    <select name="city_id" id="cities" data-parsley-required
                        data-parsley-required-message="Please Select City">
                    </select>
                </div>
                <span class="text-danger">
                    @error('city_id')
                        {{ $message }}
                    @enderror
                </span>

            </div>

            <div class="row">
                <div class="col-10">
                    <label for="password">Profile Pic:</label>
                </div>
                <div class="col-90">
                    <input type="file" id="profile_photo" class="form-control" name="profile_photo">
                    <img src="{{ $user->profile_photo }}" id="profile-photo-img" alt="" height="100"
                        width="100">
                </div>
                <span class="text-danger">
                    @error('profile_photo')
                        {{ $message }}
                    @enderror
                </span>

            </div>
            <div class="row">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
<script src="{{ asset('assets/js/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/js/parsley.js') }}"></script>
<script>
    $(document).ready(function() {

        var cityId = "{{ $user->city_id }}";
        var stateID = "{{ $user->state_id }}";



        $("#cities").html('');
        $.ajax({
            url: "{{ route('get-cities') }}",
            type: "POST",
            data: {
                state_id: stateID,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(res) {
                $('#cities').html('<option value="">-- Select City --</option>');
                $.each(res.cities, function(key, value) {
                    var selectedValue = cityId == value.id ? 'selected' : '';
                    $("#cities").append('<option value="' + value
                        .id + '" ' + selectedValue + '>' + value.name + '</option>');
                });
            }
        });


        $('#states').on('change', function() {
            var stateID = $(this).val();

            $("#cities").html('');
            $.ajax({
                url: "{{ route('get-cities') }}",
                type: "POST",
                data: {
                    state_id: stateID,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#cities').html('<option value="">-- Select City --</option>');
                    $.each(res.cities, function(key, value) {
                        $("#cities").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });

    $('#form-submit').submit(function() {

        var form = $(this);
        var formValidate = $(this).parsley().validate();
        if (form.parsley().isValid()) {
            return true;
        }
    });


    $('#profile_photo').change(function() {

        let reader = new FileReader();

        reader.onload = (e) => {

            $('#profile-photo-img').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);

    });
</script>

</html>
