<!-- Store Create Modal -->
<div class="modal fade" id="storeModal" tabindex="-1" role="dialog" aria-labelledby="storeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="storeModalLabel">店舗を登録する</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="storeForm" action="{{ route('stores.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">店舗名</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                <button type="submit" form="storeForm" class="btn btn-primary">登録する</button>
            </div>
        </div>
    </div>
</div>

<!-- Store Edit Modals -->
@foreach($stores as $store)
    <div class="modal fade" id="storeEditModal{{ $store->id }}" tabindex="-1" role="dialog" aria-labelledby="storeEditModalLabel{{ $store->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="storeEditModalLabel{{ $store->id }}">店舗情報を編集する</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="storeEditForm{{ $store->id }}" action="{{ route('stores.update', ['id' => $store->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">店舗名</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $store->name }}" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    <button type="submit" form="storeEditForm{{ $store->id }}" class="btn btn-warning">編集</button>
                    </form>
                    <form action="{{ route('stores.destroy', ['id' => $store->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endforeach