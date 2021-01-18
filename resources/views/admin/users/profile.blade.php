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
                <h1>
                    {{$user->name}} 
                    <small class="h6">
                        <i class="fas fa-arrow-circle-up"></i> 70 
                        <i class="fas fa-arrow-circle-down"></i> 19
                        @if ($user->id == Auth::user()->id)
                            <a href="{{route('user.profile.edit', $user->id)}}" class="btn btn-sm text-primary">
                                Edit Profile
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif
                    </small>
                </h1>
                
            </div>
        </div>

        <div class="container p-0">
            <p class="px-3">
                Roles:
                @foreach ($user->roles as $role_i)
                    <span class="badge badge-danger align-left">{{$role_i}}</span>
                @endforeach
            </p>
            <h3 class="m-3 text-center">{{$user->name}}'s Posts</h3>
            <div class="row">

                @foreach ($user->postHM as $post_i)
                    <div class="card col-lg-6" style="width: 18rem;">
                        <div class="frame frame-cover">
                            <img class="card-img-top" src="{{$post_i->post_image}}" alt="Card image cap">
                        </div>
                        <div class="card-body">
                        <h5 class="card-title">{{$post_i->title}}</h5>
                        {{-- <p class="card-text">{!!$post_i->content!!}</p> --}}
                        <a href="{{route('post.show', $post_i->id)}}" class="btn btn-primary">View Post</a>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
        
    @endsection
    
</x-admin-master>

