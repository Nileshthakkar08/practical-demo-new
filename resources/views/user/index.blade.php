<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700');

    $base-spacing-unit: 24px;
    $half-spacing-unit: $base-spacing-unit / 2;

    $color-alpha: #1772FF;
    $color-form-highlight: #EEEEEE;

    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }

    body {
        padding: $base-spacing-unit;
        font-family: 'Source Sans Pro', sans-serif;
        margin: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
    }



    .container {
        max-width: 1000px;
        margin-right: auto;
        margin-left: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .table {
        width: 100%;
        border: 1px solid $color-form-highlight;
    }

    .table-header {
        display: flex;
        width: 100%;
        background: #000;
        padding: ($half-spacing-unit * 1.5) 0;
    }

    .table-row {
        display: flex;
        width: 100%;
        padding: ($half-spacing-unit * 1.5) 0;

        &:nth-of-type(odd) {
            background: $color-form-highlight;
        }
    }

    .table-data,
    .header__item {
        flex: 1 1 20%;
        text-align: center;
    }

    .header__item {
        text-transform: uppercase;
    }

    .filter__link {
        color: white;
        text-decoration: none;
        position: relative;
        display: inline-block;
        padding-left: $base-spacing-unit;
        padding-right: $base-spacing-unit;

        &::after {
            content: '';
            position: absolute;
            right: -($half-spacing-unit * 1.5);
            color: white;
            font-size: $half-spacing-unit;
            top: 50%;
            transform: translateY(-50%);
        }

        &.desc::after {
            content: '(desc)';
        }

        &.asc::after {
            content: '(asc)';
        }

    }
</style>

<body>

    <div class="container">

        <div class="table">
            <div>
                <a href="{{ route('user.create') }}"> <button>Add New</button></a>
            </div>
            <br>
            <table border="2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Profile Photo</th>
                        <th>Hobbies</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->contact_number }}</td>
                                <td><img src="{{ $user->profile_photo }}" alt="" height="100" width="100">
                                </td>
                                @php
                                    $mainArr = [];
                                @endphp

                                @if ($user->hobbies != null)
                                    <td>
                                        @foreach ($user->hobbies as $hobbies)
                                            @php
                                                $mainArr[] = $hobbies->name;
                                            @endphp
                                        @endforeach
                                        {{ implode(',', $mainArr) }}
                                    </td>
                                @endif
                                <td>{{ $user->gender }}</td>
                                <td><button><a href="{{ route('user.edit', $user->id) }}">Edit</a>
                                    </button>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button>Delete</button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach

                    @endif

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

{{-- <!DOCTYPE html>
<html lang="en-us">
    <head>
        <style>
            *{box-sizing: border-box;
}
input[type=text], input[type=email], input[type=number], input[type=select], input[type=date],input[type=select],input[type=password], input[type=tel]
{
    width: 45%;
    padding: 12px;
    border: 1px solid rgb(168, 166, 166);
    border-radius: 4px;
    resize: vertical;
}
textarea{
    width:45%;
    padding: 12px;
    border: 1px solid rgb(168, 166, 166);
    border-radius: 4px;
    resize: vertical;
}
input[type=radio],input[type=checkbox]{
    width: 1%;
    padding-left: 0%;
    border: 1px solid rgb(168, 166, 166);
    border-radius: 4px;
    resize: vertical;
}
h1{
    font-family: Arial;
    font-size: medium;
    font-style: normal;
    font-weight: bold;
    color: brown;
    text-align: center;
    text-decoration: underline;
}
label{
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
    float:left;
}
input[type=submit]:hover {
background-color: #32a336;
}
.container{
    border-radius: 5px;
    background-color:#f2f2f2;
    padding: 20px;
}
.col-10{
    float: left;
    width:10%;
    margin-top: 6px;
}
.col-90{
    float: left;
    width: 90%;
    margin-top: 6px;
}
.row:after{
    content: "";
    display: table;
    clear: both;
}
@media screen and (max-width: 600px) {
    .col-10,.col-90,input[type=submit]{
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
        <h1>Student Registaration Form</h1>
                <div class="container">
                    <form action="{{route('user.store')}}"  method="post" id="form-submit" data-parsley-validate>
                        @csrf

            <div class="row">
                <div class="col-10">
                    <label for="lname">Name:</label>
                </div>
                <div class="col-90">
                    <input type="text" id="name" name="name" placeholder="Enter your name"  data-parsley-required data-parsley-required-message="Please Enter Name" >
                </div>

            </div>
            <div class="row">
                <div class="col-10">
                    <label for="email">Email:</label>
                </div>
                <div class="col-90">
                    <input type="email" id="email" name="email" placeholder="it should contain @,." data-parsley-required data-parsley-required-message="Please Enter Email" data-parsley-type="email" data-parsley-type-message="Please Enter Valid Email">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <label for="mobile">Contact Number:</label>
                </div>
                <div class="col-90">
                    <input type="text" id="contact_number" name="contact_number" placeholder="only 10 digits are allowed" data-parsley-required data-parsley-required-message="Please Enter Contact Number" data-parsley-maxlength="10">
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <label for="gender" required>Gender:</label>
                </div>
                <div class="col-90">
                    <input type="radio" id="male" name="gender" value="male" required=""/>Male
                    <input type="radio" id="female" name="gender" value="female"/>Female
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <label for="specialization">hobbies:</label>
                </div>
                <div class="col-90">
                    <input type="checkbox" class="specialization" id="cs" name="hobbies[]" value="Computer Science" data-parsley-mincheck="2">Cricket<br/>
                    <input type="checkbox" class="specialization" id="it" name="hobbies[]" value="Information Technology">Singing<br/>
                    <input type="checkbox" class="specialization" id="ca" name="hobbies[]" value="Computer Architecture">Acting<br/>
                    <input type="checkbox" class="specialization" id="tc" name="hobbies[]" value="Tele Communication">Dance<br/>
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <label for="qualification" required >States:</label>
                </div>
                <div class="col-90">
                    <select name="state_id" id="states" data-parsley-required data-parsley-required-message="Please Select State">
                        <option value="">Select</option>
                        @foreach ($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <label for="qualification" required >City:</label>
                </div>
                <div class="col-90">
                    <select name="city_id" id="cities" data-parsley-required data-parsley-required-message="Please Select City">
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-10">
                    <label for="password">Profile Pic:</label>
                </div>
                <div class="col-90">
                    <input type="file" id="profile_pic" class="form-control" name="profile_pic" maxlength="8" data-parsley-required data-parsley-required-message="Please Select Profile Pic">
                </div>
            </div>
            <div class="row">
                <button type="submit" >Submit</button>
            </div>
        </form>
        </div>
    </body>
    <script src="{{asset('assets/js/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/js/parsley.js')}}"></script>
    <script>


$(document).ready(function () {

$('#states').on('change', function () {
    var stateID = $(this).val();
    alert(stateID,"sf");
    $("#cities").html('');
    $.ajax({
        url: "{{route('get-cities')}}",
        type: "POST",
        data: {
            state_id: stateID,
            _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (res) {
            $('#cities').html('<option value="">-- Select City --</option>');
            $.each(res.cities, function (key, value) {
                $("#cities").append('<option value="' + value
                    .id + '">' + value.name + '</option>');
            });
        }
    });
});
});

  $('#form-submit').submit(function(){
    alert("Sfd");
    var form  = $(this);
    var formValidate = $(this).parsley().validate();
    if(form.parsley().isValid()){
        return true;
    }
    });
    </script>
</html> --}}
