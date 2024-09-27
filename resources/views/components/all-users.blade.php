<div>
    {{-- Prikaz forme za dodavanje novog korisnika --}}
    {{ $slot }} {{-- Ovo će omogućiti dodavanje sadržaja u komponentu --}}

    {{-- Tabela korisnika --}}
    <h1>All Users</h1>
    <table class="table table-striped" style="table-layout: fixed; width: 100%; text-align: center;">
        <thead>
            <tr>
                <th>Role</th>
                <th>Username</th>
                <th>Email</th>
                <th>Mobile Number</th>
            </tr>
        </thead>
        <tbody>
            @php
                $users = app('App\Models\User')->all();
            @endphp
            @foreach ($users as $user)
                <tr>
                    <td>
                        @if (Bouncer::is($user)->an('admin'))
                            Admin
                        @elseif (Bouncer::is($user)->an('manager'))
                            Manager
                        @else
                            User
                        @endif
                    </td>
                    <td>{{ $user->user_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mobile_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

