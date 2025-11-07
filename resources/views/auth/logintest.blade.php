@extends('layouts.filldart-login-app-header')
@section('content')


<style>
:root {
    --input-padding-x: .75rem;
    --input-padding-y: .5rem;
}


input[type=checkbox] {
    min-height: auto;
    width: 18px;
    height: 18px;
     margin-left: -17px; 
    margin-top: .05rem;
}


.custom-control.custom-radiobox.mb-3 {
    display: flex;
    align-content: center;
    align-items: baseline;
    flex-wrap: nowrap;
    justify-content: center;
    column-gap: 12px;
}



@supports (-ms-ime-align: auto) 
{
    .form-label-group>label 
    {
        display: none;
    }

    .form-label-group input::-ms-input-placeholder 
    {
        color: #777;
    }
}



/* Fallback for IE
-------------------------------------------------- */

@media all and (-ms-high-contrast: none),
(-ms-high-contrast: active) {
    .form-label-group>label {
        display: none;
    }

    .form-label-group input:-ms-input-placeholder {
        color: #777;
    }
}
</style>


 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<section class="login-sec">
   <div class="cred-bx text-center">
      <img src="{{ asset('resources/images/gofor-fit-logo.png') }}" height="40" class="d-inline-block align-top mb-2" alt="">
      <div class="card card-signin text-left" style="margin-top:15px;"> 
         <div class="card-body">
		 
@php

  $user_type                = Cookie::get('user_type');
  $student_id_cookie        = Cookie::get('student_id_cookie')?Cookie::get('student_id_cookie'):old('student_id');
  $student_password_cookie  = Cookie::get('student_password_cookie');  
  
$decodedPwd = base64_decode(base64_decode($student_password_cookie));
$plainPassword = substr($decodedPwd, 1, -1);
  
  
  $student_remember_token   = Cookie::get('student_remember_token')?Cookie::get('student_remember_token'):old('remember');  
  


@endphp
		 
		 
		 

                     <h5 class="card-title text-center mb-4">{{ __('Login as') }}  <span id="postion_type_role_id" style="font-weight: 600;color:#ff8000;font-size: inherit;">Trainer</span></h5>
					<div class="d-flex ">
						<div>
							<div class="custom-control custom-radiobox mb-3">
								<input type="radio" name="login_by" id="trainer" value="Trainer" class="login_by">
								<label for="trainer">Trainer</label><br>

								<input type="radio" name="login_by" id="school" value="School" class="login_by">
								<label for="school">School</label><br>

								<input type="radio" name="login_by" id="parent" value="Parent" class="login_by">
								<label for="parent">Parent</label><br>
							</div>
						</div>
					</div>
			
			
			
			
			
			
            <form class="form-signin" method="POST" action="{{ route('auth.login.test') }}">
               @csrf
               @if (session('status'))
               <div class="alert alert-danger">
                  {{ session('msg') }} 
               </div>
               @endif      


			   

               <input type="hidden" id="login_by" name="login_by" value="Trainer" >

                <div class="student_login" style="display: none;">

                    <div class="form-label-group">
                        <label for="inputStudentId">Student Id</label>
                        <input id="student" type="text" name="student_id" class="form-control @error('student_id') is-invalid @enderror" value="{{  $student_id_cookie }}" required>
                        @error('student_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-label-group">
                      <label for="inputDoB">Password</label>
                      <input id="birth_date" type="password" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{  $plainPassword }}"  placeholder="" required>
                      @error('dob')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                   </div>
                </div>


                <div class="trainer_login">
                    <div class="form-label-group">
                      <label for="inputEmail">Email address</label>
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"   required >
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="form-label-group">
                      <label for="inputPassword">Password</label>
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"   required>
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>


                <div class="custom-control custom-checkbox mb-3">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember"
                  {{ $student_remember_token ? 'checked' : '' }}>
				  &nbsp;
                  <label class="" for="customCheck1">{{ __('Remember me') }}</label>
                </div>


               <div class="captcha-row">
                  <div class="um-field" id="capcha-page-cont">
					 <div class="captcha-txtbx">
                        <div class="captcha">
                        <input type="checkbox" aria-label="Checkbox captcha" name="g-recaptcha-response">
                            <img alt="captcha" src="{{'public/assets/imgs/captcha-img.png'}}" class="img-fluid" usemap="#image-map">
                            <map name="image-map">
                                <area target="_blank" alt="Privacy" title="Privacy" href="https://policies.google.com/privacy?hl=en" coords="" shape="rect" class="m-p">
                                <area target="_blank" alt="Terms" title="Terms" href="https://policies.google.com/terms?hl=en" coords="" shape="rect" class="m-t">
                            </map>
                        </div>
						<!-- <div class="g-recaptcha" data-sitekey="6LdMGT0qAAAAAFNG4nl6f8ASTxN5qVxm4-w1J6AY"></div> -->
		    			<br>
						@if($errors->any())
						  @foreach ($errors->all() as $error)
							<div class="alert alert-danger">
							{{ $error }} 
							</div>
						  @endforeach
						@endif						
                    </div> 	 
                    <div style="clear:both;"></div>
                  </div>
               </div>
			   
               <div style="clear:both;"></div>
               <button class="btn btn-lg btn-primary btn-block"
                  type="submit">{{ __('Login') }}</button>
            </form>
         </div>
      </div>
   </div>
</section>


       
<script>
jQuery('#reload').click(function() {
    jQuery.ajax({
        type: 'GET',
        url: "{{ route('reloadCaptcha')}}",
        success: function(data) {
            jQuery(".captchaimg span").html(data.captcha);
        }
    });
});


 
var loginBy = @json($user_type);
console.log('login type', loginBy);
 
$(document).ready(function(){
	
	
		 if(loginBy) 
		 {
			$('input[name="login_by"][value="' + loginBy + '"]').prop('checked', true);
			
				 $('#login_by').val(loginBy);
				 if (loginBy === 'Trainer' || loginBy === 'School') 
				 {
					$('.trainer_login').css('display','block');
					$('.student_login').css('display','none');

					$('#email').attr('required', 'required');
					$('#password').attr('required', 'required');

					$('#student').removeAttr('required');
					$('#birth_date').removeAttr('required');

				 }else 
				{
					$('.student_login').css('display','block');
					$('.trainer_login').css('display','none');

					$('#student').attr('required', 'required');
					$('#birth_date').attr('required', 'required');

					$('#email').removeAttr('required');
					$('#password').removeAttr('required');
					
				}
			
				
		}else{
			$('input[name="login_by"][value="Trainer"]').prop('checked', true);
		}

		$('#student').removeAttr('required');
		$('#birth_date').removeAttr('required');

		$(".login_by").change(function()
		{ 
                //alert($(this).val());
				$("#postion_type_role_id").html($(this).val());
			if ($(this).val() === 'Trainer' || $(this).val() === 'School') 
			{
				
				$('#login_by').val($(this).val());
				$('.trainer_login').css('display','block');
				$('.student_login').css('display','none');

				$('#email').attr('required', 'required');
				$('#password').attr('required', 'required');

				$('#student').removeAttr('required');
				$('#birth_date').removeAttr('required');

			}else 
			{
				$('.student_login').css('display','block');
				$('.trainer_login').css('display','none');

				$('#student').attr('required', 'required');
				$('#birth_date').attr('required', 'required');

				$('#email').removeAttr('required');
				$('#password').removeAttr('required');
				 $('#login_by').val($(this).val());
			}
		});
});

</script>
@endsection