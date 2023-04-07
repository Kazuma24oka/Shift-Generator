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
        $shifts = Shift::with('employee')->get();

        return view('shifts.index', compact('shifts'));
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

    public function generate(Request $request)
    {
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
                // 従業員の希望出勤日、希望休暇日、および最低出勤日数を考慮してシフトを割り当てるアルゴリズムを実装
                $desiredWorkDays = json_decode($employee->desired_work_days, true);
                $desiredVacationDays = json_decode($employee->desired_vacation_days, true);
                $minimumWorkDays = $employee->minimum_work_days;

                $currentDay = $startDate->format('Y-m-d');

                if (in_array($currentDay, $desiredVacationDays)) {
                    // この日は従業員の希望休暇日なのでシフトを割り当てない
                    continue;
                }

                if (in_array($currentDay, $desiredWorkDays) || rand(0, 1) == 1) {
                    // この日は従業員の希望出勤日またはランダムに決定した出勤日なのでシフトを割り当てる
                    $startHour = rand(8, 16);
                    $endHour = $startHour + rand(4, 8);

                    Shift::create([
                        'employee_id' => $employee->id,
                        'date' => $currentDay,
                        'start_time' => sprintf('%02d:00:00', $startHour),
                        'end_time' => sprintf('%02d:00:00', $endHour),
                    ]);
                }
            }

            $startDate->modify('+1 day');
        }

        return redirect()->route('shifts.index')->with('success', 'シフト表が自動生成されました。');
    }
}