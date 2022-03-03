@extends('layouts.main')

@section('content')
    <div class="container-lg" style="margin: 0 auto;">

        <h2 class="text-center mt-2 mb-2" 
        style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; color:blueviolet"
        >My bookings</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Booking id</th>
                    <th scope="col">Appointment id</th>
                    <th scope="col">Department name</th>
                    <th scope="col">Appointment date</th>
                    <th>Cancel</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <th scope="row">{{ $booking->id }}</th>
                        <td>{{ $booking->appointment_id }}</td>
                        <td>{{ $booking->department_name }}</td>
                        <td>{{$booking->appointment_date }}</td>
                        <td>Please call 9696789678</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
