


@foreach($employees as $employee)
    <div class="modal fade" id="employeeEditModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="employeeEditModalLabel{{ $employee->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="employeeEditModalLabel{{ $employee->id }}">従業員情報を編集する</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="employeeEditForm{{ $employee->id }}" action="{{ route('employees.update', ['id' => $employee->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $employee->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="min_working_days">最低出勤日数</label>
                            <input type="text" name="min_working_days" id="min_working_days" class="form-control" value="{{ $employee->min_working_days }}" required>
                        </div>
                        <div class="form-group">
                            <label for="store_id">所属店舗</label>
                            <input type="text" name="store_id" id="store_id" class="form-control" value="{{ $employee->store_id }}" required>
                        </div>
                        <div class="form-group">
                            <label for="preferred_store_id">優先店舗</label>
                            <input type="text" name="preferred_store_id" id="preferred_store_id" class="form-control" value="{{ $employee->preferred_store_id }}">
                        </div>
                        <div class="form-group">
                            <label for="incompatible_employee_id">相性の悪い従業員ID</label>
                            <input type="text" name="incompatible_employee_id" id="incompatible_employee_id" class="form-control" value="{{ $employee->incompatible_employee_id }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    <button type="submit" form="employeeEditForm{{ $employee->id }}" class="btn btn-warning">編集</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Preferred Working Days Edit Modals -->
@foreach($employees as $employee)
    <div class="modal fade" id="workingDaysEditModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="workingDaysEditModalLabel{{ $employee->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="workingDaysEditModalLabel{{ $employee->id }}">出勤希望日を編集する</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="preferredWorkingDaysEditForm{{ $employee->id }}" action="{{ route('employees.updatePreferredWorkingDays', ['employee' => $employee->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="preferred_working_days">出勤希望日</label>
                            <input type="text" name="preferred_working_days" id="preferred_working_days{{ $employee->id }}" class="form-control"  data-input>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    <button type="submit" form="preferredWorkingDaysEditForm{{ $employee->id }}" class="btn btn-info">登録</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Preferred DaysOff Edit Modals -->
@foreach($employees as $employee)
    <div class="modal fade" id="daysOffEditModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="daysOffEditModalLabel{{ $employee->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="daysOffEditModalLabel{{ $employee->id }}">休み希望日を編集する</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="preferredDaysOffEditForm{{ $employee->id }}" action="{{ route('employees.updatePreferredDaysOff', ['employee' => $employee->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="preferred_days_off">休み希望日</label>
                        <input type="text" name="preferred_days_off" id="preferred_days_off{{ $employee->id }}" class="form-control"  data-input>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            <button type="submit" form="preferredDaysOffEditForm{{ $employee->id }}" class="btn btn-info">登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let employeeIds = @json($employees->pluck('id'));

        employeeIds.forEach(function (employeeId) {
            // 出勤希望日のFlatpickr設定
            flatpickr(`#preferred_working_days${employeeId}`, {
                mode: 'multiple',
                dateFormat: 'Y-m-d',
                onChange: function (selectedDates, dateStr) {
                    // 選択された日付を JSON 形式に変換する
                    let jsonDates = selectedDates.map(date => date.toJSON());
                    // JSON 形式の日付を input 要素に設定する
                    document.querySelector(`#preferred_working_days${employeeId}`).value = JSON.stringify(jsonDates);
                }
            });

            // 休み希望日のFlatpickr設定
            flatpickr(`#preferred_days_off${employeeId}`, {
                mode: 'multiple',
                dateFormat: 'Y-m-d',
                onChange: function (selectedDates, dateStr) {
                    // 選択された日付を JSON 形式に変換する
                    let jsonDates = selectedDates.map(date => date.toJSON());
                    // JSON 形式の日付を input 要素に設定する
                    document.querySelector(`#preferred_days_off${employeeId}`).value = JSON.stringify(jsonDates);
                }
            });
        });
    });
    
    // バックエンドから取得した日時データ
const dateTimeUTC = '2022-01-01T00:00:00.000000Z';

// UTCからローカルタイムゾーンに変換する
const dateTimeLocal = new Date(dateTimeUTC);
const offset = new Date().getTimezoneOffset();
const dateTimeLocalAdjusted = new Date(dateTimeLocal.getTime() - (offset * 60 * 1000));

// 変換後の日時データを必要なフォーマットに整形する
const dateTimeFormatted = dateTimeLocalAdjusted.toLocaleString('ja-JP', { timeZoneName: 'short' });

</script>