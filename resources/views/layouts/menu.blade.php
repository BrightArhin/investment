<li class="nav-item {{ Request::is('admin/users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="nav-icon icon-people"></i>
        <span>Users</span>
    </a>
</li>

<li class="nav-item {{ Request::is('admin/divisions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.divisions.index') }}">
        <i class="nav-icon icon-organization"></i>
        <span>Divisions</span>
    </a>
</li>
<li class="nav-item {{ Request::is('admin/departments*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.departments.index') }}">
        <i class="nav-icon icon-layers"></i>
        <span>Departments</span>
    </a>
</li>
<li class="nav-item {{ Request::is('admin/departmentDivisions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.departmentDivisions.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Dept Divisions</span>
    </a>
</li>
<li class="nav-item {{ Request::is('admin/members*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.members.index') }}">
        <i class="nav-icon icon-user"></i>
        <span>Members</span>
    </a>
</li>



<li class="nav-item {{ Request::is('admin/transactions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.transactions.index') }}">
        <i class="nav-icon icon-calculator"></i>
        <span>Transactions</span>
    </a>
</li>

<li class="nav-item {{ Request::is('admin/deposits*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.deposits.index') }}">
        <i class="nav-icon icon-wallet"></i>
        <span>Deposits</span>
    </a>
</li>
<li class="nav-item {{ Request::is('admin/withdrawals*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.withdrawals.index') }}">
        <i class="nav-icon icon-wallet"></i>
        <span>Withdrawals</span>
    </a>
</li>

<li class="nav-item {{ Request::is('admin/reports*') ? 'active' : '' }}">
        <div class="dropdown show ">

            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span><i class="nav-icon icon-graph"></i></span> Reports Center
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{{route('admin.reports.member_statement')}}">Member Statement</a>
                <a class="dropdown-item" href="#">Advanced Report </a>
            </div>
        </div>
</li>

