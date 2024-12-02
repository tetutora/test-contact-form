@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

<style>
    svg.w-5.h-5 {
        /* paginateメソッドの矢印の大きさ調整のために追加 */
        width: 30px;
        height: 30px;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        width: 60%;
        max-width: 600px;
        margin: auto;
    }
    .modal-close {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }
</style>

@section('content')
<div class="admin-form">
    <div class="form__header">
        <p class="form__header-title">Admin</p>
    </div>
    <div class="search-list">
        <form action="" method="get">
            <div class="search-form">
                <div class="search-form__keyword">
                    <input class="search-keyword" type="search" name="keyword" placeholder="お名前、メールアドレスなどを入力" id="">
                </div>
                <div class="search-select__gender">
                    <select class="select__gender" name="gender" id="">
                        <option value="">性別</option>
                        <option value="1">男性</option>
                        <option value="2">女性</option>
                        <option value="3">その他</option>
                    </select>
                </div>
                <div class="search-select__category">
                    <select class="select__category" name="category" id="">
                        <option value="">お問い合せの種類</option>
                        <option value="1">ご質問</option>
                        <option value="2">ご意見</option>
                        <option value="3">その他</option>
                    </select>
                </div>
                <div class="search-data">
                    <input class="search-date-picker" type="date" name="date" id="date-picker" class="date-picker">
                </div>
                <div class="search__button">
                    <button type="submit" class="search__button-submit">検索</button>
                    <button class="search__button-reset" type="reset" onclick="window.location.href = '{{ url()->current() }}';">リセット</button>

                </div>
            </div>
        </form>
    </div>
    <div class="pagination-container">
        <div class="Pagination">
        {{ $contacts->links() }}
        </div>
    </div>

    <div class="data-table">
        <table class="data-table__inner">
            <tr class="data-table__row">
                <th class="data-table__header">お名前</th>
                <th class="data-table__header">性別</th>
                <th class="data-table__header">メールアドレス</th>
                <th class="data-table__header">お問い合せの種類</th>
                <th class="data-table__header"></th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="data-table__row">
                <td class="data-table__name">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                <td class="data-table__gender">
                    @if ($contact->gender == 1) 男性
                    @elseif ($contact->gender == 2) 女性
                    @else その他
                    @endif
                </td>
                <td class="data-table__email">{{ $contact->email }}</td>
                <td class="data-table__category_id">
                    @if ($contact->category_id == 1) ご質問
                    @elseif ($contact->category_id == 2) ご意見
                    @else その他
                    @endif
                </td>
                <td class="table__button">
                    <button type="button" class="data-table__button" onclick="openModal(this)" data-id="{{ $contact->id }}">詳細</button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<div id="contactModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">閉じる</span>
        <h3>お問い合せ詳細</h3>
        <div id="modalContent">
            <!-- 詳細情報がここに表示されます -->
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function openModal(button) {
    var contactId = button.getAttribute('data-id');

    fetch(`/admin/contacts/${contactId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('ネットワークエラー');
            }
            return response.json();
        })
        .then(data => {
            var modalContent = document.getElementById('modalContent');

            // 性別とカテゴリはすでに文字列で返されるので、直接使用します。
            modalContent.innerHTML = `
                <p><strong>お名前:</strong> ${data.last_name} ${data.first_name}</p>
                <p><strong>性別:</strong> ${data.gender}</p>
                <p><strong>メールアドレス:</strong> ${data.email}</p>
                <p><strong>お問い合せの種類:</strong> ${data.category}</p>
                <p><strong>お問い合わせ内容:</strong> ${data.detail}</p>
            `;
            var modal = document.getElementById('contactModal');
            modal.style.display = 'flex';
        })
        .catch(error => {
            console.error('Error fetching contact details:', error);
            alert('詳細情報の取得に失敗しました');
        });
}



    function closeModal() {
    var modal = document.getElementById('contactModal');
    if (modal) {
        modal.style.display = 'none'; // モーダルを非表示
    }
}

document.getElementById('contactModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeModal(); // 背景クリックでモーダルを閉じる
    }
});

</script>
@endsection
