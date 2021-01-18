<x-admin-master>
    
    @section('content')

        <style>
            .profile-area{
                position: relative;
            }
            /* +-----------------------------------------+ */
            /* |                Image Crop               | */
            /* +-----------------------------------------+ */
            /* Cover Pic */
            .frame-cover {
                width: 100%;
                padding-top: 30%;
                overflow: hidden;
                position: relative;
            }
            .frame-cover img {
                width: 100%;
                height: auto;
                margin: auto;
                position: absolute;
                top: -100%;
                right: -100%;
                bottom: -100%;
                left: -100%;
            }
            /* Profile Pic */
            .frame-profile-pic{
                width: 50%;
                padding-top: 10%;
                /* overflow: hidden; */
                position: relative;
                top: 0%;
                left: 50%;
            }
            .frame-profile-pic img {
                width: 50%;
                height: auto;
                margin: auto;
                position: absolute;
                top: -290%;
                right: -130%;
                bottom: -100%;
                left: -100%;
                z-index: 9;
                border: .7rem solid white;
                box-shadow: 0px 1px 6px #000000
            }
            .frame-profile-pic h1 {
                position: absolute;
                top: 0%;
                top: 26%;
                right: 0%;
                bottom: 0%;
                left: -96%;
            }
        </style>
        
        <div class="card profile-area">
            <div class="frame frame-cover">
                <img class="" src="{{$user->cover_photo}}" alt="Card image cap">
            </div>
            <div class="frame frame-profile-pic">
                <img class="" src="{{$user->profile_pic}}" alt="Card image cap">
                <h1>{{$user->name}} </h1>
            </div>
        </div>

        <h3 class="m-3 text-center">Edit Profile</h3>

        <form action="{{route('user.profile.update', $user->id)}}" method="POST" class="mt-3" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="form-group">
                <label for="name">Name</label>
                <input value="{{$user->name}}" name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input value="{{$user->email}}" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">New Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter New Password">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Profile Picture</label>
                <div class="custom-file">
                    <input value="{{$user->profile_pic}}" name="profile_pic" type="file" class="custom-file-input" id="profile-pic">
                    <label class="custom-file-label" for="profile-pic">Choose file</label>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Cover Photo</label>
                <div class="custom-file">
                    <input value="{{$user->cover_photo}}" name="cover_photo" type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            
            <a type="submit" class="btn btn-light btn-lg float-right my-3">Cancel</a>
            <button class="btn btn-primary btn-lg float-right mr-2 mt-3 mb-3">Update</button>
        </form>
    @endsection
    
</x-admin-master>

