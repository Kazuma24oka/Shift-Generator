@extends('layouts.shiftapp')

@section('content')
    <h1>シフト表</h1>
    <!-- シフト表の表示処理を実装します。 -->
    <!-- ここでは、サンプルとしてテーブル形式でシフト表を表示します。 -->


    
    <table class="table">
        <thead>
            <tr>
                <th>日付</th>
                <th>従業員名</th>
                <th>開始時間</th>
                <th>終了時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shifts as $shift)
                <tr>
                    <td>{{ $shift->date }}</td>
                    <td>{{ $shift->employee->name }}</td>
                    <td>{{ $shift->start_time }}</td>
                    <td>{{ $shift->end_time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button class="btn btn-primary">シフト表を自動生成する</button>
    <a href="{{ route('employees.information') }}" class="btn btn-primary mr-2">従業員情報画面</a>

@endsection