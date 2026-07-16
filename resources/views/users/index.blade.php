<x-admin-layout>

<style>

.page-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}

.page-title{
font-size:32px;
font-weight:700;
color:white;
}

.search-box{
display:flex;
gap:15px;
margin-bottom:25px;
}

.search-box input{
background:#111827;
border:none;
color:white;
border-radius:14px;
padding:12px 18px;
width:320px;
}

.search-box input:focus{
outline:none;
box-shadow:0 0 18px rgba(124,58,237,.4);
}

.table-card{
background:#111827;
border-radius:24px;
padding:25px;
box-shadow:0 20px 45px rgba(0,0,0,.35);
}

.table{
color:white;
margin-bottom:0;
}

.table thead{
background:#1F2937;
}

.table tbody td{
background:#111827;
vertical-align:middle;
}

.role-admin{
background:#DC2626;
padding:6px 14px;
border-radius:20px;
font-size:13px;
font-weight:600;
}

.role-student{
background:#059669;
padding:6px 14px;
border-radius:20px;
font-size:13px;
font-weight:600;
}

.btn-add{
background:linear-gradient(135deg,#6D28D9,#8B5CF6);
color:white;
padding:12px 22px;
border-radius:15px;
text-decoration:none;
font-weight:600;
transition:.3s;
}

.btn-add:hover{
color:white;
transform:translateY(-2px);
box-shadow:0 12px 30px rgba(124,58,237,.4);
}

.action-btn{
width:40px;
height:40px;
display:inline-flex;
align-items:center;
justify-content:center;
border-radius:10px;
text-decoration:none;
margin-right:8px;
}

.edit-btn{
background:#2563EB;
color:white;
}

.delete-btn{
background:#DC2626;
color:white;
}

</style>

<div class="page-header">

<div class="page-title">

Users Management

</div>

<a href="{{ route('users.create') }}" class="btn-add">

<i class="fas fa-plus"></i>

Add User

</a>

</div>

<form method="GET">

<div class="search-box">

<input
type="text"
name="search"
value="{{ request('search') }}"
placeholder="Search name, email or student ID">

<button class="btn-purple">

<i class="fas fa-search"></i>

Search

</button>

</div>

</form>

<div class="table-card">

<div class="table-responsive">

<table class="table">

<thead>

<tr>

<th>Name</th>

<th>Student ID</th>

<th>Email</th>

<th>Phone</th>

<th>Role</th>

<th width="150">

Action

</th>

</tr>

</thead>

<tbody>

@forelse($users as $user)

<tr>

<td>{{ $user->name }}</td>

<td>{{ $user->student_id }}</td>

<td>{{ $user->email }}</td>

<td>{{ $user->phone }}</td>

<td>

@if($user->role=="admin")

<span class="role-admin">

Admin

</span>

@else

<span class="role-student">

Student

</span>

@endif

</td>

<td>

<a
href="{{ route('users.edit',$user) }}"
class="action-btn edit-btn">

<i class="fas fa-pen"></i>

</a>

<form
action="{{ route('users.destroy',$user) }}"
method="POST"
style="display:inline;">

@csrf

@method('DELETE')

<button
class="action-btn delete-btn deleteForm">

<i class="fas fa-trash"></i>

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center">

No users found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-4">

{{ $users->links() }}

</div>

</div>

</x-admin-layout>