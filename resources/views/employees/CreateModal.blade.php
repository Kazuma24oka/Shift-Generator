<!-- Employee Create Modal -->
<div class="modal fade" id="employeeCreateModal" tabindex="-1" role="dialog" aria-labelledby="employeeCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeCreateModalLabel">従業員情報を登録する</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="employeeCreateForm" action="{{ route('employees.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">名前</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="min_working_days">最低出勤日数</label>
                        <input type="text" name="min_working_days" id="min_working_days" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="store_id">所属店舗</label>
                        <input type="text" name="store_id" id="store_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="preferred_store_id">優先店舗</label>
                        <input type="text" name="preferred_store_id" id="preferred_store_id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="incompatible_employee_id">相性の悪い従業員ID</label>
                        <input type="text" name="incompatible_employee_id" id="incompatible_employee_id" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">登録する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>