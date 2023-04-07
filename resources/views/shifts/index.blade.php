@extends('layouts.shiftapp')

@section('content')
    <h1>シフト表</h1>

    <div id="calendar"></div>



    <a href="{{ route('employees.information') }}" class="btn btn-primary mr-2">従業員情報画面</a>

    <!-- シフト表の自動生成処理をトリガーするボタンを追加 -->
    <form action="{{ route('shifts.generate') }}" method="post" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-success">シフト表を自動生成</button>
    </form>
@endsection