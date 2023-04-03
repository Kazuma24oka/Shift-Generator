<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Employee;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::all();
        return view('shifts.index', compact('shifts'));
    }

    public function generate(Request $request)
    {
        // シフト表の自動生成処理を実装します。
        // このサンプルでは、実際のアルゴリズムは省略されています。

        // 1. ユーザーに関連するすべての従業員を取得する
        $employees = Employee::where('user_id', Auth::id())->get();

        // 2. 期間や従業員ごとの制約に基づいてシフト表を自動生成する
        $startDate = new \DateTime(); // 今日の日付を取得
        $endDate = (clone $startDate)->modify('+1 month'); // 1ヶ月後の日付を取得

        while ($startDate <= $endDate) {
            // 休日をスキップ
            if ($startDate->format('N') == 6 || $startDate->format('N') == 7) {
                $startDate->modify('+1 day');
                continue;
            }

            foreach ($employees as $employee) {
                // このサンプルでは、ランダムにシフトを割り当てます。
                // 実際には、従業員の希望に基づいてシフトを割り当てるアルゴリズムを検討してください。
                $startHour = rand(8, 16);
                $endHour = $startHour + rand(4, 8);

                Shift::create([
                    'employee_id' => $employee->id,
                    'date' => $startDate->format('Y-m-d'),
                    'start_time' => sprintf('%02d:00:00', $startHour),
                    'end_time' => sprintf('%02d:00:00', $endHour),
                ]);
            }

            $startDate->modify('+1 day');
        }

        return redirect()->route('shifts.index')->with('success', 'シフト表が自動生成されました。');
    }
    
    public function update(Request $request)
    {
        $shift_id = $request->input('shift_id');
        $date = $request->input('date');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $employee_id = $request->input('employee_id');

        $shift = Shift::find($shift_id);
        if ($shift) {
            $shift->update([
                'date' => $date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'employee_id' => $employee_id,
            ]);

            return redirect()->route('shifts.index')->with('success', 'シフトが更新されました。');
        }

        return redirect()->route('shifts.index')->with('error', 'シフトの更新に失敗しました。');
    }

    public function edit($id)
    {
        $shift = Shift::find($id);
        $employees = Employee::all();
        return view('shifts.edit', compact('shift', 'employees'));
    }

    public function history($id)
    {
        // 以前の自動生成されたシフト表を取得・表示するロジックを実装します。
        // シンプルな履歴機能を実装する場合は、Shiftモデルに生成時刻を追跡するカラムを追加し、
        // そのカラムを使用して過去のシフト表を検索することができます。

        // $shifts = Shift::where('generated_at', '<', $someTimestamp)->get();
        // return view('shiftshistory', compact('shifts'));
    }

    public function save(Request $request)
    {
        $shifts = $request->input('shifts');
        $name = $request->input('name');

        // シフト表の名前とデータを保存します。
        // このサンプルでは、JSON形式でシフトデータを保存しますが、
        // 実際のアプリケーションでは適切なデータ構造に応じて保存方法を変更できます。
        $shiftData = json_encode($shifts);

        // ShiftScheduleモデルを使用してデータベースに保存することを想定しています。
        // ShiftScheduleモデルは、マイグレーションで作成する必要があります。
        // ShiftSchedule::create([
        //     'name' => $name,
        //     'shifts' => $shiftData,
        //     'user_id' => Auth::id(),
        // ]);

        return redirect()->route('shifts.index')->with('success', 'シフト表が保存されました。');
    }
}