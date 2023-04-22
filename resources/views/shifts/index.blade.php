@extends('layouts.shiftapp')

@section('content')
    <h1>シフト表</h1>

    @php
    $dates = \App\Models\Shift::dateList();
@endphp

    @foreach($shifts as $store => $employees)
        <h2>{{ $store }}</h2>

        <table id="shiftTable">

            <thead>
                <tr>
                    <th>従業員名</th>
                    @foreach($dates as $date)
                        <th>{{ $date }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee => $shiftData)
                    <tr>
                        <td>{{ $employee }}</td>
                        @foreach($dates as $date)
                            <td>{{ $shiftData[$date] }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <a href="{{ route('employees.information') }}" class="btn btn-primary mr-2">従業員情報画面</a>

    <!-- シフト表の自動生成処理をトリガーするボタンを追加 -->
    <form action="{{ route('shifts.generate') }}" method="post" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-success">シフト表を自動生成</button>
    </form>

@endsection