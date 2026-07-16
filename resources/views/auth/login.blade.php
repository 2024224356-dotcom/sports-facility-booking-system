<x-guest-layout>

<form method="POST"
      action="{{ route('login') }}"
      class="form-box">

    @csrf

    @if(session('status'))

        <div style="
            background:#10B981;
            color:white;
            padding:12px;
            border-radius:12px;
            margin-bottom:20px;
            text-align:center;
        ">

            {{ session('status') }}

        </div>

    @endif

    <div class="form-group">

        <i class="fa-solid fa-envelope"></i>

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
            class="form-control"
            placeholder="University Email"
            required
            autofocus>

    </div>

    @error('email')

        <div style="
            color:#F87171;
            margin-top:-15px;
            margin-bottom:15px;
            font-size:14px;
        ">

            {{ $message }}

        </div>

    @enderror

    <div class="form-group">

        <i class="fa-solid fa-lock"></i>

        <input
            id="password"
            type="password"
            name="password"
            class="form-control"
            placeholder="Password"
            required>

        <span
            id="togglePassword"
            style="
                position:absolute;
                right:18px;
                top:18px;
                cursor:pointer;
                color:#9CA3AF;
            ">

            <i class="fa-solid fa-eye"></i>

        </span>

    </div>

    @error('password')

        <div style="
            color:#F87171;
            margin-top:-15px;
            margin-bottom:15px;
            font-size:14px;
        ">

            {{ $message }}

        </div>

    @enderror

    <div class="options">

        <label>

            <input
                type="checkbox"
                name="remember">

            Remember Me

        </label>

    </div>

    <button
    type="submit"
    class="login-btn">

    <i class="fa-solid fa-right-to-bracket"></i>

    &nbsp;

    LOGIN

</button>

</form>

<script>

const toggle=document.getElementById("togglePassword");

const password=document.getElementById("password");

toggle.addEventListener("click",()=>{

if(password.type==="password"){

password.type="text";

toggle.innerHTML='<i class="fa-solid fa-eye-slash"></i>';

}else{

password.type="password";

toggle.innerHTML='<i class="fa-solid fa-eye"></i>';

}

});

</script>

</x-guest-layout>