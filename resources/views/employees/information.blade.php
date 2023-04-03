@extends('layouts.shiftapp')

@section('content')
    <h1>従業員情報</h1>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employeeCreateModal">従業員情報を登録する</button>
    <table class="table mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>出勤希望日</th>
            <th>休み希望日</th>
            <th>最低出勤日数</th>
            <th>所属店舗</th>
            <th>優先店舗</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->name }}</td>
                <td>
                    {{ $employee->preferred_working_days }}
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#workingDaysEditModal{{ $employee->id }}">出勤希望日を編集する</button>
                    <form id="preferredWorkingDaysDeleteForm{{ $employee->id }}" action="{{ route('employees.deletePreferredWorkingDays', ['employee' => $employee->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </td>
                <td>
                    {{ $employee->preferred_days_off }}
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#daysOffEditModal{{ $employee->id }}">休み希望日を編集する</button>
                    <form id="preferredDaysOffDeleteForm{{ $employee->id }}" action="{{ route('employees.deletePreferredDaysOff', ['employee' => $employee->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </td>
                <td>{{ $employee->min_working_days }}</td>
                <td>
                    @if ($employee->store_needs_update)
                        <span class="text-danger">{{ $employee->store->name }} (更新が必要です)</span>
                    @else
                        {{ $employee->store->name }}
                    @endif
                </td>
                <td>{{ $employee->preferred_store->name }}</td>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#employeeEditModal{{ $employee->id }}">編集</button>
                </td>
                <td>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </tr>
        @endforeach
    </tbody>
</table>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeModal">店舗を登録する</button>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>店舗ID</th>
                <th>店舗名</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stores as $store)
                <tr>
                    <td>{{ $store->id }}</td>
                    <td>{{ $store->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('shifts.index') }}" class="btn btn-primary mr-2">シフト表画面</a>


    @include('employees.CreateModal')
    @include('employees.EditModal')
    @include('employees.StoreModal')

@endsection